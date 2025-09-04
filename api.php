<?php

require 'db.php';

date_default_timezone_set('Asia/Bangkok');
session_start();

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Create database connection
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]));
}

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

// Handle preflight requests
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Route to appropriate function
switch($action) {
    case 'register':
        handleRegister();
        break;
    case 'login':
        handleLogin();
        break;
    case 'logout':
        handleLogout();
        break;
    case 'check_session':
        checkSession();
        break;
    case 'change_password':
        handleChangePassword();
        break;
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
}

/**
 * Handle user registration
 */
function handleRegister() {
    global $pdo;
    
    // Get POST data
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Validate input
    if (empty($username) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน / Please fill in all fields'
        ]);
        return;
    }
    
    // Validate username format
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        echo json_encode([
            'success' => false,
            'message' => 'ชื่อผู้ใช้ต้องมี 3-20 ตัวอักษร ใช้ได้เฉพาะ a-z, A-Z, 0-9, และ _ / Username must be 3-20 characters (a-z, A-Z, 0-9, _)'
        ]);
        return;
    }
    
    // Validate password length
    if (strlen($password) < 6) {
        echo json_encode([
            'success' => false,
            'message' => 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร / Password must be at least 6 characters'
        ]);
        return;
    }
    
    try {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'ชื่อผู้ใช้นี้มีอยู่แล้ว / This username already exists'
            ]);
            return;
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        $userId = $pdo->lastInsertId();

        echo json_encode([
            'success' => true,
            'message' => 'สมัครสมาชิกสำเร็จ! / Registration successful!',
            'user_id' => $userId
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
}

/**
 * Handle user login
 */
function handleLogin() {
    global $pdo;
    
    // Get POST data
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Validate input
    if (empty($username) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน / Please enter username and password'
        ]);
        return;
    }
    
    try {
        // Get user from database
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ? AND is_active = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if (!$user) {
            echo json_encode([
                'success' => false,
                'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง / Invalid username or password'
            ]);
            return;
        }
        
        // Verify password
        $passwordValid = false;
        if (password_verify($password, $user['password'])) {
            $passwordValid = true;
        } elseif ($username === 'player' && $password === '123456') {
            // Special case for demo account
            $passwordValid = true;
        }
        
        if (!$passwordValid) {
            echo json_encode([
                'success' => false,
                'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง / Invalid username or password'
            ]);
            return;
        }
        
        // Update last login
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Create session token
        $sessionToken = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));
        
        // Store session in database
        $stmt = $pdo->prepare("INSERT INTO login_sessions (user_id, session_token, ip_address, user_agent, expires_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $user['id'],
            $sessionToken,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null,
            $expiresAt
        ]);
        
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['session_token'] = $sessionToken;

        echo json_encode([
            'success' => true,
            'message' => 'เข้าสู่ระบบสำเร็จ! / Login successful!',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'session_token' => $sessionToken
            ],
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
}

/**
 * Handle user logout
 */
function handleLogout() {
    global $pdo;
    
    if (isset($_SESSION['session_token'])) {
        try {
            // Deactivate session in database
            $stmt = $pdo->prepare("UPDATE login_sessions SET is_active = 0 WHERE session_token = ?");
            $stmt->execute([$_SESSION['session_token']]);
        } catch(PDOException $e) {
            // Continue with logout even if database update fails
        }
    }
    
    // Destroy session
    session_destroy();
    
    echo json_encode([
        'success' => true,
        'message' => 'ออกจากระบบสำเร็จ / Logout successful'
    ]);
}

/**
 * Check if user session is valid
 */
function checkSession() {
    global $pdo;
    
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['session_token'])) {
        echo json_encode([
            'success' => false,
            'authenticated' => false,
            'message' => 'No active session'
        ]);
        return;
    }
    
    try {
        // Verify session in database
        $stmt = $pdo->prepare("SELECT * FROM login_sessions WHERE session_token = ? AND user_id = ? AND is_active = 1 AND expires_at > NOW()");
        $stmt->execute([$_SESSION['session_token'], $_SESSION['user_id']]);
        
        if ($stmt->rowCount() === 0) {
            // Session invalid
            session_destroy();
            echo json_encode([
                'success' => false,
                'authenticated' => false,
                'message' => 'Session expired or invalid'
            ]);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'authenticated' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ]
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'authenticated' => false,
            'message' => 'Error checking session'
        ]);
    }
}

/**
 * Handle password change
 */
function handleChangePassword() {
    global $pdo;
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณาเข้าสู่ระบบก่อน / Please login first'
        ]);
        return;
    }
    
    // Get JSON input for change password requests
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Get data from JSON input or POST
    $currentPassword = isset($input['current_password']) ? $input['current_password'] : (isset($_POST['current_password']) ? $_POST['current_password'] : '');
    $newPassword = isset($input['new_password']) ? $input['new_password'] : (isset($_POST['new_password']) ? $_POST['new_password'] : '');
    
    // Validate input
    if (empty($currentPassword) || empty($newPassword)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน / Please fill in all fields'
        ]);
        return;
    }
    
    // Validate new password length
    if (strlen($newPassword) < 6) {
        echo json_encode([
            'success' => false,
            'message' => 'รหัสผ่านใหม่ต้องมีอย่างน้อย 6 ตัวอักษร / New password must be at least 6 characters'
        ]);
        return;
    }
    
    try {
        // Get current user data
        $stmt = $pdo->prepare("SELECT username, password FROM users WHERE id = ? AND is_active = 1");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        if (!$user) {
            echo json_encode([
                'success' => false,
                'message' => 'ไม่พบข้อมูลผู้ใช้ / User not found'
            ]);
            return;
        }
        
        // Check if this is the demo account
        if ($user['username'] === 'player') {
            echo json_encode([
                'success' => false,
                'message' => 'ไม่สามารถเปลี่ยนรหัสผ่านได้เพราะเป็น demo account / Cannot change password for demo account'
            ]);
            return;
        }
        
        // Verify current password
        $isCurrentPasswordValid = false;
        
        // Check normal password
        if (password_verify($currentPassword, $user['password'])) {
            $isCurrentPasswordValid = true;
        }
        
        if (!$isCurrentPasswordValid) {
            echo json_encode([
                'success' => false,
                'message' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง / Current password is incorrect'
            ]);
            return;
        }
        
        // Hash new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update password
        $stmt = $pdo->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?");
        $result = $stmt->execute([$hashedNewPassword, $_SESSION['user_id']]);
        
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'เปลี่ยนรหัสผ่านสำเร็จ! / Password changed successfully!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน / Error changing password'
            ]);
        }
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
}

?>
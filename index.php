<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ฟังก์ชันตรวจสอบการ login
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// ฟังก์ชันตรวจสอบ session token
function isValidSession() {
    if (!isset($_SESSION['session_token'])) {
        return false;
    }
    
    // ตรวจสอบ session token กับ database (optional - เพิ่มความปลอดภัย)
    // ในที่นี้จะตรวจสอบแค่ว่ามี token หรือไม่
    return true;
}

// ฟังก์ชัน redirect
function redirect($path) {
    header("Location: /$path");
    exit();
}

// ฟังก์ชันแสดงหน้า 404
function show404() {
    http_response_code(404);
    include '404.php';
    exit();
}

// รับ path จาก URL และทำความสะอาด
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = trim($path, '/');
$path = strtolower($path);

// แยก path และ query string
$segments = explode('/', $path);
$route = $segments[0] ?? '';
$subroute = $segments[1] ?? '';
$params = array_slice($segments, 2);

// กำหนด routes
$routes = [
    // Public routes (ไม่ต้อง login)
    'public' => [
        'login',     // หน้า login
        'register',  // หน้าสมัครสมาชิก
        '404'        // หน้า 404
    ],
    
    // Protected routes (ต้อง login)
    'protected' => [
        '',          // หน้าแรก
        'home',      // หน้าหลัก
        'friend',    // เล่นกับเพื่อน
        'ai',        // เล่นกับ AI
        'ai_test',   // ทดสอบ AI
        'profile',   // หน้าโปรไฟล์
        'settings',  // หน้าตั้งค่า
        'logout',     // logout
		'stats'
    ],
    
    // API routes (จัดการแยก)
    'api' => [
        'api.php',
		'stats_api.php',
        'api',
		'stats_api',
    ]
];

// ตรวจสอบว่าเป็น API request หรือไม่
if (in_array($route, $routes['api']) || strpos($route, 'api/') === 0) {
    // ถ้าเป็น api.php ให้ include โดยตรง
    if (file_exists('api.php')) {
        include 'api.php';
        exit();
    }
}

// ตรวจสอบว่าเป็น .php file ที่เข้าผ่าน URL ตรงๆ หรือไม่
if (strpos($path, '.php') !== false && $path !== 'api.php') {
    // ถ้าพยายามเข้า PHP files โดยตรง (ยกเว้น api.php)
    // ให้ตัด .php ออกและ redirect
    $cleanPath = str_replace('.php', '', $path);
    redirect($cleanPath);
}

// ตรวจสอบว่าเป็น static file หรือไม่
$static_extensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf'];
$extension = pathinfo($path, PATHINFO_EXTENSION);
if (in_array($extension, $static_extensions)) {
    // ให้ Apache/Nginx จัดการ static files
    return false;
}

// จัดการ route พิเศษ
switch($route) {
    case 'logout':
        // จัดการ logout
        if (isset($_SESSION['session_token'])) {
            // อาจเพิ่มการอัพเดท database ที่นี่
        }
        session_destroy();
        redirect('login');
        break;
        
    case 'api':
    case 'api.php':
        // ให้ไปที่ api.php
        include 'api.php';
        exit();
        break;
		
    case 'stats_api':
    case 'stats_api.php':
        // ให้ไปที่ api.php
        include 'stats_api.php';
        exit();
        break;
		
    case 'ai':
        // จัดการ AI route พิเศษ - รองรับ /ai/easy, /ai/medium, /ai/hard, /ai/extreme
        if (!isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $request_uri;
            $_SESSION['login_message'] = 'กรุณาเข้าสู่ระบบก่อนเข้าใช้งาน / Please login first';
            redirect('login');
        }
        
        // ตรวจสอบระดับความยาก
        $validDifficulties = ['easy', 'medium', 'hard', 'extreme'];
        $difficulty = 'medium'; // เปลี่ยน default เป็น medium
        
        // ลำดับการรับค่า difficulty
        // 1. จาก query parameter (?diff=extreme)
        if (isset($_GET['diff']) && in_array(strtolower(trim($_GET['diff'])), $validDifficulties)) {
            $difficulty = strtolower(trim($_GET['diff']));
            error_log("AI route: difficulty from GET['diff']: $difficulty");
        }
        // 2. จาก URL path (/ai/extreme)
        elseif ($subroute && in_array($subroute, $validDifficulties)) {
            $difficulty = $subroute;
            // ตั้งค่า GET parameter สำหรับ ai.php
            $_GET['diff'] = $difficulty;
            error_log("AI route: difficulty from URL path: $difficulty");
        }
        // 3. ใช้ default
        else {
            // ถ้าไม่มีทั้งสองแบบ ให้ตั้งค่า GET parameter
            $_GET['diff'] = $difficulty;
            error_log("AI route: using default difficulty: $difficulty");
        }
        
        error_log("AI route: final difficulty = $difficulty, GET['diff'] = " . $_GET['diff']);
        
        // Include ai.php
        include 'ai.php';
        exit();
        break;
}

// ตรวจสอบว่า route นี้ต้องการ authentication หรือไม่
$isPublicRoute = in_array($route, $routes['public']);
$isProtectedRoute = in_array($route, $routes['protected']);
$isApiRoute = in_array($route, $routes['api']);

// ถ้าไม่ใช่ route ที่รู้จัก และไม่ใช่ API
if (!$isPublicRoute && !$isProtectedRoute && !$isApiRoute) {
    show404();
}

// ถ้าเป็น protected route ให้ตรวจสอบ login
if ($isProtectedRoute && !isLoggedIn()) {
    // เก็บ URL ที่พยายามจะเข้าไว้ใน session
    $_SESSION['redirect_after_login'] = $request_uri;
    
    // แสดง message ถ้าพยายามเข้า protected page
    $_SESSION['login_message'] = 'กรุณาเข้าสู่ระบบก่อนเข้าใช้งาน / Please login first';
    
    redirect('login');
}

// ตรวจสอบว่า user ที่ login แล้วพยายามเข้าหน้า login/register หรือไม่
if (isLoggedIn() && ($route === 'login' || $route === 'register')) {
    redirect('home');
}

// Map routes to files
$routeMap = [
    'login' => 'login.php',
    'register' => 'register.php',
    'home' => 'home.php',
    'friend' => 'friend.php',
    'ai' => 'ai.php',
    'ai_test' => 'ai_test.php',
    'profile' => 'profile.php',
    'settings' => 'settings.php',
    '404' => '404.php',
	'stats' => 'stats.php'
];

// ตรวจสอบว่ามี route mapping หรือไม่
if (isset($routeMap[$route])) {
    $file = $routeMap[$route];
    
    // ตรวจสอบว่าไฟล์มีอยู่จริงหรือไม่
    if (file_exists($file)) {
        // เพิ่ม security headers
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
        
        // Include the file
        include $file;
        exit();
    }
}

// ถ้าไม่พบ route ให้แสดง 404
show404();
?>
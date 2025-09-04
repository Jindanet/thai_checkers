<?php

require 'db.php';

date_default_timezone_set('Asia/Bangkok');

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

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

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
}

switch($action) {
    case 'save_game_result':
        saveGameResult();
        break;
    case 'get_leaderboard':
        getLeaderboard();
        break;
    case 'get_player_stats':
        getPlayerStats();
        break;
    case 'get_my_ranking':
        getMyRanking();
        break;
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
}

/**
 * บันทึกผลเกม
 */
function saveGameResult() {
    global $pdo;
    
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
        echo json_encode([
            'success' => false,
            'message' => 'User not logged in'
        ]);
        return;
    }
    
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $game_mode = isset($_POST['game_mode']) ? $_POST['game_mode'] : '';
    $result = isset($_POST['result']) ? $_POST['result'] : '';
    $game_duration = isset($_POST['game_duration']) ? (int)$_POST['game_duration'] : 0;
    $moves_count = isset($_POST['moves_count']) ? (int)$_POST['moves_count'] : 0;
    $pieces_captured = isset($_POST['pieces_captured']) ? (int)$_POST['pieces_captured'] : 0;
    $pieces_lost = isset($_POST['pieces_lost']) ? (int)$_POST['pieces_lost'] : 0;
    $kings_promoted = isset($_POST['kings_promoted']) ? (int)$_POST['kings_promoted'] : 0;
    $game_start_time = isset($_POST['game_start_time']) ? $_POST['game_start_time'] : date('Y-m-d H:i:s');
    $game_end_time = isset($_POST['game_end_time']) ? $_POST['game_end_time'] : date('Y-m-d H:i:s');
    
    // Validate input
    if (empty($game_mode) || empty($result)) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields'
        ]);
        return;
    }
    
    if (!in_array($game_mode, ['ai_easy', 'ai_medium', 'ai_hard', 'ai_extreme'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid game mode'
        ]);
        return;
    }
    
    if (!in_array($result, ['win', 'lose'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid result'
        ]);
        return;
    }
    
    try {
        $pdo->beginTransaction();
        
        // บันทึกสถิติเกม
        $stmt = $pdo->prepare("
            INSERT INTO game_statistics (
                user_id, username, game_mode, result, game_duration, 
                moves_count, pieces_captured, pieces_lost, kings_promoted,
                game_start_time, game_end_time
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $user_id, $username, $game_mode, $result, $game_duration,
            $moves_count, $pieces_captured, $pieces_lost, $kings_promoted,
            $game_start_time, $game_end_time
        ]);
        
        // อัปเดต Leaderboard ถ้าเป็นการชนะ
        if ($result === 'win') {
            // fastest win
            $difficulty = str_replace('ai_', '', $game_mode);
            $fastest_type = 'fastest_win_' . $difficulty;
            
            // ตรวจสอบว่ามีสถิติเดิมหรือไม่
            $stmt = $pdo->prepare("SELECT score FROM leaderboards WHERE user_id = ? AND leaderboard_type = ?");
            $stmt->execute([$user_id, $fastest_type]);
            $existing = $stmt->fetch();
            
            if ($existing) {
                // อัปเดตถ้าเวลาใหม่เร็วกว่า
                if ($game_duration < $existing['score']) {
                    $stmt = $pdo->prepare("
                        UPDATE leaderboards 
                        SET score = ?, moves_count = ?, game_date = ?, last_updated = NOW()
                        WHERE user_id = ? AND leaderboard_type = ?
                    ");
                    $stmt->execute([$game_duration, $moves_count, $game_end_time, $user_id, $fastest_type]);
                }
            } else {
                // เพิ่มสถิติใหม่
                $stmt = $pdo->prepare("
                    INSERT INTO leaderboards (leaderboard_type, user_id, username, score, moves_count, game_date)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$fastest_type, $user_id, $username, $game_duration, $moves_count, $game_end_time]);
            }
            
            // most wins
            $most_wins_type = 'most_wins_' . $difficulty;
            $stmt = $pdo->prepare("SELECT score FROM leaderboards WHERE user_id = ? AND leaderboard_type = ?");
            $stmt->execute([$user_id, $most_wins_type]);
            $existing_wins = $stmt->fetch();
            
            if ($existing_wins) {
                // เพิ่มจำนวนชนะ
                $stmt = $pdo->prepare("
                    UPDATE leaderboards 
                    SET score = score + 1, game_date = ?, last_updated = NOW()
                    WHERE user_id = ? AND leaderboard_type = ?
                ");
                $stmt->execute([$game_end_time, $user_id, $most_wins_type]);
            } else {
                // เพิ่มสถิติใหม่
                $stmt = $pdo->prepare("
                    INSERT INTO leaderboards (leaderboard_type, user_id, username, score, game_date)
                    VALUES (?, ?, ?, 1, ?)
                ");
                $stmt->execute([$most_wins_type, $user_id, $username, $game_end_time]);
            }
        }
        
        $pdo->commit();
        
        // ดึงข้อมูลสถิติใหม่ของผู้เล่น
        $stats = getPlayerStatsData($user_id);
        
        echo json_encode([
            'success' => true,
            'message' => 'Game result saved successfully',
            'player_stats' => $stats
        ]);
        
    } catch(PDOException $e) {
        $pdo->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Error saving game result: ' . $e->getMessage()
        ]);
    }
}

/**
 * ดึงตารางอันดับ
 */
function getLeaderboard() {
    global $pdo;
    
    $board_type = isset($_GET['type']) ? $_GET['type'] : 'fastest_wins_hard';
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
    
    // ตรวจสอบ type ที่ถูกต้อง
    $valid_types = [
        'fastest_wins_easy', 'fastest_wins_medium', 'fastest_wins_hard', 'fastest_wins_extreme',
        'most_wins_easy', 'most_wins_medium', 'most_wins_hard', 'most_wins_extreme'
    ];
    
    if (!in_array($board_type, $valid_types)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid leaderboard type'
        ]);
        return;
    }
    
    try {
        if (strpos($board_type, 'fastest_wins') === 0) {
            // ตารางอันดับเวลาเร็วที่สุด
            $difficulty = str_replace('fastest_wins_', '', $board_type);
            $leaderboard_type = 'fastest_win_' . $difficulty;
            
            $stmt = $pdo->prepare("
                SELECT 
                    username,
                    score as time_seconds,
                    moves_count,
                    game_date as achieved_date
                FROM leaderboards 
                WHERE leaderboard_type = ?
                ORDER BY score ASC
                LIMIT ?
            ");
            $stmt->bindValue(1, $leaderboard_type, PDO::PARAM_STR);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            
        } else {
            // ตารางอันดับชนะมากที่สุด
            $difficulty = str_replace('most_wins_', '', $board_type);
            $leaderboard_type = 'most_wins_' . $difficulty;
            
            // ดึงข้อมูลชนะมากที่สุด พร้อมเวลาเร็วที่สุด
            $fastest_type = 'fastest_win_' . $difficulty;
            
            $stmt = $pdo->prepare("
                SELECT 
                    mw.username,
                    mw.score as total_wins,
                    fw.score as fastest_time,
                    mw.game_date as latest_win
                FROM leaderboards mw
                LEFT JOIN leaderboards fw ON mw.user_id = fw.user_id AND fw.leaderboard_type = ?
                WHERE mw.leaderboard_type = ?
                ORDER BY mw.score DESC, COALESCE(fw.score, 999999) ASC
                LIMIT ?
            ");
            $stmt->bindValue(1, $fastest_type, PDO::PARAM_STR);
            $stmt->bindValue(2, $leaderboard_type, PDO::PARAM_STR);
            $stmt->bindValue(3, $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        $leaderboard = $stmt->fetchAll();
        
        // เพิ่มอันดับให้แต่ละรายการ
        foreach ($leaderboard as $index => &$entry) {
            $entry['ranking'] = $index + 1;
        }
        
        // จัดรูปแบบข้อมูล
        foreach ($leaderboard as &$entry) {
            if (isset($entry['time_seconds'])) {
                $entry['formatted_time'] = formatTime($entry['time_seconds']);
            }
            if (isset($entry['fastest_time']) && $entry['fastest_time']) {
                $entry['formatted_fastest_time'] = formatTime($entry['fastest_time']);
            }
            if (isset($entry['achieved_date'])) {
                $entry['formatted_date'] = date('d/m/Y H:i', strtotime($entry['achieved_date']));
            }
            if (isset($entry['latest_win'])) {
                $entry['formatted_latest_win'] = date('d/m/Y H:i', strtotime($entry['latest_win']));
            }
        }
        
        echo json_encode([
            'success' => true,
            'leaderboard_type' => $board_type,
            'data' => $leaderboard,
            'total_entries' => count($leaderboard)
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching leaderboard: ' . $e->getMessage()
        ]);
    }
}

/**
 * ดึงสถิติของผู้เล่น
 */
function getPlayerStats() {
    global $pdo;
    
    $target_user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
    
    if (!$target_user_id) {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'User not logged in'
            ]);
            return;
        }
        $target_user_id = $_SESSION['user_id'];
    }
    
    try {
        $stats = getPlayerStatsData($target_user_id);
        
        if (!$stats) {
            echo json_encode([
                'success' => false,
                'message' => 'Player not found or no games played'
            ]);
            return;
        }
        
        echo json_encode([
            'success' => true,
            'stats' => $stats
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching player stats: ' . $e->getMessage()
        ]);
    }
}

/**
 * ดึงอันดับของผู้เล่นปัจจุบัน
 */
function getMyRanking() {
    global $pdo;
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'User not logged in'
        ]);
        return;
    }
    
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    
    try {
        $rankings = [];
        
        $leaderboard_types = [
            'fastest_win_easy', 'fastest_win_medium', 'fastest_win_hard', 'fastest_win_extreme',
            'most_wins_easy', 'most_wins_medium', 'most_wins_hard', 'most_wins_extreme'
        ];
        
        foreach ($leaderboard_types as $type) {
            if (strpos($type, 'fastest_win') === 0) {
                $stmt = $pdo->prepare("
                    SELECT COUNT(*) + 1 as ranking 
                    FROM leaderboards 
                    WHERE leaderboard_type = ? AND score < (
                        SELECT score FROM leaderboards 
                        WHERE leaderboard_type = ? AND user_id = ?
                    )
                ");
                $stmt->execute([$type, $type, $user_id]);
            } else {
                $stmt = $pdo->prepare("
                    SELECT COUNT(*) + 1 as ranking 
                    FROM leaderboards 
                    WHERE leaderboard_type = ? AND score > (
                        SELECT score FROM leaderboards 
                        WHERE leaderboard_type = ? AND user_id = ?
                    )
                ");
                $stmt->execute([$type, $type, $user_id]);
            }
            
            $result = $stmt->fetch();
            $rankings[$type] = $result ? $result['ranking'] : null;
        }
        
        echo json_encode([
            'success' => true,
            'username' => $username,
            'rankings' => $rankings
        ]);
        
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching rankings: ' . $e->getMessage()
        ]);
    }
}

/**
 * ฟังก์ชันช่วยในการดึงสถิติผู้เล่น
 */
function getPlayerStatsData($user_id) {
    global $pdo;
    
    try {
        // ดึงสถิติรวม
        $stmt = $pdo->prepare("
            SELECT 
                u.username,
                COUNT(gs.id) as total_games,
                SUM(CASE WHEN gs.result = 'win' THEN 1 ELSE 0 END) as total_wins,
                SUM(CASE WHEN gs.result = 'lose' THEN 1 ELSE 0 END) as total_losses,
                ROUND(SUM(CASE WHEN gs.result = 'win' THEN 1 ELSE 0 END) * 100.0 / COUNT(gs.id), 2) as win_percentage,
                SUM(CASE WHEN gs.result = 'win' AND gs.game_mode = 'ai_easy' THEN 1 ELSE 0 END) as wins_easy,
                SUM(CASE WHEN gs.result = 'win' AND gs.game_mode = 'ai_medium' THEN 1 ELSE 0 END) as wins_medium,
                SUM(CASE WHEN gs.result = 'win' AND gs.game_mode = 'ai_hard' THEN 1 ELSE 0 END) as wins_hard,
                SUM(CASE WHEN gs.result = 'win' AND gs.game_mode = 'ai_extreme' THEN 1 ELSE 0 END) as wins_extreme,
                AVG(gs.game_duration) as avg_game_duration,
                SUM(gs.game_duration) as total_play_time,
                MAX(gs.game_end_time) as last_played
            FROM users u
            LEFT JOIN game_statistics gs ON u.id = gs.user_id
            WHERE u.id = ?
            GROUP BY u.id, u.username
        ");
        $stmt->execute([$user_id]);
        $stats = $stmt->fetch();
        
        if (!$stats || $stats['total_games'] == 0) {
            return null;
        }
        
        // ดึงเวลาเร็วที่สุดในแต่ละระดับ
        $difficulties = ['easy', 'medium', 'hard', 'extreme'];
        foreach ($difficulties as $difficulty) {
            $leaderboard_type = 'fastest_win_' . $difficulty;
            $stmt = $pdo->prepare("SELECT score FROM leaderboards WHERE user_id = ? AND leaderboard_type = ?");
            $stmt->execute([$user_id, $leaderboard_type]);
            $fastest = $stmt->fetch();
            $stats['fastest_' . $difficulty] = $fastest ? $fastest['score'] : null;
        }
        
        // จัดรูปแบบเวลา
        foreach ($difficulties as $difficulty) {
            $key = 'fastest_' . $difficulty;
            if ($stats[$key]) {
                $stats['formatted_' . $key] = formatTime($stats[$key]);
            }
        }
        
        $stats['formatted_avg_duration'] = formatTime($stats['avg_game_duration']);
        $stats['formatted_total_time'] = formatTime($stats['total_play_time']);
        
        if ($stats['last_played']) {
            $stats['formatted_last_played'] = date('d/m/Y H:i', strtotime($stats['last_played']));
        }
        
        return $stats;
        
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * จัดรูปแบบเวลา
 */
function formatTime($seconds) {
    if (!$seconds) return '-';
    
    $seconds = floor($seconds);
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $secs = $seconds % 60;
    
    if ($hours > 0) {
        return sprintf('%d:%02d:%02d', $hours, $minutes, $secs);
    } else {
        return sprintf('%d:%02d', $minutes, $secs);
    }
}
?>
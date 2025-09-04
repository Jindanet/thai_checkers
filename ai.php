<?php
// ตรวจสอบ session
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}

// รับระดับความยาก - แก้ไขการรับค่า
$difficulty = 'medium'; // default

// ลองรับจากหลายแหล่ง
if (isset($_GET['diff']) && !empty($_GET['diff'])) {
    $inputDifficulty = trim(strtolower($_GET['diff']));
    error_log("Input difficulty from GET['diff']: '$inputDifficulty'");
    
    $validDifficulties = ['easy', 'medium', 'hard', 'extreme'];
    
    if (in_array($inputDifficulty, $validDifficulties)) {
        $difficulty = $inputDifficulty;
        error_log("Valid difficulty set to: '$difficulty'");
    } else {
        error_log("Invalid difficulty '$inputDifficulty', keeping default 'medium'");
    }
} else {
    error_log("No difficulty parameter found, using default 'medium'");
}

// Debug: แสดงค่าสุดท้าย
error_log("Final difficulty value: '$difficulty'");

// Map difficulty to Thai names
$difficultyNames = [
    'easy' => 'ง่าย',
    'medium' => 'ปานกลาง', 
    'hard' => 'ยาก',
    'extreme' => 'โหดมากๆ'
];

$difficultyName = $difficultyNames[$difficulty];
error_log("Difficulty name: '$difficultyName'");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เล่นกับ AI <?php echo $difficultyName; ?> - หมากฮอสไทย</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="/ai.css?<?= time() ?>">
</head>
<body>
    <div class="game-container shimmer">
        <div class="header">
            <h1 class="title">🤖 เล่นกับ AI</h1>
            <div class="ai-difficulty-badge difficulty-<?php echo $difficulty; ?>">
                AI ระดับ<?php echo $difficultyName; ?>
            </div>
            <p class="subtitle">Play against AI - <?php echo ucfirst($difficulty); ?> Mode</p>
        </div>
        
        <div class="game-info">
            <div class="player-info">
                <div class="player-name">🔴 คุณ</div>
                <div class="pieces-count" id="player-pieces">8 ตัว</div>
            </div>
            <div class="current-turn" id="current-turn">ตาคุณ</div>
            <div class="player-info">
                <div class="player-name">⚫ AI <?php echo $difficultyName; ?></div>
                <div class="pieces-count" id="ai-pieces">8 ตัว</div>
            </div>
        </div>
        <div class="ai-thinking" id="ai-thinking">
        </div>
        
        <div class="board" id="board"></div>
        
        <div class="controls">
            <button class="btn primary" onclick="newGame()">🎮 เริ่มเกมใหม่ / New Game</button>
            <button class="btn" onclick="changeDifficulty()">🎯 เปลี่ยนระดับ / Change Level</button><!--
            <button class="btn" onclick="showLeaderboard()">🏆 ตารางอันดับ / Leaderboard</button>
            <button class="btn" onclick="showMyStats()">📊 สถิติของฉัน / My Stats</button>-->
            <button class="btn" onclick="goToMenu()">🏠 เมนู / Menu</button><!--
            <button class="btn" id="autoPlayBtn" onclick="toggleAutoPlay()">🤖 Auto Test Play</button>-->
			<div id="autoPlayIndicator" class="auto-play-indicator">
				🤖 กำลังเล่นอัตโนมัติ… / Auto Playing…
			</div>
        </div>
        
        <div class="move-history">
            <h3>📝 ประวัติการเดิน / Move History</h3>
            <div class="move-list" id="move-list">
                <div style="text-align: center; color: #666; font-style: italic;">เกมยังไม่เริ่ม / Game not started</div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        const currentDifficulty = '<?php echo $difficulty; ?>';
        console.log('=== PHP TO JS DEBUG ===');
        console.log('PHP difficulty variable: "<?php echo $difficulty; ?>"');
        console.log('PHP difficulty name: "<?php echo $difficultyName; ?>"');
        console.log('JS currentDifficulty:', currentDifficulty);
        console.log('Current URL:', window.location.href);
        console.log('URL search params:', window.location.search);
        
        // ตรวจสอบ URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        console.log('URL diff parameter:', urlParams.get('diff'));
        console.log('========================');
    </script>
    <script src="/ai.js?<?= time() ?>"></script>
	
	<script src="/ai_difficulty.js?<?= time() ?>"></script>
</body>
</html>
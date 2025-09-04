<?php
// ตั้งค่า timezone เป็นเวลาไทย
date_default_timezone_set('Asia/Bangkok');

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}
// ตรวจสอบการล็อกอิน (อาจปรับแต่งตามระบบของคุณ)
$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : 'player';

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>🏆 ตารางอันดับ - หมากฮอสไทย</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Fredoka:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
        }

        body {
            font-family: 'Fredoka', 'Kanit', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 8px;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 8px;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.98);
            padding: 20px 16px;
            border-radius: 16px;
            margin-bottom: 16px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .title {
            font-size: clamp(1.5rem, 8vw, 3.5rem);
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            animation: gradientShift 8s ease infinite;
            line-height: 1.2;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .subtitle {
            font-size: clamp(0.9rem, 4vw, 1.2rem);
            color: #666;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .user-info {
            margin-top: 12px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
            font-size: clamp(0.8rem, 3.5vw, 1rem);
        }

        /* Navigation Buttons */
        .nav-container {
            background: rgba(255, 255, 255, 0.98);
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 12px 16px;
            border: none;
            border-radius: 12px;
            font-family: 'Fredoka', sans-serif;
            font-size: clamp(0.8rem, 3.5vw, 1rem);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
            text-align: center;
            min-height: 48px;
        }

        .nav-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s;
        }

        .nav-btn:hover:before {
            left: 100%;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .nav-btn:active {
            transform: translateY(0);
        }

        .nav-btn.secondary {
            background: linear-gradient(135deg, #fd746c, #ff9068);
            box-shadow: 0 4px 15px rgba(253, 116, 108, 0.4);
        }

        .nav-btn.secondary:hover {
            box-shadow: 0 6px 20px rgba(253, 116, 108, 0.6);
        }

        .nav-btn.tertiary {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }

        .nav-btn.tertiary:hover {
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.6);
        }

        .nav-btn.quaternary {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            color: #333;
            box-shadow: 0 4px 15px rgba(168, 237, 234, 0.4);
        }

        .nav-btn.quaternary:hover {
            box-shadow: 0 6px 20px rgba(168, 237, 234, 0.6);
        }

        /* Controls */
        .controls {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .control-group label {
            font-weight: 600;
            color: #333;
            font-size: clamp(0.85rem, 3.5vw, 1rem);
        }

        select {
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-family: 'Kanit', sans-serif;
            font-size: clamp(0.85rem, 3.5vw, 1rem);
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Leaderboard Container */
        .leaderboard-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            backdrop-filter: blur(10px);
        }

        .leaderboard-title {
            font-size: clamp(1.1rem, 5vw, 2rem);
            font-weight: 700;
            color: #333;
            margin-bottom: 16px;
            text-align: center;
            padding: 12px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            line-height: 1.3;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 12px;
            -webkit-overflow-scrolling: touch;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 320px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            font-size: clamp(0.7rem, 3vw, 0.9rem);
        }

        .leaderboard-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-weight: 600;
            font-size: clamp(0.7rem, 3vw, 1rem);
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .leaderboard-table td {
            padding: 10px 6px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 500;
            font-size: clamp(0.65rem, 2.8vw, 0.85rem);
            transition: all 0.3s ease;
            word-break: break-word;
        }

        .leaderboard-table tbody tr:nth-child(even) {
            background: rgba(102, 126, 234, 0.03);
        }

        .leaderboard-table tbody tr:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        /* Ranking Styles */
        .rank-1 { 
            color: #FFD700; 
            font-weight: 700; 
            font-size: clamp(0.8rem, 3.5vw, 1.2rem);
            text-shadow: 1px 1px 2px rgba(255, 215, 0, 0.3);
        }
        .rank-2 { 
            color: #C0C0C0; 
            font-weight: 700; 
            font-size: clamp(0.75rem, 3.2vw, 1.1rem);
            text-shadow: 1px 1px 2px rgba(192, 192, 192, 0.3);
        }
        .rank-3 { 
            color: #CD7F32; 
            font-weight: 700; 
            font-size: clamp(0.75rem, 3.2vw, 1.1rem);
            text-shadow: 1px 1px 2px rgba(205, 127, 50, 0.3);
        }

        /* Loading and No Data */
        .loading, .no-data {
            text-align: center;
            padding: 32px 16px;
            color: #666;
            font-size: clamp(1rem, 4vw, 1.2rem);
            font-weight: 500;
            line-height: 1.4;
        }

        .no-data {
            color: #999;
            font-style: italic;
        }

        /* Stats Card */
        .stats-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .stats-card h3 {
            font-size: clamp(1.1rem, 4.5vw, 1.4rem);
            text-align: center;
            margin-bottom: 16px;
            color: #333;
            font-weight: 700;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .stat-item {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 16px 12px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-item .stat-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            font-size: clamp(0.7rem, 3vw, 0.9rem);
            line-height: 1.2;
        }

        .stat-item .stat-value {
            font-weight: 700;
            color: #667eea;
            font-size: clamp(0.8rem, 3.5vw, 1.1rem);
            margin-bottom: 4px;
        }

        .stat-item .stat-player {
            font-size: clamp(0.65rem, 2.5vw, 0.8rem);
            color: #666;
            font-weight: 500;
            line-height: 1.2;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
            padding: 16px;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 20px;
            max-width: 100%;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        .modal-title {
            font-size: clamp(1.3rem, 5vw, 2rem);
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            font-weight: 700;
            line-height: 1.2;
        }

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .modal-card {
            padding: 20px;
            border-radius: 16px;
            color: white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .modal-card h3 {
            margin: 0 0 12px 0;
            font-size: clamp(1rem, 4vw, 1.3rem);
            font-weight: 700;
        }

        .modal-card p {
            margin: 6px 0;
            font-size: clamp(0.85rem, 3.5vw, 1rem);
            line-height: 1.4;
            font-weight: 500;
        }

        .modal-close {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: clamp(0.9rem, 3.5vw, 1.1rem);
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            display: block;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Mobile Specific Styles */
        @media (max-width: 768px) {
            html {
                font-size: 14px;
            }

            body {
                padding: 4px;
            }

            .container {
                padding: 0 4px;
            }

            .header {
                padding: 16px 12px;
                margin-bottom: 12px;
            }

            .nav-container {
                padding: 12px;
                margin-bottom: 12px;
            }

            .nav-buttons {
                gap: 8px;
                margin-bottom: 12px;
            }

            .nav-btn {
                padding: 10px 12px;
                gap: 4px;
                min-height: 44px;
            }

            .controls {
                gap: 10px;
                margin-bottom: 12px;
            }

            .leaderboard-container {
                padding: 12px;
                margin-bottom: 12px;
            }

            .leaderboard-title {
                padding: 10px;
                margin-bottom: 12px;
            }

            .leaderboard-table th {
                padding: 8px 4px;
            }

            .leaderboard-table td {
                padding: 8px 4px;
            }

            .stats-card {
                padding: 12px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .stat-item {
                padding: 12px 8px;
            }

            .modal-content {
                padding: 16px;
                margin: 8px;
            }

            .modal-grid {
                gap: 12px;
                margin-bottom: 16px;
            }

            .modal-card {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            html {
                font-size: 13px;
            }

            .nav-buttons {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .leaderboard-table {
                min-width: 280px;
            }

            .leaderboard-table th,
            .leaderboard-table td {
                padding: 6px 3px;
            }
        }

        @media (max-width: 320px) {
            html {
                font-size: 12px;
            }

            .container {
                padding: 0 2px;
            }

            .header, .nav-container, .leaderboard-container, .stats-card {
                padding: 8px;
            }

            .leaderboard-table {
                min-width: 260px;
            }
        }

        /* Landscape Mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .header {
                padding: 12px;
                margin-bottom: 8px;
            }

            .nav-container {
                padding: 10px;
                margin-bottom: 8px;
            }

            .nav-buttons {
                grid-template-columns: repeat(4, 1fr);
                gap: 6px;
                margin-bottom: 8px;
            }

            .nav-btn {
                padding: 8px;
                min-height: 36px;
            }

            .modal-content {
                max-height: 85vh;
            }
        }

        /* Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }

        /* Touch improvements */
        .nav-btn, .modal-close, select {
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        /* Prevent zoom on input focus */
        @media (max-width: 768px) {
            select {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="title">🏆 ตารางอันดับ</h1>
            <p class="subtitle">Leaderboard - หมากฮอสไทย</p>
            <?php if ($isLoggedIn): ?>
                <div class="user-info">
                    👋 สวัสดี <?php echo htmlspecialchars($username); ?>!
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <div class="nav-container">
            <div class="nav-buttons">
                <a href="/ai" class="nav-btn secondary">
                    🎮 เล่นเกม
                </a>
                <a href="/home" class="nav-btn tertiary">
                    🏠 หน้าหลัก
                </a>
                <?php if ($isLoggedIn): ?>
                    <button class="nav-btn" onclick="showMyStats()">
                        📊 สถิติของฉัน
                    </button>
                <?php else: ?>
                    <a href="/login" class="nav-btn quaternary">
                        🔐 เข้าสู่ระบบ
                    </a>
                <?php endif; ?>
                <button class="nav-btn" onclick="loadLeaderboard()">
                    🔄 โหลดข้อมูลใหม่
                </button>
            </div>

            <!-- Controls -->
            <div class="controls">
                <div class="control-group">
                    <label for="categorySelect">📋 ประเภทตารางอันดับ:</label>
                    <select id="categorySelect">
                        <optgroup label="⚡ ชนะเร็วที่สุด">
                            <option value="fastest_wins_easy">🟢 AI ง่าย</option>
                            <option value="fastest_wins_medium">🟡 AI ปานกลาง</option>
                            <option value="fastest_wins_hard" selected>🔴 AI ยาก</option>
                            <option value="fastest_wins_extreme">🟣 AI โหดมากๆ</option>
                        </optgroup>
                        <optgroup label="🎯 ชนะมากที่สุด">
                            <option value="most_wins_easy">🟢 AI ง่าย (จำนวนชนะ)</option>
                            <option value="most_wins_medium">🟡 AI ปานกลาง (จำนวนชนะ)</option>
                            <option value="most_wins_hard">🔴 AI ยาก (จำนวนชนะ)</option>
                            <option value="most_wins_extreme">🟣 AI โหดมากๆ (จำนวนชนะ)</option>
                        </optgroup>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="limitSelect">🔢 จำนวนที่แสดง:</label>
                    <select id="limitSelect">
                        <option value="10">Top 10</option>
                        <option value="20" selected>Top 20</option>
                        <option value="50">Top 50</option>
                        <option value="100">Top 100</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Leaderboard -->
        <div class="leaderboard-container">
            <div class="leaderboard-title" id="leaderboardTitle">
                🔴 AI ยาก - ชนะเร็วที่สุด
            </div>
            
            <div class="table-container">
                <div id="leaderboardContent">
                    <div class="loading">
                        🔄 กำลังโหลดข้อมูล...
                    </div>
                </div>
            </div>
        </div>

        <!-- System Stats -->
        <div class="stats-card">
            <h3>📈 สถิติรวมของระบบ</h3>
            <div id="systemStats" class="stats-grid">
                <div class="loading">กำลังโหลด...</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        let currentLeaderboard = 'fastest_wins_hard';
        let currentLimit = 20;
        const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

        // โหลดข้อมูลเมื่อหน้าเว็บโหลดเสร็จ
        window.addEventListener('load', function() {
            loadLeaderboard();
            loadSystemStats();
        });

        // โหลดตารางอันดับ
        async function loadLeaderboard() {
            const categorySelect = document.getElementById('categorySelect');
            const limitSelect = document.getElementById('limitSelect');
            const content = document.getElementById('leaderboardContent');
            const title = document.getElementById('leaderboardTitle');
            
            currentLeaderboard = categorySelect.value;
            currentLimit = parseInt(limitSelect.value);
            
            content.innerHTML = '<div class="loading">🔄 กำลังโหลดข้อมูล...</div>';
            
            // อัปเดตชื่อหัวข้อ
            const titles = {
                'fastest_wins_easy': '🟢 AI ง่าย - ชนะเร็วที่สุด',
                'fastest_wins_medium': '🟡 AI ปานกลาง - ชนะเร็วที่สุด',
                'fastest_wins_hard': '🔴 AI ยาก - ชนะเร็วที่สุด',
                'fastest_wins_extreme': '🟣 AI โหดมากๆ - ชนะเร็วที่สุด',
                'most_wins_easy': '🟢 AI ง่าย - ชนะมากที่สุด',
                'most_wins_medium': '🟡 AI ปานกลาง - ชนะมากที่สุด',
                'most_wins_hard': '🔴 AI ยาก - ชนะมากที่สุด',
                'most_wins_extreme': '🟣 AI โหดมากๆ - ชนะมากที่สุด'
            };
            
            title.textContent = titles[currentLeaderboard] || 'ตารางอันดับ';
            
            try {
                const response = await fetch(`/stats_api.php?action=get_leaderboard&type=${currentLeaderboard}&limit=${currentLimit}`);
                const data = await response.json();
                
                if (data.success && data.data.length > 0) {
                    let html = '<table class="leaderboard-table">';
                    html += '<thead><tr>';
                    
                    if (currentLeaderboard.startsWith('fastest_wins')) {
                        html += '<th>🏅</th>';
                        html += '<th>👤</th>';
                        html += '<th>⏱️</th>';
                        html += '<th>👣</th>';
                        html += '<th>📅</th>';
                    } else {
                        html += '<th>🏅</th>';
                        html += '<th>👤</th>';
                        html += '<th>🏆</th>';
                        html += '<th>⚡</th>';
                        html += '<th>📅</th>';
                    }
                    
                    html += '</tr></thead><tbody>';
                    
                    data.data.forEach((entry, index) => {
                        let rankClass = '';
                        let rankIcon = '';
                        
                        if (entry.ranking === 1) {
                            rankClass = 'rank-1';
                            rankIcon = '🥇';
                        } else if (entry.ranking === 2) {
                            rankClass = 'rank-2';
                            rankIcon = '🥈';
                        } else if (entry.ranking === 3) {
                            rankClass = 'rank-3';
                            rankIcon = '🥉';
                        }
                        
                        html += `<tr>`;
                        
                        if (currentLeaderboard.startsWith('fastest_wins')) {
                            html += `<td class="${rankClass}">${rankIcon} ${entry.ranking}</td>`;
                            html += `<td><strong>${entry.username}</strong></td>`;
                            html += `<td style="color: #667eea; font-weight: bold;">${entry.formatted_time}</td>`;
                            html += `<td>${entry.moves_count}</td>`;
                            html += `<td style="font-size: 0.8em; color: #666;">${formatDateMobile(entry.formatted_date)}</td>`;
                        } else {
                            html += `<td class="${rankClass}">${rankIcon} ${entry.ranking}</td>`;
                            html += `<td><strong>${entry.username}</strong></td>`;
                            html += `<td style="color: #27ae60; font-weight: bold;">${entry.total_wins}</td>`;
                            html += `<td style="color: #667eea;">${entry.formatted_fastest_time || '-'}</td>`;
                            html += `<td style="font-size: 0.8em; color: #666;">${formatDateMobile(entry.formatted_latest_win)}</td>`;
                        }
                        
                        html += '</tr>';
                    });
                    
                    html += '</tbody></table>';
                    content.innerHTML = html;
                } else {
                    content.innerHTML = '<div class="no-data">😔 ยังไม่มีข้อมูลในตารางอันดับนี้<br><small>เริ่มเล่นเกมเพื่อสร้างสถิติกันเถอะ!</small></div>';
                }
            } catch (error) {
                content.innerHTML = '<div class="no-data" style="color: #e74c3c;">❌ เกิดข้อผิดพลาดในการโหลดข้อมูล<br><small>กรุณาลองใหม่อีกครั้ง</small></div>';
                console.error('Error loading leaderboard:', error);
            }
        }

        // ฟังก์ชันจัดรูปแบบวันที่สำหรับ mobile
        function formatDateMobile(dateStr) {
            if (!dateStr) return '-';
            // แปลง "01/02/2025 14:30" เป็น "01/02"
            return dateStr.split(' ')[0].substring(0, 5);
        }

        // โหลดสถิติรวมของระบบ
        async function loadSystemStats() {
            const statsContent = document.getElementById('systemStats');
            
            try {
                // ดึงข้อมูลจากหลายๆ leaderboard
                const types = ['fastest_wins_easy', 'fastest_wins_medium', 'fastest_wins_hard', 'fastest_wins_extreme'];
                const promises = types.map(type => 
                    fetch(`/stats_api.php?action=get_leaderboard&type=${type}&limit=1`)
                        .then(res => res.json())
                );
                
                const results = await Promise.all(promises);
                
                let html = '';
                const typeLabels = {
                    'fastest_wins_easy': '🟢 AI ง่าย',
                    'fastest_wins_medium': '🟡 AI ปานกลาง',
                    'fastest_wins_hard': '🔴 AI ยาก',
                    'fastest_wins_extreme': '🟣 AI โหดมากๆ'
                };
                
                results.forEach((result, index) => {
                    const type = types[index];
                    const label = typeLabels[type];
                    
                    if (result.success && result.data.length > 0) {
                        const record = result.data[0];
                        html += `
                            <div class="stat-item">
                                <div class="stat-label">${label}</div>
                                <div style="font-size: 0.8em; color: #666; margin: 4px 0;">สถิติดีที่สุด</div>
                                <div class="stat-value">${record.formatted_time}</div>
                                <div class="stat-player">โดย ${record.username}</div>
                            </div>
                        `;
                    } else {
                        html += `
                            <div class="stat-item">
                                <div class="stat-label">${label}</div>
                                <div style="font-size: 0.8em; color: #999; margin: 4px 0;">ยังไม่มีข้อมูล</div>
                                <div class="stat-value">-</div>
                            </div>
                        `;
                    }
                });
                
                statsContent.innerHTML = html;
            } catch (error) {
                statsContent.innerHTML = '<div style="color: #e74c3c; text-align: center; font-size: 0.9em;">ไม่สามารถโหลดสถิติระบบได้</div>';
                console.error('Error loading system stats:', error);
            }
        }

        // แสดงสถิติส่วนตัว
        async function showMyStats() {
            if (!isLoggedIn) {
                showToast('กรุณาเข้าสู่ระบบก่อนดูสถิติ', 'warning');
                return;
            }

            try {
                const response = await fetch('/stats_api.php?action=get_player_stats');
                const data = await response.json();
                
                if (!data.success) {
                    showToast('ไม่สามารถโหลดสถิติได้: ' + (data.message || 'Unknown error'), 'error');
                    return;
                }
                
                const stats = data.stats;
                if (!stats) {
                    showToast('คุณยังไม่เคยเล่นเกม', 'info');
                    return;
                }
                
                // สร้าง modal แสดงสถิติ
                const modal = document.createElement('div');
                modal.className = 'modal';
                
                modal.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-title">📊 สถิติของ ${stats.username}</div>
                        
                        <div class="modal-grid">
                            <!-- สถิติรวม -->
                            <div class="modal-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                <h3>🎮 สถิติรวม</h3>
                                <p>เกมทั้งหมด: <strong>${stats.total_games || 0}</strong></p>
                                <p>ชนะ: <strong style="color: #90EE90;">${stats.total_wins || 0}</strong></p>
                                <p>แพ้: <strong style="color: #FFB6C1;">${stats.total_losses || 0}</strong></p>
                                <p>เปอร์เซ็นต์ชนะ: <strong>${stats.win_percentage || 0}%</strong></p>
                                <p>เวลาเล่นรวม: <strong>${stats.formatted_total_time || '-'}</strong></p>
                            </div>
                            
                            <!-- การชนะแต่ละระดับ -->
                            <div class="modal-card" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                                <h3>🏆 การชนะแต่ละระดับ</h3>
                                <p>🟢 AI ง่าย: <strong>${stats.wins_easy || 0}</strong></p>
                                <p>🟡 AI ปานกลาง: <strong>${stats.wins_medium || 0}</strong></p>
                                <p>🔴 AI ยาก: <strong>${stats.wins_hard || 0}</strong></p>
                                <p>🟣 AI โหดมากๆ: <strong>${stats.wins_extreme || 0}</strong></p>
                            </div>
                            
                            <!-- เวลาเร็วที่สุด -->
                            <div class="modal-card" style="background: linear-gradient(135deg, #ffecd2, #fcb69f); color: #333;">
                                <h3>⚡ เวลาเร็วที่สุด</h3>
                                <p>🟢 AI ง่าย: <strong>${stats.formatted_fastest_easy || 'ยังไม่ชนะ'}</strong></p>
                                <p>🟡 AI ปานกลาง: <strong>${stats.formatted_fastest_medium || 'ยังไม่ชนะ'}</strong></p>
                                <p>🔴 AI ยาก: <strong>${stats.formatted_fastest_hard || 'ยังไม่ชนะ'}</strong></p>
                                <p>🟣 AI โหดมากๆ: <strong>${stats.formatted_fastest_extreme || 'ยังไม่ชนะ'}</strong></p>
                            </div>
                            
                            <!-- ข้อมูลเพิ่มเติม -->
                            <div class="modal-card" style="background: linear-gradient(135deg, #a8edea, #fed6e3); color: #333;">
                                <h3>📈 ข้อมูลเพิ่มเติม</h3>
                                <p>เวลาเฉลี่ย/เกม: <strong>${stats.formatted_avg_duration || '-'}</strong></p>
                                <p>เล่นล่าสุด: <strong>${stats.formatted_last_played || 'ไม่มีข้อมูล'}</strong></p>
                            </div>
                        </div>
                        
                        <button class="modal-close" onclick="closeStatsModal()">
                            ปิด
                        </button>
                    </div>
                `;
                
                document.body.appendChild(modal);
                
                // ฟังก์ชันปิด modal
                window.closeStatsModal = function() {
                    modal.remove();
                    delete window.closeStatsModal;
                };
                
                // ปิด modal เมื่อคลิกพื้นหลัง
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeStatsModal();
                    }
                });
                
                // ปิด modal เมื่อกด Escape
                const handleEscape = function(e) {
                    if (e.key === 'Escape') {
                        closeStatsModal();
                        document.removeEventListener('keydown', handleEscape);
                    }
                };
                document.addEventListener('keydown', handleEscape);
                
            } catch (error) {
                console.error('Error showing stats:', error);
                showToast('เกิดข้อผิดพลาดในการโหลดสถิติ: ' + error.message, 'error');
            }
        }

        // ฟังก์ชันแสดง Toast
        function showToast(message, type = 'info') {
            const styles = {
                info: "linear-gradient(135deg, #667eea, #764ba2)",
                success: "linear-gradient(135deg, #11998e, #38ef7d)",
                warning: "linear-gradient(135deg, #FFD700, #FFA500)",
                error: "linear-gradient(135deg, #fd746c, #ff9068)"
            };
            
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                style: {
                    background: styles[type] || styles.info,
                    borderRadius: "12px",
                    fontSize: "14px",
                    fontFamily: "'Kanit', sans-serif",
                    fontWeight: "600",
                    boxShadow: "0 8px 24px rgba(102, 126, 234, 0.3)",
                    padding: "10px 16px"
                }
            }).showToast();
        }

        // ฟังก์ชันรีเฟรชข้อมูล
        function refreshData() {
            loadLeaderboard();
            loadSystemStats();
            showToast('โหลดข้อมูลใหม่แล้ว', 'success');
        }

        // อัปเดตอัตโนมัติทุก 30 วินาที
        setInterval(() => {
            loadLeaderboard();
            loadSystemStats();
        }, 30000);

        // Event listeners
        document.getElementById('categorySelect').addEventListener('change', loadLeaderboard);
        document.getElementById('limitSelect').addEventListener('change', loadLeaderboard);

        // เพิ่ม keyboard shortcuts (เฉพาะ desktop)
        if (window.innerWidth > 768) {
            document.addEventListener('keydown', function(e) {
                // กด R เพื่อรีเฟรช
                if (e.key === 'r' || e.key === 'R') {
                    if (!e.ctrlKey && !e.metaKey) {
                        e.preventDefault();
                        refreshData();
                    }
                }
                // กด S เพื่อดูสถิติ (ถ้าล็อกอินแล้ว)
                if ((e.key === 's' || e.key === 'S') && isLoggedIn) {
                    if (!e.ctrlKey && !e.metaKey) {
                        e.preventDefault();
                        showMyStats();
                    }
                }
            });
        }

        // แสดงข้อความต้อนรับ
        window.addEventListener('load', function() {
            setTimeout(() => {
                if (isLoggedIn) {
                    showToast('ยินดีต้อนรับสู่ตารางอันดับ! 🎉', 'success');
                } else {
                    showToast('ดูตารางอันดับได้แล้ว! เข้าสู่ระบบเพื่อดูสถิติส่วนตัว', 'info');
                }
            }, 500);
        });

        // ตรวจสอบการเชื่อมต่อ
        window.addEventListener('online', function() {
            showToast('เชื่อมต่ออินเทอร์เน็ตแล้ว', 'success');
            refreshData();
        });

        window.addEventListener('offline', function() {
            showToast('ขาดการเชื่อมต่ออินเทอร์เน็ต', 'warning');
        });

        // จัดการ orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                // รีเฟรช layout หลังจากหมุนหน้าจอ
                window.scrollTo(0, 0);
            }, 100);
        });

        // จัดการ resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // ปรับ layout หลังจาก resize
                if (window.innerWidth <= 480) {
                    document.documentElement.style.fontSize = '13px';
                } else if (window.innerWidth <= 768) {
                    document.documentElement.style.fontSize = '14px';
                } else {
                    document.documentElement.style.fontSize = '16px';
                }
            }, 250);
        });

        // Prevent double tap zoom on iOS
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function (event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    </script>
</body>
</html
<?php
// ตรวจสอบ session
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่า - หมากฮอสไทย</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(135deg, #FFE5F1, #E5F3FF, #F0E5FF);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .settings-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        
        .settings-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .title {
            font-size: 2.5em;
            font-weight: 700;
            background: linear-gradient(45deg, #FF6B9D, #4FACFE, #9B59B6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #666;
            font-size: 1.1em;
        }
        
        .settings-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.3em;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .setting-item {
            background: linear-gradient(135deg, rgba(255, 107, 157, 0.05), rgba(79, 172, 254, 0.05));
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }
        
        .setting-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .setting-label {
            font-weight: 500;
            color: #333;
        }
        
        .setting-description {
            font-size: 0.85em;
            color: #666;
            margin-top: 5px;
        }
        
        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #ccc;
            transition: .4s;
            border-radius: 30px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background: linear-gradient(135deg, #FF6B9D, #4FACFE);
        }
        
        input:checked + .slider:before {
            transform: translateX(30px);
        }
        
        /* Select dropdown */
        .select-wrapper {
            position: relative;
        }
        
        select {
            appearance: none;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 10px 40px 10px 15px;
            font-size: 1em;
            font-family: 'Kanit', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        select:hover {
            border-color: #FF6B9D;
        }
        
        select:focus {
            outline: none;
            border-color: #4FACFE;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.2);
        }
        
        .select-wrapper::after {
            content: '▼';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #666;
        }
        
        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }
        
        .btn {
            flex: 1;
            background: linear-gradient(135deg, #FF6B9D, #4FACFE);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Kanit', sans-serif;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .btn.secondary {
            background: linear-gradient(135deg, #9B59B6, #66BB6A);
        }
        
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        @media (max-width: 768px) {
            .settings-container {
                padding: 30px 20px;
            }
            
            .buttons {
                flex-direction: column;
            }
            
            .setting-item {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <div class="settings-header">
            <h1 class="title">⚙️ ตั้งค่า</h1>
            <p class="subtitle">Settings</p>
        </div>
        
        <div class="settings-section">
            <h2 class="section-title">🎮 การเล่นเกม</h2>
            
            <div class="setting-item">
                <div>
                    <div class="setting-label">เสียงเอฟเฟกต์</div>
                    <div class="setting-description">เปิด/ปิดเสียงในเกม</div>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="soundEnabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="setting-item">
                <div>
                    <div class="setting-label">ดนตรีประกอบ</div>
                    <div class="setting-description">เปิด/ปิดเพลงพื้นหลัง</div>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="musicEnabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <!--
        <div class="settings-section">
            <h2 class="section-title">🎨 การแสดงผล</h2>
            
            <div class="setting-item">
                <div>
                    <div class="setting-label">ธีม</div>
                    <div class="setting-description">เลือกธีมสีของเกม</div>
                </div>
                <div class="select-wrapper">
                    <select id="theme">
                        <option value="pastel" selected>พาสเทล</option>
                        <option value="dark">มืด</option>
                        <option value="classic">คลาสสิก</option>
                        <option value="ocean">ทะเล</option>
                    </select>
                </div>
            </div>
            
            <div class="setting-item">
                <div>
                    <div class="setting-label">แอนิเมชัน</div>
                    <div class="setting-description">เปิด/ปิดการเคลื่อนไหว</div>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="animationsEnabled" checked>
                    <span class="slider"></span>
                </label>
            </div>
        </div>-->
        <!--
        <div class="settings-section">
            <h2 class="section-title">🗑️ ข้อมูล</h2>
            
            <div class="setting-item" onclick="clearGameData()" style="cursor: pointer;">
                <div>
                    <div class="setting-label">ล้างข้อมูลเกม</div>
                    <div class="setting-description">ลบสถิติและประวัติการเล่นทั้งหมด</div>
                </div>
                <span style="color: #FF6B6B;">🗑️</span>
            </div>
        </div>-->
        
        <div class="buttons">
            <button class="btn" onclick="saveSettings()">💾 บันทึกการตั้งค่า</button>
            <button class="btn secondary" onclick="window.location.href='/home'">🏠 กลับหน้าหลัก</button>
        </div>
    </div>
    
    <div class="toast" id="toast"></div>
    
    <script>
        // โหลดการตั้งค่าปัจจุบัน
        function loadSettings() {
            const settings = JSON.parse(localStorage.getItem('gameSettings') || '{}');
            
            // ตั้งค่าเริ่มต้น
            const defaultSettings = {
                soundEnabled: true,
                musicEnabled: true,
                aiDifficulty: 'hard',
                theme: 'pastel',
                animationsEnabled: true
            };
            
            // รวมการตั้งค่า
            const currentSettings = { ...defaultSettings, ...settings };
            
            // อัพเดท UI
            document.getElementById('soundEnabled').checked = currentSettings.soundEnabled;
            document.getElementById('musicEnabled').checked = currentSettings.musicEnabled;
            document.getElementById('aiDifficulty').value = currentSettings.aiDifficulty;
            document.getElementById('theme').value = currentSettings.theme;
            document.getElementById('animationsEnabled').checked = currentSettings.animationsEnabled;
        }
        
        // บันทึกการตั้งค่า
        function saveSettings() {
            const settings = {
                soundEnabled: document.getElementById('soundEnabled').checked,
                musicEnabled: document.getElementById('musicEnabled').checked,
                aiDifficulty: document.getElementById('aiDifficulty').value,
                theme: document.getElementById('theme').value,
                animationsEnabled: document.getElementById('animationsEnabled').checked
            };
            
            // บันทึกลง localStorage
            localStorage.setItem('gameSettings', JSON.stringify(settings));
            
            // แสดงข้อความสำเร็จ
            showToast('บันทึกการตั้งค่าเรียบร้อย!', 'success');
            
            // อัพเดทธีมทันที
            applyTheme(settings.theme);
        }
        
        // ล้างข้อมูลเกม
        function clearGameData() {
            if (confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลเกมทั้งหมด?\n\nสถิติและประวัติการเล่นทั้งหมดจะถูกลบและไม่สามารถกู้คืนได้')) {
                // ลบข้อมูลสถิติ
                localStorage.removeItem('thaiCheckersStats');
                localStorage.removeItem('gameHistory');
                
                showToast('ลบข้อมูลเกมเรียบร้อย!', 'warning');
            }
        }
        
        // แสดง toast notification
        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = 'toast show';
            
            // เพิ่มสีตามประเภท
            if (type === 'success') {
                toast.style.background = 'linear-gradient(135deg, #66BB6A, #4CAF50)';
                toast.style.color = 'white';
            } else if (type === 'warning') {
                toast.style.background = 'linear-gradient(135deg, #FFA726, #FF7043)';
                toast.style.color = 'white';
            } else if (type === 'error') {
                toast.style.background = 'linear-gradient(135deg, #EF5350, #E53935)';
                toast.style.color = 'white';
            }
            
            // ซ่อนหลังจาก 3 วินาที
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        
        // Apply theme
        function applyTheme(themeName) {
            const themes = {
                pastel: {
                    background: 'linear-gradient(135deg, #FFE5F1, #E5F3FF, #F0E5FF)',
                    primary: '#FF6B9D',
                    secondary: '#4FACFE'
                },
                dark: {
                    background: 'linear-gradient(135deg, #1a1a2e, #16213e, #0f3460)',
                    primary: '#e94560',
                    secondary: '#0f3460'
                },
                classic: {
                    background: 'linear-gradient(135deg, #8B4513, #D2691E, #DEB887)',
                    primary: '#8B4513',
                    secondary: '#D2691E'
                },
                ocean: {
                    background: 'linear-gradient(135deg, #006994, #00A8CC, #00CED1)',
                    primary: '#006994',
                    secondary: '#00CED1'
                }
            };
            
            const theme = themes[themeName] || themes.pastel;
            document.body.style.background = theme.background;
            document.body.style.backgroundSize = '400% 400%';
            
            // อัพเดทสี CSS variables ถ้าต้องการ
            document.documentElement.style.setProperty('--primary', theme.primary);
            document.documentElement.style.setProperty('--secondary', theme.secondary);
        }
        
        // โหลดการตั้งค่าเมื่อเปิดหน้า
        window.addEventListener('load', () => {
            loadSettings();
            
            // Apply current theme
            const settings = JSON.parse(localStorage.getItem('gameSettings') || '{}');
            if (settings.theme) {
                applyTheme(settings.theme);
            }
        });
        
        // ตรวจจับการเปลี่ยนธีมแบบ real-time
        document.getElementById('theme').addEventListener('change', function() {
            applyTheme(this.value);
        });
        
        // ตรวจจับการเปลี่ยน animation setting
        document.getElementById('animationsEnabled').addEventListener('change', function() {
            if (!this.checked) {
                document.body.style.animation = 'none';
                document.querySelectorAll('*').forEach(el => {
                    el.style.animation = 'none';
                    el.style.transition = 'none';
                });
            } else {
                // รีโหลดหน้าเพื่อเปิด animation ใหม่
                location.reload();
            }
        });
    </script>
</body>
</html>
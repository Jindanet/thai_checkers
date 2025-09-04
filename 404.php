<?php
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
    <title>404 - ไม่พบหน้าที่ต้องการ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(135deg, #FFE5F1, #E5F3FF, #F0E5FF, #FFFACD);
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
        
        .error-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        
        .error-icon {
            font-size: 6em;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
        
        .error-code {
            font-size: 5em;
            font-weight: 700;
            background: linear-gradient(45deg, #FF6B9D, #4FACFE, #9B59B6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            line-height: 1;
        }
        
        .error-title {
            font-size: 2em;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .error-message {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        
        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            background: linear-gradient(135deg, #FF6B9D, #4FACFE);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-family: 'Kanit', sans-serif;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }
        
        .btn.secondary {
            background: linear-gradient(135deg, #9B59B6, #66BB6A);
        }
        
        .lost-pieces {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .floating-piece {
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FF6B9D, #4FACFE);
            opacity: 0.1;
            animation: float-around 20s infinite linear;
        }
        
        @keyframes float-around {
            from {
                transform: translateY(100vh) rotate(0deg);
            }
            to {
                transform: translateY(-100px) rotate(360deg);
            }
        }
        
        .floating-piece:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 18s; }
        .floating-piece:nth-child(2) { left: 30%; animation-delay: 3s; animation-duration: 22s; }
        .floating-piece:nth-child(3) { left: 50%; animation-delay: 6s; animation-duration: 20s; }
        .floating-piece:nth-child(4) { left: 70%; animation-delay: 9s; animation-duration: 24s; }
        .floating-piece:nth-child(5) { left: 90%; animation-delay: 12s; animation-duration: 19s; }
        
        @media (max-width: 768px) {
            .error-container {
                padding: 40px 30px;
            }
            
            .error-code {
                font-size: 4em;
            }
            
            .error-title {
                font-size: 1.5em;
            }
            
            .error-icon {
                font-size: 4em;
            }
            
            .buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="lost-pieces">
        <div class="floating-piece"></div>
        <div class="floating-piece"></div>
        <div class="floating-piece"></div>
        <div class="floating-piece"></div>
        <div class="floating-piece"></div>
    </div>
    
    <div class="error-container">
        <div class="error-icon">🎯</div>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">อุ๊ปส์! หลงทางแล้ว</h2>
        <p class="error-message">
            ดูเหมือนว่าตัวหมากของเราจะเดินผิดช่อง<br>
            หน้าที่คุณกำลังหาไม่มีอยู่จริง หรืออาจถูกย้ายไปแล้ว
        </p>
        <div class="buttons">
            <a href="/home" class="btn">🏠 กลับหน้าหลัก</a>
            <button class="btn secondary" onclick="goBack()">↩️ ย้อนกลับ</button>
        </div>
    </div>
    
    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/home';
            }
        }
        
        // สร้าง effect ตัวหมากลอย
        function createFloatingPiece() {
            const piece = document.createElement('div');
            piece.className = 'floating-piece';
            piece.style.left = Math.random() * 100 + '%';
            piece.style.animationDelay = Math.random() * 5 + 's';
            piece.style.animationDuration = (15 + Math.random() * 10) + 's';
            document.querySelector('.lost-pieces').appendChild(piece);
            
            // ลบออกหลังจาก animation จบ
            setTimeout(() => {
                piece.remove();
            }, 25000);
        }
        
        // สร้างตัวหมากใหม่ทุก 5 วินาที
        setInterval(createFloatingPiece, 5000);
    </script>
</body>
</html>
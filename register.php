<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - หมากฮอสไทย</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background: linear-gradient(135deg, #FFB5E8, #B5DEFF, #B5FFE8, #FFFFB5, #FFD1B5);
            background-size: 400% 400%;
            animation: gradientMove 25s ease infinite;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            /* GPU acceleration */
            will-change: background-position;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Performance optimizations for low-end devices */
        @media (max-width: 768px), (max-height: 600px), (-webkit-max-device-pixel-ratio: 1) {
            .register-container::before,
            .register-container {
                animation: none;
            }
            
            body {
                background: linear-gradient(135deg, #FFB5E8, #B5DEFF);
                background-attachment: fixed;
                animation-duration: 60s;
                animation-iteration-count: 1;
            }
            
            .checker-piece {
                animation-duration: 8s;
                animation-iteration-count: 3;
            }
            
            .register-btn {
                background: linear-gradient(135deg, #FF6B9D, #45B7D1);
                animation: none;
            }
        }
        
        /* Reduce motion for better performance */
        @media (prefers-reduced-motion: reduce), (max-width: 480px) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.1s !important;
            }
            
            .register-container::before {
                display: none;
            }
            
            body {
                background: linear-gradient(135deg, #FFB5E8, #B5DEFF);
                animation: none;
            }
        }
        
        .register-container {
            background: linear-gradient(145deg, #E8F5FF, #F0E8FF, #E8FFE8);
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 40px;
            padding: 50px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 30px rgba(255, 182, 193, 0.3);
            max-width: 480px;
            width: 100%;
            color: #4A5568;
            position: relative;
            overflow: hidden;
            /* GPU acceleration */
            will-change: transform;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        .register-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(45deg);
            animation: shine 4s infinite;
        }
        
        @keyframes shine {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .header {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
            z-index: 2;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .checkers-pieces {
            display: flex;
            gap: 5px;
        }
        
        .checker-piece {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 3px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 12px;
            animation: bounce 2s infinite;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* GPU acceleration */
            will-change: transform;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        .checker-piece:nth-child(1) {
            background: linear-gradient(135deg, #FFB6C1, #FFC0CB);
            animation-delay: 0s;
        }
        
        .checker-piece:nth-child(2) {
            background: linear-gradient(135deg, #87CEEB, #98D8E8);
            animation-delay: 0.2s;
        }
        
        .checker-piece:nth-child(3) {
            background: linear-gradient(135deg, #98FB98, #90EE90);
            animation-delay: 0.4s;
        }
        
        .checker-piece:nth-child(4) {
            background: linear-gradient(135deg, #F0E68C, #FFFFE0);
            animation-delay: 0.6s;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .logo-text {
            font-size: 2.2em;
            font-weight: 700;
            color: #6B46C1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .title {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #FF6B9D, #45B7D1, #96CEB4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
            position: relative;
            z-index: 2;
        }
        
        .subtitle {
            font-size: 1em;
            color: #6B46C1;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }
        
        .form-label {
            display: block;
            font-size: 1em;
            font-weight: 600;
            margin-bottom: 8px;
            color: #8B5CF6;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 25px;
            font-size: 1em;
            font-family: 'Noto Sans Thai', sans-serif;
            background: linear-gradient(135deg, rgba(255, 240, 245, 0.9), rgba(240, 248, 255, 0.9));
            color: #4A5568;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .form-input::placeholder {
            color: #9CA3AF;
            opacity: 1;
            font-weight: 500;
        }
        
        .form-input:focus {
            outline: none;
            background: linear-gradient(135deg, #FFF0F5, #F0F8FF);
            border-color: #FF69B4;
            color: #4A5568;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.3), 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .form-input.error {
            border-color: #FF6B9D;
            background: linear-gradient(135deg, rgba(255, 107, 157, 0.1), rgba(255, 192, 203, 0.1));
            color: #4A5568;
        }
        
        .form-input.success {
            border-color: #96CEB4;
            background: linear-gradient(135deg, rgba(150, 206, 180, 0.1), rgba(144, 238, 144, 0.1));
            color: #4A5568;
        }
        
        .error-message {
            color: #FF6B9D;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
            font-weight: 500;
        }
        
        .success-message {
            color: #96CEB4;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
            font-weight: 500;
        }
        
        .password-strength {
            margin-top: 8px;
            margin-bottom: 15px;
            font-size: 0.85em;
        }
        
        .strength-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            margin: 5px 0;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: all 0.3s ease;
            width: 0%;
        }
        
        .strength-weak .strength-fill {
            background: linear-gradient(135deg, #FF6B9D, #FF8FA3);
            width: 33%;
        }
        
        .strength-medium .strength-fill {
            background: linear-gradient(135deg, #FECA57, #FFD93D);
            width: 66%;
        }
        
        .strength-strong .strength-fill {
            background: linear-gradient(135deg, #96CEB4, #90EE90);
            width: 100%;
        }
        
        .register-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #FF6B9D, #45B7D1, #96CEB4, #FECA57);
            background-size: 300% 300%;
            animation: gradientShift 3s ease infinite;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Noto Sans Thai', sans-serif;
            margin-top: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
            overflow: hidden;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .register-btn:disabled {
            background: linear-gradient(135deg, #D1D5DB, #9CA3AF);
            cursor: not-allowed;
            opacity: 0.6;
            animation: none;
        }
        
        .register-btn:not(:disabled)::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .register-btn:not(:disabled):hover::before {
            left: 100%;
        }
        
        .register-btn:not(:disabled):hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            position: relative;
            z-index: 2;
        }
        
        .login-link a {
            color: #8B5CF6;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        
        .login-link a:hover {
            color: #FF69B4;
            border-bottom-color: #FF69B4;
            text-shadow: 0 0 10px rgba(255, 105, 180, 0.5);
        }
        
        .success-notification {
            background: linear-gradient(135deg, #96CEB4, #90EE90);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            animation: slideIn 0.5s ease-out;
            display: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
        
        @media (max-width: 768px) {
            .register-container {
                padding: 40px 30px;
                margin: 10px;
                /* Remove complex effects on mobile */
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }
            
            .title {
                font-size: 2em;
            }
            
            .logo-text {
                font-size: 1.8em;
            }
            
            .checker-piece {
                width: 30px;
                height: 30px;
                /* Reduce complex shadows on mobile */
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            
            /* Simplify form inputs on mobile */
            .form-input {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }
            
            .form-input:focus {
                box-shadow: 0 0 10px rgba(255, 105, 180, 0.2);
                transform: none;
            }
            
            .register-btn:hover {
                transform: none;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }
            
            .register-btn:active {
                transform: none;
            }
        }
        
        /* Additional optimizations for very low-end devices */
        @media (max-width: 480px) and (max-height: 600px) {
            body {
                background: #FFB5E8;
            }
            
            .register-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: none;
                box-shadow: none;
                border: 1px solid rgba(255, 255, 255, 0.5);
            }
            
            .register-container::before {
                display: none;
            }
            
            .error-message,
            .success-message {
                opacity: 0.9;
                animation: none;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="header">
			<svg width="280" height="180" viewBox="0 0 280 180" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; height: auto;">
				<defs>
					<!-- Gradients for checker pieces -->
					<linearGradient id="redPiece" x1="0%" y1="0%" x2="100%" y2="100%">
					  <stop offset="0%" style="stop-color:#FF6B9D;stop-opacity:1" />
					  <stop offset="50%" style="stop-color:#FF8FA3;stop-opacity:1" />
					  <stop offset="100%" style="stop-color:#FF4081;stop-opacity:1" />
					</linearGradient>
					
					<linearGradient id="blackPiece" x1="0%" y1="0%" x2="100%" y2="100%">
					  <stop offset="0%" style="stop-color:#4A5568;stop-opacity:1" />
					  <stop offset="50%" style="stop-color:#2D3748;stop-opacity:1" />
					  <stop offset="100%" style="stop-color:#1A202C;stop-opacity:1" />
					</linearGradient>
					
					<linearGradient id="goldPiece" x1="0%" y1="0%" x2="100%" y2="100%">
					  <stop offset="0%" style="stop-color:#FF6B9D;stop-opacity:1" />
					  <stop offset="50%" style="stop-color:#FF8FA3;stop-opacity:1" />
					  <stop offset="100%" style="stop-color:#FF4081;stop-opacity:1" />
					</linearGradient>
					
					<linearGradient id="bluePiece" x1="0%" y1="0%" x2="100%" y2="100%">
					  <stop offset="0%" style="stop-color:#4A5568;stop-opacity:1" />
					  <stop offset="50%" style="stop-color:#2D3748;stop-opacity:1" />
					  <stop offset="100%" style="stop-color:#1A202C;stop-opacity:1" />
					</linearGradient>
					
					<!-- Gradient for text -->
					<linearGradient id="textGradient" x1="0%" y1="0%" x2="100%" y2="0%">
						<stop offset="0%" style="stop-color:#FF6B9D;stop-opacity:1" />
						<stop offset="25%" style="stop-color:#45B7D1;stop-opacity:1" />
						<stop offset="50%" style="stop-color:#96CEB4;stop-opacity:1" />
						<stop offset="75%" style="stop-color:#FECA57;stop-opacity:1" />
						<stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:1" />
					</linearGradient>
					
					<!-- Board pattern -->
					<pattern id="checkerBoard" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
						<rect x="0" y="0" width="8" height="8" fill="#F8F9FA"/>
						<rect x="8" y="8" width="8" height="8" fill="#F8F9FA"/>
						<rect x="8" y="0" width="8" height="8" fill="#E2E8F0"/>
						<rect x="0" y="8" width="8" height="8" fill="#E2E8F0"/>
					</pattern>
					
					<!-- Shadows and effects -->
					<filter id="dropShadow" x="-50%" y="-50%" width="200%" height="200%">
						<feDropShadow dx="2" dy="3" stdDeviation="2" flood-color="rgba(0,0,0,0.3)"/>
					</filter>
					
					<filter id="innerShadow" x="-50%" y="-50%" width="200%" height="200%">
						<feOffset dx="0" dy="1"/>
						<feGaussianBlur stdDeviation="1" result="offset-blur"/>
						<feFlood flood-color="rgba(255,255,255,0.6)"/>
						<feComposite in2="offset-blur" operator="in"/>
						<feMerge>
							<feMergeNode in="SourceGraphic"/>
							<feMergeNode/>
						</feMerge>
					</filter>
					
					<filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
						<feGaussianBlur stdDeviation="2" result="coloredBlur"/>
						<feMerge>
							<feMergeNode in="coloredBlur"/>
							<feMergeNode in="SourceGraphic"/>
						</feMerge>
					</filter>
				</defs>
				
				<!-- Centered logo group (scaled 1.5x) -->
				<g transform="translate(140, 45) scale(1.5)">
					<!-- Background board section (centered) -->
					<rect x="-32" y="-25" width="64" height="64" fill="url(#checkerBoard)" stroke="#CBD5E0" stroke-width="2" rx="8" filter="url(#dropShadow)"/>
					
					<!-- Checker pieces on board -->
					<!-- Red pieces (top) -->
					<circle cx="-16" cy="-9" r="7" fill="url(#redPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="-9;-12;-9" dur="3s" repeatCount="indefinite"/>
					</circle>
					
					<circle cx="0" cy="-9" r="7" fill="url(#redPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="-9;-12;-9" dur="3s" begin="0.5s" repeatCount="indefinite"/>
					</circle>
					
					<circle cx="16" cy="-9" r="7" fill="url(#redPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="-9;-12;-9" dur="3s" begin="1s" repeatCount="indefinite"/>
					</circle>
					
					<!-- Black pieces (bottom) -->
					<circle cx="-16" cy="23" r="7" fill="url(#blackPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="23;20;23" dur="3s" begin="1.5s" repeatCount="indefinite"/>
					</circle>
					
					<circle cx="0" cy="23" r="7" fill="url(#blackPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="23;20;23" dur="3s" begin="2s" repeatCount="indefinite"/>
					</circle>
					
					<circle cx="16" cy="23" r="7" fill="url(#blackPiece)" stroke="white" stroke-width="1.5" filter="url(#innerShadow)">
						<animate attributeName="cy" values="23;20;23" dur="3s" begin="2.5s" repeatCount="indefinite"/>
					</circle>
					
					<!-- Floating decorative pieces -->
					<circle cx="-50" cy="-15" r="8" fill="url(#goldPiece)" stroke="white" stroke-width="2" filter="url(#dropShadow)">
						<animateTransform attributeName="transform" type="rotate" values="0 -50 -15;360 -50 -15" dur="8s" repeatCount="indefinite"/>
						<animate attributeName="cy" values="-15;-20;-15" dur="4s" repeatCount="indefinite"/>
					</circle>
					
					<circle cx="50" cy="15" r="8" fill="url(#bluePiece)" stroke="white" stroke-width="2" filter="url(#dropShadow)">
						<animateTransform attributeName="transform" type="rotate" values="360 50 15;0 50 15" dur="8s" repeatCount="indefinite"/>
						<animate attributeName="cy" values="15;10;15" dur="4s" begin="2s" repeatCount="indefinite"/>
					</circle>
				</g>
				
				<!-- Thai subtitle (centered) -->
				<text x="140" y="132" font-family="'Noto Sans Thai', Arial, sans-serif" font-size="24" font-weight="600" fill="#ff1493" opacity="0.9" text-anchor="middle">
					หมากฮอสไทย
				</text>

				
				<!-- Decorative elements (centered) -->
				<text x="140" y="152" font-family="'Noto Sans Thai', Arial, sans-serif" font-size="13" font-weight="700" fill="#000000" opacity="0.6" text-anchor="middle">
					THAI CHECKERS GAME
				</text>
			</svg>
        </div>
  
        <center>
        <h1 class="title">สร้างบัญชีใหม่<br>CREATE NEW ACCOUNT</h1>
        </center>
        <div id="successNotification" class="success-notification">
        </div>
        
        <form id="registerForm">
            <div class="form-group">
                <label class="form-label">ชื่อผู้ใช้ / NAME</label>
                <input 
                    type="text" 
                    class="form-input" 
                    id="username"
                    placeholder="ชื่อผู้ใช้งาน / Username"
                    required
                    minlength="3"
                    maxlength="20"
                >
                <div class="error-message" id="usernameError">ชื่อผู้ใช้ต้องมี 3-20 ตัวอักษร / Username must be 3-20 characters</div>
                <div class="success-message" id="usernameSuccess">ชื่อผู้ใช้ถูกต้อง / Username is valid ✓</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">รหัสผ่าน / PASSWORD</label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        class="form-input" 
                        id="password"
                        placeholder="รหัสผ่าน / Password"
                        required
                        minlength="6"
                        style="padding-right: 50px;"
                    >
                    <button 
                        type="button" 
                        id="togglePassword" 
                        onclick="togglePasswordVisibility('password', 'togglePassword')" 
                        style="
                            position: absolute;
                            right: 15px;
                            top: 50%;
                            transform: translateY(-50%);
                            background: none;
                            border: none;
                            font-size: 20px;
                            cursor: pointer;
                            color: #8B5CF6;
                            transition: all 0.3s ease;
                            padding: 5px;
                            border-radius: 50%;
                            width: 35px;
                            height: 35px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        title="แสดง/ซ่อนรหัสผ่าน"
                    >
                        👁️
                    </button>
                </div>
                <div class="error-message" id="passwordError">รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร / Password must be at least 6 characters</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">ยืนยันรหัสผ่าน / REPASSWORD</label>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        class="form-input" 
                        id="repassword"
                        placeholder="ยืนยันรหัสผ่าน / Confirm Password"
                        required
                        style="padding-right: 50px;"
                    >
                    <button 
                        type="button" 
                        id="toggleRepassword" 
                        onclick="togglePasswordVisibility('repassword', 'toggleRepassword')" 
                        style="
                            position: absolute;
                            right: 15px;
                            top: 50%;
                            transform: translateY(-50%);
                            background: none;
                            border: none;
                            font-size: 20px;
                            cursor: pointer;
                            color: #8B5CF6;
                            transition: all 0.3s ease;
                            padding: 5px;
                            border-radius: 50%;
                            width: 35px;
                            height: 35px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        title="แสดง/ซ่อนรหัสผ่าน"
                    >
                        👁️
                    </button>
                </div>
                <div class="error-message" id="repasswordError">รหัสผ่านไม่ตรงกัน / Passwords do not match</div>
                <div class="success-message" id="repasswordSuccess">รหัสผ่านตรงกัน / Passwords match ✓</div>
            </div>
            
            <button type="submit" class="register-btn" id="submitBtn" disabled>สมัครสมาชิก / Sign up</button>
        </form>
        
        <div class="login-link">
            <a href="/login" onclick="goToLogin()">มีบัญชีแล้ว? เข้าสู่ระบบที่นี่<br>Already have an account? Log in here</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Global variable to store current toast
        let currentToast = null;
        
        function showToast(options) {
            // Hide current toast if exists
            if (currentToast) {
                currentToast.hideToast();
            }
            
            // Show new toast and store reference
            currentToast = Toastify(options);
            currentToast.showToast();
            
            return currentToast;
        }
        
        class RegisterForm {
            constructor() {
                this.form = document.getElementById('registerForm');
                this.username = document.getElementById('username');
                this.password = document.getElementById('password');
                this.repassword = document.getElementById('repassword');
                this.submitBtn = document.getElementById('submitBtn');
                
                this.initEventListeners();
                this.validationState = {
                    username: false,
                    password: false,
                    repassword: false
                };
            }
            
            initEventListeners() {
                this.username.addEventListener('input', () => this.validateUsername());
                this.password.addEventListener('input', () => this.validatePassword());
                this.repassword.addEventListener('input', () => this.validateRepassword());
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));
            }
            
            validateUsername() {
                const value = this.username.value.trim();
                const usernameError = document.getElementById('usernameError');
                const usernameSuccess = document.getElementById('usernameSuccess');
                
                if (value.length < 3 || value.length > 20) {
                    this.showFieldError(this.username, usernameError, usernameSuccess);
                    this.validationState.username = false;
                } else if (!/^[a-zA-Z0-9_]+$/.test(value)) {
                    usernameError.textContent = 'ใช้ได้เฉพาะ a-z, A-Z, 0-9, และ _ / Only a-z, A-Z, 0-9, and _ allowed';
                    this.showFieldError(this.username, usernameError, usernameSuccess);
                    this.validationState.username = false;
                } else {
                    this.showFieldSuccess(this.username, usernameError, usernameSuccess);
                    this.validationState.username = true;
                }
                
                this.updateSubmitButton();
            }
            
            validatePassword() {
                const value = this.password.value;
                const passwordError = document.getElementById('passwordError');
                
                if (value.length < 6) {
                    this.showFieldError(this.password, passwordError);
                    this.validationState.password = false;
                } else {
                    this.hideFieldError(this.password, passwordError);
                    this.validationState.password = true;
                }
                
                // Revalidate repassword if it has value
                if (this.repassword.value) {
                    this.validateRepassword();
                }
                
                this.updateSubmitButton();
            }
            
            validateRepassword() {
                const value = this.repassword.value;
                const repasswordError = document.getElementById('repasswordError');
                const repasswordSuccess = document.getElementById('repasswordSuccess');
                
                if (value !== this.password.value) {
                    this.showFieldError(this.repassword, repasswordError, repasswordSuccess);
                    this.validationState.repassword = false;
                } else if (value.length > 0) {
                    this.showFieldSuccess(this.repassword, repasswordError, repasswordSuccess);
                    this.validationState.repassword = true;
                } else {
                    this.hideFieldError(this.repassword, repasswordError);
                    this.hideFieldSuccess(this.repassword, repasswordSuccess);
                    this.validationState.repassword = false;
                }
                
                this.updateSubmitButton();
            }
            
            showFieldError(field, errorElement, successElement = null) {
                field.classList.add('error');
                field.classList.remove('success');
                errorElement.style.display = 'block';
                if (successElement) successElement.style.display = 'none';
            }
            
            showFieldSuccess(field, errorElement, successElement) {
                field.classList.remove('error');
                field.classList.add('success');
                errorElement.style.display = 'none';
                successElement.style.display = 'block';
            }
            
            hideFieldError(field, errorElement) {
                field.classList.remove('error');
                errorElement.style.display = 'none';
            }
            
            hideFieldSuccess(field, successElement) {
                field.classList.remove('success');
                successElement.style.display = 'none';
            }
            
            updateSubmitButton() {
                const allValid = Object.values(this.validationState).every(valid => valid);
                this.submitBtn.disabled = !allValid;
            }
            
            async handleSubmit(e) {
                e.preventDefault();
                
                if (!Object.values(this.validationState).every(valid => valid)) {
                    showToast({
                        text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง / Please check your information",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        style: {
                            background: "linear-gradient(to right, #FF6B9D, #FF8FA3)",
                            borderRadius: "10px",
                            fontSize: "16px",
                            fontFamily: "'Noto Sans Thai', sans-serif",
                            fontWeight: "600"
                        }
                    });
                    return;
                }
                
                // Show loading message
                showToast({
                    text: "กำลังสมัครสมาชิก... / Registering...",
                    duration: 2000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "linear-gradient(to right, #FECA57, #FFD93D)",
                        borderRadius: "10px",
                        fontSize: "16px",
                        fontFamily: "'Noto Sans Thai', sans-serif",
                        fontWeight: "600"
                    }
                });
                
                try {
                    // Create form data
                    const formData = new FormData();
                    formData.append('action', 'register');
                    formData.append('username', this.username.value.trim());
                    formData.append('password', this.password.value);
                    
                    // Send register request to API
                    const response = await fetch('/api.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Show success message
						const encodedUsername = btoa(this.username.value);
						const encodedPassword = btoa(this.password.value);
						localStorage.setItem("encoded_username", encodedUsername);
						localStorage.setItem("encoded_password", encodedPassword);
                        showToast({
                            text: result.message || `สมัครสมาชิกสำเร็จ! ยินดีต้อนรับ ${this.username.value} / Registration successful! Welcome ${this.username.value}`,
                            duration: 4000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            style: {
                                background: "linear-gradient(to right, #96CEB4, #90EE90)",
                                borderRadius: "10px",
                                fontSize: "16px",
                                fontFamily: "'Noto Sans Thai', sans-serif",
                                fontWeight: "600"
                            }
                        });
                        
                        // Reset form
                        this.form.reset();
                        
                        // Reset validation state
                        this.validationState = {
                            username: false,
                            password: false,
                            repassword: false
                        };
                        
                        // Reset field styles
                        document.querySelectorAll('.form-input').forEach(input => {
                            input.classList.remove('error', 'success');
                        });
                        
                        document.querySelectorAll('.error-message, .success-message').forEach(msg => {
                            msg.style.display = 'none';
                        });
                        
                        this.updateSubmitButton();

                        // Redirect to login page after delay
                        setTimeout(() => {
                            window.location.href = '/home';
                        }, 10);
                        
                    } else {
                        // Show error message
                        showToast({
                            text: result.message || "สมัครสมาชิกไม่สำเร็จ / Registration failed",
                            duration: 4000,
                            close: true,
                            gravity: "top",
                            position: "center",
                            style: {
                                background: "linear-gradient(to right, #FF6B9D, #FF8FA3)",
                                borderRadius: "10px",
                                fontSize: "16px",
                                fontFamily: "'Noto Sans Thai', sans-serif",
                                fontWeight: "600"
                            }
                        });
                    }
                    
                } catch (error) {
                    console.error('Registration error:', error);
                    showToast({
                        text: "เกิดข้อผิดพลาดในการเชื่อมต่อ / Connection error",
                        duration: 4000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        style: {
                            background: "linear-gradient(to right, #FF6B9D, #FF8FA3)",
                            borderRadius: "10px",
                            fontSize: "16px",
                            fontFamily: "'Noto Sans Thai', sans-serif",
                            fontWeight: "600"
                        }
                    });
                }
            }
        }
        
        // Toggle password visibility function
        function togglePasswordVisibility(inputId, buttonId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(buttonId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerHTML = '🙈';
                toggleButton.title = 'ซ่อนรหัสผ่าน';
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = '👁️';
                toggleButton.title = 'แสดงรหัสผ่าน';
            }
        }

        function goToLogin() {
            showToast({
                text: "กำลังไปหน้าเข้าสู่ระบบ... / Redirecting to login page...",
                duration: 2000,
                close: true,
                gravity: "top",
                position: "center",
                style: {
                    background: "linear-gradient(to right, #8B5CF6, #A78BFA)",
                    borderRadius: "10px",
                    fontSize: "16px",
                    fontFamily: "'Noto Sans Thai', sans-serif",
                    fontWeight: "600"
                }
            });
            window.location.href = '/login';
        }
        
        // Initialize the form when page loads
        window.addEventListener('load', () => {
            new RegisterForm();
        });
    </script>
</body>
</html>
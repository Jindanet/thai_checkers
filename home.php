<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนูหลัก - หมากฮอสไทย</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Fredoka:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #FF6B9D;
            --secondary: #4FACFE;
            --accent: #9B59B6;
            --highlight: #66BB6A;
            --light-pink: #FFE5F1;
            --light-blue: #E5F3FF;
            --light-purple: #F0E5FF;
            --light-green: #E5FFEF;
            --text-primary: #2C3E50;
            --text-secondary: #5A6C7D;
            --glass: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.8);
            --shadow: rgba(0, 0, 0, 0.08);
            --glow: rgba(255, 107, 157, 0.3);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Fredoka', 'Kanit', sans-serif;
            background: linear-gradient(135deg, #FFE5F1, #E5F3FF, #F0E5FF, #FFFACD, #E5FFEF, #FFF0E5);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: max(20px, env(safe-area-inset-top)) max(20px, env(safe-area-inset-right)) max(20px, env(safe-area-inset-bottom)) max(20px, env(safe-area-inset-left));
            position: relative;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            /* GPU acceleration */
            will-change: background-position;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Performance optimizations for low-end devices */
        @media (max-width: 768px), (max-height: 600px), (-webkit-max-device-pixel-ratio: 1) {
            body {
                background: linear-gradient(135deg, #FFE5F1, #E5F3FF);
                background-attachment: fixed;
                animation-duration: 60s;
                animation-iteration-count: 1;
            }
            
            .floating-orb {
                animation-duration: 40s;
                animation-iteration-count: 2;
                opacity: 0.05;
            }
            
            .piece {
                animation-duration: 8s;
                animation-iteration-count: 3;
            }
            
            .menu-btn {
                backdrop-filter: none;
                background: linear-gradient(135deg, var(--primary), var(--secondary));
            }
            
            .menu-container {
                backdrop-filter: blur(15px);
            }
        }
        
        /* Reduce motion for better performance */
        @media (prefers-reduced-motion: reduce), (max-width: 480px) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.1s !important;
            }
            
            .floating-orb {
                display: none;
            }
            
            body {
                background: linear-gradient(135deg, #FFE5F1, #E5F3FF);
                animation: none;
            }
            
            .menu-btn::before {
                display: none;
            }
        }
        
        /* Animated background elements */
        .bg-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1;
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            animation: float 20s infinite ease-in-out;
            /* GPU acceleration */
            will-change: transform, opacity;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        .floating-orb:nth-child(1) {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
        }
        
        .floating-orb:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 6s;
            background: linear-gradient(45deg, var(--accent), var(--highlight));
        }
        
        .floating-orb:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 12s;
            background: linear-gradient(45deg, var(--secondary), var(--primary));
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0) scale(1) rotate(0deg);
                opacity: 0.08;
            }
            50% { 
                transform: translateY(-40px) scale(1.1) rotate(180deg);
                opacity: 0.15;
            }
        }
        
        /* Main container with glassmorphism */
        .menu-container {
            background: var(--glass);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 35px;
            padding: 50px 45px;
            box-shadow: 
                0 30px 60px var(--shadow),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            max-width: 520px;
            width: 100%;
            color: var(--text-primary);
            position: relative;
            z-index: 10;
            /* GPU acceleration */
            will-change: transform;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        /* Header section */
        .header {
            text-align: center;
            margin-bottom: 45px;
            position: relative;
        }
        
        .logo-section {
            margin-bottom: 30px;
        }
        
        .checker-pieces {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
        }
        
        .piece {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: 2px solid rgba(255, 255, 255, 0.9);
            box-shadow: 
                0 10px 20px var(--shadow),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
            animation: pulse-soft 4s infinite ease-in-out;
        }
        
        .piece:nth-child(1) { 
            background: linear-gradient(135deg, var(--primary), var(--accent));
            animation-delay: 0s; 
        }
        .piece:nth-child(2) { 
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            animation-delay: 0.8s; 
        }
        .piece:nth-child(3) { 
            background: linear-gradient(135deg, var(--accent), var(--highlight));
            animation-delay: 1.6s; 
        }
        .piece:nth-child(4) { 
            background: linear-gradient(135deg, var(--highlight), var(--secondary));
            animation-delay: 2.4s; 
        }
        
        @keyframes pulse-soft {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 
                    0 10px 20px var(--shadow),
                    inset 0 2px 4px rgba(255, 255, 255, 0.3);
            }
            50% { 
                transform: scale(1.08);
                box-shadow: 
                    0 15px 30px var(--shadow),
                    inset 0 2px 4px rgba(255, 255, 255, 0.4),
                    0 0 25px var(--glow);
            }
        }
        
        .title {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 12px;
            background: linear-gradient(45deg, var(--primary), var(--secondary), var(--accent), var(--highlight));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -2px;
            font-family: 'Fredoka', sans-serif;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: titleGlow 5s ease-in-out infinite;
        }
        
        @keyframes titleGlow {
            0%, 100% { filter: brightness(1); }
            50% { filter: brightness(1.1); }
        }
        
        .subtitle {
            font-size: 1.3em;
            color: var(--text-secondary);
            margin-bottom: 30px;
            opacity: 0.9;
            font-weight: 400;
            font-family: 'Kanit', sans-serif;
        }
        
        /* Menu buttons */
        .menu-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .menu-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 25px;
            padding: 22px 28px;
            color: white;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-align: left;
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 12px 30px rgba(79, 172, 254, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            /* GPU acceleration */
            will-change: transform, box-shadow;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
        
        .menu-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.8s ease;
        }
        
        .menu-btn:hover::before {
            left: 100%;
        }
        
        .menu-btn:hover {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 
                0 20px 45px rgba(79, 172, 254, 0.3),
                0 0 35px var(--glow);
        }
        
        .menu-btn:active {
            transform: translateY(-2px) scale(1.01);
        }
        
        .menu-btn:nth-child(1) {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        
        .menu-btn:nth-child(2) {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
        }
        
        .menu-btn:nth-child(3) {
            background: linear-gradient(135deg, var(--accent), var(--highlight));
        }
        
        .menu-btn:nth-child(4) {
            background: linear-gradient(135deg, var(--highlight), var(--primary));
        }
        
        .menu-btn:nth-child(5) {
            background: linear-gradient(135deg, var(--primary), var(--accent));
        }
        
        .btn-icon {
            font-size: 1.6em;
            width: 32px;
            text-align: center;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }
        
        .btn-content {
            flex: 1;
        }
        
        .btn-title {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 1.1em;
        }
        
        .btn-subtitle {
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.8);
            opacity: 0.9;
            font-weight: 400;
        }
        
        /* User info section - hidden for now */
        .user-section {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            padding: 28px;
            text-align: center;
            box-shadow: 
                0 15px 35px var(--shadow),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .user-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8em;
            font-weight: 600;
            color: white;
            box-shadow: 0 8px 20px var(--shadow);
        }
        
        .username {
            font-size: 1.25em;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-primary);
            font-family: 'Fredoka', sans-serif;
        }
        
        .user-stats {
            font-size: 1em;
            color: var(--text-secondary);
            margin-bottom: 20px;
            opacity: 0.9;
            font-family: 'Kanit', sans-serif;
        }
        
        .logout-btn {
            background: rgba(255, 107, 157, 0.1);
            border: 1px solid rgba(255, 107, 157, 0.3);
            border-radius: 15px;
            padding: 12px 24px;
            color: var(--primary);
            font-family: 'Fredoka', sans-serif;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .logout-btn:hover {
            background: rgba(255, 107, 157, 0.15);
            border-color: rgba(255, 107, 157, 0.4);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 157, 0.2);
        }
        
        /* Toast styling to match theme */
        .toast-custom {
            background: var(--glass) !important;
            backdrop-filter: blur(25px) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 20px !important;
            color: var(--text-primary) !important;
            box-shadow: 0 25px 50px var(--shadow) !important;
            font-family: 'Fredoka', sans-serif !important;
            font-weight: 500 !important;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            body {
                padding: max(16px, env(safe-area-inset-top)) max(16px, env(safe-area-inset-right)) max(16px, env(safe-area-inset-bottom)) max(16px, env(safe-area-inset-left));
                align-items: flex-start;
                padding-top: max(32px, env(safe-area-inset-top));
            }
            
            .menu-container {
                padding: 35px 28px;
                margin: 0;
                border-radius: 28px;
                width: 100%;
                max-width: 100%;
                /* Simplify shadows on mobile */
                box-shadow: 0 15px 35px var(--shadow);
            }
            
            .title {
                font-size: 3em;
            }
            
            .menu-btn {
                padding: 20px 24px;
                font-size: 1em;
                gap: 16px;
                /* Simplify button effects on mobile */
                box-shadow: 0 8px 20px rgba(79, 172, 254, 0.2);
            }
            
            .menu-btn:hover {
                transform: none;
                box-shadow: 0 12px 25px rgba(79, 172, 254, 0.25);
            }
            
            .piece {
                width: 36px;
                height: 36px;
                /* Reduce animation complexity */
                box-shadow: 0 5px 15px var(--shadow);
            }
            
            .floating-orb {
                display: none;
            }
        }
        
        /* Additional optimizations for very low-end devices */
        @media (max-width: 480px) and (max-height: 600px) {
            body {
                background: linear-gradient(135deg, #FFE5F1, #E5F3FF);
            }
            
            .menu-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: none;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.8);
            }
            
            .menu-btn {
                background: linear-gradient(135deg, #FF6B9D, #4FACFE);
                backdrop-filter: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .menu-btn::before {
                display: none;
            }
        }
        
        @media (max-width: 480px) {
            .title {
                font-size: 2.6em;
            }
            
            .menu-btn {
                padding: 18px 22px;
                font-size: 0.95em;
            }
            
            .btn-icon {
                font-size: 1.4em;
                width: 28px;
            }
            
            .menu-container {
                padding: 32px 24px;
            }
            
            .piece {
                width: 32px;
                height: 32px;
            }
        }
        
        @media (max-width: 360px) {
            .title {
                font-size: 2.4em;
            }
            
            .menu-btn {
                padding: 16px 20px;
                font-size: 0.9em;
                gap: 14px;
            }
            
            .menu-container {
                padding: 28px 20px;
            }
        }
        
        /* Landscape mobile orientation */
        @media (max-height: 600px) and (orientation: landscape) {
            body {
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            
            .menu-container {
                margin: 0;
                max-height: 90vh;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .title {
                font-size: 2.4em;
                margin-bottom: 8px;
            }
            
            .header {
                margin-bottom: 30px;
            }
            
            .menu-grid {
                gap: 16px;
                margin-bottom: 25px;
            }
            
            .menu-btn {
                padding: 16px 22px;
            }
            
            .piece {
                width: 32px;
                height: 32px;
            }
        }
        
        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .menu-btn {
                min-height: 48px;
                padding: 20px 24px;
                /* Remove complex effects for touch devices */
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .logout-btn {
                min-height: 48px;
                padding: 14px 24px;
            }
            
            .menu-btn:hover {
                transform: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .menu-btn:active {
                transform: scale(0.98);
                background: rgba(255, 255, 255, 0.2);
            }
            
            /* Disable heavy effects for touch devices */
            .menu-btn::before,
            .piece,
            .floating-orb {
                animation-play-state: paused;
            }
        }
        
        /* Additional performance media queries */
        @media (max-device-width: 812px) and (orientation: portrait) {
            /* iPhone and similar devices in portrait */
            .bg-decoration {
                display: none;
            }
            
            .menu-container {
                backdrop-filter: blur(10px);
            }
        }
        
        @media (max-device-width: 1024px) and (orientation: landscape) {
            /* Tablets in landscape */
            .floating-orb {
                animation-duration: 30s;
                opacity: 0.06;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --text-primary: #2C3E50;
                --text-secondary: #5A6C7D;
                --glass: rgba(255, 255, 255, 0.92);
                --glass-border: rgba(255, 255, 255, 0.8);
            }
        }
        
        /* Reduced motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .floating-orb,
            .piece {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <div class="bg-decoration">
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
        <div class="floating-orb"></div>
    </div>
    
    <div class="menu-container">
        <header class="header">
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
        </header>
        
        <nav class="menu-grid">
            <button class="menu-btn" onclick="playWithFriend()">
                <span class="btn-icon">🎮</span>
                <div class="btn-content">
                    <div class="btn-title">เล่นกับเพื่อน</div>
                    <div class="btn-subtitle">Play with Friend</div>
                </div>
            </button>
            
            <button class="menu-btn" onclick="playWithAI()">
                <span class="btn-icon">🤖</span>
                <div class="btn-content">
                    <div class="btn-title">เล่นกับ AI</div>
                    <div class="btn-subtitle">Play with AI</div>
                </div>
            </button>
            
            <button class="menu-btn" onclick="showLeaderboard()">
                <span class="btn-icon">🏆</span>
                <div class="btn-content">
                    <div class="btn-title">อันดับการชนะ AI</div>
                    <div class="btn-subtitle">AI Victory Leaderboard</div>
                </div>
            </button>
            <!--
            <button class="menu-btn" onclick="openSettings()">
                <span class="btn-icon">⚙️</span>
                <div class="btn-content">
                    <div class="btn-title">ตั้งค่า</div>
                    <div class="btn-subtitle">Settings</div>
                </div>
            </button>-->
            
            <button class="menu-btn" onclick="shareGame()">
                <span class="btn-icon">📤</span>
                <div class="btn-content">
                    <div class="btn-title">ส่งให้เพื่อนเล่น</div>
                    <div class="btn-subtitle">Share with Friends</div>
                </div>
            </button>
            
            <button class="menu-btn" onclick="openChangePassword()">
                <span class="btn-icon">🔒</span>
                <div class="btn-content">
                    <div class="btn-title">เปลี่ยนรหัสผ่าน</div>
                    <div class="btn-subtitle">Change Password</div>
                </div>
            </button>
			
            <button class="logout-btn" onclick="logout()">
                <span class="btn-icon">📤</span>
                <div class="btn-content">
                    <div class="btn-title">ออกจากระบบ</div>
                    <div class="btn-subtitle">Logout</div>
                </div>
            </button>
        </nav>
        <!--
        <div class="user-section">
            <div class="user-avatar">P</div>
            <div class="username">ยินดีต้อนรับ Player</div>
            <div class="user-stats">ชนะ AI: 15 ครั้ง | เล่นทั้งหมด: 23 เกม</div>
            <button class="logout-btn" onclick="logout()">ออกจากระบบ / Logout</button>
        </div>-->
    </div>

	<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<script>
		let currentToast = null;

		function showToast(message, type = "info") {
		  if (currentToast) {
			currentToast.hideToast();
		  }

		  currentToast = Toastify({
			text: message,
			duration: 3000,
			close: true,
			gravity: "top",     // แสดงด้านบน
			position: "center", // กลางหน้าจอ
			backgroundColor: type === "success" ? "#333" : 
							 type === "error" ? "#333" : 
							 type === "warning" ? "#333" : "#333"
		  });

		  currentToast.showToast();
		}


        function playWithFriend() {
            showToast("🎮 เริ่มเกมกับเพื่อน... / Starting game with friend...");
            
            setTimeout(() => {
                window.location.href = 'friend';
            }, 10);
        }
        
        function playWithAI() {
            // สร้าง modal เลือกระดับความยาก
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                animation: fadeIn 0.3s ease;
            `;
            
            const modalContent = document.createElement('div');
            modalContent.style.cssText = `
                background: white;
                border-radius: 30px;
                padding: 40px;
                max-width: 500px;
                width: 90%;
                text-align: center;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                animation: slideIn 0.3s ease;
            `;
            
            modalContent.innerHTML = `
                <h2 style="font-size: 2em; margin-bottom: 20px; color: #333;">🤖 เลือกระดับ AI</h2>
                <p style="color: #666; margin-bottom: 30px;">Select AI Difficulty</p>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <button onclick="selectDifficulty('easy')" class="difficulty-btn" style="
                        background: linear-gradient(135deg, #66BB6A, #4CAF50);
                        color: white;
                        border: none;
                        padding: 20px;
                        border-radius: 20px;
                        font-size: 1.2em;
                        cursor: pointer;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        font-family: 'Fredoka', 'Kanit', sans-serif;
                    ">
                        🟢 ง่าย (Easy)
                        <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI มือใหม่ เหมาะสำหรับฝึกหัด</div>
                    </button>
                    
                    <button onclick="selectDifficulty('medium')" class="difficulty-btn" style="
                        background: linear-gradient(135deg, #FFB74D, #FF9800);
                        color: white;
                        border: none;
                        padding: 20px;
                        border-radius: 20px;
                        font-size: 1.2em;
                        cursor: pointer;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        font-family: 'Fredoka', 'Kanit', sans-serif;
                    ">
                        🟡 ปานกลาง (Medium)
                        <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI ระดับทั่วไป ท้าทายพอดี</div>
                    </button>
                    
                    <button onclick="selectDifficulty('hard')" class="difficulty-btn" style="
                        background: linear-gradient(135deg, #FF6B9D, #FF4757);
                        color: white;
                        border: none;
                        padding: 20px;
                        border-radius: 20px;
                        font-size: 1.2em;
                        cursor: pointer;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        font-family: 'Fredoka', 'Kanit', sans-serif;
                    ">
                        🔴 ยาก (Hard)
                        <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI แข็งแกร่ง ต้องคิดมาก</div>
                    </button>
                    
                    <button onclick="selectDifficulty('extreme')" class="difficulty-btn" style="
                        background: linear-gradient(135deg, #9B59B6, #8E44AD);
                        color: white;
                        border: none;
                        padding: 20px;
                        border-radius: 20px;
                        font-size: 1.2em;
                        cursor: pointer;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        font-family: 'Fredoka', 'Kanit', sans-serif;
                    ">
                        🟣 โหดมากๆ (Extreme)
                        <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI สุดโหด แทบเอาชนะไม่ได้!</div>
                    </button>
                </div>
                <button onclick="closeModal()" style="
                    margin-top: 20px;
                    background: #e0e0e0;
                    color: #666;
                    border: none;
                    padding: 12px 30px;
                    border-radius: 20px;
                    cursor: pointer;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    font-family: 'Fredoka', 'Kanit', sans-serif;
                ">ยกเลิก / Cancel</button>
            `;
            
            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            
            // เพิ่ม style สำหรับ animation
            const style = document.createElement('style');
            style.textContent = `
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
                .difficulty-btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                }
            `;
            document.head.appendChild(style);
            
            // ฟังก์ชันเลือกระดับความยาก
            window.selectDifficulty = function(difficulty) {
                const difficultyNames = {
                    'easy': 'ง่าย',
                    'medium': 'ปานกลาง',
                    'hard': 'ยาก',
                    'extreme': 'โหดมากๆ'
                };
                
                showToast(`🤖 เริ่มเกมกับ AI ระดับ ${difficultyNames[difficulty]}...`);
                
                const aiSettings = {
                    mode: 'ai',
                    difficulty: difficulty,
                    aiType: 'smart',
                    playerName: getUserName()
                };
                
                sessionStorage.setItem('gameSettings', JSON.stringify(aiSettings));
                
                setTimeout(() => {
                    // ใช้ URL pattern ใหม่ แบบ /ai/extreme
                    window.location.href = `/ai/?diff=${difficulty}`;
                }, 10);
            };
            
            // ฟังก์ชันปิด modal
            window.closeModal = function() {
                modal.remove();
                style.remove();
            };
            
            // ปิด modal เมื่อคลิกพื้นหลัง
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
        
        function showLeaderboard() {
            showToast("🏆 กำลังโหลดอันดับ... / Loading leaderboard...");
            
            setTimeout(() => {
                const currentPlayer = {
                    username: getUserName(),
                    wins: getUserWins(),
                    totalGames: getUserTotalGames()
                };
                
                sessionStorage.setItem('currentPlayer', JSON.stringify(currentPlayer));
                window.location.href = '/stats';
            }, 10);
        }
        
        function openSettings() {
            showToast("⚙️ กำลังเปิดหน้าตั้งค่า... / Opening settings...");
            
            setTimeout(() => {
                const currentSettings = {
                    soundEnabled: true,
                    musicEnabled: true,
                    difficulty: 'medium',
                    language: 'th',
                    theme: 'pastel'
                };
                
                sessionStorage.setItem('gameSettings', JSON.stringify(currentSettings));
                window.location.href = '/settings';
            }, 10);
        }
        
        function shareGame() {
            showToast("📤 กำลังแชร์เกม... / Sharing game...");
            
            const shareData = {
                title: 'หมากฮอสไทย - Thai Checkers',
                text: 'มาเล่นหมากฮอสกันเถอะ! Come play Thai Checkers with me!',
                url: window.location.origin
            };
            
            if (navigator.share && /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                navigator.share(shareData)
                    .then(() => {
                        showToast("✅ แชร์สำเร็จ! / Shared successfully!");
                    })
                    .catch((error) => {
                        console.log('Error sharing:', error);
                        fallbackShare(shareData);
                    });
            } else {
                fallbackShare(shareData);
            }
        }
        function openChangePassword() {
            const modal = document.createElement('div');
            modal.id = 'changePasswordModal';
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                animation: fadeIn 0.3s ease;
            `;
            
            const modalContent = document.createElement('div');
            modalContent.style.cssText = `
                background: var(--glass);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 30px;
                padding: 40px;
                max-width: 450px;
                width: 90%;
                text-align: center;
                box-shadow: 0 30px 60px var(--shadow);
                animation: slideIn 0.3s ease;
                font-family: 'Fredoka', 'Kanit', sans-serif;
            `;
            
            modalContent.innerHTML = `
                <h2 style="font-size: 2em; margin-bottom: 20px; color: var(--text-primary); font-weight: 600;">🔒 เปลี่ยนรหัสผ่าน</h2>
                <p style="color: var(--text-secondary); margin-bottom: 30px; font-size: 1.1em;">Change Password</p>
                
                <form id="changePasswordForm" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 8px; color: var(--text-primary); font-weight: 500;">รหัสผ่านเก่า (Current Password)</label>
                        <div style="position: relative;">
                            <input type="password" id="currentPassword" placeholder="กรอกรหัสผ่านปัจจุบัน" required style="
                                width: 100%;
                                padding: 15px 50px 15px 20px;
                                border: 2px solid rgba(255, 255, 255, 0.3);
                                border-radius: 20px;
                                background: rgba(255, 255, 255, 0.8);
                                font-size: 1em;
                                font-family: 'Fredoka', 'Kanit', sans-serif;
                                color: var(--text-primary);
                                box-sizing: border-box;
                                transition: all 0.3s ease;
                            ">
                            <button 
                                type="button" 
                                id="toggleCurrentPassword" 
                                onclick="toggleChangePasswordVisibility('currentPassword', 'toggleCurrentPassword')" 
                                style="
                                    position: absolute;
                                    right: 15px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    background: none;
                                    border: none;
                                    font-size: 18px;
                                    cursor: pointer;
                                    color: var(--primary);
                                    transition: all 0.3s ease;
                                    padding: 5px;
                                    border-radius: 50%;
                                    width: 32px;
                                    height: 32px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                "
                                title="แสดง/ซ่อนรหัสผ่าน"
                            >
                                👁️
                            </button>
                        </div>
                    </div>
                    
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 8px; color: var(--text-primary); font-weight: 500;">รหัสผ่านใหม่ (New Password)</label>
                        <div style="position: relative;">
                            <input type="password" id="newPassword" placeholder="กรอกรหัสผ่านใหม่" required style="
                                width: 100%;
                                padding: 15px 50px 15px 20px;
                                border: 2px solid rgba(255, 255, 255, 0.3);
                                border-radius: 20px;
                                background: rgba(255, 255, 255, 0.8);
                                font-size: 1em;
                                font-family: 'Fredoka', 'Kanit', sans-serif;
                                color: var(--text-primary);
                                box-sizing: border-box;
                                transition: all 0.3s ease;
                            ">
                            <button 
                                type="button" 
                                id="toggleNewPassword" 
                                onclick="toggleChangePasswordVisibility('newPassword', 'toggleNewPassword')" 
                                style="
                                    position: absolute;
                                    right: 15px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    background: none;
                                    border: none;
                                    font-size: 18px;
                                    cursor: pointer;
                                    color: var(--primary);
                                    transition: all 0.3s ease;
                                    padding: 5px;
                                    border-radius: 50%;
                                    width: 32px;
                                    height: 32px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                "
                                title="แสดง/ซ่อนรหัสผ่าน"
                            >
                                👁️
                            </button>
                        </div>
                    </div>
                    
                    <div style="text-align: left;">
                        <label style="display: block; margin-bottom: 8px; color: var(--text-primary); font-weight: 500;">ยืนยันรหัสผ่านใหม่ (Confirm New Password)</label>
                        <div style="position: relative;">
                            <input type="password" id="confirmPassword" placeholder="กรอกรหัสผ่านใหม่อีกครั้ง" required style="
                                width: 100%;
                                padding: 15px 50px 15px 20px;
                                border: 2px solid rgba(255, 255, 255, 0.3);
                                border-radius: 20px;
                                background: rgba(255, 255, 255, 0.8);
                                font-size: 1em;
                                font-family: 'Fredoka', 'Kanit', sans-serif;
                                color: var(--text-primary);
                                box-sizing: border-box;
                                transition: all 0.3s ease;
                            ">
                            <button 
                                type="button" 
                                id="toggleConfirmPassword" 
                                onclick="toggleChangePasswordVisibility('confirmPassword', 'toggleConfirmPassword')" 
                                style="
                                    position: absolute;
                                    right: 15px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    background: none;
                                    border: none;
                                    font-size: 18px;
                                    cursor: pointer;
                                    color: var(--primary);
                                    transition: all 0.3s ease;
                                    padding: 5px;
                                    border-radius: 50%;
                                    width: 32px;
                                    height: 32px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                "
                                title="แสดง/ซ่อนรหัสผ่าน"
                            >
                                👁️
                            </button>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <button type="submit" style="
                            flex: 1;
                            background: linear-gradient(135deg, var(--primary), var(--secondary));
                            color: white;
                            border: none;
                            padding: 15px 25px;
                            border-radius: 20px;
                            font-size: 1.1em;
                            cursor: pointer;
                            font-weight: 600;
                            transition: all 0.3s ease;
                            font-family: 'Fredoka', 'Kanit', sans-serif;
                        ">
                            ✅ เปลี่ยนรหัสผ่าน
                        </button>
                        
                        <button type="button" onclick="closeChangePasswordModal()" style="
                            flex: 1;
                            background: rgba(108, 117, 125, 0.1);
                            color: var(--text-secondary);
                            border: 2px solid rgba(108, 117, 125, 0.3);
                            padding: 15px 25px;
                            border-radius: 20px;
                            font-size: 1.1em;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all 0.3s ease;
                            font-family: 'Fredoka', 'Kanit', sans-serif;
                        ">
                            ❌ ยกเลิก
                        </button>
                    </div>
                </form>
            `;
            
            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            
            // เพิ่ม CSS สำหรับ input focus effect
            const style = document.createElement('style');
            style.textContent = `
                #changePasswordForm input:focus {
                    outline: none;
                    border-color: var(--primary);
                    box-shadow: 0 0 20px rgba(255, 107, 157, 0.3);
                    transform: translateY(-2px);
                }
                
                #changePasswordForm button[type="submit"]:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 10px 30px rgba(255, 107, 157, 0.3);
                }
                
                #changePasswordForm button[type="button"]:hover {
                    background: rgba(108, 117, 125, 0.15);
                    border-color: rgba(108, 117, 125, 0.4);
                    transform: translateY(-2px);
                }
            `;
            document.head.appendChild(style);
            
            // ฟังก์ชันปิด modal
            window.closeChangePasswordModal = function() {
                modal.remove();
                style.remove();
            };
            
            // ฟังก์ชันแสดง/ซ่อนรหัสผ่านในฟอร์มเปลี่ยนรหัสผ่าน
            window.toggleChangePasswordVisibility = function(inputId, buttonId) {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(buttonId);
                
                if (passwordInput && toggleButton) {
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
            };
            
            // ปิด modal เมื่อคลิกพื้นหลัง
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeChangePasswordModal();
                }
            });
            
            // Handle form submission
            document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const currentPassword = document.getElementById('currentPassword').value;
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                // Validate passwords
                if (newPassword !== confirmPassword) {
                    showToast("❌ รหัสผ่านใหม่ไม่ตรงกัน / New passwords don't match", "error");
                    return;
                }
                
                if (newPassword.length < 6) {
                    showToast("❌ รหัสผ่านใหม่ต้องมีอย่างน้อย 6 ตัวอักษร / Password must be at least 6 characters", "error");
                    return;
                }
                
                // Call API to change password
                changePassword(currentPassword, newPassword);
            });
        }
        
        function changePassword(currentPassword, newPassword) {
            showToast("🔄 กำลังเปลี่ยนรหัสผ่าน... / Changing password...");
            
            // First check session validity
            fetch('/api.php?action=check_session', {
                method: 'GET',
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(sessionData => {
                if (!sessionData.success || !sessionData.authenticated) {
                    showToast("❌ Session หมดอายุ กรุณาเข้าสู่ระบบใหม่ / Session expired, please login again", "error");
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                    return;
                }
                
                // If session is valid, proceed with password change
                return fetch('/api.php?action=change_password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin', // Include cookies and session
                    body: JSON.stringify({
                        current_password: currentPassword,
                        new_password: newPassword
                    })
                });
            })
            .then(response => {
                if (!response) return; // Session check failed
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!data) return; // Session check failed
                
                if (data.success) {
                    showToast("✅ เปลี่ยนรหัสผ่านสำเร็จ! / Password changed successfully!", "success");
                    closeChangePasswordModal();
                } else {
                    showToast("❌ " + (data.message || "เกิดข้อผิดพลาด / Error occurred"), "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast("❌ เกิดข้อผิดพลาดในการเชื่อมต่อ / Connection error", "error");
            });
        }

        function logout() {
            showToast("👋 กำลังออกจากระบบ... / Logging out...");
            
            setTimeout(() => {
                localStorage.removeItem('userToken');
                localStorage.removeItem('userData');
                localStorage.removeItem('gameStats');
                sessionStorage.clear();
                
                showToast("✅ ออกจากระบบสำเร็จ / Logout successful");
                
                setTimeout(() => {
                    window.location.href = '/logout';
                }, 10);
            }, 10);
        }
        
        function fallbackShare(shareData) {
            const shareText = `${shareData.text}\n${shareData.url}`;
            
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(shareText)
                    .then(() => {
                        showToast("📋 ลิงก์ถูกคัดลอกแล้ว! / Link copied to clipboard!");
                    })
                    .catch(() => {
                        openSharePage(shareData);
                    });
            } else {
                openSharePage(shareData);
            }
        }
        
        function openSharePage(shareData) {
            sessionStorage.setItem('shareData', JSON.stringify(shareData));
            
            setTimeout(() => {
                window.location.href = 'pages/share.html';
            }, 500);
        }
        
        function getUserName() {
            const usernameElement = document.querySelector('.username');
            if (usernameElement) {
                return usernameElement.textContent.replace('ยินดีต้อนรับ ', '').trim();
            }
            
            const userData = JSON.parse(localStorage.getItem('userData') || '{}');
            return userData.username || 'Player';
        }
        
        function getUserWins() {
            const statsElement = document.querySelector('.user-stats');
            if (statsElement) {
                const match = statsElement.textContent.match(/ชนะ AI: (\d+)/);
                return match ? parseInt(match[1]) : 0;
            }
            return 0;
        }
        
        function getUserTotalGames() {
            const statsElement = document.querySelector('.user-stats');
            if (statsElement) {
                const match = statsElement.textContent.match(/เล่นทั้งหมด: (\d+)/);
                return match ? parseInt(match[1]) : 0;
            }
            return 0;
        }
        
        function isLoggedIn() {
            return localStorage.getItem('userToken') !== null;
        }
        
        function saveGameStats(gameResult) {
            const currentStats = JSON.parse(localStorage.getItem('gameStats') || '{}');
            
            currentStats.totalGames = (currentStats.totalGames || 0) + 1;
            if (gameResult.won) {
                currentStats.wins = (currentStats.wins || 0) + 1;
            }
            
            localStorage.setItem('gameStats', JSON.stringify(currentStats));
        }

        // Performance-optimized event handling
        let isLowEndDevice = false;
        
        // Detect low-end devices
        function detectLowEndDevice() {
            const ua = navigator.userAgent;
            const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(ua);
            const hasLowMemory = navigator.deviceMemory && navigator.deviceMemory < 4;
            const hasSlowCPU = navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4;
            
            return isMobile || hasLowMemory || hasSlowCPU || window.innerWidth < 768;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            isLowEndDevice = detectLowEndDevice();
            
            const buttons = document.querySelectorAll('.menu-btn');
            buttons.forEach(button => {
                if (!isLowEndDevice) {
                    // Only add hover effects on high-end devices
                    button.addEventListener('mouseenter', function() {
                        if (window.matchMedia('(hover: hover)').matches) {
                            this.style.transform = 'translateY(-4px) scale(1.02)';
                        }
                    });
                    
                    button.addEventListener('mouseleave', function() {
                        if (window.matchMedia('(hover: hover)').matches) {
                            this.style.transform = 'translateY(0) scale(1)';
                        }
                    });
                }
                
                // Optimized touch events
                button.addEventListener('touchstart', function(e) {
                    this.style.transform = isLowEndDevice ? 'scale(0.98)' : 'scale(0.96)';
                    this.style.transition = 'transform 0.2s ease';
                }, { passive: true });
                
                button.addEventListener('touchend', function(e) {
                    this.style.transform = 'scale(1)';
                }, { passive: true });
            });
            
            const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            if (isTouch || isLowEndDevice) {
                // Disable parallax on touch devices and low-end devices
                document.removeEventListener('mousemove', parallaxEffect);
                document.body.classList.add('touch-device');
                
                // Disable heavy animations
                const style = document.createElement('style');
                style.textContent = `
                    .floating-orb { display: none !important; }
                    .menu-btn::before { display: none !important; }
                `;
                document.head.appendChild(style);
            }
            
            // Delayed welcome message to improve initial load performance
            if (!isLowEndDevice) {
                setTimeout(() => {
                    showToast("🌈 ยินดีต้อนรับสู่หมากฮอสไทย! / Welcome to Thai Checkers!");
                }, 1200);
            }
        });
        
        // Throttled parallax effect for better performance
        let parallaxTimeout;
        function parallaxEffect(e) {
            if (isLowEndDevice) return;
            
            if (parallaxTimeout) return;
            
            parallaxTimeout = setTimeout(() => {
                if (window.matchMedia('(hover: hover)').matches && window.innerWidth > 768) {
                    const orbs = document.querySelectorAll('.floating-orb');
                    const x = e.clientX / window.innerWidth;
                    const y = e.clientY / window.innerHeight;
                    
                    orbs.forEach((orb, index) => {
                        const moveX = (x - 0.5) * (15 + index * 10); // Reduced movement range
                        const moveY = (y - 0.5) * (15 + index * 10);
                        orb.style.transform = `translate(${moveX}px, ${moveY}px)`;
                    });
                }
                parallaxTimeout = null;
            }, 16); // ~60fps throttling
        }
        
        if (!('ontouchstart' in window) && !isLowEndDevice) {
            document.addEventListener('mousemove', parallaxEffect, { passive: true });
        }
        
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                document.body.style.height = '100vh';
                document.body.style.height = '100dvh';
            }, 100);
        });
        
        function handleViewportResize() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
        
        window.addEventListener('resize', handleViewportResize);
        window.addEventListener('orientationchange', handleViewportResize);
        handleViewportResize();
	</script>
</body>
</html>
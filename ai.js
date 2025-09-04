// ตรวจสอบ device type เพื่อ optimize performance
const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || 
                 window.innerWidth <= 768 || 
                 ('ontouchstart' in window);

const isLowEnd = navigator.hardwareConcurrency <= 2 || 
                 /Android [1-4]|iPhone [1-5]|iPad [1-3]/i.test(navigator.userAgent);

console.log('Device detection:', { isMobile, isLowEnd });

// Throttle function สำหรับ mobile
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function changeDifficulty() {
    console.log('Current difficulty when opening modal:', currentDifficulty);
    
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
        ${!isMobile ? 'animation: fadeIn 0.3s ease;' : ''}
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
        ${!isMobile ? 'animation: slideIn 0.3s ease;' : ''}
    `;
    
    const currentDiffName = {
        'easy': 'ง่าย',
        'medium': 'ปานกลาง',
        'hard': 'ยาก', 
        'extreme': 'โหดมากๆ'
    };
    
    modalContent.innerHTML = `
        <h2 style="font-size: 2em; margin-bottom: 10px; color: #333;">🤖 เลือกระดับ AI</h2>
        <p style="color: #666; margin-bottom: 10px;">ปัจจุบัน: AI ระดับ${currentDiffName[currentDifficulty] || currentDifficulty}</p>
        <p style="color: #999; margin-bottom: 30px; font-size: 0.9em;">Select AI Difficulty</p>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <button onclick="selectNewDifficulty('easy')" class="difficulty-btn" style="
                background: linear-gradient(135deg, #66BB6A, #4CAF50);
                color: white;
                border: none;
                padding: 20px;
                border-radius: 20px;
                font-size: 1.2em;
                cursor: pointer;
                font-weight: 600;
                ${!isMobile ? 'transition: all 0.3s ease;' : 'transition: none;'}
                font-family: 'Fredoka', 'Kanit', sans-serif;
                ${currentDifficulty === 'easy' ? 'opacity: 0.5; cursor: default; border: 3px solid #4CAF50;' : ''}
            " ${currentDifficulty === 'easy' ? 'disabled' : ''}>
                🟢 ง่าย (Easy) ${currentDifficulty === 'easy' ? '← ปัจจุบัน' : ''}
                <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI มือใหม่ เหมาะสำหรับฝึกหัด</div>
            </button>
            
            <button onclick="selectNewDifficulty('medium')" class="difficulty-btn" style="
                background: linear-gradient(135deg, #FFB74D, #FF9800);
                color: white;
                border: none;
                padding: 20px;
                border-radius: 20px;
                font-size: 1.2em;
                cursor: pointer;
                font-weight: 600;
                ${!isMobile ? 'transition: all 0.3s ease;' : 'transition: none;'}
                font-family: 'Fredoka', 'Kanit', sans-serif;
                ${currentDifficulty === 'medium' ? 'opacity: 0.5; cursor: default; border: 3px solid #FF9800;' : ''}
            " ${currentDifficulty === 'medium' ? 'disabled' : ''}>
                🟡 ปานกลาง (Medium) ${currentDifficulty === 'medium' ? '← ปัจจุบัน' : ''}
                <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI ระดับทั่วไป ท้าทายพอดี</div>
            </button>
            
            <button onclick="selectNewDifficulty('hard')" class="difficulty-btn" style="
                background: linear-gradient(135deg, #FF6B9D, #FF4757);
                color: white;
                border: none;
                padding: 20px;
                border-radius: 20px;
                font-size: 1.2em;
                cursor: pointer;
                font-weight: 600;
                ${!isMobile ? 'transition: all 0.3s ease;' : 'transition: none;'}
                font-family: 'Fredoka', 'Kanit', sans-serif;
                ${currentDifficulty === 'hard' ? 'opacity: 0.5; cursor: default; border: 3px solid #FF4757;' : ''}
            " ${currentDifficulty === 'hard' ? 'disabled' : ''}>
                🔴 ยาก (Hard) ${currentDifficulty === 'hard' ? '← ปัจจุบัน' : ''}
                <div style="font-size: 0.8em; opacity: 0.9; margin-top: 5px;">AI แข็งแกร่ง ต้องคิดมาก</div>
            </button>
            
            <button onclick="selectNewDifficulty('extreme')" class="difficulty-btn" style="
                background: linear-gradient(135deg, #9B59B6, #8E44AD);
                color: white;
                border: none;
                padding: 20px;
                border-radius: 20px;
                font-size: 1.2em;
                cursor: pointer;
                font-weight: 600;
                ${!isMobile ? 'transition: all 0.3s ease;' : 'transition: none;'}
                font-family: 'Fredoka', 'Kanit', sans-serif;
                ${currentDifficulty === 'extreme' ? 'opacity: 0.5; cursor: default; border: 3px solid #8E44AD;' : ''}
            " ${currentDifficulty === 'extreme' ? 'disabled' : ''}>
                🟣 โหดมากๆ (Extreme) ${currentDifficulty === 'extreme' ? '← ปัจจุบัน' : ''}
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
            ${!isMobile ? 'transition: all 0.3s ease;' : 'transition: none;'}
            font-family: 'Fredoka', 'Kanit', sans-serif;
        ">ยกเลิก / Cancel</button>
    `;
    
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
    
    // เฉพาะ desktop ถึงจะใส่ animations
    if (!isMobile) {
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
            .difficulty-btn:not(:disabled):hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
        `;
        document.head.appendChild(style);
    }
    
    window.selectNewDifficulty = function(difficulty) {
        console.log('=== SELECT NEW DIFFICULTY ===');
        console.log('Selected difficulty:', difficulty);
        console.log('Current difficulty:', currentDifficulty);
        console.log('Are they the same?', difficulty === currentDifficulty);
        
        if (difficulty === currentDifficulty) {
            console.log('Same difficulty selected, closing modal');
            closeModal();
            return;
        }
        
        const targetUrl = `/ai/?diff=${difficulty}`;
        console.log('Target URL:', targetUrl);
        
        if (game) {
            game.showToast(`🎯 กำลังเปลี่ยนเป็น AI ระดับ${difficulty === 'easy' ? 'ง่าย' : difficulty === 'medium' ? 'ปานกลาง' : difficulty === 'hard' ? 'ยาก' : 'โหดมากๆ'}...`, 'info');
        }
        
        setTimeout(() => {
            console.log('Redirecting to:', targetUrl);
            window.location.href = targetUrl;
        }, 500);
    };
    
    window.closeModal = function() {
        modal.remove();
        if (!isMobile && document.head.lastElementChild.tagName === 'STYLE') {
            document.head.lastElementChild.remove();
        }
    };
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
}

function goToMenu() {
    window.location.href = '/home';
}

function showLeaderboard() {
    window.location.href = '/stats';
}

function showMyStats() {
    window.location.href = '/stats';
}

// Optimized event listeners สำหรับ mobile
const handleKeyDown = isMobile ? null : function(e) {
    if (!game) return;
    
    switch(e.key) {
        case 'n':
        case 'N':
            if (e.ctrlKey) {
                e.preventDefault();
                newGame();
            }
            break;
        case 'Escape':
            if (game.selectedPiece) {
                game.selectedPiece = null;
                game.validMoves = [];
                game.renderBoard();
                game.updateStatus();
            }
            break;
    }
};

if (handleKeyDown) {
    document.addEventListener('keydown', handleKeyDown);
}

window.addEventListener('load', () => {
    console.log('=== WINDOW LOAD DEBUG ===');
    console.log('currentDifficulty variable:', currentDifficulty);
    console.log('typeof currentDifficulty:', typeof currentDifficulty);
    console.log('currentDifficulty length:', currentDifficulty.length);
    console.log('currentDifficulty charCodes:', Array.from(currentDifficulty).map(c => c.charCodeAt(0)));
    
    const cleanDifficulty = currentDifficulty.trim();
    console.log('cleaned currentDifficulty:', cleanDifficulty);
    console.log('is clean same as original?', cleanDifficulty === currentDifficulty);
    
    newGame();
    
    setTimeout(() => {
        if (game) {
            const diffNames = {
                'easy': 'ง่าย',
                'medium': 'ปานกลาง', 
                'hard': 'ยาก',
                'extreme': 'โหดมากๆ'
            };
            
            const expectedName = diffNames[currentDifficulty] || currentDifficulty;
            console.log('Expected difficulty name:', expectedName);
            
            game.showToast(`🤖 ยินดีต้อนรับสู่การเล่นกับ AI ระดับ${expectedName}!`, 'success');
        }
    }, 1000);
});

let autoPlayInterval = null;
let autoPlayAI = null;
let autoPlayGameCount = 0;

function toggleAutoPlay() {
    const btn = document.getElementById('autoPlayBtn');
    let indicator = document.getElementById('autoPlayIndicator');
    
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.id = 'autoPlayIndicator';
        indicator.className = 'auto-play-indicator';
        indicator.textContent = '🤖 กำลังเล่นอัตโนมัติ…';
        document.body.appendChild(indicator);
    }
    
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval);
        autoPlayInterval = null;
        autoPlayAI = null;
        autoPlayGameCount = 0;
        btn.textContent = '🤖 Auto Test Play';
        btn.classList.remove('active');
        indicator.classList.remove('show');
        
        if (game) {
            game.showToast('⏸️ หยุด Auto Test Play', 'info');
        }
    } else {
        if (!game || game.gameOver) {
            newGame();
        }
        
        autoPlayAI = new CheckersAI(currentDifficulty);
        autoPlayGameCount = 0;
        
        btn.textContent = '⏸️ หยุด Auto Test';
        btn.classList.add('active');
        indicator.classList.add('show');
        
        if (game) {
            game.showToast('🤖 เริ่ม Auto Test Play - AI vs AI', 'success');
        }
        
        // เพิ่ม delay สำหรับ mobile device
        const autoPlayDelay = isMobile ? 700 : 400;
        // const autoPlayDelay = isMobile ? 100 : 200;
        autoPlayInterval = setInterval(() => {
            if (game && !game.gameOver) {
                if (game.currentPlayer === 'red' && !game.processingMove) {
                    makeAutoMove();
                }
            } else if (game && game.gameOver) {
                autoPlayGameCount++;
                
                setTimeout(() => {
                    if (autoPlayInterval) {
                        window.location.reload();
                    }
                }, 2000);
            }
        }, autoPlayDelay);
    }
}

function makeAutoMove() {
    if (!game || game.gameOver || game.currentPlayer !== 'red' || !autoPlayAI || game.processingMove) return;
    
    try {
        if (game.mustCapture && game.selectedPiece) {
            const continuousCaptures = game.getValidMoves(game.selectedPiece.row, game.selectedPiece.col, 'red')
                .filter(move => move.capture);
            
            if (continuousCaptures.length > 0 && game.continuousCaptureCount < game.maxContinuousCaptures) {
                const capture = continuousCaptures[0];
                game.makeMove(game.selectedPiece, capture);
                game.renderBoard();
                game.updateStatus();
                return;
            } else {
                game.mustCapture = false;
                game.selectedPiece = null;
                game.validMoves = [];
                game.continuousCaptureCount = 0;
                game.switchTurn();
                game.renderBoard();
                game.updateStatus();
                return;
            }
        }
        
        const aiMove = autoPlayAI.makeMove(game.board, 'red');
        
        if (aiMove) {
            const from = aiMove.from;
            const to = aiMove.to;
            
            const validMoves = game.getValidMoves(from.row, from.col, 'red');
            const validMove = validMoves.find(m => m.row === to.row && m.col === to.col);
            
            if (validMove) {
                game.selectedPiece = from;
                game.validMoves = [validMove];
                game.renderBoard();
                
                setTimeout(() => {
                    if (game.selectedPiece && game.validMoves.length > 0) {
                        game.makeMove(game.selectedPiece, game.validMoves[0]);
                        game.renderBoard();
                        game.updateStatus();
                    }
                }, isMobile ? 750 : 500);
            }
        }
    } catch (error) {
        console.error('Auto move error:', error);
        if (game && !game.gameOver) {
            game.mustCapture = false;
            game.selectedPiece = null;
            game.validMoves = [];
            game.continuousCaptureCount = 0;
            game.switchTurn();
            game.renderBoard();
            game.updateStatus();
        }
    }
}

// Memory management สำหรับ mobile
const memoryCleanupInterval = isMobile ? 30000 : 45000; // ทำความสะอาดบ่อยขึ้นใน mobile

window.addEventListener('beforeunload', () => {
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval);
    }
    
    if (game && game.ai) {
        game.ai.evaluationCache.clear();
        game.ai.transpositionTable.clear();
    }
    
    if (autoPlayAI) {
        autoPlayAI.evaluationCache.clear();
        autoPlayAI.transpositionTable.clear();
    }
});

setInterval(() => {
    if (game && game.ai) {
        const maxCacheSize = isMobile ? 1000 : 1500;
        const maxTranspositionSize = isMobile ? 500 : 800;
        
        if (game.ai.evaluationCache.size > maxCacheSize) {
            game.ai.evaluationCache.clear();
        }
        if (game.ai.transpositionTable.size > maxTranspositionSize) {
            game.ai.transpositionTable.clear();
        }
    }
    
    if (autoPlayAI) {
        const maxCacheSize = isMobile ? 1000 : 1500;
        const maxTranspositionSize = isMobile ? 500 : 800;
        
        if (autoPlayAI.evaluationCache.size > maxCacheSize) {
            autoPlayAI.evaluationCache.clear();
        }
        if (autoPlayAI.transpositionTable.size > maxTranspositionSize) {
            autoPlayAI.transpositionTable.clear();
        }
    }
}, memoryCleanupInterval);

// Error handling ที่ปรับปรุงแล้ว
window.addEventListener('error', (event) => {
    console.error('Global error:', event.error);
    
    if (game && !game.gameOver) {
        try {
            game.showToast('⚠️ เกิดข้อผิดพลาด กำลังแก้ไข...', 'warning');
            
            setTimeout(() => {
                if (game.currentPlayer === 'black' && !game.gameOver && !game.processingMove) {
                    game.forceEndAITurn();
                }
            }, 1000);
        } catch (recoveryError) {
            console.error('Recovery failed:', recoveryError);
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }
    }
});

// Optimized touch handling
let lastTouchEnd = 0;

document.addEventListener('touchstart', function(e) {
    if (e.touches.length > 1) {
        e.preventDefault();
    }
}, { passive: false });

document.addEventListener('touchend', function(e) {
    const now = (new Date()).getTime();
    if (now - lastTouchEnd <= 300) {
        e.preventDefault();
    }
    lastTouchEnd = now;
}, false);

// Sparkle effects - เฉพาะ desktop
function createSparkle() {
    if (isMobile) return; // ไม่ทำใน mobile
    
    const sparkle = document.createElement('div');
    sparkle.className = 'sparkle';
    sparkle.style.left = Math.random() * 100 + '%';
    sparkle.style.top = Math.random() * 100 + '%';
    document.body.appendChild(sparkle);
    
    setTimeout(() => {
        sparkle.remove();
    }, 2000);
}

// เฉพาะ desktop ถึงจะทำ sparkle
if (!isMobile) {
    setInterval(createSparkle, 3000);
}

// Toast system ที่ปรับปรุงแล้ว
let currentToast = null;
let shownMessages = new Set();
let gameSessionId = Date.now();

function resetShownMessages() {
    shownMessages.clear();
    gameSessionId = Date.now();
}

class CheckersAI {
    constructor(difficulty = 'hard') {
        this.difficulty = difficulty;
        this.maxDepth = this.getMaxDepth();
        this.evaluationCache = new Map();
        this.transpositionTable = new Map();
        this.moveHistory = [];
    }
    
    getMaxDepth() {
        // Adjust maximum search depth based on device capabilities and difficulty.
        // Higher difficulties search deeper, while mobile/low‑end devices cap the depth
        // to prevent excessive computation and maintain a responsive UI.
        if (isMobile || isLowEnd) {
            switch (this.difficulty) {
                case 'easy':    return 1;
                case 'medium':  return 2;
                case 'hard':    return 3;
                case 'extreme': return 4;
                default:        return 2;
            }
        } else {
            switch (this.difficulty) {
                case 'easy':    return 1;
                case 'medium':  return 3;
                case 'hard':    return 4;
                case 'extreme': return 5;
                default:        return 3;
            }
        }
    }
    
    makeMove(board, currentPlayer) {
        if (this.difficulty === 'easy') {
            return this.makeRandomMove(board, currentPlayer);
        }
        
        // ลด cache size ใน mobile
        const maxCacheSize = isMobile ? 500 : 1000;
        const maxTranspositionSize = isMobile ? 250 : 500;
        
        if (this.evaluationCache.size > maxCacheSize) {
            this.evaluationCache.clear();
        }
        if (this.transpositionTable.size > maxTranspositionSize) {
            this.transpositionTable.clear();
        }
        
        const startTime = Date.now();
        
        if (this.difficulty === 'extreme' && !isMobile) {
            const strategicMove = this.findStrategicMove(board, currentPlayer);
            if (strategicMove) {
                const endTime = Date.now();
                console.log(`AI (${this.difficulty}) กลยุทธ์: ${endTime - startTime}ms`);
                return strategicMove;
            }
        }
        
        const move = this.minimax(board, this.maxDepth, -Infinity, Infinity, true, currentPlayer);
        const endTime = Date.now();
        
        console.log(`AI (${this.difficulty}) คิด: ${endTime - startTime}ms`);
        
        return move.move;
    }
    
    findStrategicMove(board, player) {
        if (isMobile) return null; // ข้าม strategic moves ใน mobile
        
        const opponent = player === 'black' ? 'red' : 'black';
        const myKings = this.getKings(board, player);
        const enemyPieces = this.getAllPieces(board, opponent);
        const myPieces = this.getAllPieces(board, player);
        
        // กลยุทธ์การหลอกให้กิน - ใช้เมื่อเรามีเปรียบ
        if (myKings.length >= 2 && enemyPieces.length <= 3) {
            const baitMove = this.findAdvancedBaitMove(board, player);
            if (baitMove) {
                console.log('🎭 AI ใช้กลยุทธ์หลอกให้กิน!');
                return baitMove;
            }
        }
        
        // กลยุทธ์การควบคุมศูนย์กลางในช่วงต้นเกม
        if (this.isEarlyGame(board)) {
            const centerMove = this.findCenterControlMove(board, player);
            if (centerMove) {
                return centerMove;
            }
        }
        
        // กลยุทธ์การสร้างแนวป้องกัน
        const defensiveMove = this.findDefensiveMove(board, player);
        if (defensiveMove) {
            return defensiveMove;
        }
        
        return null;
    }
    
    findAdvancedBaitMove(board, player) {
        const opponent = player === 'black' ? 'red' : 'black';
        const myKings = this.getKings(board, player);
        const possibleMoves = this.getAllPossibleMoves(board, player);
        
        // หาการเดินที่เป็นการหลอกที่ซับซ้อน
        for (const baitKing of myKings) {
            const kingMoves = this.getValidMovesForPiece(board, baitKing.row, baitKing.col, player);
            
            for (const move of kingMoves) {
                if (move.capture) continue;
                
                const newBoard = this.simulateMove(board, {
                    from: { row: baitKing.row, col: baitKing.col },
                    to: move
                });
                
                // ตรวจสอบว่าคู่ต่อสู้สามารถกิน King ที่เราวางไว้ได้หรือไม่
                const opponentCaptures = this.getAllCaptureMoves(newBoard, opponent);
                
                for (const capture of opponentCaptures) {
                    if (capture.to.capturedRow === move.row && capture.to.capturedCol === move.col) {
                        // คู่ต่อสู้สามารถกินได้ ตรวจสอบว่าเรามี King อื่นสามารถกินคืนได้หรือไม่
                        const afterCaptureBoard = this.simulateMove(newBoard, capture);
                        const ourCounterCaptures = this.getAllCaptureMoves(afterCaptureBoard, player);
                        
                        for (const counter of ourCounterCaptures) {
                            if (counter.to.capturedRow === capture.to.row && counter.to.capturedCol === capture.to.col) {
                                // เราสามารถกินคืนได้!
                                const finalBoard = this.simulateMove(afterCaptureBoard, counter);
                                
                                // ประเมินผลลัพธ์ของการหลอก
                                const initialScore = this.evaluateBoard(board, player);
                                const finalScore = this.evaluateBoard(finalBoard, player);
                                
                                // ตรวจสอบว่าหลังจากการแลกเปลี่ยนแล้ว เรายังมีเปรียบอยู่หรือไม่
                                const myRemainingPieces = this.getAllPieces(finalBoard, player).length;
                                const enemyRemainingPieces = this.getAllPieces(finalBoard, opponent).length;
                                
                                if (finalScore > initialScore && myRemainingPieces > enemyRemainingPieces) {
                                    console.log(`🎯 พบการหลอกขั้นสูง: King ${baitKing.row},${baitKing.col} -> ${move.row},${move.col}`);
                                    return {
                                        from: { row: baitKing.row, col: baitKing.col },
                                        to: move,
                                        capture: false
                                    };
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return null;
    }
    
    findCenterControlMove(board, player) {
        const centerSquares = [[3,3], [3,4], [4,3], [4,4]];
        const possibleMoves = this.getAllPossibleMoves(board, player);
        
        for (const move of possibleMoves) {
            if (!move.capture) {
                for (const [centerRow, centerCol] of centerSquares) {
                    if (move.to.row === centerRow && move.to.col === centerCol) {
                        return move;
                    }
                }
            }
        }
        
        return null;
    }
    
    findDefensiveMove(board, player) {
        const backRow = player === 'black' ? 0 : 7;
        const possibleMoves = this.getAllPossibleMoves(board, player);
        
        for (let col = 0; col < 8; col++) {
            if (!board[backRow][col]) {
                for (const move of possibleMoves) {
                    if (!move.capture && move.to.row === backRow && move.to.col === col) {
                        return move;
                    }
                }
            }
        }
        
        return null;
    }
    
    isEarlyGame(board) {
        let totalPieces = 0;
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                if (board[row][col]) totalPieces++;
            }
        }
        return totalPieces > 10;
    }
    
    getKings(board, player) {
        const kings = [];
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === player && piece.king) {
                    kings.push({row, col, piece});
                }
            }
        }
        return kings;
    }
    
    getAllPieces(board, player) {
        const pieces = [];
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === player) {
                    pieces.push({row, col, piece});
                }
            }
        }
        return pieces;
    }
    
    getAllCaptureMoves(board, player) {
        const captures = [];
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === player) {
                    const moves = this.getValidMovesForPiece(board, row, col, player);
                    const captureMoves = moves.filter(m => m.capture);
                    captures.push(...captureMoves.map(m => ({
                        from: { row, col },
                        to: m,
                        capture: true
                    })));
                }
            }
        }
        return captures;
    }
    
    makeRandomMove(board, currentPlayer) {
        const possibleMoves = this.getAllPossibleMoves(board, currentPlayer);
        
        if (possibleMoves.length === 0) return null;
        
        const captureMoves = possibleMoves.filter(move => move.capture);
        
        if (captureMoves.length > 0 && Math.random() > 0.3) {
            return captureMoves[Math.floor(Math.random() * captureMoves.length)];
        }
        
        return possibleMoves[Math.floor(Math.random() * possibleMoves.length)];
    }
    
    minimax(board, depth, alpha, beta, maximizingPlayer, currentPlayer) {
        const boardKey = this.getBoardKey(board, currentPlayer, maximizingPlayer);
        if (this.transpositionTable.has(boardKey)) {
            const cached = this.transpositionTable.get(boardKey);
            if (cached.depth >= depth) {
                return cached;
            }
        }
        
        if (depth === 0 || this.isGameOver(board)) {
            const score = this.evaluateBoard(board, currentPlayer);
            const result = { score, move: null };
            this.transpositionTable.set(boardKey, { ...result, depth });
            return result;
        }

        const player = maximizingPlayer ? currentPlayer : (currentPlayer === 'black' ? 'red' : 'black');
        const possibleMoves = this.getAllPossibleMoves(board, player);
        
        if (possibleMoves.length === 0) {
            const score = maximizingPlayer ? -10000 : 10000;
            const result = { score, move: null };
            this.transpositionTable.set(boardKey, { ...result, depth });
            return result;
        }

        // Sort moves เพื่อให้ alpha-beta pruning ทำงานได้ดีขึ้น
        possibleMoves.sort((a, b) => {
            if (a.capture && !b.capture) return -1;
            if (!a.capture && b.capture) return 1;
            return 0;
        });

        if (maximizingPlayer) {
            let maxEval = -Infinity;
            let bestMoves = [];
            
            for (const move of possibleMoves) {
                const newBoard = this.simulateMove(board, move);
                const evaluation = this.minimax(newBoard, depth - 1, alpha, beta, false, currentPlayer);

                if (evaluation.score > maxEval) {
                    maxEval = evaluation.score;
                    bestMoves = [move];
                } else if (evaluation.score === maxEval) {
                    bestMoves.push(move);
                }

                alpha = Math.max(alpha, evaluation.score);
                if (beta <= alpha) break;
            }
            
            const selected = bestMoves[Math.floor(Math.random() * bestMoves.length)];
            const result = { score: maxEval, move: selected };
            this.transpositionTable.set(boardKey, { ...result, depth });
            return result;

        } else {
            let minEval = Infinity;
            let bestMoves = [];
            
            for (const move of possibleMoves) {
                const newBoard = this.simulateMove(board, move);
                const evaluation = this.minimax(newBoard, depth - 1, alpha, beta, true, currentPlayer);

                if (evaluation.score < minEval) {
                    minEval = evaluation.score;
                    bestMoves = [move];
                } else if (evaluation.score === minEval) {
                    bestMoves.push(move);
                }

                beta = Math.min(beta, evaluation.score);
                if (beta <= alpha) break;
            }
            
            const selected = bestMoves[Math.floor(Math.random() * bestMoves.length)];
            const result = { score: minEval, move: selected };
            this.transpositionTable.set(boardKey, { ...result, depth });
            return result;
        }
    }
    
    getBoardKey(board, player, maximizing) {
        let key = `${player}-${maximizing}-`;
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece) {
                    key += `${row}${col}${piece.color[0]}${piece.king ? 'k' : 'r'}`;
                }
            }
        }
        return key;
    }

    evaluateBoard(board, player) {
        const cacheKey = this.getBoardKey(board, player, true);
        if (this.evaluationCache.has(cacheKey)) {
            return this.evaluationCache.get(cacheKey);
        }
        
        let score = 0;
        const opponent = player === 'black' ? 'red' : 'black';
        
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (!piece) continue;
                
                const value = this.getPieceValue(piece, row, col);
                
                if (piece.color === player) {
                    score += value;
                } else {
                    score -= value;
                }
            }
        }
        
        score += this.evaluateBoardControl(board, player);
        score += this.evaluateBackRowDefense(board, player);
        score += this.evaluateMobility(board, player);
        score += this.evaluateAdvancement(board, player);
        // Incorporate a safety evaluation which rewards boards where the AI has
        // capture opportunities and penalises boards where its pieces are under threat.
        score += this.evaluateSafety(board, player);
        // Use strategic positional evaluation only for the extreme difficulty on non‑mobile devices.
        if (this.difficulty === 'extreme' && !isMobile) {
            score += this.evaluateStrategicPosition(board, player);
        }
        this.evaluationCache.set(cacheKey, score);
        return score;
    }

    /**
     * Evaluate the relative safety of the current board for the given player.  A positive
     * score indicates the player has more capture opportunities than the opponent and
     * fewer pieces exposed to immediate capture.  The weighting scales with the
     * difficulty: harder AIs place greater emphasis on safety.
     *
     * @param {Array<Array<Object|null>>} board
     * @param {string} player
     * @returns {number}
     */
    evaluateSafety(board, player) {
        const opponent = player === 'black' ? 'red' : 'black';
        const myCaptures = this.getAllCaptureMoves(board, player).length;
        const oppCaptures = this.getAllCaptureMoves(board, opponent).length;
        let weight;
        switch (this.difficulty) {
            case 'easy':
                weight = 2;
                break;
            case 'medium':
                weight = 3;
                break;
            case 'hard':
                weight = 5;
                break;
            case 'extreme':
                weight = 8;
                break;
            default:
                weight = 4;
        }
        return (myCaptures - oppCaptures) * weight;
    }
    
    evaluateStrategicPosition(board, player) {
        let score = 0;
        const opponent = player === 'black' ? 'red' : 'black';
        
        const myMobility = this.getAllPossibleMoves(board, player).length;
        const opponentMobility = this.getAllPossibleMoves(board, opponent).length;
        score += (myMobility - opponentMobility) * 3;
        
        const myKings = this.getKings(board, player).length;
        const opponentKings = this.getKings(board, opponent).length;
        
        if (myKings > opponentKings) {
            score += 25;
        }
        
        score += this.evaluateTrapping(board, player);
        score += this.evaluateKingSafety(board, player);
        
        return score;
    }
    
    evaluateKingSafety(board, player) {
        let score = 0;
        const kings = this.getKings(board, player);
        
        for (const king of kings) {
            // ให้คะแนนถ้า King อยู่ในตำแหน่งที่ปลอดภัย
            if (king.row === 0 || king.row === 7 || king.col === 0 || king.col === 7) {
                score += 5;
            }
        }
        
        return score;
    }
    
    evaluateTrapping(board, player) {
        let score = 0;
        const opponent = player === 'black' ? 'red' : 'black';
        
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === opponent) {
                    const moves = this.getValidMovesForPiece(board, row, col, opponent);
                    if (moves.length === 0) {
                        score += 20;
                    } else if (moves.length === 1) {
                        score += 10;
                    }
                }
            }
        }
        
        return score;
    }
    
    evaluateMobility(board, player) {
        const myMoves = this.getAllPossibleMoves(board, player).length;
        const opponent = player === 'black' ? 'red' : 'black';
        const opponentMoves = this.getAllPossibleMoves(board, opponent).length;
        
        return (myMoves - opponentMoves) * 2;
    }
    
    evaluateAdvancement(board, player) {
        let score = 0;
        
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === player && !piece.king) {
                    const advancement = player === 'red' ? (7 - row) : row;
                    score += advancement;
                }
            }
        }
        
        return score;
    }
    
    getPieceValue(piece, row, col) {
        let value = piece.king ? 60 : 35;
        
        if (!piece.king) {
            if (piece.color === 'red') {
                value += (7 - row) * 3;
            } else {
                value += row * 3;
            }
        }
        
        if (row >= 3 && row <= 4 && col >= 3 && col <= 4) {
            value += 8;
        }
        
        if (col === 0 || col === 7) {
            value += 5;
        }
        
        return value;
    }
    
    evaluateBoardControl(board, player) {
        let control = 0;
        const centerSquares = [[3,3], [3,4], [4,3], [4,4]];
        
        for (const [row, col] of centerSquares) {
            if (board[row][col] && board[row][col].color === player) {
                control += 15;
            }
        }
        
        return control;
    }
    
    evaluateBackRowDefense(board, player) {
        let defense = 0;
        const backRow = player === 'red' ? 7 : 0;
        
        for (let col = 0; col < 8; col++) {
            if (board[backRow][col] && board[backRow][col].color === player && !board[backRow][col].king) {
                defense += 8;
            }
        }
        
        return defense;
    }
    
    getAllPossibleMoves(board, player) {
        const moves = [];
        let mustCapture = false;
        
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                const piece = board[row][col];
                if (piece && piece.color === player) {
                    const pieceMoves = this.getValidMovesForPiece(board, row, col, player);
                    const captureMoves = pieceMoves.filter(m => m.capture);
                    
                    if (captureMoves.length > 0) {
                        mustCapture = true;
                        moves.push(...captureMoves.map(m => ({
                            from: { row, col },
                            to: m,
                            capture: true
                        })));
                    }
                }
            }
        }
        
        if (!mustCapture) {
            for (let row = 0; row < 8; row++) {
                for (let col = 0; col < 8; col++) {
                    const piece = board[row][col];
                    if (piece && piece.color === player) {
                        const pieceMoves = this.getValidMovesForPiece(board, row, col, player);
                        moves.push(...pieceMoves.map(m => ({
                            from: { row, col },
                            to: m,
                            capture: false
                        })));
                    }
                }
            }
        }
        
        return moves;
    }
    
    getValidMovesForPiece(board, row, col, player) {
        const piece = board[row][col];
        if (!piece || piece.color !== player) return [];
        
        const moves = [];
        
        if (piece.king) {
            const directions = [[-1, -1], [-1, 1], [1, -1], [1, 1]];
            
            for (const [dr, dc] of directions) {
                for (let distance = 1; distance < 8; distance++) {
                    const newRow = row + dr * distance;
                    const newCol = col + dc * distance;
                    
                    if (!this.isValidPosition(newRow, newCol)) break;
                    
                    const targetSquare = board[newRow][newCol];
                    
                    if (!targetSquare) {
                        moves.push({ row: newRow, col: newCol, capture: false });
                    } else if (targetSquare.color !== player) {
                        const captureRow = newRow + dr;
                        const captureCol = newCol + dc;
                        
                        if (this.isValidPosition(captureRow, captureCol) && !board[captureRow][captureCol]) {
                            moves.push({
                                row: captureRow,
                                col: captureCol,
                                capture: true,
                                capturedRow: newRow,
                                capturedCol: newCol
                            });
                        }
                        break;
                    } else {
                        break;
                    }
                }
            }
        } else {
            const directions = player === 'red' ? [[-1, -1], [-1, 1]] : [[1, -1], [1, 1]];
            
            for (const [dr, dc] of directions) {
                const newRow = row + dr;
                const newCol = col + dc;
                
                if (this.isValidPosition(newRow, newCol) && !board[newRow][newCol]) {
                    moves.push({ row: newRow, col: newCol, capture: false });
                }
                
                const captureRow = row + dr * 2;
                const captureCol = col + dc * 2;
                
                if (this.isValidPosition(captureRow, captureCol) &&
                    !board[captureRow][captureCol] &&
                    board[newRow][newCol] &&
                    board[newRow][newCol].color !== player) {
                    moves.push({
                        row: captureRow,
                        col: captureCol,
                        capture: true,
                        capturedRow: newRow,
                        capturedCol: newCol
                    });
                }
            }
        }
        
        return moves;
    }
    
    isValidPosition(row, col) {
        return row >= 0 && row < 8 && col >= 0 && col < 8;
    }
    
    simulateMove(board, move) {
        const newBoard = board.map(row => row.map(cell => cell ? {...cell} : null));
        
        const piece = newBoard[move.from.row][move.from.col];
        newBoard[move.to.row][move.to.col] = piece;
        newBoard[move.from.row][move.from.col] = null;
        
        if (move.capture) {
            newBoard[move.to.capturedRow][move.to.capturedCol] = null;
        }
        
        if (!piece.king) {
            if ((piece.color === 'red' && move.to.row === 0) ||
                (piece.color === 'black' && move.to.row === 7)) {
                piece.king = true;
            }
        }
        
        return newBoard;
    }
    
    isGameOver(board) {
        const redPieces = this.countPieces(board, 'red');
        const blackPieces = this.countPieces(board, 'black');
        
        return redPieces === 0 || blackPieces === 0;
    }
    
    countPieces(board, color) {
        let count = 0;
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                if (board[row][col] && board[row][col].color === color) {
                    count++;
                }
            }
        }
        return count;
    }
}

class AICheckers {
    constructor(difficulty) {
        this.board = [];
        this.currentPlayer = 'red';
        this.selectedPiece = null;
        this.validMoves = [];
        this.gameOver = false;
        this.mustCapture = false;
        this.moveHistory = [];
        this.gameStartTime = Date.now();
        this.ai = new CheckersAI(difficulty);
        this.moveTimeout = null;
        this.processingMove = false;
        this.winner = null;
        this.gameStartTimeStamp = new Date();
        this.gameEndTimeStamp = null;
        this.playerPiecesCaptured = 0;
        this.aiPiecesCaptured = 0;
        this.playerKingsPromoted = 0;
        this.aiKingsPromoted = 0;
        this.continuousCaptureCount = 0;
        this.maxContinuousCaptures = 15; // เพิ่มจาก 8 เป็น 15
        this.aiMoveAttempts = 0;
        this.maxAIMoveAttempts = 25; // เพิ่มจาก 15 เป็น 25 เพื่อรองรับการกินต่อเนื่องที่ยาวขึ้น
        
        this.initializeBoard();
        this.renderBoard();
        this.updateStatus();
    }
    
    initializeBoard() {
        this.board = Array(8).fill(null).map(() => Array(8).fill(null));
        
        for (let col = 1; col < 8; col += 2) {
            this.board[7][col] = { color: 'red', king: false };
        }
        for (let col = 0; col < 8; col += 2) {
            this.board[6][col] = { color: 'red', king: false };
        }
        
        for (let col = 0; col < 8; col += 2) {
            this.board[0][col] = { color: 'black', king: false };
        }
        for (let col = 1; col < 8; col += 2) {
            this.board[1][col] = { color: 'black', king: false };
        }
    }
    
    renderBoard() {
        const boardElement = document.getElementById('board');
        if (!boardElement) return;
        
        boardElement.innerHTML = '';
        
        for (let row = 0; row < 8; row++) {
            const rowElement = document.createElement('div');
            rowElement.className = 'row';
            
            for (let col = 0; col < 8; col++) {
                const cell = document.createElement('div');
                cell.className = `cell ${(row + col) % 2 === 0 ? 'light' : 'dark'}`;
                cell.dataset.row = row;
                cell.dataset.col = col;
                
                if (this.selectedPiece && this.selectedPiece.row === row && this.selectedPiece.col === col) {
                    cell.classList.add('selected');
                }
                
                if (this.validMoves.some(move => move.row === row && move.col === col)) {
                    cell.classList.add('valid-move');
                }
                
                const piece = this.board[row][col];
                if (piece) {
                    const pieceElement = document.createElement('div');
                    pieceElement.className = `piece ${piece.color}${piece.king ? ' king' : ''}`;
                    cell.appendChild(pieceElement);
                }
                
                // Optimized event handling สำหรับ mobile
                if (isMobile) {
                    cell.addEventListener('touchstart', (e) => {
                        e.preventDefault();
                        this.handleCellClick(row, col, e);
                    }, { passive: false });
                } else {
                    cell.addEventListener('click', (e) => this.handleCellClick(row, col, e));
                }
                
                rowElement.appendChild(cell);
            }
            
            boardElement.appendChild(rowElement);
        }
    }
    
    async handleCellClick(row, col, event) {
        if (this.gameOver || this.currentPlayer !== 'red' || this.processingMove) return;
        
        event.preventDefault();
        event.stopPropagation();
        
        const piece = this.board[row][col];
        let shouldRerender = false;
        
        if (this.selectedPiece) {
            const validMove = this.validMoves.find(move => move.row === row && move.col === col);
            if (validMove) {
                this.processingMove = true;
                await this.makeMove(this.selectedPiece, validMove);
                this.selectedPiece = null;
                this.validMoves = [];
                this.processingMove = false;
                shouldRerender = true;
            } else if (piece && piece.color === this.currentPlayer) {
                if (this.selectedPiece.row !== row || this.selectedPiece.col !== col) {
                    this.selectPiece(row, col);
                    shouldRerender = true;
                }
            } else {
                this.selectedPiece = null;
                this.validMoves = [];
                shouldRerender = true;
            }
        } else if (piece && piece.color === this.currentPlayer) {
            this.selectPiece(row, col);
            shouldRerender = true;
        }
        
        if (shouldRerender) {
            this.renderBoard();
            this.updateStatus();
        }
    }
    
    selectPiece(row, col) {
        this.selectedPiece = { row, col };
        this.validMoves = this.getValidMoves(row, col, this.currentPlayer);
        
        if (this.mustCapture) {
            this.validMoves = this.validMoves.filter(move => move.capture);
        }
    }
    
    getValidMoves(row, col, player) {
        const piece = this.board[row][col];
        if (!piece || piece.color !== player) return [];
        
        const moves = [];
        
        if (piece.king) {
            const directions = [[-1, -1], [-1, 1], [1, -1], [1, 1]];
            
            for (const [dr, dc] of directions) {
                for (let distance = 1; distance < 8; distance++) {
                    const newRow = row + dr * distance;
                    const newCol = col + dc * distance;
                    
                    if (!this.isValidPosition(newRow, newCol)) break;
                    
                    const targetSquare = this.board[newRow][newCol];
                    
                    if (!targetSquare) {
                        moves.push({ row: newRow, col: newCol, capture: false });
                    } else if (targetSquare.color !== player) {
                        const captureRow = newRow + dr;
                        const captureCol = newCol + dc;
                        
                        if (this.isValidPosition(captureRow, captureCol) &&
                            !this.board[captureRow][captureCol]) {
                            moves.push({
                                row: captureRow,
                                col: captureCol,
                                capture: true,
                                capturedRow: newRow,
                                capturedCol: newCol
                            });
                        }
                        break;
                    } else {
                        break;
                    }
                }
            }
        } else {
            const directions = player === 'red' ? [[-1, -1], [-1, 1]] : [[1, -1], [1, 1]];
            
            for (const [dr, dc] of directions) {
                const newRow = row + dr;
                const newCol = col + dc;
                
                if (this.isValidPosition(newRow, newCol) && !this.board[newRow][newCol]) {
                    moves.push({ row: newRow, col: newCol, capture: false });
                }
                
                const captureRow = row + dr * 2;
                const captureCol = col + dc * 2;
                
                if (this.isValidPosition(captureRow, captureCol) &&
                    !this.board[captureRow][captureCol] &&
                    this.board[newRow][newCol] &&
                    this.board[newRow][newCol].color !== player) {
                    moves.push({
                        row: captureRow,
                        col: captureCol,
                        capture: true,
                        capturedRow: newRow,
                        capturedCol: newCol
                    });
                }
            }
        }
        
        return moves;
    }
    
    isValidPosition(row, col) {
        return row >= 0 && row < 8 && col >= 0 && col < 8;
    }
    
    async makeMove(from, to) {
        const piece = this.board[from.row][from.col];
        
        const moveNotation = this.getMoveNotation(from, to);
        this.addMoveToHistory(moveNotation);
        
        this.board[to.row][to.col] = piece;
        this.board[from.row][from.col] = null;
        
        if (to.capture) {
            this.board[to.capturedRow][to.capturedCol] = null;
            
            if (this.currentPlayer === 'red') {
                this.playerPiecesCaptured++;
            } else {
                this.aiPiecesCaptured++;
                this.continuousCaptureCount++;
            }
            
            this.showToast(`🎯 ${this.currentPlayer === 'red' ? 'คุณ' : 'AI'} กินฮอต!`, 'success');
        }
        
        if (!piece.king && ((piece.color === 'red' && to.row === 0) ||
                            (piece.color === 'black' && to.row === 7))) {
            piece.king = true;
            
            if (this.currentPlayer === 'red') {
                this.playerKingsPromoted++;
            } else {
                this.aiKingsPromoted++;
            }
            
            this.showToast(`👑 เลื่อนเป็นกษัตริย์!`, 'warning');

            this.mustCapture = false;
            this.selectedPiece = null;
            this.validMoves = [];
            this.continuousCaptureCount = 0;
            this.switchTurn();
            this.checkGameOver();

            if (this.currentPlayer === 'black' && !this.gameOver) {
                setTimeout(() => this.makeAIMove(), isMobile ? 750 : 500);
            }

            return;
        }
        
        if (to.capture) {
            const additionalCaptures = this.getValidMoves(to.row, to.col, this.currentPlayer)
                .filter(move => move.capture);
            
            if (additionalCaptures.length > 0 && this.continuousCaptureCount < this.maxContinuousCaptures) {
                this.selectedPiece = { row: to.row, col: to.col };
                this.validMoves = additionalCaptures;
                this.mustCapture = true;
                return;
            } else {
                this.continuousCaptureCount = 0;
            }
        }
        
        this.mustCapture = false;
        this.selectedPiece = null;
        this.validMoves = [];
        this.continuousCaptureCount = 0;
        this.switchTurn();
        this.checkGameOver();
        
        if (this.currentPlayer === 'black' && !this.gameOver) {
            setTimeout(() => {
                this.makeAIMove();
            // }, isMobile ? 750 : 500);
			}, isMobile ? 200 : 100);
        }
    }
    
    async makeAIMove() {
        if (this.processingMove || this.gameOver || this.currentPlayer !== 'black') return;
        
        this.processingMove = true;
        this.aiMoveAttempts++;
        
        console.log(`=== AI MOVE START (Attempt ${this.aiMoveAttempts}) ===`);
        console.log('mustCapture:', this.mustCapture, 'selectedPiece:', this.selectedPiece);
        console.log('continuousCaptureCount:', this.continuousCaptureCount);
        
        if (this.moveTimeout) {
            clearTimeout(this.moveTimeout);
            this.moveTimeout = null;
        }
        
        const thinkingElement = document.getElementById('ai-thinking');
        if (thinkingElement) {
            thinkingElement.classList.add('show');
            thinkingElement.textContent = this.mustCapture ? 
                `🎯 AI กินต่อเนื่อง (${this.continuousCaptureCount}/${this.maxContinuousCaptures})...` : 
                '🤖 AI กำลังคิด...';
        }
        
        if (this.aiMoveAttempts > this.maxAIMoveAttempts) {
            console.warn('AI move attempts exceeded - forcing end turn');
            this.forceEndAITurn();
            return;
        }
        
        // เช็คการกินต่อเนื่องแยกต่างหาก - ไม่ควร force end turn ทันที
        if (this.continuousCaptureCount >= this.maxContinuousCaptures) {
            console.warn('Maximum continuous captures reached, checking for additional captures...');
            // ยังคงตรวจสอบว่ามีการกินต่อเนื่องหรือไม่ แต่ไม่ force end turn
        }
        
        const timeoutDuration = this.mustCapture ? (isMobile ? 3000 : 2000) : (isMobile ? 8000 : 6000);
        this.moveTimeout = setTimeout(() => {
            console.warn('AI timeout - forcing end turn');
            this.forceEndAITurn();
        }, timeoutDuration);
        
        try {
            if (this.mustCapture && this.selectedPiece && this.currentPlayer === 'black') {
                console.log('Processing AI continuous capture...');
                
                const continuousCaptures = this.getValidMoves(this.selectedPiece.row, this.selectedPiece.col, 'black')
                    .filter(move => move.capture);
                
                if (continuousCaptures.length > 0) {
                    console.log(`AI has ${continuousCaptures.length} continuous capture options`);
                    
                    let bestCapture = continuousCaptures[0];
                    
                    // ให้ AI เลือกการกินที่ดีที่สุด
                    const piece = this.board[this.selectedPiece.row][this.selectedPiece.col];
                    if (continuousCaptures.length > 1) {
                        let bestScore = -Infinity;
                        for (const capture of continuousCaptures) {
                            const testBoard = this.simulateAIMove(this.board, this.selectedPiece, capture);
                            const score = this.ai.evaluateBoard(testBoard, 'black');
                            console.log(`Capture option score: ${score} for move to (${capture.row}, ${capture.col})`);
                            if (score > bestScore) {
                                bestScore = score;
                                bestCapture = capture;
                            }
                        }
                        console.log(`Best capture selected: (${bestCapture.row}, ${bestCapture.col}) with score: ${bestScore}`);
                    }
                    
                    // ดำเนินการกิน
                    const from = this.selectedPiece;
                    const to = bestCapture;
                    
                    this.board[to.row][to.col] = this.board[from.row][from.col];
                    this.board[from.row][from.col] = null;
                    
                    if (to.capture) {
                        this.board[to.capturedRow][to.capturedCol] = null;
                        this.aiPiecesCaptured++;
                        console.log(`AI captured piece at (${to.capturedRow}, ${to.capturedCol})`);
                    }
                    
                    // ตรวจสอบการเลื่อนเป็นกษัตริย์หลังจากกิน
                    const movedPiece = this.board[to.row][to.col];
                    if (movedPiece && !movedPiece.king) {
                        if ((movedPiece.color === 'red' && to.row === 0) ||
                            (movedPiece.color === 'black' && to.row === 7)) {
                            movedPiece.king = true;
                            this.aiKingsPromoted++;
                            console.log(`AI piece promoted to king at (${to.row}, ${to.col}) during continuous capture!`);
                            this.showToast(`👑 AI เลื่อนเป็นกษัตริย์ระหว่างกิน!`, 'warning');
                            
                            // เมื่อเลื่อนเป็นกษัตริย์ ให้จบการกินต่อเนื่องทันที
                            this.continuousCaptureCount = 0;
                            this.mustCapture = false;
                            this.selectedPiece = null;
                            this.validMoves = [];
                            this.switchTurn();
                            this.checkGameOver();
                            
                            this.renderBoard();
                            this.updateStatus();
                            this.finishAIMove();
                            return;
                        }
                    }
                    
                    // ตรวจสอบการกินต่อเนื่อง
                    const nextCaptures = this.getValidMoves(to.row, to.col, 'black').filter(move => move.capture);
                    console.log(`After capture, found ${nextCaptures.length} additional captures`);
                    
                    if (nextCaptures.length > 0 && this.continuousCaptureCount < this.maxContinuousCaptures) {
                        this.continuousCaptureCount++;
                        this.selectedPiece = { row: to.row, col: to.col };
                        this.validMoves = nextCaptures;
                        this.mustCapture = true;
                        
                        console.log(`Continuing capture sequence, count: ${this.continuousCaptureCount}`);
                        
                        this.renderBoard();
                        this.updateStatus();
                        this.finishAIMove();
                        
                        // เรียกตัวเองอีกครั้งเพื่อกินต่อ
                        setTimeout(() => {
                            if (this.mustCapture && this.selectedPiece && this.currentPlayer === 'black' && !this.gameOver) {
                                console.log('Recursively calling makeAIMove for next capture...');
                                this.makeAIMove();
                            }
                        }, isMobile ? 800 : 500);
                        return;
                    } else {
                        console.log('No more continuous captures available or limit reached - ending AI turn');
                        this.continuousCaptureCount = 0;
                        this.mustCapture = false;
                        this.selectedPiece = null;
                        this.validMoves = [];
                        this.switchTurn();
                        this.checkGameOver();
                        
                        this.renderBoard();
                        this.updateStatus();
                        this.finishAIMove();
                        return;
                    }
                } else {
                    console.log('No more continuous captures - ending turn');
                    this.forceEndAITurn();
                    return;
                }
            }
            
            console.log('AI making new move...');
            this.aiMoveAttempts = 0;
            this.continuousCaptureCount = 0;
            
            const aiMove = this.ai.makeMove(this.board, 'black');
            
            if (aiMove) {
                const from = aiMove.from;
                const to = aiMove.to;
                
                const piece = this.board[from.row][from.col];
                const moveNotation = this.getMoveNotation(from, to);
                this.addMoveToHistory(moveNotation);
                
                this.board[to.row][to.col] = piece;
                this.board[from.row][from.col] = null;
                
                if (to.capture) {
                    this.board[to.capturedRow][to.capturedCol] = null;
                    this.aiPiecesCaptured++;
                    this.continuousCaptureCount = 1;
                    this.showToast(`🎯 AI กินฮอต!`, 'success');
                }
                
                if (!piece.king) {
                    if ((piece.color === 'red' && to.row === 0) ||
                        (piece.color === 'black' && to.row === 7)) {
                        piece.king = true;
                        this.aiKingsPromoted++;
                        this.showToast(`👑 AI เลื่อนเป็นกษัตริย์!`, 'warning');
                        
                        this.mustCapture = false;
                        this.selectedPiece = null;
                        this.validMoves = [];
                        this.continuousCaptureCount = 0;
                        this.switchTurn();
                        this.checkGameOver();
                        
                        this.renderBoard();
                        this.updateStatus();
                        this.finishAIMove();
                        return;
                    }
                }
                
                if (to.capture) {
                    console.log(`AI captured piece - checking for additional captures...`);
                    
                    const additionalCaptures = this.getValidMoves(to.row, to.col, 'black')
                        .filter(move => move.capture);
                    
                    console.log(`Found ${additionalCaptures.length} additional captures, current count: ${this.continuousCaptureCount}`);
                    
                    if (additionalCaptures.length > 0) {
                        this.continuousCaptureCount++; // เพิ่มการนับเฉพาะเมื่อมีการกินต่อเนื่อง
                        console.log(`Continuous capture count increased to: ${this.continuousCaptureCount}`);
                        
                        // ตรวจสอบว่าเกินขีดจำกัดหรือไม่ แต่ยังให้โอกาสในการกินต่อ
                        if (this.continuousCaptureCount < this.maxContinuousCaptures) {
                            this.selectedPiece = { row: to.row, col: to.col };
                            this.validMoves = additionalCaptures;
                            this.mustCapture = true;
                            this.renderBoard();
                            this.updateStatus();
                            this.finishAIMove();
                            
                            setTimeout(() => {
                                if (this.mustCapture && this.selectedPiece && this.currentPlayer === 'black' && !this.gameOver) {
                                    console.log('Continuing AI capture sequence...');
                                    this.makeAIMove();
                                }
                            }, isMobile ? 1000 : 600);
                            return;
                        } else {
                            console.log('Maximum continuous captures reached, but completing current sequence');
                            // ให้เสร็จสิ้นการกินครั้งสุดท้าย แล้วจบเทิร์น
                            this.continuousCaptureCount = 0;
                        }
                    } else {
                        console.log('No additional captures available - ending capture sequence');
                        this.continuousCaptureCount = 0;
                    }
                }
                
                this.mustCapture = false;
                this.selectedPiece = null;
                this.validMoves = [];
                this.continuousCaptureCount = 0;
                this.switchTurn();
                this.checkGameOver();
                
                this.renderBoard();
                this.updateStatus();
            } else {
                console.warn('AI has no valid moves');
                this.gameOver = true;
                this.winner = 'คุณ';
                this.checkGameOver();
            }
        } catch (error) {
            console.error('AI move error:', error);
            this.forceEndAITurn();
        }
        
        this.finishAIMove();
    }
    
    simulateAIMove(board, from, to) {
        const newBoard = board.map(row => row.map(cell => cell ? {...cell} : null));
        
        const piece = newBoard[from.row][from.col];
        newBoard[to.row][to.col] = piece;
        newBoard[from.row][from.col] = null;
        
        if (to.capture) {
            newBoard[to.capturedRow][to.capturedCol] = null;
        }
        
        return newBoard;
    }
    
    forceEndAITurn() {
        console.log('Force ending AI turn');
        
        try {
            if (this.mustCapture && this.selectedPiece && this.currentPlayer === 'black') {
                const continuousCaptures = this.getValidMoves(this.selectedPiece.row, this.selectedPiece.col, 'black')
                    .filter(move => move.capture);
                
                if (continuousCaptures.length > 0) {
                    const capture = continuousCaptures[0];
                    const from = this.selectedPiece;
                    const to = capture;
                    
                    this.board[to.row][to.col] = this.board[from.row][from.col];
                    this.board[from.row][from.col] = null;
                    
                    if (capture.capture) {
                        this.board[to.capturedRow][to.capturedCol] = null;
                        this.aiPiecesCaptured++;
                    }
                }
            } else {
                const possibleMoves = this.ai.getAllPossibleMoves(this.board, 'black');
                
                if (possibleMoves.length > 0) {
                    const move = possibleMoves[0];
                    const from = move.from;
                    const to = move.to;
                    
                    this.board[to.row][to.col] = this.board[from.row][from.col];
                    this.board[from.row][from.col] = null;
                    
                    if (move.capture) {
                        this.board[to.capturedRow][to.capturedCol] = null;
                        this.aiPiecesCaptured++;
                    }
                }
            }
        } catch (error) {
            console.error('Force move error:', error);
        }
        
        this.mustCapture = false;
        this.selectedPiece = null;
        this.validMoves = [];
        this.continuousCaptureCount = 0;
        this.aiMoveAttempts = 0;
        this.switchTurn();
        this.checkGameOver();
        this.renderBoard();
        this.updateStatus();
        this.finishAIMove();
    }
    
    finishAIMove() {
        if (this.moveTimeout) {
            clearTimeout(this.moveTimeout);
            this.moveTimeout = null;
        }
        
        const thinkingElement = document.getElementById('ai-thinking');
        if (thinkingElement) {
            thinkingElement.classList.remove('show');
        }
        
        this.processingMove = false;
        console.log('=== AI MOVE END ===');
    }
    
    getMoveNotation(from, to) {
        const fromNotation = String.fromCharCode(97 + from.col) + (8 - from.row);
        const toNotation = String.fromCharCode(97 + to.col) + (8 - to.row);
        return `${fromNotation}-${toNotation}`;
    }
    
    addMoveToHistory(moveNotation) {
        const playerName = this.currentPlayer === 'red' ? 'คุณ' : 'AI';
        
        this.moveHistory.push({
            player: this.currentPlayer,
            notation: moveNotation,
            playerName: playerName,
            timestamp: Date.now() - this.gameStartTime
        });
        
        this.updateMoveHistory();
    }
    
    updateMoveHistory() {
        const moveListElement = document.getElementById('move-list');
        if (!moveListElement) return;
        
        if (this.moveHistory.length === 0) {
            moveListElement.innerHTML = '<div style="text-align: center; color: #666; font-style: italic;">เกมยังไม่เริ่ม / Game not started</div>';
            return;
        }
        
        moveListElement.innerHTML = '';
        
        this.moveHistory.forEach((move, index) => {
            const moveElement = document.createElement('div');
            moveElement.className = `move-item ${move.player}`;
            
            const timeMinutes = Math.floor(move.timestamp / 60000);
            const timeSeconds = Math.floor((move.timestamp % 60000) / 1000);
            const timeStr = `${timeMinutes}:${timeSeconds.toString().padStart(2, '0')}`;
            
            moveElement.innerHTML = `
                <strong>${index + 1}.</strong> ${move.playerName}: ${move.notation}
                <span style="float: right; opacity: 0.7;">${timeStr}</span>
            `;
            
            moveListElement.appendChild(moveElement);
        });
        
        moveListElement.scrollTop = moveListElement.scrollHeight;
    }
    
    switchTurn() {
        this.currentPlayer = this.currentPlayer === 'red' ? 'black' : 'red';
        this.aiMoveAttempts = 0; // Reset AI move attempts when switching turns
        this.continuousCaptureCount = 0; // Reset continuous capture count when switching turns
        
        const captureMoves = this.getAllCaptureMoves(this.currentPlayer);
        this.mustCapture = captureMoves.length > 0;
    }
    
    getAllCaptureMoves(player) {
        const captures = [];
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                if (this.board[row][col] && this.board[row][col].color === player) {
                    const moves = this.getValidMoves(row, col, player);
                    captures.push(...moves.filter(move => move.capture));
                }
            }
        }
        return captures;
    }
    
    checkGameOver() {
        const redPieces = this.countPieces('red');
        const blackPieces = this.countPieces('black');
        
        if (redPieces === 0) {
            this.gameOver = true;
            this.winner = 'AI';
        } else if (blackPieces === 0) {
            this.gameOver = true;
            this.winner = 'คุณ';
        } else {
            let hasValidMoves = false;
            for (let row = 0; row < 8; row++) {
                for (let col = 0; col < 8; col++) {
                    if (this.board[row][col] && this.board[row][col].color === this.currentPlayer) {
                        const moves = this.getValidMoves(row, col, this.currentPlayer);
                        if (moves.length > 0) {
                            hasValidMoves = true;
                            break;
                        }
                    }
                }
                if (hasValidMoves) break;
            }
            
            if (!hasValidMoves) {
                this.gameOver = true;
                this.winner = this.currentPlayer === 'red' ? 'AI' : 'คุณ';
            }
        }
        
        if (this.gameOver) {
            this.gameEndTimeStamp = new Date();
            this.showToast(`🎉 ${this.winner} ชนะ!`, 'success');
            this.saveGameStats();
        }
    }
    
    async saveGameStats() {
        try {
            const gameDuration = Math.floor((this.gameEndTimeStamp - this.gameStartTimeStamp) / 1000);
            const result = this.winner === 'คุณ' ? 'win' : 'lose';
            const gameMode = `ai_${currentDifficulty}`;
            
            const formData = new FormData();
            formData.append('action', 'save_game_result');
            formData.append('game_mode', gameMode);
            formData.append('result', result);
            formData.append('game_duration', gameDuration);
            formData.append('moves_count', this.moveHistory.length);
            formData.append('pieces_captured', this.playerPiecesCaptured);
            formData.append('pieces_lost', this.aiPiecesCaptured);
            formData.append('kings_promoted', this.playerKingsPromoted);
            formData.append('game_start_time', this.gameStartTimeStamp.toISOString().slice(0, 19).replace('T', ' '));
            formData.append('game_end_time', this.gameEndTimeStamp.toISOString().slice(0, 19).replace('T', ' '));
            
            const response = await fetch('/stats_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                console.log('สถิติบันทึกสำเร็จ');
                if (result === 'win') {
                    setTimeout(() => {
                        this.showToast('🎊 สถิติของคุณได้รับการบันทึกแล้ว!', 'success');
                    }, 2000);
                }
            } else {
                console.warn('ไม่สามารถบันทึกสถิติได้:', data.message);
            }
        } catch (error) {
            console.error('เกิดข้อผิดพลาดในการบันทึกสถิติ:', error);
        }
        
        this.saveLocalStats();
    }
    
    saveLocalStats() {
        try {
            const stats = JSON.parse(localStorage.getItem('aiWinStats') || '{}');
            const difficulty = currentDifficulty;
            
            if (this.winner === 'คุณ') {
                if (!stats[difficulty]) {
                    stats[difficulty] = 0;
                }
                stats[difficulty]++;
                localStorage.setItem('aiWinStats', JSON.stringify(stats));
            }
            
            const history = JSON.parse(localStorage.getItem('gameHistory') || '[]');
            history.push({
                date: new Date().toISOString(),
                opponent: `AI ${difficulty}`,
                result: this.winner === 'คุณ' ? 'win' : 'lose',
                moves: this.moveHistory.length,
                duration: Math.floor((this.gameEndTimeStamp - this.gameStartTimeStamp) / 1000)
            });
            
            if (history.length > 50) {
                history.shift();
            }
            
            localStorage.setItem('gameHistory', JSON.stringify(history));
        } catch (error) {
            console.warn('Cannot save local stats:', error);
        }
    }
    
    countPieces(color) {
        let count = 0;
        for (let row = 0; row < 8; row++) {
            for (let col = 0; col < 8; col++) {
                if (this.board[row][col] && this.board[row][col].color === color) {
                    count++;
                }
            }
        }
        return count;
    }
    
    updateStatus() {
        const currentTurnElement = document.getElementById('current-turn');
        const playerPiecesElement = document.getElementById('player-pieces');
        const aiPiecesElement = document.getElementById('ai-pieces');
        
        const redCount = this.countPieces('red');
        const blackCount = this.countPieces('black');
        
        if (playerPiecesElement) playerPiecesElement.textContent = `${redCount} ตัว`;
        if (aiPiecesElement) aiPiecesElement.textContent = `${blackCount} ตัว`;
        
        if (currentTurnElement) {
            if (this.gameOver) {
                const winnerText = this.winner === 'คุณ' ? '🎉 คุณชนะ!' : '🎉 AI ชนะ!';
                currentTurnElement.textContent = winnerText;
                currentTurnElement.style.fontSize = '1.3em';
            } else {
                const turnText = this.currentPlayer === 'red' ? 'ตาคุณ' : 'ตา AI';
                currentTurnElement.textContent = turnText;
                
                if (this.mustCapture) {
                    currentTurnElement.textContent += ' (ต้องกิน!)';
                }
            }
        }
    }

    showToast(message, type = 'info') {
        const messageKey = `${gameSessionId}-${message}-${type}`;
        
        if (shownMessages.has(messageKey)) {
            console.log(`Toast ซ้ำถูกบล็อก: ${message}`);
            return;
        }
        
        if (currentToast) {
            try {
                currentToast.hideToast();
            } catch (error) {
                console.warn('Error hiding previous toast:', error);
            }
            currentToast = null;
        }
        
        shownMessages.add(messageKey);
        
        try {
            currentToast = Toastify({
                text: message,
                duration: isMobile ? 2000 : 3000,
                close: true,
                gravity: "top",
                position: "center",
				backgroundColor: type === "success" ? "#333" : 
								 type === "error" ? "#333" : 
								 type === "warning" ? "#333" : "#333",
                callback: function() {
                    currentToast = null;
                },
                onHidden: function() {
                    currentToast = null;
                }
            });
            
            currentToast.showToast();
            console.log(`Toast แสดง: ${message}`);
            
        } catch (error) {
            console.warn('Toast error:', error);
            currentToast = null;
        }
    }
}

let game;

function newGame() {
    const wasAutoPlaying = autoPlayInterval !== null;
    
    resetShownMessages();
    
    console.log('=== NEW GAME DEBUG ===');
    console.log('Creating new game with difficulty:', currentDifficulty);
    
    try {
        game = new AICheckers(currentDifficulty);
        
        const diffNames = {
            'easy': 'ง่าย',
            'medium': 'ปานกลาง', 
            'hard': 'ยาก',
            'extreme': 'โหดมากๆ'
        };
        
        const diffName = diffNames[currentDifficulty] || currentDifficulty;
        console.log('Difficulty name should be:', diffName);
        console.log('AI difficulty from game object:', game.ai.difficulty);
        
        game.showToast(`🎮 เกมใหม่เริ่มแล้ว! AI ระดับ${diffName}`, 'success');
        
    } catch (error) {
        console.error('New game error:', error);
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }
}



// ========= Advanced Extreme Mode Enhancements (disabled) =========

// Quiescence Search to reduce horizon effect
function quiescenceSearch(board, alpha, beta) {
    // Evaluate only capture moves until quiet position
    let stand_pat = evaluateBoard(board);
    if (stand_pat >= beta) return beta;
    if (alpha < stand_pat) alpha = stand_pat;
    let moves = generateCaptureMoves(board);
    for (let move of moves) {
        let newBoard = makeMoveOnBoard(board, move);
        let score = -quiescenceSearch(newBoard, -beta, -alpha);
        if (score >= beta) return beta;
        if (score > alpha) alpha = score;
    }
    return alpha;
}

// Null Move Pruning for pruning
function nullMovePruning(board, depth, alpha, beta) {
    if (depth <= 0) return quiescenceSearch(board, alpha, beta);
    // Make a null move: skip player turn
    let nullBoard = board.clone();
    nullBoard.switchPlayer();
    let score = -search(nullBoard, depth - 1 - 2, -beta, -alpha);
    if (score >= beta) return beta;  // prune
    return search(board, depth, alpha, beta);
}

// Aspiration Window Search
function aspirationWindowSearch(state, guess, window) {
    let alpha = guess - window;
    let beta = guess + window;
    let score = search(state, state.maxDepth, alpha, beta);
    if (score <= alpha || score >= beta) {
        // widen window if outside
        return search(state, state.maxDepth, -Infinity, Infinity);
    }
    return score;
}

// Killer Move Heuristic
const killerMoves = {};
function recordKillerMove(depth, move) {
    if (!killerMoves[depth]) killerMoves[depth] = [];
    killerMoves[depth].unshift(move);
    if (killerMoves[depth].length > 2) killerMoves[depth].pop();
}
function getKillerMoves(depth) {
    return killerMoves[depth] || [];
}

// History Heuristic
const historyTable = {};
function recordHistory(move, depth) {
    let key = move.toString();
    historyTable[key] = (historyTable[key] || 0) + depth * depth;
}
function getHistoryScore(move) {
    return historyTable[move.toString()] || 0;
}

// Late Move Reductions (LMR)
function lateMoveReduction(depth, moveIndex) {
    if (depth < 3 || moveIndex < 4) return 0;
    return Math.floor(Math.log(depth) * Math.log(moveIndex) / 2);
}

// Evaluate Mobility
function evaluateMobility(board, player) {
    let moves = generateAllMoves(board, player);
    return moves.length * 10;
}

// Evaluate King Safety
function evaluateKingSafety(board, player) {
    let safety = 0;
    let kingPos = board.getKingPosition(player);
    if (kingPos) {
        let threats = countAdjacentOpponents(board, kingPos, player);
        safety -= threats * 20;
    }
    return safety;
}

// Detect Traps (avoid simple traps)
function detectTraps(board, player) {
    let traps = 0;
    let oppMoves = generateAllMoves(board, player === 'black' ? 'red' : 'black');
    for (let move of oppMoves) {
        if (move.captures && move.to === board.getLastMoveDestination()) {
            traps += 1;
        }
    }
    return -traps * 30;
}

// Combined Advanced Evaluation
function advancedEvaluation(board, player) {
    const mobility = evaluateMobility(board, player);
    const safety = evaluateKingSafety(board, player);
    const trapScore = detectTraps(board, player);
    return basicEvaluation(board, player) + mobility + safety + trapScore;
}

// Override extreme move generator
const _makeMove = ai.makeMove;
ai.makeMove = function(board, currentPlayer) {
    if (this.difficulty === 'extreme') {
        // Use aspiration window around last best
        let guess = this.lastScore || 0;
        let score = aspirationWindowSearch({ board, maxDepth: this.maxDepth }, guess, 50);
        this.lastScore = score;
        return getBestMoveFromSearch();
    } else {
        return _makeMove.call(this, board, currentPlayer);
    }
};


// ========= Tactical Enhancements for Extreme Mode =========

// Evaluate threat level for each own piece
function evaluateThreats(board, player) {
    const threats = {};
    const oppMoves = generateAllMoves(board, opponent(player));
    for (let move of oppMoves) {
        if (move.captures) {
            threats[move.to] = (threats[move.to] || 0) + 1;
        }
    }
    return threats;
}

// Plan multi-capture sequences using DFS
function findBestCaptureSequence(board, player) {
    let bestSeq = { moves: [], captures: 0 };
    function dfs(currentBoard, seq) {
        const capMoves = generateCaptureMoves(currentBoard);
        if (capMoves.length === 0) {
            if (seq.length > bestSeq.captures) {
                bestSeq = { moves: [...seq], captures: seq.length };
            }
            return;
        }
        for (let move of capMoves) {
            const newBoard = makeMoveOnBoard(currentBoard, move);
            seq.push(move);
            dfs(newBoard, seq);
            seq.pop();
        }
    }
    dfs(board, []);
    return bestSeq;
}

// Enhanced evaluation combining advanced eval and threat avoidance
function advancedTacticalEvaluation(board, player) {
    const baseScore = advancedEvaluation(board, player);
    const threats = evaluateThreats(board, player);
    const penalty = Object.values(threats).reduce((sum, v) => sum + v, 0) * 50;
    return baseScore - penalty;
}

// Override extreme move generator with tactical planning
const _prevMakeMove = ai.makeMove;
ai.makeMove = function(board, currentPlayer) {
    if (this.difficulty === 'extreme') {
        // Attempt multi-capture if available
        const bestCap = findBestCaptureSequence(board, currentPlayer);
        if (bestCap.captures >= 2) {
            return bestCap.moves[0];
        }
        // Otherwise choose best safe move
        const threats = evaluateThreats(board, currentPlayer);
        let bestMove = null;
        let bestScore = -Infinity;
        const moves = generateAllMoves(board, currentPlayer);
        for (let move of moves) {
            const newBoard = makeMoveOnBoard(board, move);
            const score = advancedTacticalEvaluation(newBoard, currentPlayer)
                          - (threats[move.to] || 0) * 100;
            if (score > bestScore) {
                bestScore = score;
                bestMove = move;
            }
        }
        return bestMove;
    } else {
        return _prevMakeMove.call(this, board, currentPlayer);
    }
};


// ========= Ultimate Undefeatable Extreme Mode =========

// Compute worst-case score for a given move using shallow adversarial simulation
function getWorstCaseScore(board, player, depth) {
    let alpha = -Infinity;
    let beta = Infinity;
    // use null move pruning and quiescence
    return -nullMovePruning(board.clone().switchPlayer(), depth - 1, -beta, -alpha);
}

// Select moves that guarantee no negative worst-case outcome
function selectSafeMoves(board, player) {
    const moves = generateAllMoves(board, player);
    const safeMoves = [];
    for (let move of moves) {
        let newBoard = makeMoveOnBoard(board, move);
        let worst = getWorstCaseScore(newBoard, player, Math.max(1, Math.floor(this.maxDepth/2)));
        if (worst >= 0) {
            safeMoves.push({move, worst});
        }
    }
    return safeMoves;
}

// Detect forced win paths by optimistic evaluation
function detectWinningMoves(board, player) {
    const wins = [];
    const moves = generateCaptureMoves(board);
    for (let move of moves) {
        let newBoard = makeMoveOnBoard(board, move);
        let score = aspirationWindowSearch({ board: newBoard, maxDepth: this.maxDepth }, this.lastScore||0, 25);
        if (score > 1000) wins.push(move);
    }
    return wins;
}

// Evaluate draw-stability: measure material and positional parity
function evaluateDrawStability(board, player) {
    const materialDiff = countMaterial(board, player) - countMaterial(board, opponent(player));
    // favor even material differences
    return -Math.abs(materialDiff) * 20;
}

// Override extreme move generator for ultimate safety
ai.makeMove = function(board, currentPlayer) {
    if (this.difficulty === 'extreme') {
        // 1. check forced winning sequences
        const winMoves = detectWinningMoves.call(this, board, currentPlayer);
        if (winMoves.length) return winMoves[0];
        // 2. plan multi-capture if >=2
        const bestCap = findBestCaptureSequence(board, currentPlayer);
        if (bestCap.captures >= 2) return bestCap.moves[0];
        // 3. select safe moves guaranteeing non-negative outcome
        const safeList = selectSafeMoves.call(this, board, currentPlayer);
        if (safeList.length) {
            // choose safe move with highest draw stability and tactical score
            let best = safeList[0];
            for (let {move, worst} of safeList) {
                const newBoard = makeMoveOnBoard(board, move);
                const tactical = advancedTacticalEvaluation(newBoard, currentPlayer);
                const stability = evaluateDrawStability(newBoard, currentPlayer);
                const score = worst + tactical + stability;
                if (score > (best.worst + tactical + stability)) best = {move, worst};
            }
            return best.move;
        }
        // 4. fallback: highest advanced tactical eval
        return (function() {
            let mv = null, sc = -Infinity;
            for (let move of generateAllMoves(board, currentPlayer)) {
                let nb = makeMoveOnBoard(board, move);
                let s = advancedTacticalEvaluation(nb, currentPlayer);
                if (s > sc) { sc = s; mv = move; }
            }
            return mv;
        })();
    } else {
        // default behavior for other difficulties
        return _prevMakeMove.call(this, board, currentPlayer);
    }
};


// ========= Monte Carlo Tree Search (MCTS) for Ultimate Extreme Mode =========

// Define opponent helper
function opponent(player) {
    return player === 'black' ? 'red' : 'black';
}

// MCTS Node
class MCTSNode {
    constructor(board, player, parent = null, move = null) {
        this.board = board;
        this.player = player;
        this.parent = parent;
        this.move = move;
        this.wins = 0;
        this.visits = 0;
        this.children = [];
        this.untriedMoves = generateAllMoves(board, player);
    }
    isFullyExpanded() {
        return this.untriedMoves.length === 0;
    }
    isTerminal() {
        // Terminal when no moves for current player
        return generateAllMoves(this.board, this.player).length === 0;
    }
}

// UCT value calculation
function uctValue(child, totalVisits, C = Math.sqrt(2)) {
    return (child.wins / child.visits) +
           C * Math.sqrt(Math.log(totalVisits) / child.visits);
}

// Expand node by one untried move
function expand(node) {
    const moves = node.untriedMoves;
    const move = moves.pop();
    const newBoard = makeMoveOnBoard(node.board, move);
    const child = new MCTSNode(newBoard, opponent(node.player), node, move);
    node.children.push(child);
    return child;
}

// Select best child by UCT
function bestChild(node, C = Math.sqrt(2)) {
    return node.children.reduce((best, child) => {
        const uct = uctValue(child, node.visits, C);
        return uct > best.uct ? {child, uct} : best;
    }, {child: null, uct: -Infinity}).child;
}

// Tree policy: selection + expansion
function treePolicy(node) {
    while (!node.isTerminal()) {
        if (!node.isFullyExpanded()) {
            return expand(node);
        } else {
            node = bestChild(node);
        }
    }
    return node;
}

// Default policy: simulate random playout
function defaultPolicy(node) {
    let boardSim = node.board.clone();
    let playerSim = node.player;
    while (true) {
        const moves = generateAllMoves(boardSim, playerSim);
        if (moves.length === 0) break;
        const move = moves[Math.floor(Math.random() * moves.length)];
        boardSim = makeMoveOnBoard(boardSim, move);
        playerSim = opponent(playerSim);
    }
    // Win if opponent to move has no moves
    const winner = playerSim === node.player ? node.player : opponent(node.player);
    return winner === node.player ? 1 : 0;
}

// Backpropagation of simulation result
function backpropagate(node, reward) {
    let curr = node;
    while (curr) {
        curr.visits += 1;
        curr.wins += reward;
        curr = curr.parent;
    }
}

// MCTS search to pick best move
function mctsSearch(board, player, iterations = 1000) {
    const root = new MCTSNode(board, player);
    for (let i = 0; i < iterations; i++) {
        let node = treePolicy(root);
        const reward = defaultPolicy(node);
        backpropagate(node, reward);
    }
    // Pick child with highest visit count
    let best = root.children[0];
    for (let child of root.children) {
        if (child.visits > best.visits) {
            best = child;
        }
    }
    return best.move;
}

// Override extreme makeMove to use MCTS
const _previousMakeMove = ai.makeMove;
ai.makeMove = function(board, currentPlayer) {
    if (this.difficulty === 'extreme') {
        // Run MCTS to select best move
        return mctsSearch(board.clone(), currentPlayer, 2000);
    }
    return _previousMakeMove.call(this, board, currentPlayer);
};

// ========= Final Safety & Fork Detection Enhancements =========

// Filter moves that avoid immediate captures
function safeMoves(board, player) {
    const moves = generateAllMoves(board, player);
    return moves.filter(move => {
        const newBoard = makeMoveOnBoard(board, move);
        // if opponent has any capture after this move, it's unsafe
        const opp = opponent(player);
        if (generateCaptureMoves(newBoard, opp).length > 0) {
            return false;
        }
        return true;
    });
}

// Detect fork opportunities: attack >=2 pieces
function detectForks(board, player) {
    let bestFork = null;
    let moves = generateAllMoves(board, player);
    for (let move of moves) {
        const newBoard = makeMoveOnBoard(board, move);
        // count how many pieces can be captured in next move
        let count = generateCaptureMoves(newBoard, player).length;
        if (count >= 2) {
            bestFork = move;
            break;
        }
    }
    return bestFork;
}

// Override makeMove for extreme
const _prevMCTSMakeMove = ai.makeMove;
ai.makeMove = function(board, currentPlayer) {
    if (this.difficulty === 'extreme') {
        // 1. forced wins
        const winMoves = detectWinningMoves.call(this, board, currentPlayer);
        if (winMoves.length) return winMoves[0];
        // 2. immediate forks
        const fork = detectForks(board, currentPlayer);
        if (fork) return fork;
        // 3. multi-capture
        const bestCap = findBestCaptureSequence(board, currentPlayer);
        if (bestCap.captures >= 2) return bestCap.moves[0];
        // 4. safe moves only
        const safe = safeMoves(board, currentPlayer);
        if (safe.length) {
            let best = safe[0], bestScore = -Infinity;
            for (let move of safe) {
                const newBoard = makeMoveOnBoard(board, move);
                const score = advancedTacticalEvaluation(newBoard, currentPlayer);
                if (score > bestScore) {
                    bestScore = score;
                    best = move;
                }
            }
            return best;
        }
        // 5. fallback: highest eval but penalize unsafe heavily
        let fallback = null, maxScore = -Infinity;
        for (let move of generateAllMoves(board, currentPlayer)) {
            const newBoard = makeMoveOnBoard(board, move);
            const threat = generateCaptureMoves(newBoard, opponent(currentPlayer)).length;
            const score = advancedTacticalEvaluation(newBoard, currentPlayer) - threat * 1000;
            if (score > maxScore) {
                maxScore = score;
                fallback = move;
            }
        }
        return fallback;
    }
    return _prevMCTSMakeMove.call(this, board, currentPlayer);
};



// ========= Opening Book Integration using data.json =========

// Zobrist hashing setup
const ZOBRIST_TABLE = (function() {
  const table = [];
  for(let i=0;i<64;i++){
    table[i] = { black: rand32(), red: rand32(), king: rand32() };
  }
  return table;
})();
function rand32(){ return Math.floor(Math.random()*0x100000000); }
function zobristHash(board){
  let h = 0;
  board.cells.forEach((cell,i)=>{
    if (!cell) return;
    h ^= ZOBRIST_TABLE[i][ cell.player ] 
       ^ (cell.isKing ? ZOBRIST_TABLE[i].king : 0);
  });
  return h >>> 0;
}

// Load book stats once at start
let bookStats = {};
fetch('data.json')
  .then(res => res.ok ? res.json() : {})
  .then(j => bookStats = j)
  .catch(() => bookStats = {});

// Retrieve move from book if exists
function getBookMove(board){
  const key = zobristHash(board).toString();
  const entry = bookStats[key];
  if (!entry) return null;
  let bestMoveStr = null, bestRate = -1;
  for(let moveStr in entry){
    const stat = entry[moveStr];
    const rate = stat.wins / stat.plays;
    if (rate > bestRate){
      bestRate = rate;
      bestMoveStr = moveStr;
    }
  }
  return bestMoveStr ? parseMoveString(bestMoveStr) : null;
}

// Record game history (to be called after game end)
function recordGame(history, winner){
  history.forEach(({ board, moveStr }) => {
    const key = zobristHash(board).toString();
    if (!bookStats[key]) bookStats[key] = {};
    const stat = bookStats[key][moveStr] || { wins: 0, plays: 0 };
    stat.plays++;
    if (winner === 'extreme') stat.wins++;
    bookStats[key][moveStr] = stat;
  });
  // Prune to top-2 moves per key
  Object.keys(bookStats).forEach(key => {
    const arr = Object.entries(bookStats[key])
      .sort((a,b) => b[1].plays - a[1].plays)
      .slice(0,2);
    bookStats[key] = Object.fromEntries(arr);
  });
  // Send to server
  fetch('stats_api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(bookStats)
  });
}

// Override makeMove: book -> MCTS
const _origMakeMove = ai.makeMove;
ai.makeMove = function(board, player){
  if (this.difficulty === 'extreme'){
    const bookMove = getBookMove(board);
    if (bookMove) return bookMove;
    // fallback to MCTS with reduced iterations for speed
    return mctsSearch(board.clone(), player, 500);
  }
  return _origMakeMove.call(this, board, player);
};


// ========= Override Move Generation to include all pieces =========
const _origGenerateAllMoves = generateAllMoves;
generateAllMoves = function(board, player) {
    const BLACK_DIRS = [-9, -7];
    const RED_DIRS = [7, 9];
    const KING_DIRS = [-9, -7, 7, 9];
    const moves = [];
    board.cells.forEach((cell, i) => {
        if (!cell || cell.player !== player) return;
        const dirs = cell.isKing ? KING_DIRS : (player === 'black' ? BLACK_DIRS : RED_DIRS);
        // simple moves and captures for each direction
        dirs.forEach(dir => {
            const mid = i + dir;
            const to = i + dir * 2;
            // simple move
            if (board.isValidCell(i + dir) && !board.cells[i + dir]) {
                moves.push({ from: i, to: i + dir });
            }
            // capture move
            if (
                board.isValidCell(mid) &&
                board.cells[mid] &&
                board.cells[mid].player !== player &&
                board.isValidCell(to) &&
                !board.cells[to]
            ) {
                moves.push({ from: i, to: to, captures: [mid] });
            }
        });
    });
    return moves;
};

// ========= End of disabled advanced enhancements =========


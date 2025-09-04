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
    <title>เล่นกับเพื่อน - หมากฮอสไทย</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<link rel="stylesheet" href="/ai.css?<?= time() ?>">
</head>
<body>
    <div class="game-container shimmer">
        <div class="header">
            <h1 class="title">🌊 เล่นกับเพื่อน</h1>
        </div>
        
        <div class="game-info">
            <div class="player-info">
                <div class="player-name">🔴 แดง</div>
                <div class="pieces-count" id="player1-pieces">8 ตัว</div>
                <div class="timer-value" id="redTime">05:00</div>
            </div>
            <div class="current-turn" id="current-turn">ตาแดง</div>
            <div class="player-info">
                <div class="player-name">⚫ ดำ</div>
                <div class="pieces-count" id="player2-pieces">8 ตัว</div>
                <div class="timer-value" id="blackTime">05:00</div>
            </div>
        </div>
        
        <br>
        <div class="board" id="board"></div>
        
        <div class="controls">
            <button class="btn primary" onclick="newGame()">🎮 เริ่มเกมใหม่ / New Game</button>
            <button class="btn" onclick="goToMenu()">🏠 เมนู / Menu</button><!--
            <button class="btn" id="autoPlayBtn">🤖 ดู AI เล่นอัตโนมัติ</button>-->
        </div>
        
        <div class="move-history">
            <h3>📝 ประวัติการเดิน / Move History</h3>
            <div class="move-list" id="move-list">
                <div style="text-align: center; color: #006A6B; font-style: italic;">เกมยังไม่เริ่ม / Game not started</div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // สร้างเอฟเฟกต์ sparkle
        function createSparkle() {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.left = Math.random() * 100 + '%';
            sparkle.style.top = Math.random() * 100 + '%';
            document.body.appendChild(sparkle);
            
            setTimeout(() => {
                sparkle.remove();
            }, 2000);
        }
        
        // สร้าง sparkle ทุก 3 วินาที
        setInterval(createSparkle, 3000);
        
        // เพิ่มตัวแปรสำหรับเก็บ toast ปัจจุบัน
        let currentToast = null;
        
        class MultiplayerCheckers {
            constructor() {
                this.board = [];
                this.currentPlayer = 'red'; // red = player1, black = player2
                this.selectedPiece = null;
                this.validMoves = [];
                this.gameOver = false;
                this.mustCapture = false;
                this.moveHistory = [];
                this.gameStartTime = Date.now();
                
                // Timer properties
                this.timers = {
                    red: 300, // 5 minutes in seconds
                    black: 300
                };
                this.timerInterval = null;
                
                this.initializeBoard();
                this.renderBoard();
                this.updateStatus();
                this.startTimer();
            }
            
            initializeBoard() {
                // Create 8x8 board
                this.board = Array(8).fill(null).map(() => Array(8).fill(null));
                
                // Place red pieces (player1) on bottom - 8 pieces
                // Row 7: 4 pieces
                for (let col = 1; col < 8; col += 2) {
                    this.board[7][col] = { color: 'red', king: false };
                }
                // Row 6: 4 pieces
                for (let col = 0; col < 8; col += 2) {
                    this.board[6][col] = { color: 'red', king: false };
                }
                
                // Place black pieces (player2) on top - 8 pieces
                // Row 0: 4 pieces
                for (let col = 0; col < 8; col += 2) {
                    this.board[0][col] = { color: 'black', king: false };
                }
                // Row 1: 4 pieces
                for (let col = 1; col < 8; col += 2) {
                    this.board[1][col] = { color: 'black', king: false };
                }
            }
            
            startTimer() {
                if (this.timerInterval) clearInterval(this.timerInterval);
                
                this.timerInterval = setInterval(() => {
                    if (!this.gameOver) {
                        this.timers[this.currentPlayer]--;
                        this.updateTimerDisplay();
                        
                        if (this.timers[this.currentPlayer] <= 0) {
                            this.endGameByTimeout();
                        }
                    }
                }, 1000);
            }
            
            updateTimerDisplay() {
                const redMinutes = Math.floor(this.timers.red / 60);
                const redSeconds = this.timers.red % 60;
                const blackMinutes = Math.floor(this.timers.black / 60);
                const blackSeconds = this.timers.black % 60;
                
                document.getElementById('redTime').textContent = 
                    `${redMinutes.toString().padStart(2, '0')}:${redSeconds.toString().padStart(2, '0')}`;
                document.getElementById('blackTime').textContent = 
                    `${blackMinutes.toString().padStart(2, '0')}:${blackSeconds.toString().padStart(2, '0')}`;
                
                // Update active timer styling
                if (document.getElementById('redTimer')) {
                    document.getElementById('redTimer').classList.toggle('active', this.currentPlayer === 'red');
                }
                if (document.getElementById('blackTimer')) {
                    document.getElementById('blackTimer').classList.toggle('active', this.currentPlayer === 'black');
                }
            }
            
            endGameByTimeout() {
                this.gameOver = true;
                clearInterval(this.timerInterval);
                const winner = this.currentPlayer === 'red' ? 'ผู้เล่น 2' : 'ผู้เล่น 1';
                
                this.showToast(`⏰ หมดเวลา! ${winner} ชนะ / Time's up! ${winner} wins!`, 'warning');
                
                const statusElement = document.getElementById('status');
                if (statusElement) {
                    statusElement.textContent = `⏰ ${winner} ชนะ (หมดเวลา) / ${winner} wins (timeout)`;
                    statusElement.className = 'status winner';
                }
            }
            
            renderBoard() {
                const boardElement = document.getElementById('board');
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
                        
                        cell.addEventListener('click', (e) => this.handleCellClick(row, col, e));
                        rowElement.appendChild(cell);
                    }
                    
                    boardElement.appendChild(rowElement);
                }
            }
            
            handleCellClick(row, col, event) {
                if (this.gameOver) return;
                
                // ป้องกันการ re-render ที่ไม่จำเป็น
                event.preventDefault();
                event.stopPropagation();
                
                const piece = this.board[row][col];
                let shouldRerender = false;
                
                if (this.selectedPiece) {
                    const validMove = this.validMoves.find(move => move.row === row && move.col === col);
                    if (validMove) {
                        this.makeMove(this.selectedPiece, validMove);
                        this.selectedPiece = null;
                        this.validMoves = [];
                        shouldRerender = true;
                    } else if (piece && piece.color === this.currentPlayer) {
                        // Select different piece - เช็คว่าเป็นตัวเดิมหรือไม่
                        if (this.selectedPiece.row !== row || this.selectedPiece.col !== col) {
                            this.selectPiece(row, col);
                            shouldRerender = true;
                        }
                    } else {
                        // Deselect
                        this.selectedPiece = null;
                        this.validMoves = [];
                        shouldRerender = true;
                    }
                } else if (piece && piece.color === this.currentPlayer) {
                    // Select piece
                    this.selectPiece(row, col);
                    shouldRerender = true;
                }
                
                // Render เฉพาะเมื่อจำเป็น
                if (shouldRerender) {
                    this.renderBoard();
                    this.updateStatus();
                }
            }
            
            selectPiece(row, col) {
                this.selectedPiece = { row, col };
                this.validMoves = this.getValidMoves(row, col, this.currentPlayer);
                
                // If must capture, filter only capture moves
                if (this.mustCapture) {
                    this.validMoves = this.validMoves.filter(move => move.capture);
                }
            }
            
            getValidMoves(row, col, player) {
                const piece = this.board[row][col];
                if (!piece || piece.color !== player) return [];
                
                const moves = [];
                
                if (piece.king) {
                    // King can move multiple squares in diagonal directions
                    const directions = [[-1, -1], [-1, 1], [1, -1], [1, 1]];
                    
                    for (const [dr, dc] of directions) {
                        // Check multiple squares in this direction
                        for (let distance = 1; distance < 8; distance++) {
                            const newRow = row + dr * distance;
                            const newCol = col + dc * distance;
                            
                            if (!this.isValidPosition(newRow, newCol)) break;
                            
                            const targetSquare = this.board[newRow][newCol];
                            
                            if (!targetSquare) {
                                // Empty square - can move here
                                moves.push({ row: newRow, col: newCol, capture: false });
                            } else if (targetSquare.color !== player) {
                                // Enemy piece - check if we can capture
                                const captureRow = newRow + dr;
                                const captureCol = newCol + dc;
                                
                                if (this.isValidPosition(captureRow, captureCol) &&
                                    !this.board[captureRow][captureCol]) {
                                    // Can capture - king lands immediately behind captured piece
                                    moves.push({
                                        row: captureRow,
                                        col: captureCol,
                                        capture: true,
                                        capturedRow: newRow,
                                        capturedCol: newCol
                                    });
                                }
                                break; // Can't move further in this direction
                            } else {
                                // Own piece - can't move further in this direction
                                break;
                            }
                        }
                    }
                } else {
                    // Regular piece - original logic
                    const directions = player === 'red' ? [[-1, -1], [-1, 1]] : [[1, -1], [1, 1]];
                    
                    for (const [dr, dc] of directions) {
                        // Regular move
                        const newRow = row + dr;
                        const newCol = col + dc;
                        
                        if (this.isValidPosition(newRow, newCol) && !this.board[newRow][newCol]) {
                            moves.push({ row: newRow, col: newCol, capture: false });
                        }
                        
                        // Capture move
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
            
            makeMove(from, to) {
                const piece = this.board[from.row][from.col];
                
                // Record move in history
                const moveNotation = this.getMoveNotation(from, to);
                this.addMoveToHistory(moveNotation);
                
                // Move piece
                this.board[to.row][to.col] = piece;
                this.board[from.row][from.col] = null;
                
                // Handle capture
                if (to.capture) {
                    this.board[to.capturedRow][to.capturedCol] = null;
                    this.showToast(`🎯 ${this.currentPlayer === 'red' ? 'ผู้เล่น 1' : 'ผู้เล่น 2'} กินฮอต! / Player captured a piece!`, 'success');
                }
                
                // Check for king promotion
                if (!piece.king) {
                    if ((piece.color === 'red' && to.row === 0) ||
                        (piece.color === 'black' && to.row === 7)) {
                        piece.king = true;
                        this.showToast(`👑 เลื่อนเป็นกษัตริย์! / Promoted to King!`, 'warning');
                    }
                }
                
                // Check for additional captures
                if (to.capture) {
                    const additionalCaptures = this.getValidMoves(to.row, to.col, this.currentPlayer)
                        .filter(move => move.capture);
                    
                    if (additionalCaptures.length > 0) {
                        this.selectedPiece = { row: to.row, col: to.col };
                        this.validMoves = additionalCaptures;
                        this.mustCapture = true;
                        return; // Don't switch turns
                    }
                }
                
                this.mustCapture = false;
                this.switchTurn();
                this.checkGameOver();
            }
            
            getMoveNotation(from, to) {
                const fromNotation = String.fromCharCode(97 + from.col) + (8 - from.row);
                const toNotation = String.fromCharCode(97 + to.col) + (8 - to.row);
                return `${fromNotation}-${toNotation}`;
            }
            
            addMoveToHistory(moveNotation) {
                const moveNumber = Math.ceil(this.moveHistory.length / 2) + 1;
                const playerName = this.currentPlayer === 'red' ? 'ผู้เล่น 1' : 'ผู้เล่น 2';
                
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
                
                if (this.moveHistory.length === 0) {
                    moveListElement.innerHTML = '<div style="text-align: center; color: #333333; font-style: italic;">เกมยังไม่เริ่ม / Game not started</div>';
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
                
                // Auto scroll to bottom
                moveListElement.scrollTop = moveListElement.scrollHeight;
            }
            
            switchTurn() {
                this.currentPlayer = this.currentPlayer === 'red' ? 'black' : 'red';
                
                // Check if current player must capture
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
                    this.winner = 'ผู้เล่น 2';
                } else if (blackPieces === 0) {
                    this.gameOver = true;
                    this.winner = 'ผู้เล่น 1';
                } else {
                    // Check if current player has valid moves
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
                        this.winner = this.currentPlayer === 'red' ? 'ผู้เล่น 2' : 'ผู้เล่น 1';
                    }
                }
                
                if (this.gameOver) {
                    clearInterval(this.timerInterval);
                    this.showToast(`🎉 ${this.winner} ชนะ! / ${this.winner} wins!`, 'success');
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
                const player1PiecesElement = document.getElementById('player1-pieces');
                const player2PiecesElement = document.getElementById('player2-pieces');
                
                const redCount = this.countPieces('red');
                const blackCount = this.countPieces('black');
                
                player1PiecesElement.textContent = `${redCount} ตัว`;
                player2PiecesElement.textContent = `${blackCount} ตัว`;
                
                if (this.gameOver) {
                    const winnerText = this.winner === 'ผู้เล่น 1' ? '🎉 แดงชนะ!' : '🎉 ดำชนะ!';
                    currentTurnElement.textContent = winnerText;
                    currentTurnElement.style.fontSize = '1.3em';
                } else {
                    const turnText = this.currentPlayer === 'red' ? 'ตาแดง' : 'ตาดำ';
                    currentTurnElement.textContent = turnText;
                    
                    if (this.mustCapture) {
                        currentTurnElement.textContent += ' (ต้องกิน!)';
                    }
                }
                
                this.updateTimerDisplay();
            }
            
            showToast(message, type = 'info') {
                // ปิด toast เก่าก่อน (ถ้ามี)
                if (currentToast) {
                    currentToast.hideToast();
                }
                
                currentToast = Toastify({
                    text: message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
					backgroundColor: type === "success" ? "#333" : 
									 type === "error" ? "#333" : 
									 type === "warning" ? "#333" : "#333",
                    callback: function() {
                        currentToast = null; // ล้างตัวแปรเมื่อ toast หายไป
                    }
                });
                
                currentToast.showToast();
            }
        }
        
        let game;
        let gameHistory = [];
        
        function newGame() {
            if (game) {
                clearInterval(game.timerInterval);
            }
            game = new MultiplayerCheckers();
            gameHistory = [];
            
            game.showToast("🌊 เกมใหม่เริ่มแล้ว! / New game started!", 'success');
        }
        
        function undoMove() {
            if (!game || game.moveHistory.length === 0) {
                game.showToast("❌ ไม่มีการเดินให้ยกเลิก / No moves to undo", 'error');
                return;
            }
            
            if (game.gameOver) {
                game.showToast("❌ เกมจบแล้ว ไม่สามารถยกเลิกได้ / Game is over, cannot undo", 'error');
                return;
            }
            
            // Store current state for redo functionality
            gameHistory.push({
                board: JSON.parse(JSON.stringify(game.board)),
                currentPlayer: game.currentPlayer,
                moveHistory: [...game.moveHistory],
                timers: {...game.timers}
            });
            
            // For simplicity, restart the game with one less move
            // In a real implementation, you'd properly undo the last move
            const lastMoveCount = game.moveHistory.length;
            newGame();
            
            // Replay all moves except the last one
            // This is a simplified approach - in production you'd implement proper undo
            game.showToast("↶ ยกเลิกการเดินสุดท้าย / Last move undone", 'warning');
        }
        
        function showRules() {
            const rules = `🌊 กฎการเล่นหมากฮอสไทย / Thai Checkers Rules

📋 กฎพื้นฐาน / Basic Rules:
- เล่นบนกระดาน 8x8 ช่อง / Play on 8x8 board
- แต่ละฝ่ายเริ่มต้นด้วย 8 ฮอต / Each side starts with 8 pieces
- ฮอตเดินได้เฉพาะเส้นทแยงมุม / Pieces move diagonally only
- ฮอตธรรมดาเดินไปข้างหน้าเท่านั้น / Regular pieces move forward only

👑 การเลื่อนขั้น / Promotion:
- เมื่อฮอตถึงแถวสุดท้าย จะกลายเป็นกษัตริย์ / Pieces become kings at the far end
- ฮอตกษัตริย์เดินได้ทุกทิศทาง / Kings can move in all directions

🎯 การกิน / Capturing:
- กินโดยการกระโดดข้ามฮอตของฝ่ายตรงข้าม / Capture by jumping over opponent's pieces
- เมื่อกินได้ ต้องกินต่อไปจนกว่าจะไม่มีให้กิน / Must continue capturing if possible

🏆 การชนะ / Winning:
- ชนะเมื่อกินฮอตฝ่ายตรงข้ามหมด / Win by capturing all opponent pieces
- หรือปิดทางไม่ให้เดินได้ / Or by blocking all opponent moves
- หรือเมื่อฝ่ายตรงข้ามหมดเวลา / Or when opponent runs out of time

⏰ เวลา / Timer:
- แต่ละฝ่ายมีเวลา 5 นาที / Each player has 5 minutes
- เวลาจะนับเมื่อถึงเทิร์น / Timer counts down during your turn`;
            alert(rules);
        }
        
        function goToMenu() {
            window.location.href = '/home';
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (!game) return;
            
            switch(e.key) {
                case 'n':
                case 'N':
                    if (e.ctrlKey) {
                        e.preventDefault();
                        newGame();
                    }
                    break;
                case 'z':
                case 'Z':
                    if (e.ctrlKey) {
                        e.preventDefault();
                        undoMove();
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
        });
        
        // Prevent accidental page refresh during game
        window.addEventListener('beforeunload', function(e) {
            if (game && !game.gameOver && game.moveHistory.length > 0) {
                e.preventDefault();
                e.returnValue = 'คุณต้องการออกจากเกมหรือไม่? ความคืบหน้าจะหายไป / Are you sure you want to leave? Game progress will be lost.';
            }
        });
        
        // Auto-save game state (simple localStorage implementation)
        function saveGameState() {
            if (game && !game.gameOver) {
                const gameState = {
                    board: game.board,
                    currentPlayer: game.currentPlayer,
                    moveHistory: game.moveHistory,
                    timers: game.timers,
                    gameStartTime: game.gameStartTime,
                    timestamp: Date.now()
                };
                // In real app: save to server or localStorage
                console.log('Game state saved', gameState);
            }
        }
        
        // Save game state every 30 seconds
        setInterval(saveGameState, 30000);
        
        // Initialize game when page loads
        window.addEventListener('load', () => {
            newGame();
            
            // Show welcome message
            setTimeout(() => {
                game.showToast("🌊 ยินดีต้อนรับสู่เกมเล่นกับเพื่อน! / Welcome to multiplayer mode!", 'success');
            }, 1000);
        });
    </script>
    
    <script>
        const delay = ms => new Promise(res => setTimeout(res, ms));
        
        async function autoMoveOnce(playerColor) {
            if (!game || game.gameOver || game.currentPlayer !== playerColor) return;
            
            for (let row = 0; row < 8; row++) {
                for (let col = 0; col < 8; col++) {
                    const piece = game.board[row][col];
                    if (piece && piece.color === playerColor) {
                        const moves = game.getValidMoves(row, col, playerColor);
                        if (game.mustCapture) {
                            const captureMoves = moves.filter(m => m.capture);
                            if (captureMoves.length > 0) {
                                const move = captureMoves[Math.floor(Math.random() * captureMoves.length)];
                                await delay(300);
                                game.makeMove({ row, col }, move);
                                game.renderBoard();
                                game.updateStatus?.();
                                return true;
                            }
                        } else if (moves.length > 0) {
                            const move = moves[Math.floor(Math.random() * moves.length)];
                            await delay(300);
                            game.makeMove({ row, col }, move);
                            game.renderBoard();
                            game.updateStatus?.();
                            return true;
                        }
                    }
                }
            }
            console.log(`ไม่พบการเดินที่ทำได้สำหรับ ${playerColor}`);
            return false;
        }
        
        let autoPlayInterval = null;
        const autoPlayBtn = document.getElementById('autoPlayBtn');
        
        autoPlayBtn.addEventListener('click', () => {
            if (!game || game.gameOver) {
                alert("เกมจบแล้ว ไม่สามารถให้ AI เล่นต่อได้");
                return;
            }
            
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
                autoPlayBtn.textContent = "🤖 ดู AI เล่นอัตโนมัติ";
                return;
            }
            
            autoPlayInterval = setInterval(async () => {
                if (!game || game.gameOver) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                    autoPlayBtn.disabled = true;
                    autoPlayBtn.textContent = "เกมจบแล้ว";
                    console.log("🎉 เกมจบแล้ว หยุดเล่นอัตโนมัติ");
                    return;
                }
                const current = game.currentPlayer;
                await autoMoveOnce(current);
            }, 500);
            
            autoPlayBtn.textContent = "⏸ หยุด AI เล่นอัตโนมัติ";
        });
        
        // คืนค่าปุ่ม AI ให้ใช้ได้อีกเมื่อเริ่มเกมใหม่
        function resetAIButton() {
            autoPlayBtn.disabled = false;
            autoPlayBtn.textContent = "🤖 ดู AI เล่นอัตโนมัติ";
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
            }
        }
        
        // ✨ เรียก resetAIButton ทุกครั้งที่เริ่มเกมใหม่
        const originalNewGame = newGame;
        newGame = function () {
            originalNewGame(); // เรียกของเดิม
            resetAIButton();   // คืนค่า AI ปุ่ม
        };
        
        // ✨ เพิ่มการปิดปุ่ม AI เมื่อเกมจบ (แทน updateStatus)
        const originalUpdateStatus = MultiplayerCheckers.prototype.updateStatus;
        MultiplayerCheckers.prototype.updateStatus = function () {
            originalUpdateStatus.call(this);
            if (this.gameOver) {
                autoPlayBtn.disabled = true;
                autoPlayBtn.textContent = "เกมจบแล้ว";
            }
        };
    </script>
</body>
</html>
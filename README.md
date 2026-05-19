# 🏆 หมากฮอสไทย - Thai Checkers Game

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)](https://html.spec.whatwg.org/)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)](https://www.w3.org/Style/CSS/)

A modern, responsive Thai Checkers game built with PHP, MySQL, and vanilla JavaScript. Features multiplayer gameplay, AI opponents with multiple difficulty levels, user authentication, and comprehensive statistics tracking.

## 🎮 Features

### Core Game Features
- **🌊 Multiplayer Mode**: Play against friends locally with turn-based gameplay
- **🤖 AI Opponent**: Challenge AI with 4 difficulty levels:
  - 🟢 **Easy** (ง่าย) - Perfect for beginners
  - 🟡 **Medium** (ปานกลาง) - Balanced challenge
  - 🔴 **Hard** (ยาก) - Requires strategy
  - 🟣 **Extreme** (โหดมากๆ) - Nearly unbeatable!
- **⏱️ Timer System**: 5-minute timer per player in multiplayer mode
- **📝 Move History**: Complete game move tracking
- **🏁 Game Statistics**: Track wins, losses, and performance

### User System
- **🔐 User Registration & Login**: Secure authentication system
- **👤 User Profiles**: Personal statistics and game history
- **🔒 Password Management**: Change password functionality
- **📊 Leaderboards**: Global ranking system for AI victories
- **⚡ Session Management**: Secure session handling

### Technical Features
- **📱 Responsive Design**: Optimized for mobile and desktop
- **🎨 Modern UI/UX**: Glassmorphism design with smooth animations
- **⚡ Performance Optimized**: Low-end device support with reduced animations
- **🔧 SEO Friendly**: Clean URL routing system
- **🌐 Multi-language**: Thai and English support
- **💾 Database Integration**: MySQL with PDO for secure data handling

## 🛠️ Technology Stack

### Backend
- **PHP 7.4+** - Server-side logic and routing
- **MySQL/MariaDB** - Database for user management and statistics
- **PDO** - Database abstraction layer for security

### Frontend
- **HTML5** - Modern semantic markup
- **CSS3** - Advanced styling with animations and responsive design
- **Vanilla JavaScript** - Game logic and interactive features
- **Toastify.js** - Notification system

### Design
- **Google Fonts** (Fredoka, Kanit) - Typography
- **CSS Grid & Flexbox** - Layout system
- **CSS Custom Properties** - Theme management
- **Media Queries** - Responsive breakpoints

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache, Nginx)
- Modern web browser

### Setup Steps

1. **Clone/Download the project**
   ```bash
   git clone https://github.com/jindanet/thai-checkers.git
   cd thai-checkers
   ```

2. **Database Setup**
   - Create a new MySQL database
   - Import the example database from `[Database File]/example.sql`
   - Update database credentials in `db.php`:
   ```php
   $db_host = 'localhost';
   $db_user = 'your_username';
   $db_pass = 'your_password';
   $db_name = 'your_database_name';
   ```

3. **Web Server Configuration**
   - Point your web server document root to the project folder
   - Ensure PHP modules are enabled: `pdo`, `pdo_mysql`
   - Configure URL rewriting (see `.htaccess` for Apache)

4. **File Permissions**
   ```bash
   chmod 755 .
   chmod 644 *.php *.html *.css *.js
   ```

### Apache .htaccess Configuration
The project includes a `.htaccess` file for clean URLs. Ensure `mod_rewrite` is enabled:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

## 📖 Usage

### Starting a Game

1. **Register/Login**: Create an account or log in to an existing one
2. **Choose Game Mode**:
   - **Play with Friend**: Local multiplayer on the same device
   - **Play with AI**: Challenge computer opponent
3. **Select Difficulty** (AI mode): Choose your preferred challenge level
4. **Start Playing**: Follow traditional checkers rules

### Game Rules

- **Objective**: Capture all opponent pieces or block all their moves
- **Movement**: Diagonal moves only on dark squares
- **Capturing**: Jump over opponent pieces to capture them
- **King Pieces**: Pieces reaching the opposite end become kings (can move backward)
- **Forced Captures**: Must capture when possible
- **Multiple Captures**: Continue capturing in the same turn when possible

### Navigation

- **Home** (`/`) or `/home` - Main menu
- **Play with Friend** (`/friend`) - Multiplayer mode
- **Play with AI** (`/ai` or `/ai?diff=level`) - AI mode with difficulty
- **Statistics** (`/stats`) - View leaderboards and rankings
- **Login** (`/login`) - User authentication
- **Register** (`/register`) - Create new account

## 🗂️ Project Structure

```
thai-checkers/
├── 📁 [Database File]/
│   └── example.sql              # Safe example schema and seed data
├── 📄 index.php                 # Main router and application entry point
├── 📄 home.php                  # Homepage with game menu
├── 📄 friend.php                # Multiplayer game interface
├── 📄 ai.php                    # AI game interface with difficulty selection
├── 📄 login.php                 # User login page
├── 📄 register.php              # User registration page
├── 📄 stats.php                 # Statistics and leaderboard page
├── 📄 settings.php              # User settings and preferences
├── 📄 api.php                   # API endpoints for authentication
├── 📄 stats_api.php             # API for statistics and leaderboards
├── 📄 db.php                    # Database configuration
├── 📄 404.php                   # Custom 404 error page
├── 📄 logout.php                # Logout functionality
├── 📄 ai.css                    # Game styling and animations
├── 📄 ai.js                     # Main game logic and AI implementation
├── 📄 .htaccess                 # Apache URL rewriting configuration
└── 📄 README.md                 # This documentation
```

## 🎯 Game Logic & AI

### Checkers Implementation
- **Board Representation**: 8x8 grid with piece positioning
- **Move Validation**: Legal move checking and forced capture detection
- **Game State Management**: Turn handling, win condition detection
- **King Promotion**: Automatic promotion when reaching the opposite end

### AI Algorithm
The AI uses a **Minimax algorithm with Alpha-Beta pruning**:

- **Easy**: Depth 2, basic evaluation
- **Medium**: Depth 3, improved position evaluation
- **Hard**: Depth 4, advanced tactical awareness
- **Extreme**: Depth 5+, opening book integration

### Evaluation Factors
- Piece count differential
- King piece value bonus
- Board position advantages
- Mobility and capture opportunities
- Endgame patterns

## 🎨 Design System

### Color Palette
- **Primary**: `#FF6B9D` (Pink)
- **Secondary**: `#4FACFE` (Blue)
- **Accent**: `#9B59B6` (Purple)
- **Success**: `#66BB6A` (Green)
- **Background**: Gradient combinations of pastels

### Typography
- **Headers**: Fredoka (playful, rounded)
- **Body**: Kanit (Thai-optimized, readable)
- **Sizes**: Responsive with `clamp()` for fluid typography

### Responsive Breakpoints
- **Mobile**: `< 768px`
- **Tablet**: `768px - 1024px`
- **Desktop**: `> 1024px`
- **Large**: `> 1440px`

## 🔧 API Endpoints

### Authentication
```
POST /api.php?action=register
POST /api.php?action=login
POST /api.php?action=logout
GET  /api.php?action=check_session
POST /api.php?action=change_password
```

### Statistics
```
GET  /stats_api.php?action=get_leaderboard
POST /stats_api.php?action=save_game_result
GET  /stats_api.php?action=get_user_stats
```

## 📱 Mobile Optimization

### Performance Features
- **Device Detection**: Automatic low-end device optimization
- **Animation Reduction**: Disabled heavy animations on mobile
- **Touch Optimization**: Larger touch targets and gestures
- **Bandwidth Saving**: Reduced asset loading on slow connections
- **Memory Management**: Efficient DOM manipulation

### PWA Features
- **Responsive Design**: Works on all screen sizes
- **Touch-Friendly**: Optimized for touch interactions
- **Fast Loading**: Minimized assets and efficient caching
- **Offline Capability**: Core game functions work offline

## 🔒 Security Features

### Authentication Security
- **Password Hashing**: Secure bcrypt password storage
- **Session Management**: Secure PHP sessions with regeneration
- **CSRF Protection**: Token-based request validation
- **Input Sanitization**: All user inputs are validated and sanitized
- **SQL Injection Prevention**: PDO prepared statements

### General Security
- **XSS Protection**: Content Security Policy headers
- **Clickjacking Prevention**: X-Frame-Options headers
- **Secure Headers**: Modern security headers implementation
- **Clean URLs**: Prevents direct PHP file access

## 🚀 Performance Optimization

### Backend Optimization
- **Database Indexing**: Optimized database queries
- **Connection Pooling**: Efficient database connections
- **Caching**: Session-based caching for frequently accessed data
- **Minification**: CSS/JS compression for production

### Frontend Optimization
- **Lazy Loading**: Images and heavy components loaded on demand
- **Animation GPU Acceleration**: Hardware-accelerated animations
- **Event Throttling**: Reduced event handler frequency
- **Memory Management**: Proper cleanup of event listeners and objects

## 🧪 Testing

### Manual Testing Checklist
- [ ] User registration and login flow
- [ ] Password change functionality
- [ ] Multiplayer game mechanics
- [ ] AI difficulty levels
- [ ] Statistics tracking
- [ ] Mobile responsiveness
- [ ] Cross-browser compatibility

### Browser Support
- **Chrome** 70+
- **Firefox** 65+
- **Safari** 12+
- **Edge** 79+
- **Mobile Browsers**: iOS Safari 12+, Chrome Mobile 70+

## 📈 Future Enhancements

### Planned Features
- 🌐 **Online Multiplayer**: Real-time gameplay with WebSocket
- 🏆 **Tournament Mode**: Organized competitions
- 🎨 **Theme System**: Multiple visual themes
- 🔊 **Sound Effects**: Audio feedback for moves
- 📱 **Native Mobile App**: React Native or Flutter version
- 🤖 **Advanced AI**: Machine learning integration
- 🏅 **Achievement System**: Unlockable rewards
- 📊 **Analytics Dashboard**: Detailed game analytics

### Technical Improvements
- **Redis Caching**: Advanced caching layer
- **REST API**: Full API for mobile apps
- **Docker Support**: Containerized deployment
- **CI/CD Pipeline**: Automated testing and deployment
- **Performance Monitoring**: Application performance tracking

## 🤝 Contributing

### Development Setup
1. Follow installation steps
2. Enable PHP error reporting for development
3. Use browser developer tools for frontend debugging
4. Test on multiple devices and browsers

### Code Style
- **PHP**: Follow PSR-12 standards
- **JavaScript**: ES6+ with consistent formatting
- **CSS**: BEM methodology for class naming
- **Comments**: Document complex logic in Thai and English

## 📄 License

This project is licensed under the **MIT License**. You are free to use, modify, and distribute this code for personal or commercial purposes.

```
MIT License

Copyright (c) 2025 Thai Checkers Game

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 💬 Support & Contact

### Getting Help
- **Issues**: Report bugs and issues on GitHub Issues
- **Documentation**: Check this README and inline code comments
- **Community**: Join discussions in the project repository

### Project Statistics
- **Language**: Primarily PHP (backend) and JavaScript (frontend)
- **Database**: MySQL with comprehensive statistics tracking
- **UI Framework**: Custom CSS with modern design principles
- **Game Engine**: Custom JavaScript implementation

---

## 🌟 Acknowledgments

- **Font**: Google Fonts (Fredoka, Kanit) for beautiful typography
- **Icons**: Emoji icons for universal accessibility
- **Inspiration**: Traditional Thai checkers rules and gameplay
- **Design**: Modern glassmorphism and pastel color trends

---

### 📊 Quick Stats
- **Game Modes**: 2 (Multiplayer, AI)
- **AI Levels**: 4 difficulty settings
- **Languages**: Thai, English
- **Responsive**: Mobile-first design
- **Database Tables**: 8+ for comprehensive statistics
- **Authentication**: Secure user management system

**Ready to play? 🎮 [Visit the game](https://checkers.iws.lol/login) and start your Thai Checkers adventure!**

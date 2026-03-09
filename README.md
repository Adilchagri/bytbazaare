# 🛒 BytBazaare — Full Stack E-Commerce Platform

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

> A secure, feature-rich digital marketplace built from scratch — covering product management, user authentication, cart system, and payment flows.

---

## ✨ Features

- 🔐 **Secure Authentication** — Registration, login, session management with hashed passwords
- 🛍️ **Product Catalog** — Multi-category product management with search and filtering
- 🛒 **Shopping Cart** — Real-time cart updates, quantity management, persistent sessions
- 💳 **Payment Flow** — Secure checkout process with order confirmation
- 👤 **User Dashboard** — Order history, profile management
- 📦 **Admin Panel** — Product CRUD, inventory management, order tracking
- 📱 **Responsive Design** — Mobile-first with Bootstrap 5

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.0, MVC Architecture |
| Database | MySQL with optimized queries |
| Frontend | HTML5, CSS3, JavaScript ES6, Bootstrap 5 |
| Security | PDO prepared statements, CSRF protection, bcrypt hashing |

---

## 📁 Project Structure

```
bytbazaare/
├── index.php              # Entry point & router
├── config/
│   └── db.php             # Database configuration
├── controllers/
│   ├── AuthController.php
│   ├── ProductController.php
│   ├── CartController.php
│   └── OrderController.php
├── models/
│   ├── User.php
│   ├── Product.php
│   └── Order.php
├── views/
│   ├── auth/
│   ├── products/
│   ├── cart/
│   └── admin/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── database/
    └── schema.sql
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.0+
- MySQL 5.7+ or MariaDB
- Apache/Nginx web server (or XAMPP/WAMP for local dev)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/Adilchagri/bytbazaare.git
cd bytbazaare

# 2. Set up database
mysql -u root -p < database/schema.sql

# 3. Configure database connection
cp config/db.example.php config/db.php
# Edit config/db.php with your credentials

# 4. Set up web server
# Point document root to project folder
# OR use PHP built-in server:
php -S localhost:8000
```

### Configuration

```php
// config/db.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'bytbazaare');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

---

## 🗄️ Database Schema

Key tables:
- `users` — user accounts with hashed passwords
- `products` — product catalog with categories, pricing, stock
- `cart_items` — session-linked cart management
- `orders` + `order_items` — order history and line items

---

## 🔒 Security Features

- **SQL Injection Prevention** — All queries use PDO prepared statements
- **XSS Protection** — Output escaping with `htmlspecialchars()`
- **CSRF Tokens** — Form submissions protected against cross-site request forgery
- **Password Hashing** — bcrypt via `password_hash()` / `password_verify()`

---

## 📸 Screenshots

> Coming soon — demo deployment in progress

---

## 👤 Author

**Adil Chagri** — [github.com/Adilchagri](https://github.com/Adilchagri) | [linkedin.com/in/adilchagri](https://linkedin.com/in/adilchagri)

---

## 📄 License

MIT License

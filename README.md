<div align="center">
  <img src="website/img/banner.png" alt="ByteBazaar Banner" width="100%">

  # ByteBazaar
  
  **A Modern E-commerce Platform for Computer Parts & Accessories**

  [![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
  [![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
  [![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
  [![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
  [![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)

  [View Demo](#) • [Report Bug](https://github.com/adilchagri/ByteBazaar/issues) • [Request Feature](https://github.com/adilchagri/ByteBazaar/issues)
</div>

---

## 🚀 Overview

**ByteBazaar** is a fully functional e-commerce solution designed to provide a seamless shopping experience. Built with a robust PHP backend and a responsive frontend, it features a comprehensive admin dashboard, secure user authentication, and an intuitive shopping cart system.

## ✨ Key Features

| Feature | Description |
|---------|-------------|
| 🛒 **Shopping Cart** | Intuitive add-to-cart, update quantities, and checkout flow. |
| 🛡️ **Admin Panel** | Complete control over products, orders, users, and reviews. |
| 👤 **User Accounts** | Secure registration, login, profile management, and order history. |
| ⭐ **Reviews & Ratings** | Interactive product feedback system for customers. |
| 📱 **Responsive Design** | Optimized for desktop, tablet, and mobile devices. |
| 🔍 **Advanced Search** | Find products quickly with category filtering and search. |

## 🛠️ Technology Stack

- **Backend:** PHP (Native)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap, FontAwesome
- **Server:** Apache (XAMPP/WAMP recommended)

## ⚡ Installation & Setup

Follow these steps to get ByteBazaar running on your local machine.

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/en/) installed.
- Git installed.

### Steps

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/adilchagri/ByteBazaar.git
    ```

2.  **Move to Server Directory**
    Move the project folder to your web server's root directory:
    - XAMPP: `C:\xampp\htdocs\`
    - WAMP: `C:\wamp64\www\`

3.  **Database Setup**
    - Open phpMyAdmin (`http://localhost/phpmyadmin`).
    - Create a new database named **`bytebazaar`**.
    - Import the SQL file located at root: **`bytebazaar (1).sql`**.

4.  **Configuration**
    - Open `website/include/connect.php`.
    - Verify your database credentials (default is usually `root` with no password):
      ```php
      $con = mysqli_connect('localhost', 'root', '', 'bytebazaar');
      ```

5.  **Run the Application**
    - Open your browser and visit:
      ```
      http://localhost/ByteBazaar
      ```
    - **Admin Panel**: `http://localhost/ByteBazaar/admin.php`

## 📂 Project Structure

```
ByteBazaar/
├── website/            # Main website assets (img, include)
├── admin.php           # Admin dashboard entry
├── index.php           # Homepage
├── shop.php            # Product catalog
├── cart.php            # Shopping cart
├── checkout.php        # Order processing
├── bytebazaar (1).sql  # Database dump
└── README.md           # Documentation
```

## 🤝 Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

## 👨‍💻 Author

**Adil Chagri**
- GitHub: [@adilchagri](https://github.com/adilchagri)

---
<div align="center">
  Made with ❤️ by Adil Chagri
</div>

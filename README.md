```markdown
# 📚 Online Bookstore

## 🛒 **Overview**

The **Online Bookstore** is a full-stack web application built by a group of college students to simulate a real-world e-commerce platform focused on books. It enables users to **browse**, **register**, **login**, and seamlessly **purchase books**. Featuring a clean UI, secure authentication, and robust admin capabilities, the platform demonstrates practical use of PHP, MySQL, HTML/CSS, and JavaScript in building a scalable web solution.

### 🚀 **Key Features**
- **User Registration & Login**: Secure login system with password hashing and session management.
- **Book Catalog**: Users can browse available books with details like **title**, **author**, **price**, and **stock status**.
- **Shopping Cart**: Add/remove books from the cart, view totals, and checkout summary.
- **Export to Excel**: Download cart contents as an Excel sheet.
- **Admin Dashboard**: Admins can **add**, **edit**, and **delete** books securely.
- **Role-based Access**: Admin functionalities are protected and only accessible to authorized users.

---

## 🛠️ **Tech Stack**

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (XAMPP recommended)
- **Tools**: phpMyAdmin, Excel Export

---

## ⚙️ **How to Run the Project Locally**

### 1. **Clone the Repository**

```bash
git clone https://github.com/AB2511/WebTechbnologyLabMiniProject.git
```

### 2. **Set Up the Database**

1. Open **phpMyAdmin** (or MySQL CLI).
2. Create the database:

```sql
CREATE DATABASE bookstore_db;
USE bookstore_db;
```

3. Run the following SQL to create tables:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT DEFAULT 0
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    quantity INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);
```

4. (Optional) Insert test data:

```sql
INSERT INTO users (name, email, password, is_admin)
VALUES ('Admin User', 'admin@example.com', '$2y$10$hashedpasswordhere...', 1);

INSERT INTO books (title, author, price, quantity, image_url)
VALUES ('Test Book', 'Test Author', 19.99, 10, 'https://example.com/test.jpg');
```

---

### 3. **Configure the Database Connection**

Edit `db.php` and update with your local MySQL credentials:

```php
$conn = new mysqli("localhost", "your_username", "your_password", "bookstore_db");
```

Ensure to handle connection errors properly.

---

### 4. **Run the Application**

1. Move the project folder to your web server directory (e.g., `C:\xampp\htdocs\bookstore`).
2. Start **Apache** and **MySQL** in XAMPP.
3. Open your browser and visit:

```url
http://localhost/bookstore
```

---

## 🧭 **User Flow**

### 🔹 For Users:
- Visit `index.php` to explore the catalog.
- Register via `register.php` or login via `login.php`.
- Add books to the cart on `catalog.php`.
- View and manage your cart using `cart.php`.
- Export cart data to Excel via `export_cart.php`.

### 🔸 For Admins:
- Login with:
  - Email: `admin@example.com`
  - Password: `admin1234`
- Access the dashboard: `admin/admin_dashboard.php`
  - Add: `admin/add_book.php`
  - Edit: `admin/edit_book.php?id=<book_id>`
  - Delete: `admin/delete_book.php?id=<book_id>`
- Logout: `logout.php`

---

## 📁 **Project Structure**

```
bookstore/
├── admin/
│   ├── add_book.php
│   ├── edit_book.php
│   ├── delete_book.php
│   ├── admin_dashboard.php
│   └── admin_helper.php
├── db.php
├── index.php
├── login.php
├── register.php
├── catalog.php
├── cart.php
├── export_cart.php
├── remove_from_cart.php
├── logout.php
├── style.css
└── README.md
```

---

## 🤝 **Contributing**

We welcome contributions! Feel free to fork the repo and submit pull requests. Please maintain code consistency and document your changes.

---

## 🙏 **Acknowledgments**

- Special thanks to open-source tools like **XAMPP**, **PHP**, and **MySQL**.
- Inspired by modern e-commerce practices and user experience design principles.

---

### 📚 Happy Reading & Coding! 🚀

---
```

Let me know if you'd like a version with markdown badges or visuals added too!

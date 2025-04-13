# Online Bookstore

## Project Description
The Online Bookstore is a web-based e-commerce application designed to provide users with a seamless platform to browse, manage, and purchase books. Built using PHP, MySQL, HTML, CSS, and JavaScript, the project features a user-friendly interface with a catalog page displaying books with details such as title, author, price, and availability. Users can register, log in, add books to their cart, view cart totals, remove items, and export cart details to Excel. The application includes robust admin functionalities for managing books (add, edit, delete) and ensures secure user authentication with password hashing and session management. This project demonstrates a practical e-commerce solution with a focus on usability, security, and scalability.

## Features
- **User Features**:
  - Browse a catalog of books with title, author, price, and availability.
  - User registration and secure login with password hashing.
  - Add books to a shopping cart.
  - View cart details, calculate totals, and remove items.
  - Export cart contents to Excel.

- **Admin Features**:
  - Add, edit, and delete books in the catalog.
  - Restricted access to admin dashboard and management pages.

- **Technical Highlights**:
  - Server-side logic implemented with PHP.
  - Database management with MySQL.
  - Responsive interface styled with HTML and CSS.
  - Dynamic interactions enhanced with JavaScript.
  - Secure session management and password hashing.
  - Admin access control using role-based checks.

## Prerequisites
- **Web Server**: Apache (e.g., XAMPP for local development).
- **PHP**: Version 7.4 or higher.
- **MySQL**: Version 5.7 or higher.
- **Web Browser**: Any modern browser (Chrome, Firefox, etc.).

## Installation

1. **Clone the Repository**:
   ```bash
   git clone  https://github.com/AB2511/WebTechbnologyLabMiniProject.git
## Set Up the Database:
Create the database and tables by running the following SQL commands or importing bookstore_db.sql:

<details> <summary>Click to expand SQL setup</summary>
CREATE DATABASE bookstore_db;
USE bookstore_db;

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

-- Add a test admin user
INSERT INTO users (name, email, password, is_admin) 
VALUES ('Admin User', 'admin@example.com', '$2y$10$9o3tTU1ZmZnpA9A9Svdg8O6LnMNFA7qkK14fUrKi5zr...', 1);

-- Add a test book
INSERT INTO books (title, author, price, quantity, image_url) 
VALUES ('Test Book', 'Test Author', 19.99, 10, 'https://example.com/test.jpg');
</details>
Update db.php with your MySQL credentials:
php
$conn = new mysqli("localhost", "your_username", "your_password", "bookstore_db");
Ensure the connection check (if ($conn->connect_error)) is active to handle errors.
## Configure the Web Server:
Place the project folder in your web server directory (e.g., C:\xampp\htdocs\bookstore for XAMPP).
Start the Apache and MySQL services.

## Run the Application:
Open a browser and navigate to http://localhost/bookstore.
Log in with the admin credentials (admin@eg.com, admin12) or register a new user.
## Usage
- **User Workflow**:
  - Visit the homepage (index.php) and register (register.php) or log in (login.php).
  - Browse the catalog (catalog.php), add books to the cart, and manage the cart (cart.php).
  - Export the cart to Excel (export_cart.php) or remove items.
- **Admin Workflow**:
  - Log in with admin@example.com and admin1234 to access the admin dashboard (admin/admin_dashboard.php).
  - Manage books using:
    - Add: admin/add_book.php
    - Edit: admin/edit_book.php?id=<book_id>
    - Delete: admin/delete_book.php?id=<book_id>
  - Logout via logout.php.
## File Structure
bookstore/
├── admin/
│   ├── add_book.php          # Add new books
│   ├── edit_book.php         # Edit existing books
│   ├── delete_book.php       # Delete books
│   ├── admin_dashboard.php   # Admin hub
│   ├── admin_helper.php      # Admin access function
├── db.php                   # Database connection
├── index.php                # Welcome page
├── login.php                # User login
├── register.php             # User registration
├── catalog.php              # Book catalog
├── cart.php                 # Shopping cart
├── export_cart.php          # Export cart to Excel
├── remove_from_cart.php     # Remove items from cart
├── style.css                # Stylesheet
├── logout.php               # Logout functionality
├── README.md                # This file
└── (optional: hash_test.php, update_password.php for setup)

Contributing
Contributions are welcome! Please fork the repository and submit pull requests for enhancements or bug fixes. Follow the existing code style, add comments, and include tests where applicable.
Acknowledgments
Thanks to the open-source community for tools like XAMPP, PHP, and MySQL.
Inspired by e-commerce best practices for usability and security.

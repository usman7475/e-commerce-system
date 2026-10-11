# PakBazar

PakBazar is a PHP and MySQL e-commerce web application for browsing and selling products across categories such as groceries, home essentials, and electronics. It includes customer shopping features and separate administration and supplier panels.

## Features

- Browse products, view product details, search, and filter by category
- Register and sign in as a customer
- Add products to a shopping cart and place orders with Cash on Delivery
- View and submit product reviews with a 1–5 star rating
- Admin dashboard for managing categories, products, orders, users, homepage slides, and reviews
- Supplier panel for managing products, orders, customers, and reviews
- Responsive interface built with Bootstrap and custom CSS

## Built With

- PHP
- MySQL / MariaDB
- HTML, CSS, and JavaScript
- Bootstrap, jQuery, and Font Awesome (loaded from CDNs)

## Requirements

- PHP with the `mysqli` extension
- MySQL or MariaDB
- A local PHP server such as XAMPP, WAMP, or LAMP
- Internet access for the frontend libraries loaded from CDNs

## Installation

### 1. Get the project

Clone the repository into your web server's document root. For XAMPP on Windows, that is usually `C:\xampp\htdocs`.

```bash
git clone <your-repository-url> pakbazar
```

Alternatively, download the repository and place the `pakbazar` folder inside `htdocs`.

### 2. Start the local services

Open the XAMPP Control Panel and start **Apache** and **MySQL**.

### 3. Create and import the database

1. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Create a database named `pakbazar`.
3. Select the database and choose **Import**.
4. Import `Database File sql/pakbazar.sql` from the project folder.

### 4. Configure the database connection

Open `conn.php` and set the connection values for your MySQL installation. The checked-in defaults are for a typical local XAMPP installation; update the username, password, host, and database name if yours differ.

```php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pakbazar';
```

Do not use local development credentials in a production environment.

### 5. Open the application

Visit [http://localhost/pakbazar](http://localhost/pakbazar) in your browser.

## Accounts and Roles

Customers can create an account through the registration page. Registration creates a `User` role. Admin and supplier access is role-based and must be assigned to an account in the `registration` table; use an account you control and change its role to `Admin` or `Supplier` using phpMyAdmin as appropriate.

The SQL dump may contain demonstration records, including account credentials and order contact details. Review and remove or anonymize those records before publishing the repository or using the application with real users. Never rely on sample credentials for a live deployment.

## Project Structure

```text
pakbazar/
├── admin/                 # Admin dashboard and management pages
├── supplier/              # Supplier dashboard and management pages
├── Database File sql/     # Database schema and seed data
├── admin/upload/          # Product and homepage slide uploads
├── conn.php               # MySQL connection settings
├── index.php              # Storefront homepage
├── product.php            # Product listing and search
├── detail.php             # Product detail and reviews
├── cart.php               # Shopping cart
├── checkout.php           # Checkout and order placement
└── style.css              # Site styling
```

## Notes

- The application uses Cash on Delivery for checkout.
- The frontend loads several libraries from third-party CDNs.
- For production use, review authentication, authorization, input validation, database credentials, and uploaded-file handling before deployment.

## Author

**Usman Younis**  
Email: [usmanyounis7475@gmail.com](mailto:usmanyounis7475@gmail.com)

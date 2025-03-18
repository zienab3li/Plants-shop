# MY_SHOP - E-commerce Website

## 📌 Overview
MY_SHOP is a fully functional e-commerce website built using **native PHP** and **MySQL**. It allows users to browse products, add them to the cart, and place orders. Admins can manage products, categories, users, and orders through a dashboard.

---

## 🚀 Features

### 🛒 User Features:
- Browse and search for products.
- Add products to the cart.
- Checkout and place orders.
- View order history and status.

### 🔑 Admin Features:
- Manage products (add, edit, delete).
- Manage categories.
- Manage users (list and delete).
- Manage orders (update status, delete).
- Dashboard with an overview of store activity.

---

## 🛠️ Technologies Used

- **Backend:** PHP (Native)
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap
- **Authentication:** Sessions (PHP)
- **Admin Panel:** Bootstrap-based dashboard

---

## 📂 Project Structure

MY_SHOP/ │── app/ # Database configuration │ ├── dbconfig.php # Database connection settings │ │── assets/ # CSS, JS, and images │ ├── css/ # Stylesheets │ │ ├── style.css │ ├── js/ # JavaScript files │ │ ├── scripts.js │ ├── images/ # Image assets │ │── dashboard/ # Admin Panel │ ├── assets/ # Admin-specific assets │ ├── categories/ # Category management (add, edit, list) │ ├── orders/ # Order management (delete, details, status) │ ├── products/ # Product management (add, edit, list) │ ├── users/ # User management (list) │ ├── shared/ # Admin layout files (header, navbar, footer, sidebar) │ │── shared/ # Reusable components │ ├── header.php │ ├── navbar.php │ ├── footer.php │ │── vendor/ # External libraries │ │── database.sql # SQL dump file │── index.php # Homepage │── login.php # User authentication │── logout.php # Logout script │── register.php # User registration │── profile.php # User profile │── cart.php # Shopping cart │── add-to-cart.php # Add products to cart │── remove_from_cart.php # Remove items from cart │── checkout.php # Order checkout │── orders.php # User order history │── error.php # Access restriction page │── success.php # Order success page │── readme.md # Documentation


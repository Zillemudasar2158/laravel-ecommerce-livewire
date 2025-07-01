# Laravel E-Commerce Project

This is a fully functional e-commerce platform built with Laravel and Livewire. It includes complete cart functionality, dynamic product listings, coupon discounts, order management, and more.

## 🔥 Features


- 🔐 **User Authentication** (Register, Login, Logout)
- 🧾 **Role-Based Authorization** (Admin/User)
- 📦 **Product Management**
  - Add/Edit/Delete Products
  - Product Image Uploads
  - Discount Price Handling
  - Auto Product Code Generator
- 🏷️ **Category & Subcategory Management**
- 🔍 **Product Search** (Search by title, category, subcategory)
- 🛒 **Dynamic Shopping Cart** with:
  - Add to Cart
  - Quantity Increment/Decrement
  - Auto Remove on `0` Quantity
- 📬 **Email Notifications**
  - Order Confirmation Email
  - Order Summary with Product Details
- 🧾 **Order Management System**
  - Shipping Address
  - Payment Mode (COD + Online coming soon)
  - Admin Panel for All Orders
  - Order Status Update with Livewire
- 🧹 **Wishlist, Reviews & Coupons** *(In Progress)*
- 📈 **Fully Responsive UI** with Tailwind CSS

---

## 🧠 Application Workflow

1. 👤 User registers and logs in using Laravel Breeze
2. 🛍️ User browses products by category/subcategory
3. ➕ Adds products to cart dynamically (Livewire-based)
4. 🧾 Applies coupon if available
5. 📝 Enters shipping address and chooses payment method (COD)
6. 📧 Receives email confirmation with order summary
7. 🛠 Admin views all orders and updates status via Livewire panel

---

## 🔗 Core Relationships

- A **User** has many **Orders**
- An **Order** has many **Products** through **OrderItems**
- A **Category** has many **Subcategories**
- A **Product** belongs to a **Category** and **Subcategory**
- A **User** may have **Wishlist Items** and **Product Reviews**
- An **Order** may include a **Coupon** (if applied)

---

## 🌐 API Roadmap (Coming Soon)

We are planning to add RESTful API endpoints to integrate mobile apps and external services.

- `GET /api/products` – List all products
- `POST /api/orders` – Create a new order
- `GET /api/user/orders` – Fetch user-specific orders
- JSON response structure will be standardized
- Postman collection will be published in future update

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Blade, Livewire, Tailwind CSS
- **Database:** MySQL
- **Email:** Laravel Mail with Markdown
- **Version Control:** Git, GitHub

---

## 📂 Project Structure
```bash
app/
├── Http/
│ ├── Controllers/
│ ├── Livewire/ # All Livewire components like Cart, OrderList, etc.
├── Models/
resources/
├── views/ # Blade files
│ ├── products/
│ ├── category/
│ ├── cart/
routes/
├── web.php # Route definitions

---

## ⚙️ Setup Instructions

Clone the repository:
   ```bash
   git clone https://github.com/Zillemudasar2158/laravel-ecommerce-livewire.git
   cd laravel-ecommerce-livewire
   composer install
   npm install && npm run dev
   cp .env.example .env
   php artisan key:generate
   php artisan serve

📝 Todo / Upcoming Features

🛠 Online Payment Gateway Integration *(Coming Soon)*  
🛠 Wishlist & Product Reviews *(In Progress)*  


👨‍💻 Author
Muhammad Zill-e-Muddassar
Laravel Developer | PHP Enthusiast
GitHub: Zillemudasar2158

📄 License
This project is open-sourced and available under the MIT license.

---
Copyright (c) 2025 Muhammad Zill-e-Muddassar

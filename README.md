# 🛒 Laravel E-Commerce Platform (Livewire Based)

This is a fully functional E-Commerce platform built using **Laravel 12**, **Livewire**, and **Tailwind CSS**. The application provides core e-commerce features such as category-wise product listings, cart management, order processing, payment integration, and user authentication – all with a clean and modern UI/UX.

---

## 🚀 Features

- 🔐 **User Authentication** (Register, Login, Logout)
- 🧾 **Role-Based Authorization** (Admin/User)
- 📦 **Product Management**
  - Add/Edit/Delete Products
  - Product Image Uploads
  - Discount Price Handling
  - Auto Product Code Generator
- 🏷️ **Category & Subcategory Management**
- 🔍 **Livewire-Based Product Search** (Search by title, category, subcategory)
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

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Blade, Livewire, Tailwind CSS
- **Database:** MySQL
- **Email:** Laravel Mail with Markdown
- **Version Control:** Git, GitHub

---

## 📂 Project Structure

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

 Online Payment Gateway Integration

 Admin Dashboard UI

 Wishlist & Product Reviews

 Coupon System

 User Profile Management

👨‍💻 Author
Muhammad Zill-e-Muddassar
Laravel Developer | PHP Enthusiast
GitHub

📄 License
This project is open-sourced and available under the MIT license.

---
Copyright (c) 2025 Muhammad Zill-e-Muddassar

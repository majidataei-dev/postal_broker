# Postal Broker

A full-stack application built with **Laravel** (backend) and **Vue.js +
Inertia.js** (frontend).

------------------------------------------------------------------------

## 📑 Table of Contents

-   [Introduction](#introduction)
-   [Features](#features)
-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
    -   [Backend](#backend)
    -   [Frontend](#frontend)
-   [Project Structure](#project-structure)
-   [Routes & API](#routes--api)
-   [Security Considerations](#security-considerations)
-   [Development & Contribution](#development--contribution)
-   [License](#license)

------------------------------------------------------------------------

## 🚀 Introduction

**Postal Broker** is a full-stack system for managing shipping
packages.\
It provides a modern SPA-like experience with **Laravel** as the backend
and **Vue.js + Inertia.js** as the frontend.

------------------------------------------------------------------------

## ✨ Features

-   🔑 User authentication & management (Laravel Sanctum)\
-   ⚡ Single Page Application (Vue.js + Inertia.js)\
-   📦 Full CRUD operations\
-   📱 Responsive design (desktop & mobile)\
-   🔔 Notifications with IziToast\
-   🌍 Optional multilingual support

------------------------------------------------------------------------

## ⚙️ Prerequisites

-   PHP \>= 8.2\
-   Composer\
-   Node.js \>= 22\
-   MySQL\
-   npm or yarn

------------------------------------------------------------------------

## 🛠 Installation

### Backend

``` bash
# Clone the repository
git clone https://github.com/MajidAtaei1993/postal_broker.git
cd postal_broker

# Fix autoload issues
composer dump-autoload

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# (Optional) Generate Wayfinder definitions
php artisan wayfinder:generate

# Run migrations & seeders
php artisan migrate --seed

# Start Laravel development server
php artisan serve
```

### Frontend

``` bash
# Install dependencies
npm install

# Run development server
npm run dev
```

------------------------------------------------------------------------

## 📂 Project Structure

    postal_broker/
    ├── app/             # Laravel backend logic
    ├── database/        # Migrations & seeders
    ├── resources/js/    # Vue.js + Inertia frontend
    ├── routes/          # Web & API routes
    ├── public/          # Public assets
    └── ...

------------------------------------------------------------------------

## 🔗 Routes & API

### Users

**POST** `/api/users`\
Example request body:

``` json
{
  "full_name": "Majid Ataei",
  "mobile": "09198412978",
  "address": "123 Main St, City",
  "zip_code": "5619877131"
}
```

### Shipments

**GET** `/api/shipments`\
**POST** `/api/shipments`\
Example request body:

``` json
{
  "sender_id": "3faf286a-6e0a-49f5-91aa-67d93410ebe1",
  "receiver_id": "a31e63b8-b264-4879-9ad4-baab3e8b575f",
  "service_type": "express",
  "status": "pending",
  "description": "This is a test shipment with multiple packages",
  "packages": [
    {
      "weight": 2.5,
      "length": 30,
      "width": 20,
      "height": 15,
      "package_type": "fragile"
    },
    {
      "weight": 1.2,
      "length": 15,
      "width": 10,
      "height": 8,
      "package_type": "document"
    },
    {
      "weight": 0.8,
      "length": 10,
      "width": 8,
      "height": 5,
      "package_type": "valuable"
    }
  ]
}
```

------------------------------------------------------------------------

## 🔒 Security Considerations

-   Protect all routes with **Sanctum** authentication.\
-   Validate all inputs with Laravel Form Requests.\
-   Use HTTPS in production.\
-   Avoid exposing sensitive `.env` data.

------------------------------------------------------------------------

## 🤝 Development & Contribution

1.  Fork the repo\
2.  Create your feature branch (`git checkout -b feature/awesome`)\
3.  Commit changes (`git commit -m 'Add new feature'`)\
4.  Push to the branch (`git push origin feature/awesome`)\
5.  Open a Pull Request

------------------------------------------------------------------------

## 📄 License

This project is licensed under the [MIT License](LICENSE).
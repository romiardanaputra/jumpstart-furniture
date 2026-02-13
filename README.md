# JumpStart Furniture 🛋️

**JumpStart Furniture** is a premium e-commerce platform built with Laravel 9, designed to provide a seamless and visually stunning shopping experience for high-end furniture. The platform emphasizes performance, scalability, and a modern user interface.

![JumpStart Furniture Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

---

## 🚀 Core Features

- **🛒 Dynamic Product Catalog**: Real-time filtering (by color, material, room type) using Livewire.
- **💳 Secure Payments**: Full integration with **Xendit** (Virtual Account, E-Wallet, QRIS) with idempotency protection.
- **🚚 Smart Logistics**: Dynamic shipping rates calculation through **RajaOngkir** integration.
- **📰 Advanced Blog System**: SEO-friendly "Shop the Look" integration and rich-text editing.
- **🛡️ Enterprise Architecture**: Robust Service-Repository pattern for clear separation of concerns.
- **👤 User Profiles**: Comprehensive account management and order tracking powered by Jetstream & Sanctum.
- **📊 Admin Dashboard**: KPIs, product variation management, and order pipeline tracking.

---

## 🛠️ Tech Stack

- **Backend**: [Laravel 9.x](https://laravel.com) (PHP 8.1+)
- **Frontend**: [Tall Stack](https://tallstack.dev) (Tailwind CSS, Alpine.js, Laravel Livewire, Laravel)
- **State Management**: [Alpine.js](https://alpinejs.dev)
- **Styling**: [Tailwind CSS 3](https://tailwindcss.com) & [Flowbite](https://flowbite.com)
- **Payments**: [Xendit PHP SDK](https://github.com/xendit/xendit-php)
- **Build Tool**: [Vite](https://vitejs.dev)

---

## 🏗️ Architecture & Standards

This project follows an enterprise-grade architecture to ensure maintainability:

1. **Service-Repository Pattern**: Decouples business logic from data access.
2. **Contract-Based DI**: Uses PHP interfaces for flexible service injection.
3. **Optimistic/Pessimistic Locking**: Ensures data integrity during high-concurrency checkouts.
4. **Atomic UI Design**: Uses a custom `x-ui` component library for visual consistency.

For more details, see the [Architecture Overview](docs/ARCHITECTURE.md).

---

## 📦 Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Installation

1. **Clone the repository**:

    ```bash
    git clone https://github.com/romiardanaputra/jumpstart-furniture.git
    cd jumpstart-furniture
    ```

2. **Install dependencies**:

    ```bash
    composer install
    npm install
    ```

3. **Setup environment**:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations & seeders**:

    ```bash
    php artisan migrate --seed
    ```

5. **Compile assets**:

    ```bash
    npm run dev
    ```

6. **Serve the application**:
    ```bash
    php artisan serve
    ```

---

## 📂 Project Structure

- `app/Services`: Business logic orchestration.
- `app/Repositories`: Data access logic (Eloquent).
- `app/Contracts`: System interfaces and definitions.
- `app/Http/Livewire`: Interactive frontend components.
- `docs/`: Technical documentation and roadmaps.

---

## 🗺️ Roadmap

- [x] Phase 1: MVP - Core Storefront & Checkout.
- [ ] Phase 2: Growth - RajaOngkir & WA Notifications.
- [ ] Phase 3: Advanced - AI Recommendations & AR Preview.

See the full [Feature Roadmap](docs/FEATURE_ROADMAP.md) for details.

---

## ⚖️ License

The JumpStart Furniture platform is open-sourced software licensed under the [MIT license](LICENSE).

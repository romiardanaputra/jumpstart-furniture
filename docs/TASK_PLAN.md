# JumpStart Furniture - Implementation Task Plan (Phase 1)

This document contains the granular technical tasks for Phase 1: MVP. Each task includes implementation details and architectural requirements.

## 1. Foundation: Database & Models 🏗️

**Goal**: Build a scalable schema for furniture products and variations.

### 1.1 Category & Attributes

- [ ] **Migration: `categories`**: Support nested categories (`parent_id`, `slug`, `image`).
- [ ] **Migration: `attributes`**: To store variation types (e.g., "Color", "Material", "Size").
- [ ] **Migration: `attribute_values`**: To store specific values (e.g., "Teak Wood", "Grey", "King Size").

### 1.2 Products & SKUs (Parent-Child)

- [ ] **Migration: `products`**: General product data (title, slug, long description, base price).
- [ ] **Migration: `skus`**: The actual sellable units.
    - Fields: `product_id`, `code` (Unique SKU), `price`, `stock`, `weight`, `dimensions` (json or individual columns).
- [ ] **Migration: `attribute_value_sku`**: Pivot table to link SKUs to their attribute values.

---

## 2. Core Storefront: Discovery & Experience 🛋️

**Goal**: Implement the public-facing catalog.

### 2.1 Livewire: Product Discovery

- [ ] **`ProductList` Component**:
    - [ ] Grid display with lazy-loaded images.
    - [ ] Real-time filtering by Category and Price Range.
    - [ ] Sort functionality (Newest, Price High-Low).
- [ ] **`ProductDetail` Component**:
    - [ ] Image gallery.
    - [ ] **Variation Selector**: Dynamic price/stock updates when a variation is selected.
    - [ ] Tabbed content (Specs, Shipping, Reviews).

### 2.2 Shared Components

- [ ] **`ProductCard`**: Hover effects (lifestyle shot preview).
- [ ] **`CategoryNav`**: Sidebar/Dropdown navigation.

---

## 3. Cart & Transactions 🛒

**Goal**: Secure and idempotent shopping experience.

### 3.1 Cart Logic

- [ ] **`CartService`**: Centralized logic for adding/removing/updating cart items in session/db.
- [ ] **`MiniCart`**: Quick view dropdown in the navbar.
- [ ] **`CartDetail`**: Full cart page with shipping estimator logic.

### 3.2 Xendit Payment Integration

- [ ] **Xendit Service**: Implement the Redirect/Invoice API call.
- [ ] **Webhook Controller**: Handle IPN (Instant Payment Notification) with token validation.
- [ ] **Order Success View**: Polling status for immediate user feedback.

---

## 4. Admin Dashboard Basics 🎛️

**Goal**: Enable management of products and orders.

- [ ] **Product Management**:
    - [ ] CRUD for Products.
    - [ ] **Variation Generator**: Batch create SKUs from selected attributes.
- [ ] **Order Management**:
    - [ ] List views with status filters.
    - [ ] Status transition logic (Manual vs. Automatic via Webhooks).

---

## Implementation Standards

- **Validation**: Strict use of `FormRequests`.
- **Eager Loading**: All SKU queries must use `with(['product', 'attributeValues'])`.
- **Atomic UI**: Use existing `x-ui` components for all interfaces.
- **Transactions**: Use `DB::transaction()` for all order placements.

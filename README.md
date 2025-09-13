# Scribbles

Scribbles is a simple web application for viewing and creating posts.

## About

Scribbles allows users to browse existing posts and create their own content with a clean, modern interface. 

## Tech Stack

- Laravel 12 (PHP 8.x)
- MySQL
- Tailwind CSS
- npm 11.x

## Security

This project implements some of Laravel's built-in security features including:

- CSRF protection for form submissions
- SQL injection prevention through Eloquent ORM
- XSS protection with Blade templating
- Secure password hashing

## Getting Started

1. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

3. **Run the application**
   ```bash
   npm run dev
   php artisan serve
   ```

Visit `http://localhost:8000` to view the application.


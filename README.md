# TripGenius Installation Guide

Welcome to the installation guide for TripGenius. Follow the steps below to set up your local development environment.

## Prerequisites
Ensure you have the following installed on your system:
- PHP 7.4 or higher
- [Composer](https://getcomposer.org/)

You can check your PHP version by running:
```bash
php -v
```

And Composer by running:
```bash
composer -v
```

## Installation

1. **Clone the Repository**

   Use the following command to clone the TripGenius repository to your local machine:

   ```bash
   git clone https://github.coventry.ac.uk/maiadasila/TripGenius.git
   ```

2. **Navigate to the Project Directory**

   After cloning the repository, navigate into the project directory:

   ```bash
   cd tripgenius
   ```

3. **Install Dependencies**

   Install all necessary PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. **Environment Setup**

   Copy the example environment file to create a new `.env` file:

   ```bash
   cp .env.example .env
   ```

   Then, open the `.env` file and enter your database credentials.

5. **Application Key**

   Generate a unique application key with Artisan:

   ```bash
   php artisan key:generate
   ```

6. **Database Migration and Seeding**

   Run the database migrations and (optionally) seed the database:

   ```bash
   php artisan migrate --seed
   ```

7. **Start the Development Server**

   Launch the Laravel development server:

   ```bash
   php artisan serve
   ```

   Your application will now be running at 
   ```bash
   http://localhost:8000
   ```

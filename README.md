### Project Documentation

## Table of Contents

1. [Introduction](#introduction)
2. [Project Structure](#project-structure)
   - [Backend (Laravel)](#backend-laravel)
   - [Frontend (Vue.js)](#frontend-vuejs)
3. [Setting Up the Project](#setting-up-the-project)
   - [Backend Setup](#backend-setup)
   - [Frontend Setup](#frontend-setup)
4. [Running the Project](#running-the-project)
5. [API Documentation](#api-documentation)
6. [Testing](#testing)
7. [Deployment](#deployment)
8. [Contributing](#contributing)
9. [Troubleshooting](#troubleshooting)
10. [License](#license)

## Introduction



## Project Structure

### Backend (Laravel)

Explain the structure of the `backend` folder. Highlight key directories and files.

```
/backend
  /app
    # Laravel application files
  /config
    # Configuration files
  /database
    # Database migrations and seeds
  /public
    # Publicly accessible assets
  /resources
    # Views, lang files, and other resources
  /routes
    # API routes
  /tests
    # PHPUnit test cases
  artisan
    # Laravel artisan command-line tool
  composer.json
    # Composer dependencies
  .env
    # Environment configuration
```

### Frontend (Vue.js)

Explain the structure of the `frontend` folder. Highlight key directories and files.

```
/frontend
  /src
    /assets
      # Frontend assets
    /components
      # Vue components
    /layout
      # layout
    /store
      # Vuex store
    /views
      # Vue views
    App.vue
      # Main Vue component
    main.js
      # Vue.js entry point
  /public
    # Publicly accessible assets
  babel.config.js
    # Babel configuration
  package.json
    # Node.js dependencies
  vue.config.js
    # Vue.js configuration
```

## Setting Up the Project

### Backend Setup

1. Clone the repository.
   ```bash
   git clone https://github.com/aathil-ali/Photographer-Gallery.git
   ```

2. Navigate to the `backend` directory.
   ```bash
   cd backend
   ```

3. Install Laravel dependencies.
   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env` and configure your database and other settings.
   ```bash
   cp .env.example .env
   ```

5. Generate the application key.
   ```bash
   php artisan key:generate
   ```

6. Run migrations.
   ```bash
   php artisan migrate 
   ```
7. Run Storage Link.
   ```bash
   php artisan storage:link
   ```

### Frontend Setup

1. Navigate to the `frontend` directory.
   ```bash
   cd frontend
   ```

2. Install Node.js dependencies.
   ```bash
   npm install
   ```

3. Configure the backend API URL in the `.env` file.

## Running the Project

- **Backend:**
  ```bash
  cd backend  
  php artisan serve
  ```

- **Frontend:**
  ```bash
  cd frontend
  npm run serve
  ```

Access the backend API at `http://localhost:8000` and the frontend at `http://localhost:8080`.



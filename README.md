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

This project documentation provides comprehensive guidance for setting up, configuring, and running the Photographer Gallery project. It covers both the backend, developed with Laravel, and the frontend, built using Vue.js.

## Project Structure

### Backend (Laravel)

The `backend` folder contains all files and directories related to the Laravel backend application:

- **app**: Houses Laravel application files, including controllers, models, and middleware.
- **config**: Contains configuration files for the Laravel application.
- **database**: Includes database migrations and seeds for setting up the database schema and initial data.
- **public**: This directory holds publicly accessible assets such as images, CSS, and JavaScript files.
- **resources**: Contains views, language files, and other resources used by the application.
- **routes**: Defines API routes for the Laravel application.
- **tests**: Contains PHPUnit test cases for testing application functionality.
- **artisan**: The Laravel artisan command-line tool for executing various commands.
- **composer.json**: Defines Composer dependencies for the Laravel application.
- **.env**: Environment configuration file containing settings such as database connection details and application key.

### Frontend (Vue.js)

The `frontend` folder contains files and directories related to the Vue.js frontend application:

- **src**: Contains the source code of the Vue.js application.
  - **assets**: Houses frontend assets such as images, fonts, and other static files.
  - **components**: Includes Vue components used to build the frontend UI.
  - **layout**: Defines layout components used to structure the frontend views.
  - **store**: Contains Vuex store modules for managing application state.
  - **views**: Houses Vue views representing different pages or sections of the application.
  - **App.vue**: The main Vue component serving as the entry point for the application.
  - **main.js**: The entry point of the Vue.js application.
- **public**: Contains publicly accessible assets served by the Vue.js application.
- **babel.config.js**: Configuration file for Babel, the JavaScript compiler.
- **package.json**: Defines Node.js dependencies and project metadata.
- **vue.config.js**: Configuration file for Vue.js customization.

## Setting Up the Project

### Backend Setup

1. **Clone the Repository**: Clone the Photographer Gallery repository from GitHub:
   ```bash
   git clone https://github.com/aathil-ali/Photographer-Gallery.git
   ```

2. **Navigate to the Backend Directory**: Change directory to the `backend` folder:
   ```bash
   cd backend
   ```

3. **Install Laravel Dependencies**: Use Composer to install the required dependencies for the Laravel application:
   ```bash
   composer install
   ```

4. **Configure the Environment**: Copy the `.env.example` file to `.env` and configure the environment settings such as database connection details:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**: Generate a unique application key for Laravel:
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**: Execute database migrations to create the necessary tables in the database:
   ```bash
   php artisan migrate
   ```

7. **Run Storage Link**: Create a symbolic link from the public storage directory to the `storage` directory:
   ```bash
   php artisan storage:link
   ```

### Frontend Setup

1. **Navigate to the Frontend Directory**: Change directory to the `frontend` folder:
   ```bash
   cd frontend
   ```

2. **Install Node.js Dependencies**: Use npm to install the required dependencies for the Vue.js application:
   ```bash
   npm install
   ```

3. **Configure Backend API URL**: Update the `.env` file to specify the URL of the backend API.

## Running the Project

- **Backend**: Start the Laravel development server:
  ```bash
  cd backend  
  php artisan serve
  ```

- **Frontend**: Run the Vue.js development server:
  ```bash
  cd frontend
  npm run serve
  ```

Access the backend API at `http://localhost:8000` and the frontend at `http://localhost:8080`.

This comprehensive setup guide ensures that the Photographer Gallery project can be seamlessly deployed and run on a local development environment.

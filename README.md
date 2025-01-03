# System Installation Guide

This guide will help you set up the frontend and backend of the system using Docker.

## Tech Stack

- **Frontend**: Vue.js version 3
- **Backend**: Laravel version 11
- **PHP**: Version 8.2
- **Docker**: For containerized environment

## Prerequisites

Before you begin, make sure you have the following installed:

- [Docker](https://www.docker.com/get-started)

## Steps to Set Up Using Docker

### 1. Install Docker

Follow the [official Docker installation guide](https://docs.docker.com/get-docker/) to install Docker on your system.

### 2. Build the Docker Containers

Once Docker is installed, navigate to the root directory of the project and run the following command to build the Docker containers:

```
    docker-compose up -d --build
```

### 3. Database Setup

1. Access the Backend Container:

```
    docker exec -it backend-svc bash
```
2. Run Database Migrations:

```
    php artisan migrate
```
3. Seed the Database:

```
    php artisan db:seed
```
*** If backend not start because no vendor follow this step ***
1. Access the Backend Container:
```
    docker exec -it backend-svc bash
```
2. Install Composer:
```
    composer install
```
## Testing

- For frontend testing, access it on port 8080 or go to [frontend test](http://localhost:8080).
- For backend testing, access it on port 3000. you can use Postman or similar tools with the link http://localhost:8000/api.
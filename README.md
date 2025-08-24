# CoverageX Task Manager

A simple To-Do task manager built with **Laravel 11**, **MySQL**, **Blade**, and **Docker**.

---

## Features

- Add new tasks (title + description)  
- View the latest 5 tasks  
- Mark tasks as completed  
- Simple Blade UI with responsive design  

---

## Tech Stack

- **Backend:** Laravel 11 (PHP 8.2 FPM)  
- **Frontend:** Blade + Tailwind CSS  
- **Database:** MySQL 8  
- **Webserver:** Nginx  
- **Containerization:** Docker & Docker Compose  

---

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed  
- [Git](https://git-scm.com/) installed  

---

## Setup Instructions

1. **Clone the repository**

'''bash
git clone https://github.com/MRinuka/coveragex-tasks.git
cd coveragex-tasks

2. **Copy Environment File**

'''bash
cp .env.example .env

3. **Start the containers**

'''bash
docker compose up -d

4. **Install dependencies inside container**

'''bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

5. **Access the app**

Enter URL http://localhost:8080/

6. **Stop the app**

'''bash
docker composer down

7. **To run the test framework**

'''bash
docker compose exec app php artisan test

# OctaHaus

# Installation
Clone the repository
    git@github.com:ozkancandan/OctaHaus.git

I created mysql and postgresql containers at the same time so that you can test them with both databases.
Check the .env file for use which DB (MySQL or PostgreSQL)
if you want to mysql please use following settings

    DB_CONNECTION=mysql
    DB_HOST=octahaus-mysql
    DB_PORT=3306
    DB_DATABASE=octahaus
    DB_USERNAME=root
    DB_PASSWORD=root

# Requirements
## Linux or MacOS with Docker installed

# How to install app
## run "make start" in terminal

# After install to all containers run the following codes
## docker exec -it octahaus-api bash
## php artisan migrate

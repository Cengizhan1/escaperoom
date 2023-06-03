# Escape Room API
This project provides an API for managing Escape Room reservations.
> The Escape Room API is an API used
> to manage Escape Room reservations.
> It automates the reservation process and simplifies
> the booking experience for Escape Room businesses.

## Requirements
```
- PHP 7.4 or higher
- Laravel 8.x
- MySQL database
```

## Installation
1. Clone the project:

```
git clone https://github.com/Cengizhan1/escaperoom.git
``` 
2. Navigate to the project directory:

```
cd escaperoom
``` 
3. Install the dependencies:

```
composer install
``` 
4. Create the .env file and set your database connection details:

```
cp .env.example .env
``` 
5. Update the following lines in the .env file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=escape_room
DB_USERNAME=root
DB_PASSWORD=
``` 
6. Generate the application key:

```
php artisan key:generate
``` 

7. Create and migrate the database:

```
php artisan migrate
``` 

8. Start the application:

```
php artisan serve
``` 
    The application will run at http://localhost:8000 by default.
    
    You are now ready to use the API.

## API Documentation
You can find the API documentation here. 
It provides detailed information on available routes and their usage.

https://api.postman.com/collections/16991416-faf754f7-59f8-4d8f-bbeb-3adf6ff5df24?access_key=PMAT-01H1ZBAVZEC5J2WY4FQWBCS9DV

## Contributers
Cengizhan Yavuz \
Email : cengizhany.cy@gmail.com
## License
This project is licensed under the MIT License. See the LICENSE file for more information.

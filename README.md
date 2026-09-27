✈️ magdyTravel

A Travel Management & Booking API built with Laravel 10, designed to provide a structured backend for managing travel services, destinations, trips, categories, rides, reviews, currencies, users, and travel bookings.

The project exposes a RESTful API that can be consumed by web or mobile frontends and includes authentication, user management, travel management, booking workflows, trip pricing, and media management.

---

🌍 Overview

magdyTravel is a backend system for a tourism/travel platform.

The API provides endpoints for managing:

- ✈️ Travel services
- 🗺️ Destinations
- 🏷️ Categories
- 🚐 Rides / transportation
- 🧳 Trips
- 📅 Travel bookings
- 💰 Currencies
- ⭐ Reviews
- 👤 Users
- 🖼️ Travel photos
- 💵 Dynamic trip pricing

The project is structured around Laravel's MVC architecture and uses Eloquent ORM for database interaction.

---

✨ Features

👤 Authentication & Users

The API provides authentication and user-management functionality.

Features include:

- User registration
- User login
- User management
- User profile updates
- User roles
- Authentication using Laravel Sanctum
- Protected authenticated-user endpoint

Example:

POST /api/register
POST /api/login
GET /api/user

Authenticated requests can use:

auth:sanctum

for API authentication.

---

🧳 Travel Management

Travel services can be managed through a dedicated REST API.

Available operations include:

GET     /api/travels
POST    /api/travels
GET     /api/travels/{id}
PUT     /api/travels/{id}
DELETE  /api/travels/{id}

Additional travel functionality includes:

- Retrieve all travels
- Filter travels by category
- Manage travel photos
- Add photos to a travel
- Delete travel photos

Example:

GET /api/travel/all
GET /api/travels/by-category/{categorySlug}
POST /api/travels/{id}/addPhotos
DELETE /api/travels/photos/{id}

---

🗺️ Destinations

The system provides CRUD operations for travel destinations.

GET     /api/destinations
POST    /api/destinations
GET     /api/destinations/{id}
PUT     /api/destinations/{id}
DELETE  /api/destinations/{id}

Additional endpoint:

GET /api/destination/all

---

🏷️ Categories

Travel services can be organized using categories.

Supported operations include:

GET     /api/categories
POST    /api/categories
GET     /api/categories/{id}
PUT     /api/categories/{id}
DELETE  /api/categories/{id}

Category images can also be updated through:

POST /api/category-photo-update

---

🚐 Rides & Transportation

The API includes a dedicated resource for transportation/rides.

GET     /api/rides
POST    /api/rides
GET     /api/rides/{id}
PUT     /api/rides/{id}
DELETE  /api/rides/{id}

This allows the travel platform to manage transportation services independently from travel packages.

---

📅 Travel Bookings

Users can book travel services through the booking API.

GET     /api/booking/travel
POST    /api/booking/travel
GET     /api/booking/travel/{id}
PUT     /api/booking/travel/{id}
DELETE  /api/booking/travel/{id}

This provides the backend foundation for managing customer travel reservations.

---

🧳 Trips

Trips are managed through a dedicated API resource.

GET     /api/trips
POST    /api/trips
GET     /api/trips/{id}
PUT     /api/trips/{id}
DELETE  /api/trips/{id}

The project also supports trip price management.

Change the current trip price:

POST /api/trips/price/change

Retrieve the latest trip price:

GET /api/trips/price/show

This makes it possible to maintain pricing changes without modifying the original trip data directly.

---

💱 Currency Management

The API provides CRUD operations for currencies.

GET     /api/currencies
POST    /api/currencies
GET     /api/currencies/{id}
PUT     /api/currencies/{id}
DELETE  /api/currencies/{id}

This allows travel services and pricing logic to work with multiple currencies.

---

⭐ Reviews

Customer reviews are handled through their own RESTful resource.

GET     /api/reviews
POST    /api/reviews
GET     /api/reviews/{id}
PUT     /api/reviews/{id}
DELETE  /api/reviews/{id}

Reviews can therefore be associated with the travel platform independently from the core travel data.

---

🔌 API Structure

The application follows RESTful API conventions using Laravel API resources.

Main API resources:

/api/users
/api/travels
/api/destinations
/api/rides
/api/categories
/api/reviews
/api/currencies
/api/trips
/api/booking/travel

Additional endpoints provide specialized operations such as:

/api/login
/api/register
/api/user

/api/travel/all
/api/travels/by-category/{categorySlug}

/api/destination/all

/api/category-photo-update

/api/trips/price/change
/api/trips/price/show

---

🔐 API Authentication

The application uses Laravel Sanctum for API authentication.

Protected requests can use:

Route::middleware(['auth:sanctum'])

Example authenticated endpoint:

GET /api/user

Authentication flow:

Register
   ↓
Login
   ↓
Authentication Token
   ↓
Authenticated API Requests

---

🛠️ Technology Stack

Technology| Usage
PHP 8.1+| Backend language
Laravel 10| Backend framework
MySQL| Database
Eloquent ORM| Database interaction
Laravel Sanctum| API authentication
Laravel Jetstream| Authentication & user management
Livewire 3| Reactive components
Laravel Tinker| Application debugging / interaction
Guzzle| HTTP client
Eloquent Sluggable| Automatic slug generation
Laravel Breeze| Authentication scaffolding / development
PHPUnit| Testing
Laravel Sail| Local development support
Vite / Laravel Mix| Frontend asset management

The package configuration in the repository confirms Laravel "^10.10", Sanctum "^3.3", Jetstream "^4.1", Livewire "^3.0", Guzzle "^7.2", and Eloquent Sluggable "^10.0".

---

🏗️ Project Architecture

The project follows Laravel's standard MVC architecture:

magdyTravel/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── api/
│   │   │   └── Auth/
│   │   │
│   │   └── Middleware/
│   │
│   ├── Models/
│   └── ...
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   ├── api.php
│   ├── web.php
│   └── ...
│
├── public/
├── storage/
├── tests/
│
├── composer.json
├── package.json
└── artisan

---

🔄 API Workflow

A typical travel booking workflow can be represented as:

Client
  │
  ▼
Authentication
  │
  ▼
Travel / Destination Discovery
  │
  ▼
Trip Selection
  │
  ▼
Booking
  │
  ▼
Booking Management

The backend separates the major resources into independent API controllers, making the application easier to maintain and extend.

---

⚙️ Installation

1. Clone the repository

git clone https://github.com/MoamenRamy/magdyTravel.git

cd magdyTravel

2. Install PHP dependencies

composer install

3. Create the environment file

cp .env.example .env

On Windows:

.env.example → .env

4. Generate the application key

php artisan key:generate

5. Configure the database

Update your ".env" file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Run migrations

php artisan migrate

If the project requires seeded data:

php artisan db:seed

Or:

php artisan migrate --seed

7. Install frontend dependencies

npm install

8. Start the development server

php artisan serve

The API will be available at:

http://127.0.0.1:8000

---

🧪 Testing

Run the Laravel test suite:

php artisan test

Or:

./vendor/bin/phpunit

---

📡 Example API Requests

Register

POST /api/register
Content-Type: application/json

Login

POST /api/login
Content-Type: application/json

Get Travels

GET /api/travels

Get Travels By Category

GET /api/travels/by-category/{categorySlug}

Get Destinations

GET /api/destinations

Get Trips

GET /api/trips

Create Booking

POST /api/booking/travel

Change Trip Price

POST /api/trips/price/change

Get Latest Trip Price

GET /api/trips/price/show

---

🧩 Backend Concepts Demonstrated

This project demonstrates practical experience with:

- RESTful API design
- Laravel API Resources
- MVC architecture
- Eloquent ORM
- CRUD operations
- Authentication
- Laravel Sanctum
- User management
- Role management
- Middleware
- Database migrations
- Database relationships
- Slug-based filtering
- File/photo management
- Booking workflows
- Dynamic pricing
- Currency management
- Reviews
- API route organization
- HTTP client integration with Guzzle

---

📈 Future Improvements

Potential extensions for the platform include:

- Online payment gateway integration
- Advanced search and filtering
- Availability management
- Booking status workflow
- Email notifications
- SMS notifications
- Advanced admin dashboard
- API documentation with OpenAPI / Swagger
- Automated feature tests
- Rate limiting and API versioning
- Caching for frequently requested travel data
- Production monitoring and logging

---

🔒 Security

Never commit sensitive credentials to the repository.

Keep the following values inside ".env":

APP_KEY=
DB_PASSWORD=
MAIL_PASSWORD=
API_KEYS=

The ".env" file should remain excluded from Git.

---

👨‍💻 Author

Moamen Ramy

Junior Backend Developer | PHP & Laravel

Focused on building scalable backend systems, REST APIs, database-driven applications, and business solutions.

Technical Focus

PHP
Laravel
MySQL
REST APIs
Sanctum
Eloquent ORM
Python
Django
Git
GitHub

Links

- GitHub: https://github.com/MoamenRamy
- LinkedIn: https://www.linkedin.com/in/moamen-ramy-492a8b212/

---

⭐ Project

If you find this project useful or interesting, consider giving it a ⭐ on GitHub.
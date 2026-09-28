✈️ magdyTravel — Travel Management & Booking API

A RESTful travel management and booking backend built with Laravel 10, designed to provide the backend infrastructure for a tourism platform.

The system manages travel services, destinations, categories, transportation, trips, bookings, reviews, currencies, users, photos, and dynamic trip pricing through a structured REST API.

The project follows Laravel's MVC architecture and uses Eloquent ORM, Laravel Sanctum, API Resources, middleware, database relationships, and role-based user management.

---

🚀 Features

🔐 Authentication & User Management

The API provides authentication and user-management functionality.

- User registration
- User login
- JWT-like token authentication using Laravel Sanctum
- Authenticated user profile
- User CRUD operations
- User profile updates
- User role management
- Admin role assignment
- Super Admin role assignment
- Default user role management
- Protected API endpoints
- Password management through Laravel authentication features
- Email verification support
- Two-factor authentication support through Jetstream

🧳 Travel Management

The platform provides a complete travel resource for managing tourism services.

- Create travel services
- View travel services
- Update travel services
- Delete travel services
- Retrieve all travel services
- Filter travels by category
- Manage travel photos
- Add photos to travels
- Delete travel photos
- Slug-based travel categorization

Example:

GET    /api/travels
POST   /api/travels
GET    /api/travels/{id}
PUT    /api/travels/{id}
DELETE /api/travels/{id}

🗺️ Destinations

Destinations are managed as an independent resource.

- Create destinations
- View destinations
- Update destinations
- Delete destinations
- Retrieve all destinations

🏷️ Categories

Travel services can be organized using categories.

- Create categories
- View categories
- Update categories
- Delete categories
- Category photo management
- Filter travels using category slugs

🚐 Transportation & Rides

The system includes a dedicated transportation resource.

- Create rides
- View rides
- Update rides
- Delete rides
- Manage transportation independently from travel services

🧳 Trips

Trips are managed separately from general travel services.

- Create trips
- View trips
- Update trips
- Delete trips
- Manage trip pricing
- Retrieve the latest trip price
- Track historical price changes

📅 Travel Bookings

Users can create and manage travel bookings.

- Create travel bookings
- View bookings
- View individual booking details
- Update bookings
- Delete bookings
- Associate users with travel services

💱 Currency Management

The API includes currency management functionality.

- Create currencies
- View currencies
- Update currencies
- Delete currencies
- Currency-related application logic

⭐ Reviews

Customers can interact with the platform through reviews.

- Create reviews
- View reviews
- Update reviews
- Delete reviews
- Associate reviews with travel services

📸 Travel Photos

Travel services can have multiple photos.

The API supports:

- Adding photos to travels
- Removing travel photos
- Storing photo references
- Managing travel media independently

👥 Role Management

The application includes multiple user roles.

Supported operations include:

- Promote user to Admin
- Promote user to Super Admin
- Reset user to Default User

Role-management endpoints are separated from the standard user CRUD operations.

---

🔑 API Routes

Authentication

Method| Endpoint| Description
POST| "/api/register"| Register a new user
POST| "/api/login"| Login
GET| "/api/user"| Get authenticated user

---

Users

Method| Endpoint| Description
GET| "/api/users"| Get all users
POST| "/api/users"| Create user
GET| "/api/users/{id}"| Get user
PUT/PATCH| "/api/users/{id}"| Update user
DELETE| "/api/users/{id}"| Delete user
PATCH| "/api/users/adminSet/{id}"| Assign Admin role
PATCH| "/api/users/superAdminSet/{id}"| Assign Super Admin role
PATCH| "/api/users/defaultUser/{id}"| Reset user role
POST| "/api/users/update-profile"| Update authenticated profile

---

Travels

Method| Endpoint| Description
GET| "/api/travels"| Get travels
POST| "/api/travels"| Create travel
GET| "/api/travels/{id}"| Get travel
PUT/PATCH| "/api/travels/{id}"| Update travel
DELETE| "/api/travels/{id}"| Delete travel
GET| "/api/travel/all"| Get all travels
GET| "/api/travels/by-category/{categorySlug}"| Get travels by category
POST| "/api/travels/{id}/addPhotos"| Add travel photos
DELETE| "/api/travels/photos/{id}"| Delete travel photo

---

Destinations

Method| Endpoint| Description
GET| "/api/destinations"| Get destinations
POST| "/api/destinations"| Create destination
GET| "/api/destinations/{id}"| Get destination
PUT/PATCH| "/api/destinations/{id}"| Update destination
DELETE| "/api/destinations/{id}"| Delete destination
GET| "/api/destination/all"| Get all destinations

---

Categories

Method| Endpoint| Description
GET| "/api/categories"| Get categories
POST| "/api/categories"| Create category
GET| "/api/categories/{id}"| Get category
PUT/PATCH| "/api/categories/{id}"| Update category
DELETE| "/api/categories/{id}"| Delete category
POST| "/api/category-photo-update"| Update category photo

---

Rides

Method| Endpoint| Description
GET| "/api/rides"| Get rides
POST| "/api/rides"| Create ride
GET| "/api/rides/{id}"| Get ride
PUT/PATCH| "/api/rides/{id}"| Update ride
DELETE| "/api/rides/{id}"| Delete ride

---

Reviews

Method| Endpoint| Description
GET| "/api/reviews"| Get reviews
POST| "/api/reviews"| Create review
GET| "/api/reviews/{id}"| Get review
PUT/PATCH| "/api/reviews/{id}"| Update review
DELETE| "/api/reviews/{id}"| Delete review

---

Currencies

Method| Endpoint| Description
GET| "/api/currencies"| Get currencies
POST| "/api/currencies"| Create currency
GET| "/api/currencies/{id}"| Get currency
PUT/PATCH| "/api/currencies/{id}"| Update currency
DELETE| "/api/currencies/{id}"| Delete currency

---

Trips

Method| Endpoint| Description
GET| "/api/trips"| Get trips
POST| "/api/trips"| Create trip
GET| "/api/trips/{id}"| Get trip
PUT/PATCH| "/api/trips/{id}"| Update trip
DELETE| "/api/trips/{id}"| Delete trip
POST| "/api/trips/price/change"| Change trip price
GET| "/api/trips/price/show"| Get latest trip price

---

Travel Bookings

Method| Endpoint| Description
GET| "/api/booking/travel"| Get travel bookings
POST| "/api/booking/travel"| Create travel booking
GET| "/api/booking/travel/{id}"| Get booking
PUT/PATCH| "/api/booking/travel/{id}"| Update booking
DELETE| "/api/booking/travel/{id}"| Delete booking

---

🔒 Authentication Flow

The API uses Laravel Sanctum for API authentication.

A typical authentication flow:

Register
   ↓
Login
   ↓
Sanctum Token
   ↓
Authenticated API Request
   ↓
Protected Resource

Authenticated requests use:

Authorization: Bearer YOUR_TOKEN

The project also contains Laravel Jetstream/Fortify authentication functionality for features such as:

- Email verification
- Password reset
- Password updates
- Two-factor authentication
- Profile management
- API token management

---

🏗️ Project Architecture

The project follows Laravel's MVC architecture with dedicated API controllers, models, API resources, middleware, requests, and database layers.

magdyTravel/
│
├── app/
│   ├── Actions/
│   ├── Console/
│   ├── Events/
│   ├── Exceptions/
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   └── api/
│   │   │
│   │   ├── Middleware/
│   │   ├── Requests/
│   │   └── Resources/
│   │
│   ├── Listeners/
│   ├── Mail/
│   ├── Models/
│   ├── Providers/
│   ├── Traits/
│   └── View/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── markdown/
│   └── views/
│
├── routes/
│   ├── api.php
│   ├── auth.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── public/
├── storage/
├── composer.json
├── package.json
└── artisan

---

🧩 Application Layers

Controllers

API controllers handle HTTP requests and coordinate application logic.

Main API controllers include:

TravelController
DestinationController
CategoryController
RideController
ReviewController
CurrencyController
TripController
UserController
UserTravelController
PhotoController
ChangeTripPriceController

Authentication is handled through:

ApiAuthController

Models

The application contains models representing the main business entities:

User
Travel
Destination
Category
Ride
Review
Currency
Trip
UserTravel
Photo
ChangeTripPrice

API Resources

Laravel API Resources are used to structure API responses.

Category
ChangeTripPrice
Currency
Destination
Photo
Review
Ride
Travel
Trip
User
UserTravel

Middleware

The application includes custom middleware for:

- Authentication
- Admin authorization
- Super Admin authorization
- API request validation
- CORS handling
- Email verification
- Maintenance mode handling

---

🗄️ Database Design

The application uses MySQL with Laravel migrations and Eloquent ORM.

Main Entities

User
│
├── Travel Bookings
│
└── Roles

Travel
│
├── Category
├── Destination
├── Photos
├── Reviews
└── Bookings

Trip
│
└── Trip Price History

Ride

Category

Destination

Currency

Review

Photo

UserTravel

Database Components

The project includes migrations for:

- Users
- Password reset tokens
- Personal access tokens
- Destinations
- Categories
- Travels
- Rides
- Photos
- Reviews
- User travel bookings
- Trip price changes
- Trips
- Sessions
- Laravel authentication features

Factories and seeders are also provided for the main application entities.

---

🔄 Travel Booking Workflow

A typical user flow can be represented as:

User
  │
  ▼
Register / Login
  │
  ▼
Browse Travel Services
  │
  ▼
Explore Categories / Destinations
  │
  ▼
Select Travel
  │
  ▼
Create Booking
  │
  ▼
Booking Management

The backend separates each major business resource into its own controller and model, allowing the system to be extended without coupling unrelated functionality.

---

💰 Dynamic Trip Pricing

The application includes a dedicated system for changing trip prices without directly modifying the original trip record.

Trip
  │
  ▼
Change Trip Price
  │
  ▼
Store New Price
  │
  ▼
Price History
  │
  ▼
Retrieve Latest Price

Endpoints:

POST /api/trips/price/change
GET  /api/trips/price/show

This allows the application to maintain pricing changes separately from the core trip entity.

---

🖼️ Photo Management

Travel services support multiple photos.

Example workflow:

Create Travel
     ↓
Upload Photos
     ↓
Associate Photos With Travel
     ↓
Display Travel Gallery
     ↓
Delete Photo When Required

Endpoints:

POST   /api/travels/{id}/addPhotos
DELETE /api/travels/photos/{id}

---

🏷️ Category-Based Travel Filtering

Travels can be filtered using category slugs.

Example:

GET /api/travels/by-category/{categorySlug}

Example flow:

Category
   ↓
Category Slug
   ↓
Travel Query
   ↓
Filtered Travel Results

This allows frontend applications to build category-based travel browsing pages.

---

🛠️ Tech Stack

Technology| Purpose
PHP 8.1+| Backend programming language
Laravel 10| Backend framework
MySQL| Relational database
Eloquent ORM| Database interaction
Laravel Sanctum| API authentication
Laravel Jetstream| Authentication and user management
Laravel Fortify| Authentication backend
Livewire 3| Reactive Laravel components
Laravel Tinker| Application debugging
Guzzle| HTTP client
Eloquent Sluggable| Automatic slug generation
Laravel Breeze| Authentication scaffolding
Laravel Sail| Local development environment
PHPUnit| Automated testing
Vite / Laravel frontend tooling| Frontend asset management
Git| Version control
GitHub| Source code management

The package configuration uses Laravel "^10.10", Sanctum "^3.3", Jetstream "^4.1", Livewire "^3.0", Guzzle "^7.2", and Eloquent Sluggable "^10.0".

---

📦 Installation

1. Clone the Repository

git clone https://github.com/MoamenRamy/magdyTravel.git

cd magdyTravel

2. Install PHP Dependencies

composer install

3. Create Environment File

cp .env.example .env

On Windows, copy:

.env.example → .env

4. Generate Application Key

php artisan key:generate

5. Configure Database

Update your ".env" file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

6. Run Migrations

php artisan migrate

To run the database seeders:

php artisan db:seed

Or:

php artisan migrate --seed

7. Install Frontend Dependencies

npm install

8. Start the Development Server

php artisan serve

The application will be available at:

http://127.0.0.1:8000

---

🧪 Testing

The project includes Laravel feature and unit tests.

Run the test suite with:

php artisan test

Or:

./vendor/bin/phpunit

The repository includes tests covering authentication and Laravel application functionality such as:

- Registration
- Authentication
- Email verification
- Password reset
- Password updates
- Profile information
- API token management
- Account deletion
- Two-factor authentication
- Browser sessions

---

📡 Example API Requests

Register

POST /api/register
Content-Type: application/json

Login

POST /api/login
Content-Type: application/json

Get Authenticated User

GET /api/user
Authorization: Bearer YOUR_TOKEN

Get Travels

GET /api/travels

Get Travels by Category

GET /api/travels/by-category/{categorySlug}

Get Destinations

GET /api/destinations

Get Trips

GET /api/trips

Create Travel Booking

POST /api/booking/travel
Authorization: Bearer YOUR_TOKEN

Change Trip Price

POST /api/trips/price/change
Authorization: Bearer YOUR_TOKEN

Get Latest Trip Price

GET /api/trips/price/show

---

🧠 Backend Concepts Demonstrated

This project demonstrates practical experience with:

- RESTful API development
- Laravel MVC architecture
- API Resources
- Eloquent ORM
- CRUD operations
- Laravel Sanctum
- Authentication
- Authorization
- Role-based access control
- Middleware
- Form requests
- Database migrations
- Database relationships
- Model factories
- Database seeders
- Slug-based filtering
- File and photo management
- Travel booking workflows
- Dynamic pricing
- Currency management
- Reviews
- User management
- Custom middleware
- Events and listeners
- Email functionality
- Password reset
- Email verification
- Two-factor authentication
- HTTP client integration
- Automated testing
- Git and GitHub

---

🔐 Security

Sensitive credentials should never be committed to GitHub.

Keep environment-specific values inside ".env".

Example:

APP_KEY=
DB_PASSWORD=
MAIL_PASSWORD=
API_KEYS=

The ".env" file should remain excluded from version control.

If credentials are ever accidentally committed to a public repository, they should be revoked and regenerated immediately.

---

📈 Possible Improvements

Future improvements could include:

- Online payment gateway integration
- Advanced travel search
- Advanced filtering and sorting
- Availability management
- Booking status workflow
- Email booking notifications
- SMS notifications
- Advanced admin dashboard
- OpenAPI / Swagger documentation
- More API feature tests
- API versioning
- Rate limiting
- Response caching
- Production monitoring
- Logging and analytics
- Reservation availability validation

---

📌 Project Purpose

"magdyTravel" was developed as a real-world tourism backend focused on building a structured and maintainable REST API.

The project demonstrates how to design a Laravel backend capable of handling:

Users
   ↓
Authentication
   ↓
Travel Services
   ↓
Destinations
   ↓
Categories
   ↓
Trips
   ↓
Transportation
   ↓
Bookings
   ↓
Reviews
   ↓
Pricing

The project focuses on practical backend development rather than a simple CRUD demonstration, including authentication, authorization, relationships, API resources, booking logic, media management, and dynamic pricing.

---

👨‍💻 Author

Moamen Ramy

Junior Backend Developer | PHP & Laravel

Focused on building backend systems, REST APIs, database-driven applications, and real-world business solutions.

Technical Focus

- PHP
- Laravel
- MySQL
- REST APIs
- Laravel Sanctum
- Eloquent ORM
- API Resources
- Authentication & Authorization
- Git
- GitHub

Links

- GitHub: https://github.com/MoamenRamy
- LinkedIn: https://www.linkedin.com/in/moamen-ramy-492a8b212/

---

⭐ Support

If you find this project useful or interesting, consider giving the repository a star ⭐

""GitHub" (https://img.shields.io/badge/GitHub-MoamenRamy-black?style=flat-square&logo=github)" (https://github.com/MoamenRamy)

""LinkedIn" (https://img.shields.io/badge/LinkedIn-Moamen%20Ramy-blue?style=flat-square&logo=linkedin)" (https://www.linkedin.com/in/moamen-ramy-492a8b212/)

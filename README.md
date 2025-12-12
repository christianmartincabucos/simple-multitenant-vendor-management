# Simple Multi Tenant Vendor Management System

## Setup

1. Clone the repository:
   ```
   git clone https://github.com/christianmartincabucos/simple-multitenant-vendor-management.git
   cd simple-multitenant-vendor-management
   ```

2. Copy `.env.example` to `.env` and set your environment variables.

3. Build and start containers:
   ```
   docker-compose up --build
   ```

4. Install dependencies and migrate database:
   ```
   docker-compose exec app composer install
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan key:generate
   ```

## Usage

- Access the app at [http://localhost:8000](http://localhost:8000)
- Frontend is available at [http://localhost:5173](http://localhost:5173)
- API endpoints are available under `/api`

## Testing

- Run backend tests:
  ```
  docker-compose exec app php artisan test
  ```

## Sanctum

- Sanctum is used for API authentication. See Laravel docs for frontend integration.

## Database

- MySQL is used. Default credentials are in `.env.example`.
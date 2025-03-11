# Bus Tracker

Bus Tracker is a Laravel-based application designed to monitor and track bus movements in real-time. The system allows users to view live bus locations, estimated arrival times, and route information.

## Features
- Real-time bus tracking
- User authentication and roles (Admin, Operator, Passenger)
- Route and schedule management
- GPS integration for live tracking
- Notifications and alerts
- Reporting and analytics

## Requirements
- PHP 8.2+
- Laravel 11+
- MySQL
- Composer
- Node.js & NPM (for frontend assets)

## Installation
1. **Clone the repository**
   ```sh
   git clone https://github.com/nsengiyumva-wilberforce/bus_tracker.git
   cd bus_tracker
   ```

2. **Install dependencies**
   ```sh
   composer install
   npm install
   ```

3. **Set up environment file**
   ```sh
   cp .env.example .env
   ```
   Update `.env` with your database credentials and other configurations.

4. **Generate application key**
   ```sh
   php artisan key:generate
   ```

5. **Run migrations**
   ```sh
   php artisan migrate
   ```

6. **Start the development server**
   ```sh
   php artisan serve
   ```

## Usage
- Admins can manage users, routes, and buses.
- Operators can update bus locations.
- Passengers can view live bus tracking.

## API Endpoints
| Method | Endpoint          | Description              |
|--------|------------------|--------------------------|
| GET    | /api/buses       | Get all buses            |
| GET    | /api/buses/{id}  | Get a specific bus       |
| POST   | /api/buses       | Create a new bus         |
| PUT    | /api/buses/{id}  | Update bus details       |
| DELETE | /api/buses/{id}  | Delete a bus             |

## Deployment
1. Set up a production server (e.g., DigitalOcean, AWS, or shared hosting).
2. Configure the environment variables.
3. Run `composer install --no-dev --optimize-autoloader`.
4. Run `php artisan migrate --force`.
5. Set up a queue worker (if needed):
   ```sh
   php artisan queue:work
   ```
6. Configure a cron job for scheduled tasks:
   ```sh
   * * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
   ```

## License
This project is open-source and available under the [MIT License](LICENSE).

## Contributing
Contributions are welcome! Please open an issue or submit a pull request.

## Contact
For support, contact [your email] or visit [your website].


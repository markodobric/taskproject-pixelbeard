## Setting it up

1. Clone the repository - `git clone git@github.com:markodobric/taskproject-pixelbeard.git`
2. Run `composer install`
3. Copy `.env.example` to `.env` and run `php artisan key:generate`
4. Create a MySQL database `pixelbeard`. Add the database name to your `DB_DATABASE` env variable
5. Run migrations: `php artisan migrate --seed`. `--seed` will create an initial user
6. Run server with `php artisan serve`
7. To run test, first create `pixelbeard_test` database and run `php artisan migrate`

# API Docs

To generate API docs run the command: `php artisan scribe:generate` and visit `http://localhost:8000/docs#endpoints`

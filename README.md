# Setting up project:

1. Create `.env` based on `.env.example` and set proper config for MySQL connection
2. Install all packages by: `composer install`
3. Create database by: `php bin/console doctrine:database:create`
4. Run migrate `php bin/console doctrine:migrations:migrate` to get all tables.
4. Run fixtures `php bin/console doctrine:fixtures:load` to get properties.
5. start server: `symfony server:start`. Copy generated web server url and add it to `recruitment-fe` .env 

Project built and tested on PHP: 7.3.29

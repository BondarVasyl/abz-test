# Laravel api template

## Run Locally

Clone the project

```bash
  git clone git@github.com:BondarVasyl/abz-test.git
```

Go to the project directory

```bash
  cd project
```

Copy env.example and set it up :
```bash
  cp .env.example .env
```
    DB_DATABASE,

    DB_USERNAME,
    
    DB_PASSWORD,
    
    TINIFY_KEY,
    
    L5_SWAGGER_CONST_HOST if it needs

Install dependencies

```bash
  composer install
```

Install npm packages and build project

```bash
  npm install && npm run dev
```

Generate keys

```bash
  php artisan key:generate
```

Generate storage symlink

```bash
  php artisan storage:link
```

Run migrations and seeders

```bash
  php artisan migrate --seed
```

Run server

```bash
  php artisan serve
```

And create default theme

```bash
  php artisan theme:create default
```

To see api documentation visit: ${APP_URL}/api/documentation page

To see result of api work visit home page

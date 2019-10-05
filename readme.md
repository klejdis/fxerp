## FxERP 

This is a boilerplate project build to manage products and clients with Laravel.

## How to Install

### 1. Clone the project
```bash
git clone https://github.com/klejdis/fxerp.git
```

### 2. Install dependecies
```bash
composer install
```
After dependencies are installed copy .env.example file to .env and compile the values for
 DB_DATABASE,DB_USERNAME,DB_PASSWORD.

### 3.Generate App key
```bash
php artisan key:generate
```

### 4.Adjust storage permissions
Go inside project and from terminal execute the following command.
```bash
sudo chmod -R  777 storage/
```

### 5. Run Migrations and Seeds
```bash
php artisan migrate
```

and 
```bash
php artisan db:seed
```

Now the application is installed just navigate to /admin/login and use 
email:admin@admin.com password: 12345678 
to login as admin and 
email:user@user.com password: 12345678

# user-info-package

## Instalation
```sh
composer require fahimadnan2100/info-package:dev-main
```

## Vendor Publish
```sh
php artisan vendor:publish --provider="Fahim\InfoPackage\InfoServiceProvider"
```

## Database
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```
Migrate the database \n
Run the project \n
Go to this route http://127.0.0.1:8000/info-add
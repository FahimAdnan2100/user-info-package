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
Create your database
example : 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=info_package
DB_USERNAME=root
DB_PASSWORD=

Now go to this route http://127.0.0.1:8000/info-add
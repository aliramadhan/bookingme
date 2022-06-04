## Quick start
Daftar Email/Password
```
Admin
email : admin@user.com
password : password

Approver : approver@user.com
password : password
```

Database : Mysql
PHP : 8.1.5
Framework : Laravel 9.16.0

Panduan
```
1. Clone dan jalankan composer install di direktori projek bookingme
2. copy env.example dan rename menjadi .env
3. buat database cocokkan nama database sesuai .env DB_DATABASE
4. jalan kan perintah php artisan key:generate dan php artisan migrate --seed
5. login menggunakan email dan password yang sudah diberikan.

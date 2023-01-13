# Order to Cart E-Commerce

REST API dengan fitur add product to cart hingga place order

## Installation

Clone repository

```bash
  git clone https://github.com/0-agx/laravel-order-to-cart-with-jwt.git
```

Masuk ke directory project

```bash
cd laravel-order-to-cart-with-jwt
```

Lakukan composer install

```bash
composer install
```

Publish configursi untuk plugin JWT

```bash
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
```

Generate .env file

```bash
cp .env.example .env
php artisan key:generate
```

Generate JWT Secret Key

```bash
php artisan jwt:secret
```

Setup database credentials di `.env` (sesuaikan dengan konfigurasi anda)

`DB_DATABASE=ecommerce`

`DB_USERNAME=tes`

`DB_PASSWORD=tes`

Tambahkan line berikut di `.env` file bagian paling bawah

`JWT_SHOW_BLACKLIST_EXCEPTION=true`

Jalankan migrasi dan seeding database

```bash
php artisan migrate:fresh --seed
```

Run project

```bash
php artisan serve
```

## Documentation

Daftar service yang tersedia bisa dilihat pada link berikut:

[Postman Colection](https://documenter.getpostman.com/view/4125190/2s8ZDSbkB8)

## Work Flow

-   Customer melakukan login dengan service `Login`
-   Tambahkan barang ke dalam keranjang menggunakan service `Add Item To Cart`
-   Untuk mengetahui list produk (item) yang tersedia, silahkan menggunakan service `Get All Item`
-   Checkout keranjang belanja menggunkan service `Checkout Order`
-   Untuk mengetahui list layanan ekspedisi yang didukung, silahkan menggunakan service `Get All Expedition`

Terdapat beberapa service pendukung, semua dokumentasi terlampir di link Postman Collection pada section `Documentation` di atas

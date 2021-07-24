
## Example E-commerce cart (with back office)

Laravel 8 project, include following functions:
- Cart - View Products, Add to cart, View cart, Checkout
- Back Office - Add products, Manage products, View sales
	- Roles 
		- Admin/ Operation Manager -  Add products, Manage products
		- Sales Manager - View sales

Packages use:
- [Yajra Laravel Datatables](https://github.com/yajra/laravel-datatables "yajra / laravel-datatables")
- [Spatie Laravel Permission](https://github.com/spatie/laravel-permission "spatie / laravel-permission")
- [Intervention Image](http://image.intervention.io/ "Intervention Image")


## Demo

- Check out live demo of cart at here :  https://cart.mybugslist.com/ . Use `user@abc.com` and password `123456` to login cart.
- Check out live demo of back office at here :  https://cart.mybugslist.com/admin
    - Use `admin@abc.com` and password `123456` to login back office as Admin.
    - Use `operation@abc.com` and password `123456` to login back office as Operation Manager. 
    - Use `sales@abc.com` and password `123456` to login back office as Sales Manager. 


## How to use

Just clone this project into your desired project folder

`git clone git@github.com:udaraz/laravel_cart.git`

and follow the instructions below to set it up for local or production

### Local setup

- Install the dependencies

  `composer install`

- Setup .env file

      cp .env.example .env
      #adjust database settings to use mysql
      #save .env
      #generate APP_KEY
      php artisan key:generate

- Run migrations + seeding
  
  `php artisan migrate`
  
  `php artisan db:seed`

- Link Storage
  
  `php artisan storage:link`
  
- Run Project

  `php artisan serve`

Now access the application at http://localhost:8000.
Use `admin@abc.com` and password `123456` to login (Use demo credentials to access other users)

Thank you..!

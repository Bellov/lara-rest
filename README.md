## REST API - CRUD

Setup:


**1. Clone the repository**

 ```bash
git clone https://github.com/Bellov/lara-rest.git
```


**2. Configure MYSQL database**

* Create a database named rest-articles.

**3.  Run the application**

#### Mac Os, Ubuntu and windows users continue here:

* Open the console and cd your project root directory

```bash
composer install
```

```bash
php artisan key:generate
```

* Then open `.env` and change username and password  as per mysql  installation.


```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= rest-articles
DB_USERNAME= Your database username
DB_PASSWORD= Your database password
```

```bash
1. php artisan migrate
2. php artisan db:seed --class=ArticlesTableSeeder
3. php artisan db:seed --class=UserTableSeeder
```

```bash
php artisan serve
```

### You can now access the project at localhost:8000




* API calls routes

 ```bash
1. GET: http://localhost:8000/rest/article
2. UPDATE: http://localhost:8000/rest/article/1
3. SHOW: http://localhost:8000/rest/article/3
4. DELETE: http://localhost:8000/rest/article/3
5. CREATE: http://localhost:8000/rest/article

For filter records the route is: 
http://localhost:8000/rest/filter?title=test

For paginate records the route is: 
http://localhost:8000/rest/articles?paginate=1

```








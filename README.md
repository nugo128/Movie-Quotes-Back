---

Movie Quotes is an App where can register or join by Google. in the app, you can see hundreds of movie quotes. you can add, edit, like and comment to movie quotes

#

### Table of Contents

-   [Prerequisites](#prerequisites)
-   [Tech Stack](#tech-stack)
-   [Getting Started](#getting-started)
-   [Migrations](#migration)
-   [Development](#development)
-   [Resources](#resources)

#

### Prerequisites

-   *PHP@8.1 and up*
-   _MYSQL@8 and up_
-   *composer@2.4 and up*
-   _npm@7 and up_

#

### Tech Stack

-   [Laravel@9.x](https://laravel.com/docs/9.x) - back-end framework
-   [Laravel-Sanctum](https://laravel.com/docs/10.x/sanctum#spa-authentication) - Spa authentication
-   [Pusher](https://pusher.com) - Real time notification package

#

### Getting Started

1\. First, you need to clone >Movie Quotes Upgraded repository from github:

```sh
git clone https://github.com/RedberryInternship/nugzar-rostiashvili-movie-quotes-back.git
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

3\. after that, we need to install JS dependencies:

```sh
npm install
```

4\. We need to link our storage folder to public folder:

```sh
php artisan storage:link
```

5\. Now we need to set our env file.

```sh
cp .env.example .env
```

6\. Next we need to generate Laravel key:

```sh
php artisan key:generate
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

#

**Pusher:**

> ROADCAST_DRIVER=pusher

> CACHE_DRIVER=file

> FILESYSTEM_DISK=public

> QUEUE_CONNECTION=sync

> SESSION_DRIVER=file

> SESSION_LIFETIME=120

> PUSHER_APP_ID=**\***

> PUSHER_APP_KEY=**\***

> PUSHER_APP_SECRET=**\***

> PUSHER_PORT=443

> PUSHER_SCHEME=https

> PUSHER_APP_CLUSTER=**\***

#

**App urls:**

> VITE_API_BASE_URL=**\***

> BASE_URL=**\***

> FRONT_TOP_LEVEL_DOMAIN=**\***

> FRONT_TOP_LEVEL_DOMAIN=**\***

#

**Email:**

> MAIL_DRIVER=smtp

> MAIL_HOST=smtp.gmail.com

> MAIL_PORT=465

> MAIL_USERNAME=**\***

> MAIL_PASSWORD=**\***

> MAIL_ENCRYPTION=**\***

> MAIL_FROM_ADDRESS=**\***

> MAIL_FROM_NAME="${APP_NAME}"

##### Now, you should be good to go!

#

### Migration

after completing getting started section, it is time to migrate database:

```sh
php artisan migrate
```

Once migration is complete we should seed database with fake data and categories:

```sh
php artisan db:seed
```

```
php artisan db:seed --class=CategorySeeder
```

#

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

#

### Resources

1\. Database structure in DrawSQL:

```sh
https://drawsql.app/teams/nugos-team/diagrams/movie-quotes-upgraded/embed
```

![alt text](https://i.ibb.co/7Yywk8w/draw-SQL-movie-quotes-upgraded-export-2023-07-17.png)

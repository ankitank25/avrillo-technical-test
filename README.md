<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About

This application is built using laravel 10.x. This is a technical test provided by J&T Recruitment for Avrillo LLP. 

This is to fetch west quotes from https://kanye.rest/

### Deployment / Setup

To setup this application, clone repository from:
https://github.com/ankitank25/avrillo-technical-test.git

then go to application root directory and run below commands OR follow steps:

- composer install
- php artisan key:generate
- copy .env.example file and rename to .env
- change configuration values for KANYE_API_URL and KANYE_API_TOKEN if needed
- To run test: php artisan test
- To run the application: php artisan serve

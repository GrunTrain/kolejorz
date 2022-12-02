# Installation

## 1. Clone repository
`git clone https://github.com/grinmilksoftware/kolejorz`

## 2. Move into directory you've created
`cd kolejorz`

## 3. Install dependencies
`docker run --rm -v $(pwd):/app composer install`
### You can change the ownership of directory to non root user
`sudo chown -R $USER:$USER kolejorz`

## 4. Create .env file based on .env.example
`cp .env.example .env`

## 5. Run containers
`./vendor/bin/sail up`

## 6. Generate key
`./vendor/bin/sail artisan key:generate`

## 7. To add Vue.js
`npm install'
<br>
`npm i -D @vue-leaflet/vue-leaflet`

#!/bin/sh

composer install
tr -d '\r' <.env.example >env.temp && mv env.temp .env.example
cp .env.example .env
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
sail up -d
sail artisan key:generate
sail npm install
sail artisan migrate

#!/bin/bash

composer install
tr -d '\r' <.env.example >env.temp && mv env.temp .env.example
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm install
./vendor/bin/sail artisan migrate

start:
	rm -rf ./var/cache/*
	composer install
	yarn
	make -j2 encore fpm

encore:
	./node_modules/.bin/encore dev --watch

fpm:
	@php-fpm

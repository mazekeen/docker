# Makefile for Docker Nginx PHP Composer MySQL

include .env

start:
	@docker-compose up -d

stop:
	@docker-compose down	

list:
	@docker-compose ps

github:
	@git add .
	@git commit -m "new changes"
	@git push origin master

# Makefile for Docker Nginx PHP Composer MySQL

include .env

start:
	@docker-compose up -d

stop:
	@docker-compose down	

list:
	@docker-compose ps

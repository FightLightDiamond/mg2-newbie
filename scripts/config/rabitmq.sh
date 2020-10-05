#!/bin/bash

# Install Latest RabbitMQ Server on Ubuntu 20.04

## install Erlang/OTP
wget -O- https://packages.erlang-solutions.com/ubuntu/erlang_solutions.asc | sudo apt-key add -
echo "deb https://packages.erlang-solutions.com/ubuntu focal contrib" | sudo tee /etc/apt/sources.list.d/rabbitmq.list
sudo apt update -y
sudo apt install erlang -y

## Add RabbitMQ Repository to Ubuntu
### Import RabbitMQ:
sudo apt update && sudo apt install wget -y
sudo apt install apt-transport-https -y
wget -O- https://dl.bintray.com/rabbitmq/Keys/rabbitmq-release-signing-key.asc | sudo apt-key add -
wget -O- https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | sudo apt-key add -
### Now add RabbitMQ Repository
echo "deb https://dl.bintray.com/rabbitmq-erlang/debian focal erlang-22.x" | sudo tee /etc/apt/sources.list.d/rabbitmq.list

## Install RabbitMQ Server
sudo apt update -y
sudo apt install rabbitmq-server -y
systemctl is-enabled rabbitmq-server.service
sudo systemctl enable rabbitmq-server

## Enable the RabbitMQ Management Dashboard
sudo rabbitmq-plugins enable rabbitmq_management
ss -tunelp | grep 15672

## Set user
echo "Create user. Example: "
echo "sudo rabbitmqctl add_user admin StrongPassword"
echo "rabbitmqctl set_user_tags admin administrator"
echo "Thank for using"

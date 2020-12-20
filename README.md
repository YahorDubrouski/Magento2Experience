# Magento2Experience

## About the project
In this project I public my Magento 2 modules to practice and for the portfolio

## Installation
### For Ubuntu
* Clone this repository using the ``git clone`` command
* Install Docker - https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository
* Install Docker Compose - https://docs.docker.com/compose/install/#install-compose-on-linux-systems
* Set up user permissions for Docker - https://docs.docker.com/engine/install/linux-postinstall/
* Install Dockergento - https://github.com/ModestCoders/magento2-dockergento/#installation
* Open the project root directory in the terminal
* Build and start docker containers using the command - ``dockergento start``
* Add the host line - ``127.0.0.1 magento2experience.loc`` to the hosts file - ``/etc/hosts``
* Create an account in the Magento Marketplace - https://account.magento.com/
* Install composer packages using the command - ``dockergento composer install`` and fill in the public and private keys from your Magento Marketplace account if need
* Install Magento using the command - 
```
dockergento magento setup:install \
--base-url=http://magento2experience.loc/ \
--db-host=db \
--db-name=magento2experience \
--db-user=admin \
--db-password=password \
--language=en_US \
--currency=USD \
--timezone=America/Chicago \
--use-rewrites=1 \
--search-engine=elasticsearch6 \
--elasticsearch-host=elasticsearch \
--elasticsearch-port=9200
```
* Visit the ``http://magento2experience.loc/`` host to make sure the installation process completed successfully

## Workflow
### Database 
* Run the phpmyadmin using the command - ```docker-compose up -d phpmyadmin```
* Visit the ``http://magento2experience.loc:6080/`` host to make sure the phpmyadmin installed successfully

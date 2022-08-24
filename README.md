1) docker-compose -f ./docker/docker-compose.yml build - Билд проекта в корневой директории
2) docker-compose -f ./docker/docker-compose.yml up Запустить докер контейнер с nginx на порту 8080 (путь http://127.0.0.1:8080/form/new)
3) make app_bash - провалиться в контейнер с php, выполнить команду php ./bin/console doctrine:migrations:migrate

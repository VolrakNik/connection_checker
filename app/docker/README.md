## Using docker
В докерфайле используется composer.json, который лежит в соседней дериктории.
Чтобы соседняя дериктория была видна, необходимо использовать флаг -f
>docker build -f ./docker/Dockerfile . --tag app
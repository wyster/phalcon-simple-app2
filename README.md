**Запуск контейнера**

1. Настройка, запустить `make setup`, при желании сконфигурировать коннект к базе данных в .env
2. Сборка командой
 
`$ docker image build -t phalcon-simple-app2 .`

3. Запуск 

`$ docker container run --env-file ./.env --publish 80:80 -v $(pwd):/var/www/html phalcon-simple-app2`

В `--publish` можно передать желаемый порт, например 8080 `--publish 8080:80`

С флагом `-d` можно запустить в `detached mode`

3. Сайт доступен на выбранном вами порту, по умолчанию на 80: `http://localhost/`

С флагом `-d` можно запустить в `detached mode`

**Остановка контейнера**

`$ docker container stop $(docker container ls -q --filter="ancestor=phalcon-simple-app2")`

**Пример запроса через curl**
```
$ curl -X POST \
    http://localhost/ \
    -d '{"jsonrpc":"2.0", "id":1, "method":"auth.index", "params": {"login":"admin", "password":"admin"}}'
```

**Тесты**

```
$ make unit-test
```

**Покрытие**

```
$ make coverage
```


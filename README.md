**Запуск контейнера**

1. Настройка, запустить `make setup`, при желании сконфигурировать коннект к базе данных в .env

2. Сборка командой
 
`$ make build`

3. Запуск 

`$ make run`

В `port` можно передать желаемый порт, например 8080 `port 8080`

3. Сайт доступен на выбранном вами порту, по умолчанию на 80: `http://localhost/`

С флагом `-d` можно запустить в `detached mode`

**Остановка контейнера**

`$ make stop`

**Пример запроса через curl**
```
$ curl -X POST \
    http://localhost:8082/ \
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


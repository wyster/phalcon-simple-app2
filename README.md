**Запуск контейнера**

1. Сборка командой
 
`$ docker image build -t phalcon-simple-app .`

2. Запуск 

`$ docker container run --env USE_PHP_INTERNAL_SERVER=1 -v $(pwd):/var/www/html phalcon-simple-app`

В `--publish` можно передать желаемый порт, например `--publish 8080:80`

С флагом `-d` можно запустить в `detached mode`

**Остановка контейнера**

`$ docker container stop $(docker container ls -q --filter="ancestor=phalcon-simple-app")`

**Пример запроса через curl**
```
$ curl -X POST \
    http://localhost:8080/ \
    -d '{"jsonrpc":"2.0","id":1,"method":"auth.index","params": {"login":"admin", "password":"admin"}}'
```

**Тесты**

```
$ make unit-test
```

**Покрытие**

```
$ make coverage
```


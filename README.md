# Yandex Metrika API

SDK для удобного взаимодействия с Yandex Metrika API управления

[![Latest Stable Version](http://poser.pugx.org/webcrea/yandex-metrika-sdk/v)](https://packagist.org/packages/webcrea/yandex-metrika-sdk)
[![Total Downloads](http://poser.pugx.org/webcrea/yandex-metrika-sdk/downloads)](https://packagist.org/packages/webcrea/yandex-metrika-sdk)
[![License](http://poser.pugx.org/webcrea/yandex-metrika-sdk/license)](https://packagist.org/packages/webcrea/yandex-metrika-sdk)

## Установка

### С помощью Composer

```bash
$ composer require webcrea/yandex-metrika-sdk
```

### Получение токена

1. Перейти на https://oauth.yandex.ru/
2. Нажать "Зарегистрировать новое приложение"
3. Заполнить необходимые поля.
4. В разделе "Платформы" выбрать Веб-сервисы и нажать "Подставить URL для разработки"
5. В разделе "Доступы" \ Яндекс.Метрика нужно отметить "Получение статистики" и "Создание счётчиков"
6. После сохранения нужно скопировать ИД приложения и подставить в URL для получения токена:

```
https://oauth.yandex.ru/authorize?response_type=token&client_id=ИД ПРИЛОЖЕНИЯ
```

## Инициализация

```php
$counterId = '';
$token = '';

// CDP API
$cdp = new \WebCrea\YandexMetrikaSdk\Api\CdpApi($token);

// Management API
$management = new \WebCrea\YandexMetrikaSdk\Api\ManagementApi($token);

```

## Примеры использования

```php
$counterId = '00000000';
$token = '00000000000000000000';

$cdp = new \WebCrea\YandexMetrikaSdk\Api\CdpApi($token);

// Сопоставление статусов заказов
$map['order_statuses'] = [
    [
        'id' => 'NO',
        'humanized' => 'Не оплачен',
        'type' => 'IN_PROGRESS',
    ],
    [
        'id' => 'N',
        'humanized' => 'Новый заказ',
        'type' => 'IN_PROGRESS',
    ],
];

$result = $cdp->mapOrderStatuses($counterId, $map);

// Загрузка заказов (JSON)
$orders['orders'] = [
    [
        "id" => "32152",
        "client_uniq_id" => "sertw345fgdsg",
        "client_type" => "CONTACT",
        "create_date_time" => "2020-04-14 13:17:00",
        "update_date_time" => "2020-04-17 16:12:21",
        "finish_date_time" => "2020-04-17 11:59:00",
        "revenue" => 2000,
        "order_status" => "Создан",
        "cost" => 100500,
        "products" => ["Товар А" => 173, "Товар Б" => 146],
    ],
];

$result = $cdp->uploadOrdersJson($counterId, $orders, ['merge_mode' => 'SAVE']);

// Информация о последних загрузках 
$result = $cdp->getLastUploadings($counterId);
```

## Описание CDP API
#### Сопоставление статусов заказов https://yandex.ru/dev/metrika/doc/api2/crm/schema/maporderstatuses.html
```php
public function mapOrderStatuses(int $counterId, array $content): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$content | array | Карта статусов

#### Загрузка данных о клиентах (JSON) https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadcontactjson.html
```php
public function uploadContactsJson(int $counterId, array $content, array $requestParams): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$content | array | Список клиентов
$requestParams | array | Параметры запроса

#### Загрузка заказов (JSON) https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadordersjson.html
```php
public function uploadOrdersJson(int $counterId, array $content, array $requestParams): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$content | array | Список заказов
$requestParams | array | Параметры запроса

#### Создание атрибутов https://yandex.ru/dev/metrika/doc/api2/crm/schema/createattributes.html
```php
public function createAttributes(int $counterId, array $content, array $requestParams = []): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$content | array | Cписок атрибутов
$requestParams | array | Параметры запроса

#### Создание списка товаров https://yandex.ru/dev/metrika/doc/api2/crm/schema/createproducts.html
```php
public function createProducts(int $counterId, array $content): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$content | array | Cписок товаров

#### Информация о всех атрибутах https://yandex.ru/dev/metrika/doc/api2/crm/schema/createproducts.html
```php
public function getAttributes(int $counterId, array $requestParams = []): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$requestParams | array | Параметры запроса

#### Информация о типах пользовательских атрибутов https://yandex.ru/dev/metrika/doc/api2/crm/schema/getpredefinedtypes.html
```php
public function getPredefinedTypes(int $counterId): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика

#### Информация о типах системных атрибутов https://yandex.ru/dev/metrika/doc/api2/crm/schema/gettypes.html
```php
public function getTypes(int $counterId): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика

#### Информация о последних загрузках https://yandex.ru/dev/metrika/doc/api2/crm/uploadings/getlastuploadings.html
```php
public function getLastUploadings(int $counterId, array $requestParams = []): array
```
Название | Тип | Описание
---------|-----|----------------------
$counterId | integer | Номер счетчика
$requestParams | array | Параметры запроса

# Qiwi API Client
API клиент для работы с API личного кабинета Qiwi - [Документация Qiwi](https://developer.qiwi.com/qiwiwallet/qiwicom_ru.html)<br><br>
<b>Версия Qiwi API:</b> Версия 1.4 от 15.05.2018<br>
<b>Версия Qiwi API Class PHP:</b> Версия 1.2 от 26.05.2018<br><br>
<b>Предложения/Баги/Ошибки принимаются на сайте:</b> [culabra.ru](https://culabra.ru/qiwi-api-class-php-klass-dlya-raboty-s-api-qiwi)<br>

# Установка
* Скопируйте Qiwi.php из папки src/ и подключите его в вашем скрипте
```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
```


# Пример отправка средств

```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
$sendMoney = $qiwi->sendMoneyToQiwi([
    'id' => 'time() + 10 * 5',
    'sum' => [
        'amount'   => 1000,
        'currency' => '643'
    ], 
    'paymentMethod' => [
        'type' => 'Account',
        'accountId' => '643'
    ],
    'comment' => 'Тестовый платеж',
    'fields' => [
        'account' => '+79996661212'
    ]
]);

```

# Получение последних 50 записей из истории платежей за 30 дней

```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
$getHistory = $qiwi->getPaymentsHistory([
	'startDate' => '2018-03-01T00:00:00+03:00',
	'endDate' => '2018-03-01T00:00:00+03:00',
	'rows' => '50'
]);

```

# Получение данных по определенной транзакции

```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
$getTxn = $qiwi->getTxn('11963463493');

```


# Методы

Метод | Описание
------------ | -------------
getAccount(Array $params) | Профиль пользователя
getPaymentsHistory(Array $params) | История платежей
getPaymentsStats(Array $params) | Статистика платежей
getBalance() | Баланс QIWI Кошелька
getCheck($txnId, Array $params) | Квитанция платежа
getTxn($txnId, Array $params) | Определенная транкзация по ID
getTax($providerId) | Комиссионные тарифы
sendMoneyToQiwi(Array $params) | Перевод на QIWI Кошелек
sendMoneyToProvider($providerId, Array $params) | Оплата услуг по ID получателя
sendMoneyToOther(Array $params) | Платеж по свободным реквизитам

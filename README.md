# Qiwi API Client
API клиент для работы с API личного кабинета Qiwi
[Документация Qiwi](https://developer.qiwi.com/qiwiwallet/qiwicom_ru.html)

# Установка
* Скопируйте Qiwi.php из папки src/ и включите его в скрипт
```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
```


# Пример

```php
require_once 'Qiwi.php';
$qiwi = new Qiwi('79996661212', 'a9760264ca3e817264ee2340aa877');
$sendMoney = $qiwi->sendMoneyToQiwi([
    'id' => time() + 10 * 5,
    'sum' => [
        'amount'   => 1000,
        'currency' => 643
    ], 
    'source' => 'account_643',
    'paymentMethod' => [
        'type' => 'Account',
        'accountId' => 643
    ],
    'comment' => 'Тестовый платеж',
    'fields' => [
        'account' => '+79996661212'
    ]
]);

```

# Методы

Метод | Описание
------------ | -------------
getAccount(Array $params) | Профиль пользователя
getPaymentsHistory(Array $params) | История платежей
getPaymentsStats(Array $params) | Статистика платежей
getBalance() | Баланс QIWI Кошелька
getTxn($params) | Определенная транкзация ($params - ID Transaction)
getTax($providerId) | Комиссионные тарифы
sendMoneyToQiwi(Array $params) | Перевод на QIWI Кошелек
sendMoneyToProvider($providerId, Array $params) | Оплата услуг по ID получателя

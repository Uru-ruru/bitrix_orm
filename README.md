# ORM Bitrix Examples
Примеры реализации Bitrix ORM для инфоблоков и HL блоков Битркса. Запрос связей с другими инфоблоками, списками и т.д.

## Настройка Битрикс
1. Необходимо у всех ИБ заполнить поле "API symbolic code", после появится возможность работать с ними через ОРМ
2. Для генерации аннотаций всех ИБ выполнить команду: `php bitrix/bitrix.php orm:annotate -m all`

## Примеры работы

```php
use App\Models\ORM\CertificationsTable;
try {

    $certsORM = CertificationsTable::getList([
        'select' => ['*', 'CERT_ID', 'CERTIFICATION_TYPE.ITEM', 'DEVELOPER', 'LEVEL']
    ])->fetchCollection();
} catch (\Bitrix\Main\ObjectPropertyException|\Bitrix\Main\ArgumentException|\Bitrix\Main\SystemException $e) {
    echo $e->getMessage();
}

/** @var  \Bitrix\Iblock\Elements\EO_ElementCertifications $cert */
foreach ($certsORM as $cert) {
    echo $cert->getCertId() ? $cert->getCertId()->getValue() : "-";
}
```
В `select` 
- для простых свойств поле выбираем по имени
- для справочников добавляем `.ITEM`

В примере выше запрашиваются следующие поля:

- 'CERT_ID' - **string** номер
- 'CERTIFICATION_TYPE.ITEM'- **string** тип из справочника
- 'DEVELOPER' - **int** связь с пользователем
- 'LEVEL' - **int** связь с HL


## Геттеры

- Для строковых свойств
```php
$cert->getCertId()->getValue();
```
- Для справочников
```php
$cert->getCertificationType()->getItem()->getValue();
```
- Для связей с HL
```php
$cert->getLevelRef()->getLevelName();
```
при этом в модель добавлен геттер
```php
/**
     * @return EntityObject|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getLevelRef(): ?EntityObject
    {
        $levelId = $this->getLevel() ? $this->getLevel()->getValue() : null;
        if ($levelId) {
            return LevelsTable::getById($levelId)->fetchObject();
        }
        return null;
    }
```
- Для связи с пользователем
```php
$cert->getDeveloperRef()->getLogin();
```
при этом в модель добавлен геттер
```php
 /**
     * @return EO_User|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getDeveloperRef(): ?EO_User
    {
        $userId = $this->getDeveloper() ? $this->getDeveloper()->getValue() : null;
        if ($userId) {
            return UserTable::getById($userId)->fetchObject();
        }
        return null;
    }
```

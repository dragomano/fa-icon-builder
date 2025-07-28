# FA Icon Builder

![PHP](https://img.shields.io/badge/PHP-^8.1-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-icon-builder/main)

[English](README.md)

## Описание

Набор инструментов PHP без зависимостей для создания классов иконок Font Awesome, HTML-тегов и коллекций (Solid/Regular/Brands). Идеально подходит для проектов, где вам нужно работать с иконками FA без загрузки CSS/JS.

## Установка

```bash
composer require bugo/fa-icon-builder
```

## Использование

Для каждого набора иконок доступен отдельный декоратор:

```php
// 'fa-brands fa-windows'
echo BrandsIcon::make('windows');

// 'fa-regular fa-user'
echo RegularIcon::make('user');

// 'fa-solid fa-user'
echo SolidIcon::make('user');
```

Если нужна поддержка устаревших классов, просто укажите `true` вторым параметром:

```php
// 'fas fa-user'
echo SolidIcon::make('user', true);
```

Расширенный пример:

```php
$icon = Icon::make('user', IconStyle::Solid);

// '<i class="fa-solid fa-user fa-2xl text-red-500 fa-fw" title="Пользователь" aria-hidden="true"></i>'
var_dump(
    $icon
        ->color('text-red-500')
        ->size('2xl')
        ->title('Пользователь')
        ->fixedWidth()
        ->ariaHidden()
        ->html()
);
```

Дополнительные классы можно передать через метод `addClass`:

```php
$icon = SolidIcon::make('heart');

// '<i class="fa-solid fa-heart fa-beat"></i>'
var_dump(
    $icon
        ->addClass('fa-beat')
        ->html()
);
```

Кроме того, доступно получение случайной иконки:

```php
var_dump(Icon::random());
```

А так можно получить всю коллекцию со всеми классами сразу:

```php
var_dump(Icon::collection());
```

Или коллекцию конкретного набора:

```php
var_dump(Icon::collection(IconStyle::Brands));

var_dump(BrandsIcon::collection());
```

Вам также может пригодиться класс `IconBuilder`, который может создавать иконку по её классу:

```php
var_dump(IconBuilder::make(Icon::random()));
```

# FA Icon Builder

![PHP](https://img.shields.io/badge/PHP-^8.1-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-icon-builder/main)

[По-русски](README.ru.md)

## Description

Dependency-free PHP toolset to generate Font Awesome icon classes, HTML tags, and collections (Solid/Regular/Brands). Perfect for projects where you need to work with FA icons without loading CSS/JS.

## Installation

```bash
composer require bugo/fa-icon-builder
```

## Usage

A unique decorator is provided for each icon set:

```php
// 'fa-brands fa-windows'
echo BrandsIcon::make('windows');

// 'fa-regular fa-user'
echo RegularIcon::make('user');

// 'fa-solid fa-user'
echo SolidIcon::make('user');
```

If you need support for legacy classes, simply pass `true` as the second parameter:

```php
// 'fas fa-user'
echo SolidIcon::make('user', true);
```

Extended example:

```php
$icon = Icon::make('user', IconStyle::Solid);

// '<i class="fa-solid fa-user fa-2xl text-red-500 fa-fw" title="User" aria-hidden="true"></i>'
var_dump(
    $icon
        ->color('text-red-500')
        ->size('2xl')
        ->title('User')
        ->fixedWidth()
        ->ariaHidden()
        ->html()
);
```

Additional classes can be passed via the `addClass` method:

```php
$icon = SolidIcon::make('heart');

// '<i class="fa-solid fa-heart fa-beat"></i>'
var_dump(
    $icon
        ->addClass('fa-beat')
        ->html()
);
```

Additionally, random icon retrieval is available:

```php
var_dump(Icon::random());
```

You can retrieve the entire collection with all classes at once:

```php
var_dump(Icon::collection());
```

Or a specific collection set:

```php
var_dump(Icon::collection(IconStyle::Brands));

var_dump(BrandsIcon::collection());
```

You might also find the `IconBuilder` class useful, which can create an icon by its class:

```php
var_dump(IconBuilder::make(Icon::random()));
```

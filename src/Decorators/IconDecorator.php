<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Decorators;

use Bugo\FontAwesome\Enums\IconStyle;
use Bugo\FontAwesome\Icon;

abstract class IconDecorator
{
    protected static IconStyle $style;

    protected static array $icons;

    public static function make(string $iconName, bool $useOldStyle = false): Icon
    {
        return Icon::make($iconName, static::$style, $useOldStyle);
    }

    public static function getAll(): array
    {
        return static::$icons;
    }

    public static function collection(bool $useOldStyle = false): array
    {
        return Icon::collection(static::$style, $useOldStyle);
    }

    public static function random(bool $useOldStyle = false): string
    {
        return Icon::random(static::$style, $useOldStyle);
    }
}

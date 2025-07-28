<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Enums\IconStyle;

class IconBuilder
{
    public static function make(string $iconClass): Icon
    {
        $iconName = self::getIconName($iconClass);
        $style = IconStyle::fromClass($iconClass);
        $useOldStyle = IconStyle::isOldStyle($iconClass);

        return Icon::make($iconName, $style, $useOldStyle);
    }

    private static function getIconName(string $iconClass): string
    {
        $cleaned = preg_replace('/^(fa[srb]?|fa-(solid|regular|brands))\s+/', '', $iconClass);

        return str_replace('fa-', '', $cleaned);
    }
}

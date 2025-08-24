<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Enums\IconStyle;

use function count;
use function explode;
use function implode;
use function preg_replace;
use function str_replace;

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

        $parts = explode(' ', (string) $cleaned);

        if (count($parts) > 0) {
            $parts[0] = str_replace('fa-', '', $parts[0]);
        }

        return implode(' ', $parts);
    }
}

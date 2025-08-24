<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Enums\IconSize;
use Bugo\FontAwesome\Enums\IconStyle;

use function array_merge;
use function implode;
use function str_starts_with;

class IconRenderer
{
    public static function render(
        string $iconName,
        IconStyle $style,
        ?IconSize $size,
        string $color,
        array $classes,
        array $attributes,
        bool $useOldStyle
    ): string
    {
        $classesString = self::getClassesString($iconName, $style, $size, $classes, $useOldStyle);
        $attributesString = self::getAttributesString($color, $attributes);

        return "<i class=\"$classesString\"$attributesString></i>";
    }

    public static function getClassesString(
        string $iconName,
        IconStyle $style,
        ?IconSize $size,
        array $classes,
        bool $useOldStyle
    ): string
    {
        $prefix = $style->getPrefix($useOldStyle);

        $classes = array_merge(
            [$prefix, "fa-$iconName"],
            $size ? ["fa-$size->value"] : [],
            $classes
        );

        return implode(' ', $classes);
    }

    public static function getAttributesString(string $color, array $attributes): string
    {
        $attributesArray = [];

        if ($color && ! str_starts_with($color, 'text-')) {
            $attributesArray[] = "style=\"color: $color\"";
        }

        foreach ($attributes as $key => $value) {
            $attributesArray[] = "$key=\"$value\"";
        }

        return $attributesArray ? ' ' . implode(' ', $attributesArray) : '';
    }
}

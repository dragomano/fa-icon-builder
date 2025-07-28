<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

use InvalidArgumentException;

enum IconStyle
{
    case Brands;
    case Regular;
    case Solid;

    public function getPrefix(bool $useOldStyle = false): string
    {
        return match ($this) {
            self::Brands  => $useOldStyle ? 'fab' : 'fa-brands',
            self::Regular => $useOldStyle ? 'far' : 'fa-regular',
            self::Solid   => $useOldStyle ? 'fas' : 'fa-solid',
        };
    }

    public static function fromClass(string $iconClass): self
    {
        foreach (self::cases() as $style) {
            if (self::isStyleMatch($iconClass, $style)) {
                return $style;
            }
        }

        throw new InvalidArgumentException("Unknown icon class: $iconClass");
    }

    public static function isOldStyle(string $iconClass): bool
    {
        foreach (self::cases() as $style) {
            if (str_starts_with($iconClass, $style->getPrefix(true))) {
                return true;
            }
        }

        return false;
    }

    private static function isStyleMatch(string $iconClass, self $style): bool
    {
        return str_starts_with($iconClass, $style->getPrefix(true)) ||
            str_starts_with($iconClass, $style->getPrefix());
    }
}

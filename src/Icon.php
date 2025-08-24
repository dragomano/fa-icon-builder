<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Decorators\BrandsIcon;
use Bugo\FontAwesome\Decorators\RegularIcon;
use Bugo\FontAwesome\Decorators\SolidIcon;
use Bugo\FontAwesome\Enums\IconSize;
use Bugo\FontAwesome\Enums\IconStyle;
use InvalidArgumentException;

use function array_map;
use function array_rand;
use function array_unique;
use function implode;
use function is_string;
use function preg_match;
use function str_starts_with;

class Icon implements \Stringable
{
    protected ?IconSize $size = null;

    protected string $color = '';

    protected array $classes = [];

    protected array $attributes = [];

    protected function __construct(
        protected string $iconName,
        protected IconStyle $style,
        protected bool $useOldStyle = false
    ) {}

    public function __toString(): string
    {
        return $this->html();
    }

    public function html(): string
    {
        return IconRenderer::render(
            $this->iconName,
            $this->style,
            $this->size,
            $this->color,
            $this->classes,
            $this->attributes,
            $this->useOldStyle
        );
    }

    public function text(): string
    {
        return IconRenderer::getClassesString(
            $this->iconName,
            $this->style,
            $this->size,
            $this->classes,
            $this->useOldStyle
        );
    }

    public static function make(string $iconName, IconStyle $style, bool $useOldStyle = false): static
    {
        return new static($iconName, $style, $useOldStyle);
    }

    public static function collection(?IconStyle $style = null, bool $useOldStyle = false): array
    {
        return $style === null
            ? self::getAllIconsWithPrefixes($useOldStyle)
            : self::getStyleSpecificIcons($style, $useOldStyle);
    }

    private static function getAllIconsWithPrefixes(bool $useOldStyle): array
    {
        $result = [];

        foreach ([IconStyle::Brands, IconStyle::Regular, IconStyle::Solid] as $style) {
            $prefix = $style->getPrefix($useOldStyle);
            $icons = self::getIconsOfStyle($style);

            foreach ($icons as $icon) {
                $result[] = "$prefix fa-$icon";
            }
        }

        return array_unique($result);
    }

    private static function getStyleSpecificIcons(IconStyle $style, bool $useOldStyle): array
    {
        $icons = self::getIconsOfStyle($style);
        $prefix = $style->getPrefix($useOldStyle);

        return array_map(fn($icon) => "$prefix fa-$icon", $icons);
    }

    private static function getIconsOfStyle(IconStyle $style): array
    {
        return match ($style) {
            IconStyle::Brands  => BrandsIcon::getAll(),
            IconStyle::Regular => RegularIcon::getAll(),
            IconStyle::Solid   => SolidIcon::getAll(),
        };
    }

    public static function random(?IconStyle $style = null, bool $useOldStyle = false): string
    {
        $classes = static::collection($style, $useOldStyle);

        return $classes[array_rand($classes)];
    }

    public function size(IconSize|string $size): self
    {
        if (is_string($size)) {
            $sizeEnum = IconSize::tryFrom($size);

            if ($sizeEnum === null) {
                throw new InvalidArgumentException(
                    "Invalid size: $size. Use one of: " . implode(
                        ', ', array_map(fn($case) => $case->value, IconSize::cases())
                    )
                );
            }

            $this->size = $sizeEnum;
        } else {
            $this->size = $size;
        }

        return $this;
    }

    public function color(string $color): self
    {
        $this->color = match (true) {
            $this->isHexColor($color) || $this->isNamedColor($color) => $color,
            $this->isTailwindColorClass($color) => $this->classes[] = $color,
            default => throw new InvalidArgumentException(
                "Invalid color format. Use hex (#RRGGBB), named color (red) or Tailwind CSS class (text-red-500)."
            ),
        };

        return $this;
    }

    public function title(string $title): self
    {
        $this->attributes['title'] = $title;

        return $this;
    }

    public function addClass(string $class): self
    {
        $this->classes[] = $class;

        return $this;
    }

    public function addAttribute(string $key, string $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function fixedWidth(): self
    {
        $this->classes[] = 'fa-fw';

        return $this;
    }

    public function ariaHidden(): self
    {
        $this->attributes['aria-hidden'] = 'true';

        return $this;
    }

    private function isHexColor(string $color): bool
    {
        return (bool) preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color);
    }

    private function isNamedColor(string $color): bool
    {
        return (bool) preg_match('/^[a-zA-Z]+$/', $color);
    }

    private function isTailwindColorClass(string $color): bool
    {
        return str_starts_with($color, 'text-');
    }
}

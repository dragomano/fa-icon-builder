<?php declare(strict_types=1);

use Bugo\FontAwesome\Enums\IconSize;
use Bugo\FontAwesome\Enums\IconStyle;
use Bugo\FontAwesome\Icon;

beforeEach(function () {
    $this->userIcon = Icon::make('user', IconStyle::Regular);
    $this->calendarIcon = Icon::make('calendar', IconStyle::Solid, true);
});

test('html method', function () {
    expect($this->userIcon->html())
        ->toBe('<i class="fa-regular fa-user"></i>')
        ->and((string) $this->userIcon)->toBe($this->userIcon->html());
});

test('text method', function () {
    expect($this->userIcon->text())->toBe('fa-regular fa-user')
        ->and($this->calendarIcon->text())->toBe('fas fa-calendar');
});

test('collection method', function () {
    expect(Icon::collection())->toBeArray()
        ->and(Icon::collection())->toContain('fa-solid fa-user')
        ->and(Icon::collection(IconStyle::Brands))->toContain('fa-brands fa-apple')
        ->and(Icon::collection(IconStyle::Brands))->not->toContain('fa-solid fa-user');
});

test('random method', function () {
    expect(Icon::random())->toBeString()
        ->and(Icon::random())->not->toBe(Icon::random());
});

describe('size method', function () {
    it('checks enum param', function () {
        expect($this->calendarIcon->size(IconSize::Xs)->text())
            ->toBe('fas fa-calendar fa-xs');
    });

    it('checks string param', function () {
        expect($this->calendarIcon->size('lg')->text())
            ->toBe('fas fa-calendar fa-lg');
    });

    it('checks unknown param', function () {
        expect(fn() => $this->calendarIcon->size('10px')->text())
            ->toThrow(
                InvalidArgumentException::class,
                "Invalid size: 10px. Use one of: 2xs, xs, sm, 1x, lg, xl, 2xl, 2x, 3x, 4x, 5x, 6x, 7x, 8x, 9x, 10x"
            );
    });
});

describe('color method', function () {
    it('accepts valid hex color', function () {
        expect($this->userIcon->color('#ff0000')->html())
            ->toBe('<i class="fa-regular fa-user" style="color: #ff0000"></i>');
    });

    it('accepts short hex color', function () {
        expect($this->userIcon->color('#f00')->html())
            ->toBe('<i class="fa-regular fa-user" style="color: #f00"></i>');
    });

    it('accepts CSS color name', function () {
        expect($this->userIcon->color('red')->html())
            ->toBe('<i class="fa-regular fa-user" style="color: red"></i>');
    });

    it('accepts Bootstrap text color classes', function () {
        expect($this->userIcon->color('text-primary')->text())
            ->toBe('fa-regular fa-user text-primary');
    });

    it('accepts Tailwind text color classes', function () {
        expect($this->userIcon->color('text-red-500')->text())
            ->toBe('fa-regular fa-user text-red-500');
    });

    it('throws exception for empty color', function () {
        expect(fn() => $this->userIcon->color(''))
            ->toThrow(
                InvalidArgumentException::class,
                'Use hex (#RRGGBB), named color (red) or Tailwind CSS class (text-red-500).'
            );
    });

    it('throws exception for invalid color format', function () {
        expect(fn() => $this->userIcon->color('not-a-color!'))
            ->toThrow(
                InvalidArgumentException::class,
                'Use hex (#RRGGBB), named color (red) or Tailwind CSS class (text-red-500).'
            );
    });
});

test('title method', function () {
    expect($this->calendarIcon->title('Calendar')->html())
        ->toBe('<i class="fas fa-calendar" title="Calendar"></i>');
});

test('addClass method', function () {
    expect($this->calendarIcon->addClass('fa-spin')->text())
        ->toBe('fas fa-calendar fa-spin');
});

test('addAttribute method', function () {
    expect($this->calendarIcon->addAttribute('data-key', 'value')->html())
        ->toBe('<i class="fas fa-calendar" data-key="value"></i>');
});

test('fixedWidth method', function () {
    expect($this->calendarIcon->fixedWidth()->html())
        ->toBe('<i class="fas fa-calendar fa-fw"></i>');
});

test('ariaHidden method', function () {
    expect($this->calendarIcon->ariaHidden()->html())
        ->toBe('<i class="fas fa-calendar" aria-hidden="true"></i>');
});

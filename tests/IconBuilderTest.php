<?php declare(strict_types=1);

use Bugo\FontAwesome\Icon;
use Bugo\FontAwesome\IconBuilder;

beforeEach(function () {
    $this->brandsIcon = IconBuilder::make('fab fa-windows');
    $this->regularIcon = IconBuilder::make('fa-regular fa-bell');
    $this->solidIcon = IconBuilder::make('fas fa-user');
});

it('properly handles brands classes', function () {
    expect($this->brandsIcon)->toBeInstanceOf(Icon::class)
        ->and($this->brandsIcon->html())->toBe('<i class="fab fa-windows"></i>');
});

it('properly handles regular classes', function () {
    expect($this->regularIcon)->toBeInstanceOf(Icon::class)
        ->and($this->regularIcon->html())->toBe('<i class="fa-regular fa-bell"></i>');
});

it('properly handles solid classes', function () {
    expect($this->solidIcon)->toBeInstanceOf(Icon::class)
        ->and($this->solidIcon->html())->toBe('<i class="fas fa-user"></i>');
});

it('throws exception for unknown icon class', function () {
    expect(fn() => IconBuilder::make('some fa-foo-bar'))
        ->toThrow(
            InvalidArgumentException::class,
            "Unknown icon class: some fa-foo-bar"
        );
});

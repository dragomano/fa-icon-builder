<?php declare(strict_types=1);

use Bugo\FontAwesome\Decorators\BrandsIcon;

beforeEach(function () {
    $this->icon = BrandsIcon::make('windows');
});

test('make method', function () {
    expect($this->icon->html())
        ->toBe('<i class="fa-brands fa-windows"></i>')
        ->and((string) $this->icon)->toBe($this->icon->html())
        ->and($this->icon->text())->toBe('fa-brands fa-windows');
});

test('collection method', function () {
    expect(BrandsIcon::collection())->toBeArray()
        ->and(BrandsIcon::collection(true))->toContain('fab fa-apple')
        ->and(BrandsIcon::collection())->toContain('fa-brands fa-apple');
});

test('random method', function () {
    expect(BrandsIcon::random())->toBeString()
        ->and(BrandsIcon::random())->not->toBe(BrandsIcon::random());
});

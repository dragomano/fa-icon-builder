<?php declare(strict_types=1);

use Bugo\FontAwesome\Decorators\SolidIcon;

beforeEach(function () {
    $this->icon = SolidIcon::make('anchor');
});

test('make method', function () {
    expect($this->icon->html())
        ->toBe('<i class="fa-solid fa-anchor"></i>')
        ->and((string) $this->icon)->toBe($this->icon->html())
        ->and($this->icon->text())->toBe('fa-solid fa-anchor');
});

test('collection method', function () {
    expect(SolidIcon::collection())->toBeArray()
        ->and(SolidIcon::collection(true))->toContain('fas fa-arrow-up-long')
        ->and(SolidIcon::collection())->toContain('fa-solid fa-arrow-up-long');
});

test('random method', function () {
    expect(SolidIcon::random())->toBeString()
        ->and(SolidIcon::random())->not->toBe(SolidIcon::random());
});

<?php declare(strict_types=1);

use Bugo\FontAwesome\Decorators\RegularIcon;

beforeEach(function () {
    $this->icon = RegularIcon::make('angry');
});

test('make method', function () {
    expect($this->icon->html())
        ->toBe('<i class="fa-regular fa-angry"></i>')
        ->and((string) $this->icon)->toBe($this->icon->html())
        ->and($this->icon->text())->toBe('fa-regular fa-angry');
});

test('collection method', function () {
    expect(RegularIcon::collection())->toBeArray()
        ->and(RegularIcon::collection(true))->toContain('far fa-face-meh')
        ->and(RegularIcon::collection())->toContain('fa-regular fa-face-meh');
});

test('random method', function () {
    expect(RegularIcon::random())->toBeString()
        ->and(RegularIcon::random())->not->toBe(RegularIcon::random());
});

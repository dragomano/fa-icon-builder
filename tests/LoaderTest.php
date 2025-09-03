<?php declare(strict_types=1);

use Bugo\FontAwesome\Loader;

test('getCdnLink method', function () {
    expect(Loader::getCdnLink())->toContain('fontawesome-free@7/css/all.min.css')
        ->and(Loader::getCdnLink('6'))->toContain('fontawesome-free@6/css/all.min.css');
});

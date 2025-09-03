<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use function htmlspecialchars;

class Loader
{
    public static function getCdnLink(string $version = '7'): string
    {
        $version = htmlspecialchars($version, ENT_QUOTES);
        $url = "https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@$version/css/all.min.css";

        return '<link rel="preload" href="' . $url . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    }
}

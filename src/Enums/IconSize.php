<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

enum IconSize: string
{
    case Xs2 = '2xs'; // 0.625em, 10px
    case Xs = 'xs'; // 0.75em, 12px
    case Sm = 'sm'; // 0.875em, 14px
    case X1 = '1x'; // 1em, 16px
    case Lg = 'lg'; // 1.25em, 20px
    case Xl = 'xl'; // 1.5em, 24px
    case Xl2 = '2xl'; // 2em, 32px
    case X2 = '2x'; // 2em, 32px
    case X3 = '3x'; // 3em, 48px
    case X4 = '4x'; // 4em, 64px
    case X5 = '5x'; // 5em, 80px
    case X6 = '6x'; // 6em, 96px
    case X7 = '7x'; // 7em, 112px
    case X8 = '8x'; // 8em, 128px
    case X9 = '9x'; // 9em, 144px
    case X10 = '10x'; // 10em, 160px
}

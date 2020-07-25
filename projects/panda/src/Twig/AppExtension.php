<?php

namespace App\Twig;

use App\Entity\LikeNotification;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigTest;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    /** @var string */
    private $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getGlobals(): array
    {
        return [
            'locale' => $this->locale
        ];
    }

    public function getTests()
    {
        return[
            new TwigTest(
                'like',
                function ($obj) {
                    return $obj instanceof LikeNotification;
                }
            )
        ];
    }
}


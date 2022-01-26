<?php

namespace App\Actions;

use App\Traits\TakesScreenshots;

class TakeScreenshot
{
    use TakesScreenshots;

    public ?string $localUrl;

    public function __construct($localUrl = null)
    {
        if ($localUrl) {
            $this->setUrl($localUrl);
        }
    }
}

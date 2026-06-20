<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class BilletQrService
{
    public function generate(string $code): string
    {
        $options = new QROptions([
            'scale' => 8,
            'outputBase64' => false,
        ]);

        return (new QRCode($options))->render($code);
    }
}

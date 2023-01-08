<?php

declare(strict_types=1);

namespace App\Framework\Ui\Http\Controller;

use Symfony\Component\HttpFoundation\Request;

interface PayloadProcessor
{
    public function generate(Request $request): object;
}

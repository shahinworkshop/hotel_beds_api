<?php

declare(strict_types=1);

namespace App\Tests\Ui\Http\Controller;

use App\Tests\Ui\UiTestCase;

final class StatusTest extends UiTestCase
{
    public function testStatusEndpoint(): void
    {
        $this->client->request('GET', '/status');

        $this->assertResponseStatusCodeSame(200);
    }
}

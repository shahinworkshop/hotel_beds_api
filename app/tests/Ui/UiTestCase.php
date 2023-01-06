<?php declare(strict_types=1);

namespace App\Tests\Ui;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UiTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $this->client->setServerParameter(
            'LAMBDA_REQUEST_CONTEXT',
            \json_encode([
                'authorizer' => [
                    'claims' => [
                        'cognito:username' => 'admin@instapro.com',
                    ],
                ],
            ], true)
        );
    }
}

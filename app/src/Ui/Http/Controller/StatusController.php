<?php

declare(strict_types=1);

namespace App\Ui\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/status', name: 'app_status')]
final class StatusController extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/StatusController.php',
        ]);
    }
}

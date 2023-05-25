<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthProbeController extends AbstractController
{
    /**
     * @Route("/health/probe", name="app_health_probe")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'status => 'Ok',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_app')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller JP!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/api', name: 'home_api_weather')]
    public function apiCall(HttpClientInterface $client)
    {

        try {
            $response = $client->request(
                'GET',
                'https://wttr.inr/nce'
            );
            $statusCode = $response->getStatusCode();
            $contentType = $response->getHeaders()['content-type'][0];
            $content = $response->getContent();
            return $this->json([
                'status' => $statusCode,
                'contentType' => $contentType
            ]);
        } catch (ClientExceptionInterface | \Exception $e) {
            return $this->json([
                'status' => Response::HTTP_SERVICE_UNAVAILABLE,
                'message' => $e->getMessage()
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

}

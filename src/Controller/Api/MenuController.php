<?php

namespace App\Controller\Api;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/menu', name: 'api_menu_')]
class MenuController extends AbstractController
{
    #[Route('/all', name: 'all', methods: ['GET'])]
    public function all(MenuRepository $menuRepository): JsonResponse
    {
        $menu = $menuRepository->findAll();
        return $this->json($menu, 200, context: ['groups' => 'api_menu_all']);
    }
}

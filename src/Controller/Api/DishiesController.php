<?php

namespace App\Controller\Api;

use App\Repository\DishiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/dish', name: 'api_dish_')]
class DishiesController extends AbstractController
{
    #[Route('/all', name: 'all', methods: ['GET'])]
    public function all(DishiesRepository $dishiesRepository): JsonResponse
    {
        $dishies = $dishiesRepository->findAll();
        return $this->json($dishies, 200, context: ['groups' => 'api_dish_all']);
    }

    #[Route('/picture', name: 'picture', methods: ['GET'])]
    public function picture(DishiesRepository $dishiesRepository): JsonResponse
    {
        $allDishiesPictures = $dishiesRepository->findAll();

        $dishiesPicturesIndex = array_rand($allDishiesPictures, 5);

        $dishiesPictures = [];

        foreach ($dishiesPicturesIndex as $dishIndex) {
            array_push($dishiesPictures, $allDishiesPictures[$dishIndex]);
        }

        return $this->json($dishiesPictures, 200, context: ['groups' => 'api_dish_picture']);
    }
}

<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="mainpage")
     */
    public function index(PersonRepository $personRepository, TagRepository $tagRepository)
    {
        $persons = $personRepository->findAll(); 
        $tags = $tagRepository->findAll();
        return $this->render('main/index.html.twig', [
            'persons' => $persons,
            'tags' => $tags,
        ]);
    }
}

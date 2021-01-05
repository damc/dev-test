<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\FilterType;
use App\Repository\CharacterRepository;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @Route("/", name="character_index")
     */
    public function index(Request $request, CharacterRepository $characterRepository): Response
    {
        $form = $this->createForm(FilterType::class);
        $form->handleRequest($request);

        $page = $request->get('page', 1);
        $characters = null;
        $totalPages = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $name = (string) $form->get('name')->getData();
            $characters = $characterRepository->findBy(['name' => $name], $page);
            $totalPages = $characterRepository->getTotalPagesBy(['name' => $name]);
        } else {
            $characters = $characterRepository->findAll($page);
            $totalPages = $characterRepository->getTotalPages();
        }

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
            'form' => $form->createView(),
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * @Route("/view/{id}", name="character_view")
     */
    public function view(
        int $id,
        CharacterRepository $characterRepository,
        EpisodeRepository $episodeRepository
    ): Response
    {
        /** @var Character $character */
        $character = $characterRepository->find($id);

        if (is_null($character)) {
            throw $this->createNotFoundException("Character does not exist.");
        }

        $episodes = $episodeRepository->findByCharacter($character);

        return $this->render('character/view.html.twig', [
            'character' => $character,
            'episodes' => $episodes
        ]);
    }
}

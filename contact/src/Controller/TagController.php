<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/tag", name="tag_")
     */
class TagController extends AbstractController
{
    /**
     * @Route("s", name="browse")
     */
    
    public function browse(TagRepository $tagRepository)
    {   
        $tags = $tagRepository->findAll();

        return $this->render('tag/browse.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("s/add", name="add")
     */
    public function add(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($tag);
            $em->flush();
            
            $this->addFlash('success', 'Le tag  : '. $tag->getName() .' à bien été ajouté.');
            return $this->redirectToRoute('tag_browse');
        }


        return $this->render('tag/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("s/{id}", name="read", requirements={"id":"\d+"})
     */
    public function read(Tag $tag)
    {
        return $this->render('tag/read.html.twig', [
            'tag' => $tag,
        ]);
    }

        /**
     * @Route("s/{id}", name="delete", requirements={"id":"\d+"})
     */
    public function delete(Tag $tag)
    {
        //todo : limiter les accès
        $em = $this->getDoctrine()->getManager();
        $em->remove($tag);
        $em->flush();
    
        $this->addFlash('primary', 'Le\'étiquette à bien été supprimée.');
        return $this->redirectToRoute('tag_browse');
    }




}

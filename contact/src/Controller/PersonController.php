<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person", name="person_")
 */
class PersonController extends AbstractController
{

    /**
     * Browse : Liste les contact existants
     * @Route("s", name="browse")
     */
    public function browse(PersonRepository $personRepository)
    {
        return $this->render('person/browse.html.twig', [
             'people' => $personRepository->findAll(),
        ]);
    }

   /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('person_browse');
        }

        return $this->render('person/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    /**
     * Read : Affiche la 'carte' d'un contact prècis
     * @Route("/{id}/read", name="read", requirements={"id":"\d+"})
     */
    public function read(Person $person)
    {
        return $this->render('person/read.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * Edit : Affiche et traite le formulaire de modification d'un contact existant
     * @Route("/{id}/edit", name="edit", requirements={"id":"\d+"})
     */
    public function edit(Person $person)
    {

        $form = $this->createForm(PersonType::class, $person);
        
        return $this->render('person/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

 

    /**
     * Delete : Traite la suppression d'un contact
     * @Route("/{id}/delete", name="delete", requirements={"id":"\d+"})
     */
    public function delete(Person $person)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();
    
        return $this->redirectToRoute('person_browse');
    }
}

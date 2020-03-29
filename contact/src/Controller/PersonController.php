<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * Add : Affiche et traite le formulaire d'ajout d'un contact 
     * @Route("/add", name="add")
     */
    public function add()
    {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        return $this->render('person/add.html.twig', [
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

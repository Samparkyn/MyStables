<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Horse;
use AppBundle\Form\HorseType;

/**
 * Horse controller.
 *
 * @Route("/horse")
 */
class HorseController extends Controller
{
    /**
     * Lists all Horse entities.
     *
     * @Route("/", name="horse_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $horses = $em->getRepository('AppBundle:Horse')->findAll();

        return $this->render('horse/index.html.twig', array(
            'horses' => $horses,
        ));
    }

    /**
     * Creates a new Horse entity.
     *
     * @Route("/new", name="horse_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $horse = new Horse();
        $form = $this->createForm('AppBundle\Form\HorseType', $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($horse);
            $em->flush();

            return $this->redirectToRoute('horse_show', array('id' => $horse->getId()));
        }

        return $this->render('horse/new.html.twig', array(
            'horse' => $horse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Horse entity.
     *
     * @Route("/{id}", name="horse_show")
     * @Method("GET")
     */
    public function showAction(Horse $horse)
    {
        $deleteForm = $this->createDeleteForm($horse);

        return $this->render('horse/show.html.twig', array(
            'horse' => $horse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Horse entity.
     *
     * @Route("/{id}/edit", name="horse_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Horse $horse)
    {
        $deleteForm = $this->createDeleteForm($horse);
        $editForm = $this->createForm('AppBundle\Form\HorseType', $horse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($horse);
            $em->flush();

            return $this->redirectToRoute('horse_edit', array('id' => $horse->getId()));
        }

        return $this->render('horse/edit.html.twig', array(
            'horse' => $horse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Horse entity.
     *
     * @Route("/{id}", name="horse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Horse $horse)
    {
        $form = $this->createDeleteForm($horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($horse);
            $em->flush();
        }

        return $this->redirectToRoute('horse_index');
    }

    /**
     * Creates a form to delete a Horse entity.
     *
     * @param Horse $horse The Horse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Horse $horse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('horse_delete', array('id' => $horse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

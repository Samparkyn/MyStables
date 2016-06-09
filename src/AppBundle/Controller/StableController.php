<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Stable;
use AppBundle\Form\StableType;

/**
 * Stable controller.
 *
 * @Route("/stable")
 */
class StableController extends Controller
{
    /**
     * Lists all Stable entities.
     *
     * @Route("/", name="stable_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stables = $em->getRepository('AppBundle:Stable')->findAll();

        return $this->render('stable/index.html.twig', array(
            'stables' => $stables,
        ));
    }

    /**
     * Creates a new Stable entity.
     *
     * @Route("/new", name="stable_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $stable = new Stable();
        $form = $this->createForm('AppBundle\Form\StableType', $stable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stable);
            $em->flush();

            return $this->redirectToRoute('stable_show', array('id' => $stable->getId()));
        }

        return $this->render('stable/new.html.twig', array(
            'stable' => $stable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Stable entity.
     *
     * @Route("/{id}", name="stable_show")
     * @Method("GET")
     */
    public function showAction(Stable $stable)
    {
        $deleteForm = $this->createDeleteForm($stable);

        return $this->render('stable/show.html.twig', array(
            'stable' => $stable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stable entity.
     *
     * @Route("/{id}/edit", name="stable_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stable $stable)
    {
        $deleteForm = $this->createDeleteForm($stable);
        $editForm = $this->createForm('AppBundle\Form\StableType', $stable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stable);
            $em->flush();

            return $this->redirectToRoute('stable_edit', array('id' => $stable->getId()));
        }

        return $this->render('stable/edit.html.twig', array(
            'stable' => $stable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Stable entity.
     *
     * @Route("/{id}", name="stable_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Stable $stable)
    {
        $form = $this->createDeleteForm($stable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stable);
            $em->flush();
        }

        return $this->redirectToRoute('stable_index');
    }

    /**
     * Creates a form to delete a Stable entity.
     *
     * @param Stable $stable The Stable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stable $stable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stable_delete', array('id' => $stable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

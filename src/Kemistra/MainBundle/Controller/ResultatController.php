<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\Resultat;
use Kemistra\MainBundle\Form\ResultatType;

/**
 * Resultat controller.
 *
 */
class ResultatController extends Controller
{
    /**
     * Lists all Resultat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KemistraMainBundle:Resultat')->findAll();

        return $this->render('KemistraMainBundle:Resultat:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Resultat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Resultat();
        $form = $this->createForm(new ResultatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('resultat_show', array('id' => $entity->getId())));
        }

        return $this->render('KemistraMainBundle:Resultat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Resultat entity.
     *
     */
    public function newAction()
    {
        $entity = new Resultat();
        $form   = $this->createForm(new ResultatType(), $entity);

        return $this->render('KemistraMainBundle:Resultat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Resultat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Resultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resultat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:Resultat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Resultat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Resultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resultat entity.');
        }

        $editForm = $this->createForm(new ResultatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:Resultat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Resultat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Resultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Resultat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ResultatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('resultat_edit', array('id' => $id)));
        }

        return $this->render('KemistraMainBundle:Resultat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Resultat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KemistraMainBundle:Resultat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Resultat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('resultat'));
    }

    /**
     * Creates a form to delete a Resultat entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\Analyse;
use Kemistra\MainBundle\Form\AnalyseType;

/**
 * Analyse controller.
 *
 */
class AnalyseController extends Controller
{
    /**
     * Lists all Analyse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KemistraMainBundle:Analyse')->findAll();

        return $this->render('KemistraMainBundle:Analyse:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Analyse entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Analyse();
        $form = $this->createForm(new AnalyseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('analyse_show', array('id' => $entity->getId())));
        }

        return $this->render('KemistraMainBundle:Analyse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Analyse entity.
     *
     */
    public function newAction()
    {
        $entity = new Analyse();
        $form   = $this->createForm(new AnalyseType(), $entity);

        return $this->render('KemistraMainBundle:Analyse:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Analyse entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Analyse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analyse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:Analyse:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Analyse entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Analyse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analyse entity.');
        }

        $editForm = $this->createForm(new AnalyseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:Analyse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Analyse entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:Analyse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analyse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AnalyseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('analyse_edit', array('id' => $id)));
        }

        return $this->render('KemistraMainBundle:Analyse:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Analyse entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KemistraMainBundle:Analyse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Analyse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('analyse'));
    }

    /**
     * Creates a form to delete a Analyse entity by id.
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

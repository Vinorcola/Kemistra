<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\TypeResultat;
use Kemistra\MainBundle\Form\TypeResultatType;

/**
 * TypeResultat controller.
 *
 */
class TypeResultatController extends Controller
{
    /**
     * Lists all TypeResultat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KemistraMainBundle:TypeResultat')->findAll();

        return $this->render('KemistraMainBundle:TypeResultat:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new TypeResultat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeResultat();
        $form = $this->createForm(new TypeResultatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeresultat_show', array('id' => $entity->getId())));
        }

        return $this->render('KemistraMainBundle:TypeResultat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TypeResultat entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeResultat();
        $form   = $this->createForm(new TypeResultatType(), $entity);

        return $this->render('KemistraMainBundle:TypeResultat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeResultat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:TypeResultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeResultat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:TypeResultat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TypeResultat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:TypeResultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeResultat entity.');
        }

        $editForm = $this->createForm(new TypeResultatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KemistraMainBundle:TypeResultat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeResultat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KemistraMainBundle:TypeResultat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeResultat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypeResultatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeresultat_edit', array('id' => $id)));
        }

        return $this->render('KemistraMainBundle:TypeResultat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeResultat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KemistraMainBundle:TypeResultat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeResultat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typeresultat'));
    }

    /**
     * Creates a form to delete a TypeResultat entity by id.
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

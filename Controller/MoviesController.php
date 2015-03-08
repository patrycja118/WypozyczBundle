<?php

namespace Patrycja\WypozyczBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Patrycja\WypozyczBundle\Entity\Movies;
use Patrycja\WypozyczBundle\Form\MoviesType;

/**
 * Movies controller.
 *
 * 
 */
class MoviesController extends Controller
{

    /**
     * Lists all Movies entities.
     *
     * @Route("/", name="movies")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PatrycjaWypozyczBundle:Movies')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Movies entity.
     *
     * @Route("/", name="movies_create")
     * @Method("POST")
     * @Template("PatrycjaWypozyczBundle:Movies:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Movies();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('movies_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Movies entity.
     *
     * @param Movies $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Movies $entity)
    {
        $form = $this->createForm(new MoviesType(), $entity, array(
            'action' => $this->generateUrl('movies_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Movies entity.
     *
     * @Route("/new", name="movies_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Movies();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Movies entity.
     *
     * @Route("/{id}", name="movies_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $movie = $em->getRepository('PatrycjaWypozyczBundle:Movies')->find($id);
        $em = $this->getDoctrine()->getManager();
        $actor = $em->getRepository('PatrycjaWypozyczBundle:AActors')->findAll();
        $Specy = $this->getDoctrine()
        ->getRepository('PatrycjaWypozyczBundle:Species')->findAll();

        if (!$movie) {
            throw $this->createNotFoundException('Unable to find Movies movie.');
        }

       // return $this->render('PatrycjaWypozyczBundle:Movies:show.html.twig', array(
           // 'movie' => $movie,
            //'movies' => $movies,
           //'aactors' => $actor
            //'Species' => $species
        //));

        $deleteForm = $this->createDeleteForm($id);

         return $this->render('PatrycjaWypozyczBundle:Movies:show.html.twig', array(
            'movie'      => $movie,
            'aactors' => $actor,
            'species' => $Specy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Movies entity.
     *
     * @Route("/{id}/edit", name="movies_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PatrycjaWypozyczBundle:Movies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movies entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Movies entity.
    *
    * @param Movies $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Movies $entity)
    {
        $form = $this->createForm(new MoviesType(), $entity, array(
            'action' => $this->generateUrl('movies_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Movies entity.
     *
     * @Route("/{id}", name="movies_update")
     * @Method("PUT")
     * @Template("PatrycjaWypozyczBundle:Movies:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PatrycjaWypozyczBundle:Movies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('movies_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Movies entity.
     *
     * @Route("/{id}", name="movies_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PatrycjaWypozyczBundle:Movies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Movies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('movies'));
    }

    /**
     * Creates a form to delete a Movies entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('movies_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

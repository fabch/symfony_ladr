<?php

namespace LADR\ContactBundle\Controller;

use AppBundle\Entity\Contact;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all Contact entities.
     *
     * @Route("/contacts", name="ladr_contact_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('LADRContactBundle:contact:index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Creates a new Contact entity.
     *
     * @Route("/contacts/ajouter", name="ladr_contact_new")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('LADR\ContactBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('ladr_contact_show', array('id' => $contact->getId()));
        }

        return $this->render('LADRContactBundle:contact:new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/contacts/{id}/visualiser", name="ladr_contact_show")
     * @Method({"GET"})
     */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('LADRContactBundle:contact:show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     * @Route("/contacts/{id}/modifier", name="ladr_contact_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('LADR\ContactBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('ladr_contact_edit', array('id' => $contact->getId()));
        }

        $this->getUser();
        return $this->render('LADRContactBundle:contact:edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contact entity.
     *
     * @param Request $request
     * @param Contact $contact
     *
     * @Route("/contacts/{id}", name="ladr_contact_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('ladr_contact_index');
    }

    /**
     * Creates a form to delete a Contact entity.
     *
     * @param Contact $contact The Contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ladr_contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

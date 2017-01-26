<?php
namespace LADR\SecurityBundle\Controller;

use AppBundle\Entity\Access;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccessController extends Controller
{

    /**
     * Manage accesses
     *
     * @param Request $request
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/accesses", name="ladr_security_access_index")
     * @Method({"GET", "POST"})
     */
    public function indexAccessAction(Request $request){

        $accesses = $this->getDoctrine()->getRepository('AppBundle:Access')->findAll();
        return $this->render('LADRSecurityBundle:Access:index.html.twig', array(
            'accesses'    => $accesses
        ));
    }

    /**
     * Add a Access entity.
     *
     * @param Request $request
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/accesses/add", name="ladr_security_access_new")
     * @Method({"GET", "POST"})
     */
    public function addAccessAction(Request $request){

        $access = new Access();
        /** @var Form $form */
        $form = $this->createForm($this->getParameter('ladr.form.security.access.class'), $access, array(
            'action' => $this->generateUrl('ladr_security_access_new'),
            'method' => 'POST',
            'validations_group' => array('Create')
        ));
        $form->add('submit',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*
            $username = $access->getContact() !== null ? $this->get('ladr.util.username_generator')->generateUsernameFor($access->getContact());
            $plainPassword = $this->get('ladr.util.password_generator')->generatePassword();
            $access->setUsername($username);
            $access->setPassword($this->get('security.password_encoder')->encodePassword($access, $plainPassword));
            */

            $password = $this->get('security.password_encoder')
                ->encodePassword($access, $access->getPlainPassword());
            $access->setPassword($password);
            $access->setCreatedAt(new \Datetime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($access);
            $em->flush();

            return $this->redirectToRoute('ladr_security_access_index');
        }

        return $this->render(':default:form.html.twig', array(
            'form'    => $form->createView()
        ));
    }


    /**
     * Edit access entity
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/accesses/{id}/edit", name="ladr_security_access_edit")
     * @Method({"GET","POST"})
     */
    public function editAccessAction(Request $request, Access $access)
    {
        /** @var Form $form */
        $form = $this->createForm($this->getParameter('ladr.form.security.access.class'), $access, array(
            'action' => $this->generateUrl('ladr_security_access_edit', array('id' => $access->getId())),
            'method' => 'POST'
        ));
        $form->add('submit',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($access);
            $em->flush();

            return $this->redirectToRoute('ladr_security_access_index');
        }

        return $this->render(':default:form.html.twig', array(
            'form'    => $form->createView()
        ));

    }

    /**
     * Deletes a Access entity.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/accesses/{id}/remove", name="ladr_security_access_remove")
     * @Method({"DELETE"})
     */
    public function removeAccessAction(Request $request, Access $access)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('ladr_security_access_remove', array('id' => $access->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($access);
            $em->flush();

            return $this->redirectToRoute('ladr_security_access_index');
        }

        throw $this->createNotFoundException();
    }
}
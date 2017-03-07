<?php
namespace LADR\SecurityBundle\Controller;

use AppBundle\Entity\Access;

use LADR\SecurityBundle\Form\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/login", name="ladr_security_login")
     * @Method({"GET"})
     */
    public function loginAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('LADRSecurityBundle:Security:login.html.twig',array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }

    /**
     * @param Request $request
     *
     * @Route("/login_check", name="ladr_security_login_check")
     * @Method({"POST"})
     */
    public function loginCheckAction(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/register", name="ladr_security_register")
     * @Method({"GET","POST"})
     */
    public function registerAction(Request $request)
    {
        $access = new Access();
        $access->addRole('ROLE_USER');
        $form = $this->createForm($this->getParameter('ladr.form.security.register.class'), $access);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($access, $access->getPlainPassword());
            $access->setPassword($password);
            $access->setCreatedAt(new \Datetime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($access);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Registration success');
            return $this->redirectToRoute('ladr_security_login');
        }

        return $this->render('LADRSecurityBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/change-mot-de-passe", name="ladr_security_change_password")
     * @Method({"GET","POST"})
     */
    public function changePasswordAction(Request $request)
    {
        $access = $this->getUser();
        $form = $this->createForm($this->getParameter('ladr.form.security.change_password.class'), $access);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($access, $access->getPlainPassword());
            $access->setPassword($password);
            $access->setLastLogin(new \Datetime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($access);
            $em->flush();

            $token = new UsernamePasswordToken($this->getUser(), null, 'main', $this->getUser()->getRoles());

            $this->get('security.token_storage')->setToken($token);

            $this->addFlash('success', 'Votre mot de passe à été modifié avec succès');
            return $this->redirectToRoute('admin');
        }

        return $this->render('LADRSecurityBundle:Security:change_password.html.twig',
            array('form' => $form->createView())
        );
    }
}
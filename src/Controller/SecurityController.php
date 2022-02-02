<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        //parent::__construct();
        $this->hasher = $hasher;
    }


    /**
     * @return Response
     * @Route ("/registration", name="RegistrationPage")
     */
    public function registrationPage(){
        return $this->render('registration/registration.html.twig');
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route ("/createUsers", name="createUsers", methods={"POST"})
     */
    public function createUsers(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $hasher){
        if ($request->isMethod('POST')) {
            if (!empty($request->request->get('password')) && !empty($request->request->get('password2')) 
                && $request->request->get('password') === $request->request->get('password2')) {
                $user = new User();
                $user->setName($request->request->get('Name'))
                    ->setLastname($request->request->get('lastName'))
                    ->setEmail($request->request->get('email'))
                    ->setPassword($hasher->hashPassword($user, $request->request->get('password')))
                    ->setcreateCount(new \DateTime());
        
                $entityManager->persist($user);
                $entityManager->flush(); //query
        
                return $this->redirectToRoute('HomePage');

            }
        }
    }

    /**
     * @return Response
     * @Route("/profile" , name="ProfilPage")
     */
    public function UserShow(){
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $user = $this->getUser();
        /*404*/
        if (!$user) {
           return $this->render('bundles/TwigBundle/Exception/error404.html.twig',[ ]);
        }
        return $this->render('profil/profil.html.twig',[
            "user" => $user,
        ]);
    }
    
    
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

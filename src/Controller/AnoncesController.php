<?php

namespace App\Controller;

use App\Entity\Anonces;
use App\Entity\QuestionsAnonces;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AnoncesController extends AbstractController
{

    //private Security $security;
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/posts" , name="Anonces")
     */
    public function posts(EntityManagerInterface $entityManager){
        $repository = $entityManager->getRepository(Anonces::class);
        $anonces = $repository->findAll();
        /*404*/
        if (!$anonces) {
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig',[ ]);
        }

        return $this->render('anoncesFolder/anonces/anonces.html.twig',[
            'anonces' => $anonces
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $ids
     * @return Response
     * @Route("/post/{ids}" , name="ShowAnonces")
     */
    public function post($ids,EntityManagerInterface $entityManager){
        $repository = $entityManager->getRepository(Anonces::class);
        $repositoryquestions = $entityManager->getRepository(QuestionsAnonces::class);

        // if ($this->security->getUser()) {
        //     $this->logger->info($this->security->getUser());
        //     dd($this->logger->info($this->security->getUser()));
        //     // $user = $this->getUser();
        //     // dd($user);
        // }
        
        $anonces = $repository->findBy(['id' => $ids]);
        $questions = $repositoryquestions->findBy(['Anonces' => $ids]);
        /*404*/
        if (!$anonces) {
           return $this->render('bundles/TwigBundle/Exception/error404.html.twig',[ ]);
        }
        return $this->render('anoncesFolder/anonce/anonce.html.twig',[
            "ids" => $ids,
            "anonces" => $anonces,
            "questions" => $questions
        ]);
    }

    /**
     * @Route ("/addAnonces", name="AddAnoncespage")
     * @return Response
     */
    public function addAnoncespage(){
        return $this->render('anoncesFolder/addanonce/addanonce.html.twig');
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route ("/createAnonces", name="createAnonces", methods={"POST"})
     */
    public function createAnonces(EntityManagerInterface $entityManager, Request $request){
        $anonces = new Anonces();
        $anonces->setTitle($request->request->get('title'))
            ->setDescription($request->request->get('description'))
            ->setPrix($request->request->get('prix'))
            ->setImage($request->request->get('image'))
            ->setTags($request->request->get('tags'))
            ->setcreatePost(new \DateTime());

        $entityManager->persist($anonces);
        $entityManager->flush(); //query

        return $this->redirectToRoute('HomePage');
    }

    // /**
    //  * @param EntityManagerInterface $entityManager
    //  * @param Request $request
    //  * @return Response
    //  * @Route ("/createAnoncesquestions", name="createAnoncesquestions", methods={"POST"})
    //  */
    // public function createAnoncesquestions(EntityManagerInterface $entityManager, Request $request){
    //     $user = $this->getUser();
    //     dd($user);


    //     $anoncesQuestionss = new QuestionsAnonces();
    //     $anoncesQuestionss->setContent($request->request->get('title'))
    //         ->setAnonces($request->request->get('description'))
    //         ->setUser($request->request->get('prix'));

    //     $entityManager->persist($anoncesQuestionss);
    //     $entityManager->flush(); //query

    //     return $this->redirectToRoute('HomePage');
    // }

    /**
     * @param Anonces $anonces
     * @return Response
     * @Route ("/modify/{ids}/anonces", name="modifyAnoncespage")
     * 
     */
    public function modifyAnoncespage(Anonces $anonces){
        return $this->render('anoncesFolder/modifyanonce/modifyanonce.html.twig',[
            'anonces' => $anonces
        ]);
    }

    /**
     * @param Anonces $anonces
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route ("/update/{ids}/anonces", name="updateAnonces", methods={"POST"})
     */
    public function updateAnonces(Anonces $anonces, EntityManagerInterface $entityManager, Request $request){
        $anonces->setTitle($request->request->get('title'))
            ->setDescription($request->request->get('description'))
            ->setPrix($request->request->get('prix'))
            ->setImage($request->request->get('image'))
            ->setTags($request->request->get('tags'));

        $entityManager->flush(); //query

        return $this->redirectToRoute('HomePage');
    }

    /**
     * @param Anonces $anonces
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/delete/{ids}/anonces", name="deleteAnonces")
     */
    public function deleteAnonces(Anonces $anonces, EntityManagerInterface $entityManager){
        $entityManager->remove($anonces);
        $entityManager->flush();
        
        return $this->redirectToRoute('/posts');
    }
}

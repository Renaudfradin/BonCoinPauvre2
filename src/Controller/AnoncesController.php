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
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class AnoncesController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/posts" , name="Anonces")
     */
    public function posts(EntityManagerInterface $entityManager,PaginatorInterface $paginatorInterface, Request $request){
        $repository = $entityManager->getRepository(Anonces::class);
        $anonces = $repository->findAll();
        /*404*/
        if (!$anonces) {
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig',[ ]);
        }

        $paginationAnonces = $paginatorInterface->paginate(
            $anonces,
            $request->query->getInt('page',1),
            20
        );

        return $this->render('anoncesFolder/anonces/anonces.html.twig',[
            'anonces' => $paginationAnonces
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
        $anonces = $repository->findOneBy(['id' => $ids]);

        $questions = $repositoryquestions->findBy(['Anonces' => $ids]);
        //dd($questions);

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
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('anoncesFolder/addanonce/addanonce.html.twig');
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route ("/createAnonces", name="createAnonces", methods={"POST"})
     */
    public function createAnonces(EntityManagerInterface $entityManager, Request $request){
        if ($request->isMethod('POST')) {
            if (!empty($request->request->get('title')) 
            && !empty($request->request->get('description')) 
            && !empty($request->request->get('prix'))
            && !empty($request->files->get('image'))
            && !empty($request->request->get('tags'))) 
            {
                $anonces = new Anonces();
                $newfiles = $request->files->get('image');
                $destinations = $this->getParameter('kernel.project_dir').'\public\image\uploads\anonces';
                $originalName = $newfiles->getClientOriginalName();

                $baseFileName = pathinfo($originalName, PATHINFO_FILENAME);

                $filesName = $baseFileName . '-'. uniqid() . '.' . $newfiles->guessExtension();
                $newfiles->move($destinations, $filesName);
                $chemin = "/image/uploads/anonces/".$filesName;

                $anonces->setTitle($request->request->get('title'))
                    ->setDescription($request->request->get('description'))
                    ->setPrix($request->request->get('prix'))
                    ->setImage($chemin)
                    ->setTags($request->request->get('tags'))
                    ->setcreatePost(new \DateTime());
                //->setUserAnonces(45);

                $entityManager->persist($anonces);
                $entityManager->flush(); //query

                //$this->addFlash('success','yo');
                return $this->redirectToRoute('HomePage');
            } else {
                return $this->render('anoncesFolder/addanonce/addanonce.html.twig');
            }
            
        }
        
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
     * @return Response
     * @Route ("/modify/{ids}/anonces", name="modifyAnoncespage")
     */
    public function modifyAnoncespage(EntityManagerInterface $entityManager,$ids){
        $repository = $entityManager->getRepository(Anonces::class);
        $anonces = $repository->findBy(['id' => $ids]);
        return $this->render('anoncesFolder/modifyanonce/modifyanonce.html.twig',[
            'anonce' => $anonces,
            'ids' => $ids
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route ("/update/{ids}", name="updateAnonces", methods={"POST"})
     */
    public function updateAnonces(EntityManagerInterface $entityManager, Request $request,$ids,ManagerRegistry $doctrine){
        $entityManager = $doctrine->getManager();
        $anonces = $entityManager->getRepository(Anonces::class)->find($ids);
        if ($request->isMethod('POST')) {
            
            $newfiles = $request->files->get('image');
            $destinations = $this->getParameter('kernel.project_dir').'\public\image\uploads\anonces';
            //$originalName = $newfiles->getClientOriginalName();

            //$baseFileName = pathinfo($originalName, PATHINFO_FILENAME);

            $filesName =  uniqid() . '.' . $newfiles->guessExtension();
            $newfiles->move($destinations, $filesName);
            $chemin = "/image/uploads/anonces/".$filesName;


            $anonces->setTitle($request->request->get('title'))
                ->setDescription($request->request->get('description'))
                ->setPrix($request->request->get('prix'))
                ->setImage($chemin)
                ->setTags($request->request->get('tags'));
        
            $entityManager->persist($anonces);
            $entityManager->flush(); //query

            return $this->redirectToRoute('HomePage');
        }
        
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/delete/{ids}/anonces", name="deleteAnonces")
     */
    public function deleteAnonces(EntityManagerInterface $entityManager,$ids,ManagerRegistry $doctrine){
        $entityManager = $doctrine->getManager();
        $anonces = $entityManager->getRepository(Anonces::class)->find($ids);
        $entityManager->remove($anonces);
        $entityManager->flush();
        
        return $this->redirectToRoute('HomePage');
    }
}

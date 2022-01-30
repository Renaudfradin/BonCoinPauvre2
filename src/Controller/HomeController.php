<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
     /**
     *@Route("/", name="HomePage")
     *@return Response
     */

    public function homepage(){
        //$nombres = [1,2,3,5,9,10,11,65,45,22];

        return $this->render('home/homepage.html.twig', [
            // 'nom' => "bar",
            // 'nombres' => $nombres
        ]);
    }
}

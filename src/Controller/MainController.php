<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $post = $this->getDoctrine()
        ->getRepository('App\Entity\Post')
        ->findAll();
        return $this->render(
            'main/index.html.twig',
            array('post' => $post)
        );
    }
}

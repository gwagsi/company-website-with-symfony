<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $post = $this->getDoctrine()
            ->getRepository('App\Entity\Post')
            ->findAll();
            return $this->render(
                'blog/index.html.twig',
                array('post' => $post)
            );
    }
    public function blogDetail($id)
    {
        $post = $this->getDoctrine()
            ->getRepository('App\Entity\Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        return $this->render(
            'blog/blog-detail.html.twig',
            array('post' => $post)
        );
    }

  
}

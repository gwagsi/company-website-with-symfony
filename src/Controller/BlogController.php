<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
    public function blogDetail(Request $request,$id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect('/blog-detail/' . $comment->getId());

        }
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
            array('post' => $post,'form' => $form->createView())
        );
    }

  
}

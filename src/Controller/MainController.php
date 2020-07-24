<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\PostTranslation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function index(TranslatorInterface $translator, Request $request, PaginatorInterface $paginator)
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([],['id' => 'desc']);

        $post = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1),
            3 
        );
        
        return $this->render('main/index.html.twig', [
            'post' => $post,
        ]);
    }

}

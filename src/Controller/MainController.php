<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
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
            $posts, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        
        return $this->render('main/index.html.twig', [
            'post' => $post,
        ]);
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\PostTranslation;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([],['id' => 'desc']);

        $post = $paginator->paginate(
            $posts, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        
        return $this->render('blog/index.html.twig', [
            'post' => $post,
        ]);
    }
    public function blogDetail(Request $request,$id)
    {
        $post = $this->getDoctrine()
        ->getRepository('App\Entity\Post')
        ->find($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }
        $em = $this->getDoctrine()->getManager();
        $showComment = $em->getRepository('App\Entity\Comment')->find($id);
        return $this->render(
            'blog/blog-detail.html.twig',
            array('post' => $post,'showComment' => $showComment,)
        );
    }

  
}

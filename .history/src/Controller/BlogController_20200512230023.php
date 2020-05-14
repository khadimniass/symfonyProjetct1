<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles= $repo ->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=>$articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/blog/{id<[0-9]+>}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig',
        ['article'=>$article
    ]);
    }

    /**
     * @Route("/blog/new", name="create_show")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $article=new Article();
        $form=$this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')
        ->getForm();

        return $this->render('blog/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
}
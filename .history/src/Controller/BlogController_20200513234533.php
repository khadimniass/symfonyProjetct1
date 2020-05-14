<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
// use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Repository\ArticleRepository;

// use Doctrine\Common\Persistence\ObjectManager;



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
     * @Route("/blog/new", name="create_show")
     */
    public function create(Request $request,EntityManagerInterface $manager)
    // public function create(Request $request)
    {
        $article=new Article();
        $form=$this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')
        ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article-> getCreatedAt(new \DateTime());

            $manager->persist($article);
            $manager->flush();
            
            return $this->redirectToRoute('blog_show',['id' =>$article->getId()]);
        }
        return $this->render('blog/create.html.twig',[
            'formArticle'=>$form->createView()
            ]);
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
    }
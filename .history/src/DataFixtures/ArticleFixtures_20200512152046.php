<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <=10 ; $i++) { 
            $article =new Article();
            $article->setTitle("Titre de l'article n° ".$i."<br>")
                    ->setContent("<p>Contenu de l'article n° </p>".$i."<br>")
                    ->setImage("//via.placeholder.com/350x150")
                    ->setCreatedAt(new \DateTime());

            $manager->persist($article);
        }
        $manager->flush();
    }
}

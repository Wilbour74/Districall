<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Form\ArticleType;
class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function getArticle(ArticleRepository $articleRepo, Request $request): Response
    {
        $articles = $articleRepo->findAll();
        $newArticle = new Article();
        $form = $this->createForm(ArticleType::class, $newArticle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $Newarticle = $form->getData();
            
            $entityManager->persist($newArticle);
            $entityManager->flush();


        }

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form,
            "articles" => $articles,
        ]);
    }
}

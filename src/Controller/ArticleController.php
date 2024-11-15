<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créez un nouvel objet Article
        $article = new Article();
    
        if ($request->isMethod('POST')) {
            // Cas 1 : Requête JSON (Postman, API REST)
            if (str_contains($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                dd("Contenu brut du corps :", $data);
    
                if ($data) {
                    $article->setNom($data['nom'] ?? null);
                    $article->setDescription($data['description'] ?? null);
                    $article->setPrixUnitaire($data['prix'] ?? null);
                    $article->setStock($data['stock'] ?? null);
                }
            }
    
            // Cas 2 : Requête avec formulaire HTML
            else {
                $form = $this->createForm(ArticleType::class, $article);
                $form->handleRequest($request);
    
                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->persist($article);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
                }
    
                // Pour debugger les données du formulaire
                dump("Données du formulaire :", $form->getData());
            }
        }
    
        // Créez et passez le formulaire pour le navigateur
        $form = $this->createForm(ArticleType::class, $article);
    
        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
}

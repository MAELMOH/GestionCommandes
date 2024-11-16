<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleService
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    // Fonction pour obtenir tous les articles disponibles
    public function getAvailableArticles(): array
    {
        return $this->articleRepository->findAvailableArticles();
    }

    // Fonction pour sauvegarder un article
    public function saveArticle(Article $article): void
    {
        $this->articleRepository->save($article);
    }

    // Fonction pour supprimer un article
    public function deleteArticle(Article $article): void
    {
        $this->articleRepository->remove($article);
    }
    
    // Fonction pour récupérer tous les articles via le repository
    public function getAllArticles(): array
    {
        return $this->articleRepository->getAllArticles();
    }
}

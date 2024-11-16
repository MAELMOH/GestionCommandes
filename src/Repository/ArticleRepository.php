<?php
namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // Fonction pour récupérer tous les articles
    public function getAllArticles(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Fonction pour sauvegarder un article
    public function save(Article $article): void
    {
        $entityManager = $this->getEntityManager(); // Accéder à l'EntityManager
        $entityManager->persist($article);
        $entityManager->flush();
    }

    // Fonction pour supprimer un article
    public function remove(Article $article): void
    {
        $entityManager = $this->getEntityManager(); // Accéder à l'EntityManager
        $entityManager->remove($article);
        $entityManager->flush();
    }

}

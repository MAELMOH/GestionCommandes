<?php
namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    // Fonction pour récupérer toutes les commandes
    public function getAllCommandes(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.date', 'DESC') // Exemple : Tri par date décroissante
            ->getQuery()
            ->getResult();
    }

    // Fonction pour sauvegarder une commande
    public function save(Commande $commande): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($commande);
        $entityManager->flush();
    }

    // Fonction pour supprimer une commande
    public function remove(Commande $commande): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($commande);
        $entityManager->flush();
    }
}

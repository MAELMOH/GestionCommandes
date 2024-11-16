<?php
namespace App\Service;

use App\Repository\CommandeRepository;
use App\Entity\Commande;

class CommandeService
{
    private $commandeRepository;

    public function __construct(CommandeRepository $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    // Fonction pour récupérer toutes les commandes
    public function getAllCommandes(): array
    {
        return $this->commandeRepository->getAllCommandes();
    }

    // Fonction pour sauvegarder une commande
    public function saveCommande(Commande $commande): void
    {
        $this->commandeRepository->save($commande);
    }

    // Fonction pour supprimer une commande
    public function deleteCommande(Commande $commande): void
    {
        $this->commandeRepository->remove($commande);
    }
}

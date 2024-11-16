
# **GestionCommandes**

Application web pour la gestion des commandes et des articles, développée avec Symfony 6 et MySQL.

---

## **Prérequis**

Avant de commencer, assurez-vous que votre environnement est prêt :

- **PHP 8.1 ou supérieur** : Symfony 6 nécessite PHP 8.1 au minimum.
- **Composer** : Gestionnaire de dépendances PHP.
- **MySQL** : Système de gestion de base de données relationnelle.
- **Git** : Pour cloner le dépôt GitHub.

---

## **Installation**

### Étape 1 : Cloner le projet
Clonez ce dépôt GitHub sur votre machine locale :

```bash
git clone https://github.com/MAELMOH/GestionCommandes.git
cd GestionCommandes
```

---

### Étape 2 : Installer les dépendances
Installez les dépendances nécessaires avec Composer :

```bash
composer install
```

---

### Étape 3 : Configurer l'environnement
1. Copiez le fichier `.env` pour créer un fichier personnalisé :
   ```bash
   cp .env .env.local
   ```
2. Modifiez le fichier `.env.local` pour configurer la connexion à votre base de données MySQL :
   ```
   DATABASE_URL="mysql://nom_utilisateur:mot_de_passe@127.0.0.1:3306/nom_de_la_base_de_données?serverVersion=8&charset=utf8mb4"
   ```
   Remplacez `nom_utilisateur`, `mot_de_passe` et `nom_de_la_base_de_données` par vos informations.

---

### Étape 4 : Créer et configurer la base de données
1. Créez la base de données :
   ```bash
   php bin/console doctrine:database:create
   ```
2. Exécutez les migrations pour créer les tables nécessaires :
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

---

### Étape 5 : Charger les données de démonstration (Optionnel)
Si des fixtures sont disponibles, chargez-les pour peupler la base de données avec des données de test :

```bash
php bin/console doctrine:fixtures:load
```

---

### Étape 6 : Lancer le serveur local
Démarrez le serveur de développement Symfony :

```bash
php bin/console server:start
```

L'application sera accessible à l'adresse [http://localhost:8000](http://localhost:8000).

---

## **Fonctionnalités**

- **Gestion des articles** :
  - Ajouter, modifier et supprimer des articles.
  - Suivi du stock disponible.
- **Gestion des commandes** :
  - Créer des commandes avec plusieurs articles et quantités spécifiques.
  - Mettre à jour le statut des commandes (*En attente, En cours, Livrée*).
  - Consulter les détails des commandes (articles, quantités, prix total).
- **Calcul automatique** du prix total d'une commande.

---

## **Structure de la base de données**

### Tables principales :
1. **Articles** :
   - `id`
   - `nom`
   - `description`
   - `prix_unitaire`
   - `stock`
2. **Commandes** :
   - `id`
   - `date`
   - `statut`
   - `utilisateur_id`
3. **Commandes_Articles** (table pivot) :
   - `commande_id`
   - `article_id`
   - `quantité`

---

## **Évolutivité**

- Ajouter des fonctionnalités comme :
  - Export des commandes en PDF.
  - Tableau de bord pour les statistiques.
  - Notifications pour les utilisateurs.

---

## **Contributeurs**

- **Auteur** : EL MOH MOHAMED AMINE.
- **GitHub** : [MAELMOH](https://github.com/MAELMOH).

---

## **Licence**

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).

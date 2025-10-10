# 🌥️ MyClouds : Projet CSC4101 , Lina Amelal

## Objectif du projet
**MyClouds** est une application web développée dans le cadre du module CSC4101.  
Elle permet de manipuler un modèle de données simple autour d’un thème choisi : ici, **les photos de nuages**.

L’application gère :
- des **inventaires personnels** de nuages (`CloudBox`),  
- des **photos** associées (`CloudPhoto`),  
- des **membres** (`Member`) pouvant posséder un inventaire,  
- et des **galeries** (`Gallery`) regroupant des photos sélectionnées.

Le projet a pour but d’apprendre à :
- structurer un projet Symfony complet ;
- créer et relier des entités Doctrine (1–N, 1–1, N–N) ;
- afficher et naviguer entre les données avec Twig ;
- gérer le front via Bootstrap ;
- et charger des données de test via les fixtures.

---

## Modèle de données

### Entités principales :
`CloudBox` : L’inventaire d’un membre (collection de photos). |
`CloudPhoto` : Une photo de nuage appartenant à une boîte. |
`Member` : Un utilisateur de l’application, lié à une CloudBox. |
`Gallery` : Une galerie publique regroupant plusieurs photos. |

### Relations :
- **1–N** : `CloudBox` → `CloudPhoto`  
  Une boîte contient plusieurs photos.  
- **1–1** : `Member` ↔ `CloudBox`  
  Un membre possède une seule boîte d’inventaire.  
- **N–N** : `Gallery` ↔ `CloudPhoto`  
  Une photo peut appartenir à plusieurs galeries.  

---

## Technologies utilisées
- **Symfony 6.4 (LTS)**  
- **Doctrine ORM**  
- **Twig**
- **Bootstrap 5** pour la mise en forme  
- **PHP 8.2+**  
- **Git** pour le suivi de version  

---

## Installation et lancement

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/<ton-login>/myclouds.git
   cd myclouds
   
2. **Installer les dépendances :**
   ```bash
   composer install

3. **Créer et initialiser la base de données :**
   ```bash
   symfony console doctrine:database:create
   symfony console doctrine:schema:create
   symfony console doctrine:fixtures:load -n

4.	Lancer le serveur :
    ```bash
  	symfony server:start

5.	Accéder à l’application :
    http://127.0.0.1:8000

   

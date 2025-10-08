# 🌥️ MyClouds

## Objectif du projet
MyClouds est une application web réalisée avec **Symfony 6.4**.  
Elle permet à une communauté de passionnés de photographie de nuages ☁️  
de partager leurs clichés en ligne sous forme d’inventaire personnel et de galeries publiques.

Chaque utilisateur peut :
- Gérer sa collection de photos de nuages dans son **inventaire personnel** ;
- Publier certaines photos dans une **galerie** visible par la communauté ;
- Consulter les galeries d’autres membres ;
- Ajouter des **marque-pages** sur ses photos préférées.

---

## Technologies utilisées
- PHP 8.2  
- Symfony 6.4  
- Doctrine ORM  
- Twig  
- Bootstrap (pour le front)  
- Git / GitHub pour le versionnement

---

## Structure de la base de données
Les entités principales du projet :
- `User` : les membres de la communauté
- `Collection` : l’inventaire personnel de chaque membre
- `Cloud` : les photos de nuages appartenant à un utilisateur
- `Gallery` : la partie publique affichant les photos partagées

Relations :
- Un `User` possède **un seul** `Collection`
- Un `Collection` contient **plusieurs** `Cloud`
- Un `Cloud` peut apparaître dans **plusieurs** `Gallery`

---

## Installation et lancement

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/<ton-login>/myclouds.git
   cd myclouds

# Marketplace : APPLICATION DE VENTES AUX ENCHÈRES

## Présentation

Il s’agit d’une application mobile « Marketplace » de produits numériques (PDF, images…). 

Tous les membres pourront acheter et vendre leurs produits. 

Chaque produit aura un prix de départ ainsi qu’une date de fin d’enchère. 

Un système de notification push sera mis en place et notifiera les utilisateurs sur leur smartphone (voir ci-dessous). 

Une interface web destinée aux administrateurs sera également mise en place. Elle permettra de gérer les offres mises aux enchères ainsi que les utilisateurs.


## Application mobile 

L’application mobile sera réalisée avec un Framework (React Native, Flutter…) ou en natif (Swift, Android, …). 

Les utilisateurs pourront s’inscrire et devront être connectés pour accéder au reste de l’application. 

Les « vues » obligatoires sont les suivantes :
- vue liste des produits
- vue produit (affiche les informations d’un produit sélectionné)
- vue mes produits
- vue mon compte


## API / Back-end

Le choix de la technologie back-end est libre (Laravel, NodeJS, Java…). L’utilisation de Google Firebase est cependant recommandée. 

Si Firebase est choisi : 

Les « Cloud Functions » devront être utilisées pour votre code back-end et la gestion d’évènements.

Si la technologie choisie est autre que Firebase : 

Vous devrez sécuriser l’authentification des utilisateurs par l’utilisations de Tokens d’authentification. 


## Application web 

Le choix de la technologie front-end pour le back-office est libre. 

Les pages obligatoires sont les suivantes :
- page connexion
- page tableau de bord (affiche des statistiques)
- page offres (liste des offres publiées)
- page offre (affiche les informations d’une offre et les enchères associés)
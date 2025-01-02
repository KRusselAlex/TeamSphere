# Vue.js Application

## Description

Cette application Vue.js offre une interface utilisateur moderne et réactive pour gérer les fonctionnalités spécifiques de votre projet. Elle est construite avec Vue 3 et utilise Vue Router pour la navigation et Vuex pour la gestion de l'état.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [Node.js](https://nodejs.org/en/) version 14 ou supérieure
- [npm](https://www.npmjs.com/) (gestionnaire de paquets)

## Installation

1. Clonez le dépôt sur votre machine locale :
   ```bash
   git clone 
Accédez au répertoire du projet :
``

bash
Copy code
npm install
Configuration
Avant de démarrer l'application, vous devez configurer les variables d'environnement. Créez un fichier .env à la racine de votre projet et ajoutez les variables suivantes :

makefile
Copy code
VITE_API_URL=http://127.0.0.1:8000/api/v1
VITE_LOCAL_SECRET_KEY=alex-secret-key
VITE_API_URL_EM=http://127.0.0.1:8000
VITE_API_URL : URL de l'API à utiliser pour les appels API.
VITE_LOCAL_SECRET_KEY : Clé secrète utilisée pour la gestion des sessions ou autres mécanismes de sécurité.
VITE_API_URL_EM : URL pour l'API EM, qui peut être utilisée pour d'autres services ou fonctionnalités.
Démarrer l'application
Pour démarrer l'application en mode développement, utilisez la commande suivante :

bash
Copy code
npm run serve
Cela lancera l'application à l'adresse suivante : http://localhost:8080

Scripts disponibles
npm run serve : Démarre le serveur de développement
npm run build : Compile et optimise le projet pour la production
npm run lint : Vérifie le code pour détecter d'éventuelles erreurs ou incohérences
Déploiement
Pour déployer l'application, suivez ces étapes :

Compilez le projet pour la production :

bash
Copy code
npm run build
Déployez le contenu généré dans le dossier dist sur votre serveur.

Contribution
Les contributions sont les bienvenues ! Si vous avez des suggestions ou souhaitez corriger des bugs, n'hésitez pas à créer un pull request.

Licence
Ce projet est sous licence MIT.

rust
Copy code

Cela permettra aux utilisateurs de comprendre rapidement les variables à configurer
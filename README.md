##  Captures d'écran

<div align="center">
  <img src="public/screenshots/list1.png"  alt="Liste des livres1">
  <img src="public/screenshots/list2.png"  alt="Liste des livres2">
  
  <img src="public/screenshots/avis.png" alt="Formulaire d'avis">
  <img src="public/screenshots/list-avis.png" alt="Ais des Lecteurs">
</div>
##  Structure de la base
### Table `books`
- id (bigint)
- title (string)
- author (string)
- published_at (date)
- created_at (timestamp)

### Table `reviews`
- id (bigint)
- book_id (foreignId)
- rating (integer)
- comment (text)
- created_at (timestamp)

##  Installation

1. **Cloner le dépôt** :

   git clone https://github.com/madinaaidara/livres-Avis-Laravel.git
   cd livres-Avis-Laravel
   
Lancer le serveur :

Au niveau du terminal:
php artisan serve
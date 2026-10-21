# Plan d’implémentation — vitrine et créations artisan

## Objectif

Permettre à un utilisateur de créer sa vitrine de professionnel de la pâtisserie, puis d’y gérer et présenter des créations individuelles. Le parcours doit rester distinct des demandes clients existantes.

Le libellé validé pour le bouton de création est **« Mein Schaufenster erstellen »**.

## Périmètre et décisions

- Langue de l’interface existante : allemand.
- Le profil artisan existant devient l’entrée vers la vitrine professionnelle; pas de nouveau rôle utilisateur dans cette tranche.
- Une création est une fiche de portfolio/vitrine, pas une commande vendable avec paiement.
- Une fiche contient au minimum un titre, une description et des photos. Le prix est facultatif; afficher soit une indication de prix, soit « auf Anfrage » lorsque pertinent.
- Les créations sont rattachées au profil artisan. Seul son propriétaire peut les créer et les gérer.
- Les catégories de spécialités déjà choisies lors de la création du profil continuent de fonctionner comme aujourd’hui.
- **Aucune modification au modèle `BakedGood`, ses migrations, seeds, API, données ou associations.** Les créations constituent une entité indépendante.

## Étape 1 — Cadrer « Mes créations »

### Travail

1. Vérifier les règles de médias et de stockage déjà utilisées par les profils et galeries.
2. Fixer le schéma minimal d’une création : artisan propriétaire, titre, description, prix indicatif facultatif, indicateur « sur demande », statut brouillon/publié, horodatages.
3. Définir la relation des médias à une création et les limites de nombre/type/taille selon les conventions existantes.
4. Définir les états vides, erreurs et confirmations en allemand.
5. Confirmer que publier une création ne l’envoie pas automatiquement aux clients et n’ouvre pas une commande ou un paiement.

### Critères d’acceptation

- Le périmètre décrit une fiche de présentation indépendante des spécialités `BakedGood` et des demandes `ServiceRequest`.
- Le prix peut être omis sans empêcher la publication.
- Les règles de médias et de propriété sont définies avant les migrations et écrans.

## Étape 2 — Navigation et espace Backprofi

### Travail

1. Remplacer **« Profil artisan erstellen »** par **« Mein Schaufenster erstellen »** dans la navigation partagée.
2. Vérifier les autres entrées vers la création de profil et harmoniser leur libellé lorsque le même parcours est visé.
3. Après création de profil, rendre accessibles les sections **Mein Schaufenster**, **Meine Kreationen** et **Anfragen** dans l’espace artisan.
4. Ajouter un état vide « aucune création » avec une explication courte et l’action **« Erste Kreation hinzufügen »**.
5. Préserver la navigation client et le renvoi vers la création du profil pour les utilisateurs qui n’en ont pas encore.

### Critères d’acceptation

- L’utilisateur sans profil voit le bouton validé et arrive au formulaire de création existant.
- Après création, l’utilisateur trouve un accès évident à ses créations et demandes.
- Un utilisateur ne disposant pas de profil ne peut pas accéder aux écrans de gestion des créations.

## Étape 3 — Gestion des créations

### Travail

1. Créer une entité et une migration dédiées aux créations, sans réutiliser ni modifier `BakedGood`.
2. Ajouter les routes protégées et les contrôleurs pour lister, créer, modifier, publier/dépublier et supprimer les créations.
3. Ajouter validation serveur et autorisation stricte par propriétaire; valider aussi les fichiers envoyés.
4. Construire les écrans allemands de liste, formulaire et état vide dans le layout de l’espace artisan.
5. Ajouter titre, description, médias et présentation facultative du prix; préserver les brouillons non publiés.
6. Afficher uniquement les créations publiées sur la vitrine publique du profil, dans une section distincte des spécialités et de la galerie générale.

### Critères d’acceptation

- Un artisan peut créer, éditer, publier, dépublier et supprimer ses propres fiches.
- Un autre artisan ne peut ni consulter en gestion ni modifier ces fiches.
- Les brouillons ne sont pas visibles publiquement; les fiches publiées apparaissent sur le profil public.
- Une création peut être publiée sans prix.
- Aucune fonctionnalité de panier, paiement, commande ou réservation n’est introduite.
- Le modèle et les données `BakedGood` restent inchangés.

## Ordre de livraison

1. Audit ciblé des médias, layout, routes et autorisations artisan.
2. Finalisation du schéma et des règles de publication.
3. Navigation et état vide de l’espace artisan.
4. Stockage, autorisations et gestion CRUD des créations.
5. Intégration à la vitrine publique.

## Hors périmètre

- Renommer ou remodeler `BakedGood` ou ses catégories.
- Transformer les créations en produits avec inventaire, panier ou paiement.
- Modifier le workflow `ServiceRequest` ou les demandes de collaboration.
- Ajouter plusieurs rôles ou un nouveau processus d’inscription.

## État d’exécution

- [x] Étape 1 : périmètre des fiches, prix facultatif, brouillon/publication et médias définis.
- [x] Étape 2 : libellé validé appliqué, navigation artisan vers vitrine, créations et demandes ajoutée.
- [x] Étape 3 : stockage, gestion propriétaire, écrans de gestion et affichage public ajoutés.
- [x] `BakedGood` laissé inchangé.

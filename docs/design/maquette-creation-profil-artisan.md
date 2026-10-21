# Brief de maquette — Création et prévisualisation du profil artisan

**Produit :** Deliciousthings  
**Version :** 1.0 — 21 octobre 2026  
**Public :** artisans pâtissiers et cake designers de Berlin  
**Langue de l’interface à maquetter :** allemand  
**Statut :** spécification UX pour génération de maquettes

## Objectif de la page

Aider un artisan connecté à créer, enregistrer et publier un profil public convaincant sans transformer la configuration en formulaire intimidant. L’artisan peut quitter le parcours et reprendre plus tard. Le profil reste en brouillon tant qu’il n’a pas choisi de le publier.

La maquette couvre le parcours artisan complet :

1. Créer ou compléter les informations du profil.
2. Ajouter une à trois créations, chacune avec une à six photos.
3. Prévisualiser le profil public.
4. Revenir modifier le contenu ou publier le profil.
5. Après publication, retrouver l’état du profil, son lien public et son action de modification.

La création est distincte d’un projet privé ou d’une commande. Une création est une pièce de portfolio présentée publiquement.

## Principes UX

- Interface mobile-first, claire, chaleureuse et éditoriale ; éviter l’apparence d’un tableau de gestion dense.
- L’interface et les libellés visibles sont en allemand. Les annotations de ce document sont en français.
- Montrer une étape à la fois ou des sections courtes dans une page unique avec progression visible. Ne pas faire perdre les réponses en naviguant.
- Enregistrer automatiquement les changements et afficher un indicateur explicite « gespeichert » / « wird gespeichert ».
- Distinguer clairement les champs requis, facultatifs et les contenus encore manquants pour publier.
- Permettre la prévisualisation même si le profil est incomplet ; signaler les éléments manquants sans simuler de contenu.
- Une seule action principale par écran. Sur mobile, garder l’action principale accessible en bas lorsque le contenu est long.
- Employer les composants et le langage visuel existants du produit. Ne pas inventer de nouveaux logos, avis, notes, badges de certification ou statistiques.

## Parcours principal

```text
Espace artisan
  → Créer / compléter mon profil
  → Informations du profil
  → Offre et zone desservie
  → Ajouter des créations (1 à 3)
  → Prévisualiser
      ├─ Modifier une section → retour à la section concernée
      └─ Publier le profil → confirmation → profil public
```

L’artisan peut aussi enregistrer comme brouillon et sortir à chaque étape. À la prochaine visite, il reprend au tableau de bord du profil avec une liste des éléments terminés et à compléter.

## Structure des écrans

### 1. Entrée — Configuration du profil

Page dans l’espace artisan, avec titre tel que **« Dein Profil »** et une explication courte indiquant que le profil sera visible publiquement une fois publié.

Afficher :

- État sous forme de texte : **Entwurf** ou **Veröffentlicht**.
- Progression simple (par exemple « Profilinformationen », « Angebot », « Kreationen », « Vorschau »), sans pourcentage trompeur.
- Liste de complétude : informations du profil, zone/modes de service, au moins une création avec au moins une photo.
- Action principale : **« Profil bearbeiten »** ou **« Profil erstellen »**.
- Action secondaire : **« Öffentliche Vorschau ansehen »**, disponible même pour un brouillon.
- Après publication : **« Öffentliches Profil ansehen »**, **« Link kopieren »** et **« Profil bearbeiten »**.

Ne pas exposer de fausse date de dernière mise à jour ou de vue.

### 2. Formulaire — Identité et présentation

Section courte avec ces champs :

| Champ | Règle | Exemple de libellé allemand |
|---|---|---|
| Nom public | Requis | « Name deines Profils » |
| Présentation | Requise, maximum 500 caractères | « Erzähl kurz von dir und deiner Arbeit » |
| Spécialités | Requises, sélection multiple dans une liste contrôlée | « Was stellst du am liebsten her? » |
| Styles | Facultatifs, sélection multiple | « Welcher Stil passt zu deiner Arbeit? » |
| Image de couverture / portrait | Facultatif dans cette tranche, si pris en charge | « Profilbild oder Titelbild » |

Afficher le compteur de caractères de la présentation et une aide éditoriale concrète. Les listes de spécialités/styles sont faciles à parcourir et à modifier ; ne pas inventer de catégories très nombreuses. Prévoir un état « aucune sélection » et une validation compréhensible.

### 3. Formulaire — Zone et modalités

Section « Lieferung und Abholung » avec :

- Zone desservie : champ de ville/quartiers ou codes postaux, initialisé au contexte Berlin si approprié. Ne pas demander la géolocalisation du visiteur.
- Modes proposés : livraison, retrait, ou les deux. Au moins un mode doit être sélectionné.
- Délai indicatif de réponse ou de préparation : facultatif, présenté comme une information indicative, sans promesse de disponibilité.
- Acceptation de nouvelles demandes : interrupteur clair, avec libellés textuels **« Anfragen annehmen » / « Derzeit keine Anfragen »**. L’état fermé masque/désactive le CTA de contact public avec une explication.

Ne pas demander ici d’adresse résidentielle complète si la zone générale suffit. Ne pas montrer d’élément de carte qui suggérerait une précision non nécessaire.

### 4. Formulaire — Créations du portfolio

Section titrée **« Deine Kreationen »** qui explique qu’elles sont visibles sur le profil public et peuvent inspirer une demande.

- Entre une et trois créations peuvent être ajoutées dans le MVP.
- Chaque création a un nom requis, une description facultative et un prix indicatif facultatif en euros.
- Chaque création exige au minimum une photo et accepte au maximum six photos.
- Une création peut être enregistrée incomplète en brouillon, mais le profil n’est publiable que si chaque création ajoutée comporte un nom et une photo valide.
- Ajouter, retirer et réordonner les photos ; réordonner les créations.
- Pour chaque photo, demander un texte alternatif concis. Montrer un aperçu de l’image, son état d’envoi et son action de suppression.
- Proposer **« Kreation hinzufügen »** tant que la limite de trois n’est pas atteinte.
- Expliquer la limite « 1–6 Fotos pro Kreation » au moment de l’ajout, pas dans une aide éloignée.
- Si un prix est saisi, l’afficher avec la devise EUR et une mention « Richtpreis » ou « Preis auf Anfrage » selon le cas. Le prix ne déclenche pas de panier, de commande ou de réservation.

Chaque carte de création peut être développée pour l’édition. Prévoir les états sans création, en cours d’envoi, erreur d’envoi avec reprise, et limite de six photos atteinte.

### 5. Prévisualisation du profil

Présenter une véritable page de profil public dans une prévisualisation identifiable comme telle, sans les commandes d’édition dans la zone publique. Sur desktop, autoriser une prévisualisation côte à côte avec un panneau de vérification ; sur mobile, utiliser un bouton ou onglet **« Vorschau »**.

La prévisualisation comprend :

- Image de couverture ou traitement de remplacement si aucune image n’est fournie.
- Nom public, présentation, spécialités et styles renseignés.
- Zone générale et modes de livraison/retrait.
- État des demandes (ouvert/fermé) et CTA de contact si les demandes sont acceptées.
- Cartes de créations avec images, titres, descriptions et prix seulement lorsqu’ils sont saisis.
- Aucune donnée factice, aucun avis ou badge de vérification.

À côté ou en tête de la prévisualisation, afficher une liste des éventuelles actions nécessaires avant publication. Les champs manquants ont un lien **« Ergänzen »** qui ramène à la section appropriée.

Actions :

- **« Zurück bearbeiten »** — retour au formulaire sans perte.
- **« Als Entwurf speichern »** — conserve le brouillon.
- **« Profil veröffentlichen »** — activé uniquement lorsque les règles minimales sont satisfaites.

### 6. Confirmation de publication

Après publication, montrer une confirmation sobre : le profil est public et peut être consulté via son lien. Fournir **« Profil ansehen »**, **« Link kopieren »** et **« Weiter bearbeiten »**. Indiquer que l’artisan peut revenir modifier le profil ou le remettre en brouillon depuis son espace.

Ne pas afficher de mention de revue, vérification professionnelle ou validation manuelle dans le MVP de cette maquette.

## Règles de validation et états

- Profil publiable : nom public, présentation (≤ 500 caractères), spécialité, zone desservie, au moins un mode de service, état d’acceptation des demandes défini et au moins une création complète.
- Création complète : nom et au moins une photo. Une photo ne peut être comptée comme valide qu’après chargement réussi.
- Minimum et maximum par création : **1 à 6 photos**.
- Nombre maximal de créations : **3**.
- En cas d’erreur, conserver les champs saisis et donner une action de reprise.
- Les erreurs sont affichées près du champ concerné, avec un résumé visible si l’utilisateur doit corriger plusieurs champs.
- Prévoir chargement, sauvegarde, brouillon vide, reprise, erreurs réseau, publication réussie et état « profil non publié ».

## Responsive et accessibilité

- Desktop : largeur de lecture confortable, formulaire et aperçu éventuellement en deux colonnes.
- Mobile : sections empilées, téléversement utilisable au tactile, galerie défilable sans perte d’accès aux actions, boutons pleine largeur si nécessaire.
- Contraste et focus visibles, libellés persistants, erreurs associées aux champs, zones tactiles confortables.
- Donner une alternative textuelle aux images ; ne pas compter uniquement sur la couleur ou une icône pour indiquer l’état.

## Consigne à Claude pour les maquettes

Génère des maquettes cohérentes pour le parcours décrit, avec les libellés de l’interface en allemand. Montre au minimum les écrans de formulaire, gestion des créations/photos, prévisualisation sur desktop et mobile, et confirmation de publication. Utilise des contenus fictifs clairement éditoriaux (par exemple un cake design berlinois) sans inventer d’avis, de certifications, de nombres de clients ni de fonctions de paiement. Respecte strictement les limites d’une à trois créations et d’une à six photos par création. Les états brouillon et prévisualisation doivent être visibles dans les maquettes.

## Références produit

- `docs/brief-produit-mvp-deliciousthings.md` — sections 5.2, 5.2.1, 5.6, 5.8.
- `docs/plan-implementation-demandes.md` — tranche M1 et garde-fous architecture/design.

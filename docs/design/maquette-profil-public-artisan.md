# Brief de maquette — Profil public artisan, portfolio et créations

**Produit :** Deliciousthings  
**Version :** 1.0 — 21 octobre 2026  
**Marché :** Berlin, Allemagne  
**Langue de l’interface à maquetter :** allemand  
**Statut :** spécification UX pour génération de maquettes

## Objectif de la page

Permettre à un client de comprendre rapidement le travail d’un pâtissier, où il intervient et comment le contacter. Le profil met en avant les créations publiées par l’artisan. Il sert de point d’entrée vers une demande privée adressée à cet artisan ; il ne permet ni réservation ferme ni paiement.

La page est publique uniquement lorsque le profil est publié. Un profil en brouillon n’est visible que par son propriétaire dans l’espace de gestion et dans sa prévisualisation.

## Principes de conception

- Page éditoriale, mobile-first, visuelle et chaleureuse ; pas de tableau de bord ni de réseau social.
- Présenter les informations utiles au choix avant le CTA : spécialités, zone, modes de service, créations.
- L’interface est en allemand. Ne pas afficher d’avis, de note, de certification, de badge vérifié, de métrique ou de promesse non confirmée.
- Les créations sont des contenus publics distincts des demandes et projets privés.
- Les images d’une création forment une galerie de une à six photos. Une création publiée doit avoir un nom et au moins une photo.
- Les informations manquantes sont omises ou indiquées proprement ; ne jamais fabriquer des valeurs.
- Le CTA exprime une prise de contact, pas une commande : **« Anfrage senden »**.

## Parcours visiteur

```text
Résultat de recherche / création partagée / lien direct
  → Profil public artisan
  → Parcourir spécialités, zone et créations
      ├─ Ouvrir une création → galerie et détails → « Anfrage senden »
      └─ « Anfrage senden » depuis le profil
          → constructeur de demande ciblé sur cet artisan
```

Le formulaire de demande est hors de cette maquette, mais le profil doit fournir visuellement un point d’entrée clair et transmettre le contexte de l’artisan sélectionné. Une création peut également être conservée comme contexte de départ pour le formulaire.

## Hiérarchie de page

### 1. En-tête du site

Réutiliser l’en-tête public existant, avec accès de navigation et de compte selon le design du site. Garder la marque et le menu discrets pour que le profil et ses photos dominent.

### 2. Hero artisan

Afficher en premier :

- Photo de couverture ou portrait si l’artisan en a ajouté un ; sinon un traitement typographique cohérent, sans image stock trompeuse.
- Nom public de l’artisan.
- Phrase de présentation courte.
- Spécialités sous forme de libellés compacts.
- Zone générale (par exemple quartiers de Berlin ou zone desservie saisie par l’artisan).
- Indication de livraison et/ou retrait.
- CTA primaire **« Anfrage senden »** si l’artisan accepte les demandes.
- Si l’artisan n’accepte pas de nouvelles demandes, remplacer le CTA par un état informatif explicite, par exemple **« Derzeit keine Anfragen »** ; ne pas présenter un bouton actif qui ne fonctionne pas.

Ne pas afficher l’adresse privée complète. La page ne doit pas laisser entendre que la plateforme connaît la disponibilité en temps réel.

### 3. Présentation et offre

Section « Über mich » ou équivalent, avec le texte de présentation (maximum 500 caractères). Présenter ensuite :

- Spécialités et styles renseignés.
- Zone de service.
- Modes de remise.
- Délai de réponse/préparation seulement s’il a été saisi, précédé d’un qualificatif indicatif.

Éviter les doublons avec le hero : le hero résume, cette partie développe.

### 4. Portfolio — liste des créations

Section titrée **« Kreationen »** ou **« Meine Arbeiten »**. Les cartes sont l’élément principal de la page après le hero.

Chaque carte de création présente :

- Photo de couverture choisie dans sa galerie.
- Nom de la création.
- Description si fournie, limitée à quelques lignes dans la carte.
- Prix en euros uniquement si l’artisan l’a saisi ; le présenter comme indication, jamais comme devis ou prix garanti.
- Indice de galerie si plusieurs photos sont disponibles.
- Action **« Kreation ansehen »** ou ouverture de détail accessible au clavier.

Le profil peut contenir jusqu’à trois créations dans le périmètre actuel. La grille doit rester harmonieuse avec une, deux ou trois cartes. Ne pas combler une grille vide avec des exemples préchargés en production.

### 5. Détail d’une création

La maquette peut représenter le détail comme une page dédiée ou un panneau/modal accessible depuis le profil. Il doit contenir :

- Nom et description complète si disponible.
- Galerie navigable de une à six photos, avec contrôle précédent/suivant et position actuelle (ex. « 2 von 5 »).
- Texte alternatif prévu pour les lecteurs d’écran ; commandes utilisables au clavier.
- Prix facultatif, clairement indicatif.
- CTA **« Anfrage zu dieser Kreation senden »** qui démarre une demande au même artisan et conserve la création comme inspiration/contexte.
- Lien de retour au profil.

Ne pas ajouter de sélection de quantité, stock, panier, date de disponibilité ou bouton de réservation.

### 6. Pied de page et signalement

Réutiliser le pied de page public et les liens légaux existants. Si la fonction de signalement est représentée, elle reste discrète et mène à une action de signalement simple ; ne pas créer une interface d’administration dans cette maquette.

## Variantes et états à représenter

1. **Profil complet, demandes ouvertes** : toutes les sections et CTA actif.
2. **Profil complet, demandes fermées** : contenu consultable, CTA remplacé par une information claire.
3. **Profil avec une seule création** : composition équilibrée, sans emplacement vide pour une carte inexistante.
4. **Création avec plusieurs photos** : contrôles de galerie et compteur visibles.
5. **Création sans prix** : aucune zone de prix vide.
6. **Chargement ou image manquante** : remplacement visuel stable et texte accessible, sans casser la mise en page.

Le profil brouillon n’est pas une variante publique : le propriétaire y accède via la prévisualisation privée décrite dans `maquette-creation-profil-artisan.md`.

## Responsive et accessibilité

- Desktop : hero équilibré entre image et identité ; grille de créations en colonnes selon la largeur.
- Mobile : identité et CTA visibles tôt ; CTA accessible sans prendre une place excessive ; cartes sur une colonne ou défilement horizontal explicite et contrôlable.
- Respecter les zones de sécurité autour des images, leur ratio et une hauteur régulière pour les cartes.
- Contraste, focus visible, navigation clavier, boutons avec noms explicites, textes alternatifs et annonces des changements d’image.
- Ne pas utiliser la couleur seule pour distinguer demandes ouvertes/fermées.

## Contenu fictif suggéré pour la maquette

Exemple de démonstration : une cake designer basée à Berlin, spécialisée dans les gâteaux de célébration sculpturaux et les finitions florales. Utiliser un nom fictif, une courte biographie en allemand et des photos d’exemple cohérentes. Le contenu d’exemple ne doit pas suggérer une certification, une clientèle réelle, des avis ou une disponibilité confirmée.

## Consigne à Claude pour les maquettes

Crée une maquette desktop et mobile d’un profil public d’artisan pâtissier/cake designer à Berlin, avec les libellés visibles en allemand. Montre le hero, les informations de service, une grille de une à trois créations et au moins un état de détail de création avec galerie de plusieurs photos. Inclus une variante où l’artisan n’accepte pas de demandes. Le CTA démarre une demande privée et ne ressemble jamais à une réservation ou un achat. N’ajoute ni avis, ni badge de vérification, ni paiement, ni stock, ni disponibilité en temps réel. Le style doit rester cohérent avec un marketplace éditorial de pâtisserie et laisser les créations porter la page.

## Références produit

- `docs/brief-produit-mvp-deliciousthings.md` — sections 1, 4A/4D, 5.1, 5.2, 5.2.1, 5.8.
- `docs/plan-implementation-demandes.md` — parcours artisan et tranche M1.

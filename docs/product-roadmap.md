# DELICIOUSthings Product Roadmap

## Francais

### Vision Produit

DELICIOUSthings est une application Laravel + Inertia + Vue qui doit permettre aux clients de decouvrir et reserver des creations publiees par des artisans de la patisserie. Les clients doivent aussi pouvoir demander un gateau personnalise pour des evenements comme un mariage, un anniversaire, une baby shower ou une autre occasion speciale.

De leur cote, les artisans patissiers doivent pouvoir creer leur profil, presenter leur univers, publier jusqu'a trois creations reservables, et recevoir des demandes ou reservations de clients.

### Scope MVP

Le MVP doit se concentrer sur deux parcours principaux:

- Parcours client: decouvrir des creations, consulter un profil artisan, reserver une creation existante, envoyer une demande personnalisee.
- Parcours artisan: creer/modifier son profil, gerer jusqu'a trois creations, consulter les reservations et demandes recues.

Fonctionnalites prioritaires:

- Page d'accueil orientee decouverte.
- Listing public de creations.
- Fiche detail d'une creation.
- Profil public artisan.
- Reservation simple d'une creation.
- Demande personnalisee pour evenement.
- Espace artisan pour gerer profil et creations.
- Inbox artisan pour reservations, demandes personnalisees et messages.

Fonctionnalites a reporter:

- Paiement en ligne.
- Calendrier de disponibilites avance.
- Messagerie temps reel.
- Avis clients.
- Validation automatique complexe des artisans.
- Gestion fine des creneaux de retrait/livraison.

### Modele Metier Recommande

Le projet contient deja plusieurs concepts utiles: `Artisan`, `BakedGood`, `Service`, `Message`, `PreOrder`, `Media`, `Address`.

La notion centrale manquante est une creation publiee par un artisan. Il est recommande d'ajouter une entite `Creation`.

Entites principales recommandees:

- `Artisan`: profil professionnel de l'artisan.
- `Creation`: creation reservable publiee par un artisan.
- `Media`: photos associees aux artisans et aux creations, via relation polymorphique existante.
- `CreationReservation`: reservation d'une creation existante.
- `CustomCakeRequest`: demande de gateau personnalise.
- `Message`: message simple envoye a un artisan.

Exemple de champs pour `Creation`:

- `artisan_id`
- `title`
- `slug`
- `description`
- `price_amount`
- `price_currency`
- `serving_count`
- `minimum_notice_days`
- `status`: `draft` ou `published`
- `category`
- `occasion`
- `is_pickup_available`
- `is_delivery_available`

Regle metier importante:

- Un artisan peut gerer au maximum trois creations actives ou publiees. La recommandation actuelle est de limiter a trois creations totales non archivees, avec un statut brouillon/publie.

### Roadmap Technique

1. Refonte UI d'abord
   - Analyser les maquettes.
   - Extraire les principes visuels: couleurs, typographie, spacing, cartes, boutons, formulaires.
   - Decouper les maquettes en composants reutilisables.
   - Refaire progressivement les pages publiques puis l'espace artisan.

2. UI pages publiques
   - Refaire la page d'accueil.
   - Creer ou adapter le listing des creations.
   - Creer la fiche creation.
   - Refaire le profil public artisan.

3. UI espace artisan
   - Refaire l'edition du profil artisan.
   - Ajouter une interface de gestion des creations.
   - Afficher le compteur de limite: par exemple `2/3 creations`.
   - Preparer une interface pour les demandes recues.

4. Backend `Creation`
   - Ajouter migration, modele, relations et validations.
   - Ajouter les routes protegees artisan.
   - Ajouter les controles d'ownership.
   - Ajouter la limite de trois creations.
   - Reutiliser `Media` pour les photos.

5. Backend reservation
   - Ajouter `CreationReservation`.
   - Ajouter formulaire client.
   - Creer reservation en statut `pending`.
   - Notifier l'artisan par email.

6. Backend demande personnalisee
   - Ajouter `CustomCakeRequest`.
   - Permettre une demande generale ou adressee a un artisan.
   - Ajouter les statuts: `pending`, `accepted`, `declined`, `completed`, `cancelled`.

7. Inbox artisan
   - Regrouper reservations, demandes personnalisees et messages.
   - Permettre a l'artisan de consulter les details.
   - Ajouter des actions simples de changement de statut.

8. Nettoyage
   - Identifier les composants, routes et pages inutilises.
   - Renommer ce qui ne correspond plus au nouveau scope.
   - Supprimer le code mort.
   - Harmoniser routes, types TypeScript et libelles UI.

9. Tests et qualite
   - Tester la creation d'une creation.
   - Tester la limite de trois creations.
   - Tester qu'un artisan ne peut pas modifier les creations d'un autre artisan.
   - Tester la reservation d'une creation publiee.
   - Tester qu'une creation brouillon n'est pas reservable publiquement.
   - Tester la creation d'une demande personnalisee.

### Recommandation UI

La refonte doit partir des maquettes comme source de verite visuelle, tout en respectant les contraintes du code existant.

Approche recommandee:

- Commencer par un audit des layouts, composants et styles actuels.
- Construire un petit design system pragmatique.
- Utiliser les maquettes pour definir les pages et composants.
- Brancher d'abord l'UI sur les donnees existantes ou sur des donnees temporaires typees.
- Completer ensuite le backend manquant.

Direction visuelle:

- Chaleureuse, premium et claire.
- Photos de creations tres presentes.
- Interface client orientee decouverte et confiance.
- Interface artisan plus sobre, operationnelle et efficace.
- Eviter une palette dominee par une seule couleur.

### Organisation Des Threads

Pour eviter les conversations surchargees, organiser les threads par chantier stable:

- Produit & Scope
- UI Design System
- UI Pages Publiques
- UI Espace Artisan
- Backend Domaine
- Nettoyage & Refactor
- Tests & Qualite

Chaque nouveau thread doit commencer avec un court brief:

```txt
Contexte projet:
DELICIOUSthings est une app Laravel + Inertia + Vue pour decouvrir et reserver des creations de patisserie.

Objectif de ce thread:
Refaire la page d'accueil a partir des maquettes.

A respecter:
- garder l'architecture existante autant que possible
- UI premium/chaleureuse
- desktop + mobile
- ne pas toucher au backend sauf necessaire

Fichiers probables:
- resources/js/pages/Home.vue
- resources/js/components/...
- resources/css/...
```

## English

### Product Vision

DELICIOUSthings is a Laravel + Inertia + Vue application that should allow customers to discover and reserve pastry creations published by pastry artisans. Customers should also be able to request a custom cake for events such as weddings, birthdays, baby showers, or other special occasions.

On the artisan side, pastry artisans should be able to create their profile, present their style and expertise, publish up to three reservable creations, and receive customer reservations or custom requests.

### MVP Scope

The MVP should focus on two main user journeys:

- Customer journey: discover creations, view an artisan profile, reserve an existing creation, send a custom cake request.
- Artisan journey: create/edit a profile, manage up to three creations, review received reservations and requests.

Priority features:

- Discovery-focused home page.
- Public creation listing.
- Creation detail page.
- Public artisan profile.
- Simple creation reservation.
- Custom event cake request.
- Artisan area for profile and creation management.
- Artisan inbox for reservations, custom requests, and messages.

Features to postpone:

- Online payments.
- Advanced availability calendar.
- Real-time messaging.
- Customer reviews.
- Complex automatic artisan verification.
- Fine-grained pickup/delivery time slot management.

### Recommended Domain Model

The project already includes several useful concepts: `Artisan`, `BakedGood`, `Service`, `Message`, `PreOrder`, `Media`, and `Address`.

The central missing concept is a published creation made reservable by an artisan. The recommended addition is a `Creation` entity.

Recommended core entities:

- `Artisan`: professional artisan profile.
- `Creation`: reservable creation published by an artisan.
- `Media`: photos attached to artisans and creations through the existing polymorphic relation.
- `CreationReservation`: reservation for an existing creation.
- `CustomCakeRequest`: custom cake request.
- `Message`: simple message sent to an artisan.

Suggested fields for `Creation`:

- `artisan_id`
- `title`
- `slug`
- `description`
- `price_amount`
- `price_currency`
- `serving_count`
- `minimum_notice_days`
- `status`: `draft` or `published`
- `category`
- `occasion`
- `is_pickup_available`
- `is_delivery_available`

Important business rule:

- An artisan can manage at most three active or published creations. The current recommendation is to limit artisans to three non-archived creations, with a draft/published status.

### Technical Roadmap

1. UI redesign first
   - Analyze the mockups.
   - Extract visual principles: colors, typography, spacing, cards, buttons, forms.
   - Split mockups into reusable components.
   - Redesign public pages first, then the artisan area.

2. Public UI pages
   - Redesign the home page.
   - Create or adapt the creation listing.
   - Create the creation detail page.
   - Redesign the public artisan profile.

3. Artisan UI
   - Redesign artisan profile editing.
   - Add a creation management interface.
   - Display the creation limit counter, for example `2/3 creations`.
   - Prepare an interface for received requests.

4. `Creation` backend
   - Add migration, model, relations, and validations.
   - Add protected artisan routes.
   - Add ownership checks.
   - Add the three-creation limit.
   - Reuse `Media` for photos.

5. Reservation backend
   - Add `CreationReservation`.
   - Add the customer form.
   - Create reservations with `pending` status.
   - Notify the artisan by email.

6. Custom request backend
   - Add `CustomCakeRequest`.
   - Allow either a general request or a request addressed to a specific artisan.
   - Add statuses: `pending`, `accepted`, `declined`, `completed`, `cancelled`.

7. Artisan inbox
   - Group reservations, custom requests, and messages.
   - Allow artisans to inspect request details.
   - Add simple status change actions.

8. Cleanup
   - Identify unused components, routes, and pages.
   - Rename concepts that no longer match the new scope.
   - Remove dead code.
   - Harmonize routes, TypeScript types, and UI labels.

9. Tests and quality
   - Test creation creation.
   - Test the three-creation limit.
   - Test that an artisan cannot modify another artisan's creations.
   - Test reservation of a published creation.
   - Test that a draft creation cannot be reserved publicly.
   - Test custom cake request creation.

### UI Recommendation

The redesign should use the mockups as the visual source of truth while respecting the constraints of the existing codebase.

Recommended approach:

- Start with an audit of current layouts, components, and styles.
- Build a small pragmatic design system.
- Use the mockups to define pages and components.
- First connect the UI to existing data or typed temporary data.
- Complete the missing backend afterwards.

Visual direction:

- Warm, premium, and clear.
- Strong presence of creation photography.
- Customer-facing UI focused on discovery and trust.
- Artisan-facing UI should be calmer, operational, and efficient.
- Avoid a palette dominated by a single color.

### Thread Organization

To avoid overloaded conversations, organize threads by stable workstream:

- Product & Scope
- UI Design System
- Public UI Pages
- Artisan UI
- Backend Domain
- Cleanup & Refactor
- Tests & Quality

Each new thread should start with a short brief:

```txt
Project context:
DELICIOUSthings is a Laravel + Inertia + Vue app for discovering and reserving pastry creations.

Thread objective:
Redesign the home page from the mockups.

Constraints:
- keep the existing architecture as much as possible
- warm/premium UI
- desktop + mobile
- do not touch the backend unless necessary

Likely files:
- resources/js/pages/Home.vue
- resources/js/components/...
- resources/css/...
```

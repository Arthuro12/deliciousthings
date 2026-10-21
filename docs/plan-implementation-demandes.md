# Feuille de route MVP — Deliciousthings

## Objectif

Permettre à un client de transformer une idée de création pâtissière en brief partagé, puis de l’envoyer au pâtissier qu’il a choisi. L’artisan reçoit, qualifie et suit cette demande dans son espace. Le MVP sert les cake designers, pâtissiers indépendants et hobby bakers, ainsi que les clients préparant un anniversaire, mariage, baby shower, baptême ou autre événement.

Le principe produit est : idée → projet privé → demande ciblée → clarification/proposition → décision humaine → collaboration minimale. Une demande n’est ni une commande ni une réservation.

## Décisions de cadrage tirées des documents MVP

Les PDF décrivent à la fois un parcours avec artisan choisi et une marketplace avec comparaison de plusieurs propositions. Pour ne pas construire deux produits à la fois, le MVP retient les décisions suivantes :

1. La demande part du profil public ou du lien de demande d’un artisan précis. Elle lui est adressée en privé et n’apparaît jamais dans un flux public.
2. Pas d’envoi en masse, de matching automatique ni de marketplace ouverte au lancement. La comparaison multi-artisans sera réévaluée après validation du flux ciblé.
3. Project et ServiceRequest sont deux objets distincts : Project est l’espace privé et évolutif du client; ServiceRequest est le snapshot commercial transmis au destinataire. Un refus ne détruit pas le projet.
4. Un portfolio public est indépendant du projet privé. Aucun projet ni média client n’est publié implicitement.
5. Prix, disponibilité, faisabilité, acceptation et sécurité alimentaire restent des décisions humaines. Pas de commande, contrat, réservation, paiement, acompte ou certification allergène.
6. L’IA n’est pas requise. Le système doit rester utile sans IA; toute aide future prépare une suggestion qui doit être validée par un humain.
7. Conserver la stack, la structure de dossiers et les conventions actuelles : Laravel, Vue 3, Inertia, TypeScript, Vite, Sass/Tailwind et tokens de resources/css/base/_root.scss. Garder l’interface applicative en allemand, selon les pages existantes.

Ces décisions reprennent les principes du Scope, du PRD et de Communication structurée, et les objets Project/Request/Portfolio de l’Architecture Espace de travail. Le cahier Request Marketplace reste une source d’idées pour une évolution ultérieure, mais ses scénarios multi-artisans ne doivent pas rendre la demande actuelle publique.

## État du dépôt et stratégie

Le dépôt n’est pas vierge. Il contient User/Artisan, Services, Media et Addresses, Project/ProjectParticipant, Message, le constructeur et le modèle ServiceRequest, des états de demande, policies, migrations et pages de listes client/artisan. Il faut faire évoluer ces éléments, sans réécriture générale.

Écarts à auditer et traiter :

- Project existe, mais comparer sa page de création/détail et ses fonctions de collaboration aux besoins du MVP; certaines pages applicatives sont vides, incomplètes ou placeholders.
- Artisan possède déjà des champs de profil, des adresses, services et médias; l’édition, la page publique et la collection de créations ne forment pas encore un parcours complet.
- ServiceRequest porte les champs du brief et la réponse artisan; vérifier le destinataire effectif, le snapshot au moment de l’envoi, les clarifications, la visibilité et les modifications après envoi.
- Le constructeur prévoit un brouillon anonyme, alors que les routes de l’espace sont protégées par authentification. Il faut séparer l’entrée publique et les actions protégées, puis rattacher le brouillon au compte après le gate.
- Les états et libellés existants doivent être alignés sans casser les enregistrements historiques.
- Avant chaque tranche, vérifier l’état réel des routes/pages et lister ce qui est déjà fait, manquant ou cassé.

## Parcours cibles

### Client

1. Arrive sur le profil public ou le lien partagé du pâtissier.
2. Démarre sans compte et indique son niveau de préparation : idée initiale, quelques préférences ou projet presque défini.
3. Renseigne progressivement occasion, type de création, date et portions/personnes; peut choisir « je ne sais pas encore ».
4. Voit rapidement un aperçu basé uniquement sur ses réponses; les éléments inconnus sont présentés comme à discuter, pas comme des erreurs.
5. Crée/retrouve son compte pour sauvegarder, enrichir, envoyer ou suivre. Le brouillon est rattaché sans perte.
6. Ajoute styles, couleurs, goûts, contraintes alimentaires déclaratives, logistique, budget indicatif et inspirations si connus.
7. Vérifie le résumé, l’artisan destinataire et la mention que l’envoi ne vaut ni commande ni réservation.
8. Envoie une demande privée et suit statut, réponse, prochaine action et clarifications au même endroit.

### Artisan

1. Crée et édite son profil professionnel : identité, bio courte, localisation/zone, spécialités et styles structurés, modes de remise, délai indicatif et état d’acceptation des demandes.
2. Ajoute jusqu’à trois créations représentatives à son portfolio; chaque création a au minimum image, titre, catégorie, occasion et style.
3. Prévisualise/publie son profil et copie son lien partageable.
4. Consulte les demandes qui lui sont adressées, les trie par statut, date d’événement et date de réception, puis ouvre un brief scannable.
5. Marque une demande consultée, répond avec un message et estimation indicative, demande une précision ciblée ou décline.
6. Suit les échanges et décisions dans le contexte de la demande/projet.

Le profil est une page éditoriale mobile-first, pas un CRM ou un réseau social. Les capacités et spécialités sont structurées; délai, zone, prix indicatif et modes de remise ne garantissent pas la faisabilité.

## Modèle de données et règles

| Concept | Mapping dans le dépôt | Responsabilité |
| --- | --- | --- |
| Identité | User | Authentification et ownership. |
| Profil professionnel | Artisan existant | Public, capacités et préférences artisan. |
| Création publique | PortfolioItem + PortfolioMedia à ajouter | Portfolio possédé par Artisan, distinct du projet. |
| Espace de préparation | Project existant | Brief privé évolutif. |
| Collaborateurs | ProjectParticipant existant | Accès contextuel; aucun droit implicite de publication. |
| Demande | ServiceRequest existant | Snapshot envoyé à un artisan ciblé, réponse et statut. |
| Version du brief | ProjectVersion ou snapshot append-only à ajouter si nécessaire | Préserver ce qui a été envoyé sans écrasement silencieux. |
| Clarification | Clarification à ajouter ou adaptation minimale | Questions/réponses contextualisées. |
| Échanges | Message existant à étendre si besoin | Message lié à une demande ou un projet; pas de chat temps réel. |
| Historique | ActivityEvent à ajouter si non couvert | Événements importants lisibles et auditables. |
| Note privée | PrivateNote si les pilotes la réclament | Jamais sérialisée côté client. |

Principes :

- Ne pas ajouter de ClientProfile global si User et Project suffisent.
- L’artisan destinataire est résolu et autorisé côté serveur; ne jamais faire confiance à un artisan_id non validé du navigateur.
- À l’envoi, copier les champs dans une version/snapshot. Une modification ultérieure du projet ne modifie pas silencieusement la demande reçue.
- Garder le texte original et les données structurées; représenter explicitement les informations incertaines ou inconnues.
- Les données alimentaires sont déclaratives et requièrent confirmation directe de l’artisan.
- Images de projet sur stockage privé, avec validation MIME/taille et URLs temporaires si nécessaire. Ajouter/importer une image au portfolio est une action explicite du propriétaire Artisan.
- Utiliser des taxonomies minimales/versionnées pour occasion, type, style, thème de clarification et motif de clôture; conserver les textes source utiles.
- Implémenter les transformations Project → ServiceRequest et ServiceRequest → Project dans des Actions/Services idempotents, avec contrôleurs minces.
- Les migrations sont additives; prévoir la compatibilité des statuts et données existants.

## Plan d’exécution priorisé

Chaque tranche inclut backend, policy, interface Vue/Inertia, validations, états de chargement/vide/erreur, responsive et critères d’acceptation. Priorité au parcours vertical avant l’accumulation de modules.

### M0 — Audit et fondations (P0)

- Faire l’inventaire routes → contrôleurs → pages → composants; marquer chaque écran complet, vide, placeholder ou inaccessible.
- Vérifier séparation routes publiques/protégées : profil et démarrage publics; sauvegarde, suivi et inbox protégés.
- Définir la matrice de permission visiteur / propriétaire du projet / client / artisan destinataire / autre artisan / propriétaire du profil.
- Harmoniser les états métier, libellés allemands, transitions légales et anciens statuts persistés.
- Vérifier relations, migrations, contraintes, index et casts.
- Définir les événements minimaux : project_started, first_value_previewed, account_gate_shown, account_created, project_submitted, request_viewed, clarification_requested/answered, request_closed.

Sortie : diagnostic court, liste ordonnée des pages manquantes et modèle de transition fixé avant les changements d’interface.

État de l’audit du dépôt — 20 octobre 2026 :

- Le constructeur et ses opérations de brouillon/confirmation sont maintenant servis par des routes publiques Inertia; l’espace, les listes, l’inbox et les actions artisan restent protégés par auth.
- Une demande sans artisan destinataire ne peut plus être envoyée. Les demandes adressées sont filtrées par artisan_id et seule l’identité liée à cet Artisan peut les voir/répondre. Ajouter le choix d’artisan et le profil public est donc un prérequis avant de réactiver un envoi client réussi.
- Le login rattache le brouillon invité et revient désormais sur son identifiant au lieu de perdre l’aperçu.
- ServiceRequestStatus contient draft, confirmed, sent, responded, declined, completed, cancelled et responses_pending; pending/matching sont conservés comme valeurs historiques. Cycle minimal actif : draft → confirmed → sent → responded ou declined → completed/cancelled. Les états viewed et needs_information restent à implémenter avec le flux de clarification M4.
- Artisan/ProfileController a des méthodes create/edit/show, mais seules la création et l’inbox ont une route. Dans resources/js/platform/pages/artisan, seules CreateArtisan.vue et Requests.vue existent : pas encore de page edit/public ni de gestion de créations portfolio.
- Les pages client Projects.vue, Messages.vue et Profile.vue sont des placeholders très courts; le détail projet, le portfolio et la page publique ne sont pas encore raccordés. Requests.vue et le constructeur de demande existent déjà.

Cet audit ferme la découverte M0; l’implémentation suivante est M1 (profil professionnel éditable, page publique et portfolio), avant de compléter le destinataire du constructeur dans le vertical slice M2/M3. Le blocage serveur de l’envoi sans destinataire reste volontaire jusqu’à ce que le client puisse réellement en choisir un.

### M1 — Profil artisan et portfolio (P0)

- Compléter création/édition, validation serveur, prévisualisation, visibilité et lien public.
- Champs MVP : identité, bio ≤ 500 caractères, zone/localisation générale, spécialités/styles structurés, retrait/livraison, délai indicatif et accepte les demandes.
- Construire le profil public : hero, à propos, spécialités, styles, créations, informations de service, CTA « Anfrage senden ».
- Ajouter PortfolioItem/PortfolioMedia avec maximum trois créations, CRUD propriétaire seulement, ordre, légende/texte alternatif et upload validé.
- Le CTA transmet le contexte du destinataire au constructeur sans permettre d’usurpation.

Done : un artisan peut gérer et publier profil + trois créations; un visiteur peut consulter et commencer une demande adressée à cet artisan.

### M2 — Projet progressif et valeur avant compte (P0)

- Rendre les premières étapes accessibles anonymement.
- Commencer par maturité, occasion, type, date, portions/personnes; adapter l’ordre/la profondeur selon la maturité.
- Sauvegarder/restaurer temporairement le brouillon avec identifiant non prédictible, expiration claire et stratégie de rattachement.
- Présenter l’aperçu avant compte; ne pas inventer de valeurs; distinguer confirmé, approximatif et à discuter.
- Déplacer le gate d’auth au moment où le client veut sauvegarder, enrichir, envoyer ou suivre; récupérer le brouillon après connexion/inscription.
- Ajouter ensuite styles/couleurs/goûts/éléments à éviter, allergènes déclaratifs, logistique et budget indicatif dans des groupes courts.

Done : visiteur → premières réponses → aperçu → compte → reprise sans perte.

### M3 — Demande privée et suivi client (P0)

- Relier le constructeur à l’artisan du profil/de la page d’entrée; présenter ce destinataire avant l’envoi.
- Afficher un résumé final et l’avertissement « demande, pas commande/réservation ».
- À la soumission, créer snapshot/version et ServiceRequest adressée avec horodatage; confirmer le transfert et la prochaine étape.
- Supprimer la publication/visibilité globale : seuls le propriétaire client et l’artisan destinataire voient la demande.
- Compléter liste et détail client : brouillons, état, destinataire, résumé transmis, réponse, estimation indicative, dernière activité et prochaine action.
- Modifier librement un brouillon; après envoi, historiser une mise à jour ou passer par une clarification.
- Préserver le brief côté client après refus/annulation.

Done : une demande envoyée au profil A est visible par le client et A, jamais par B ou un visiteur.

### M4 — Inbox et traitement artisan (P0)

- Construire inbox avec filtres simples statut/date événement/date de réception et tri par dernière activité.
- Afficher d’abord date, portions, budget déclaré, lieu, remise, préférences, contraintes et inspirations.
- Marquer consultée de façon idempotente à la première ouverture.
- Permettre intérêt/réponse indicative, refus avec motif facultatif, ou clarification (thème + texte).
- Permettre au client de répondre; réinscrire la demande dans la file « à traiter ».
- Ajouter notes privées uniquement si demandées par les artisans pilotes; policy et payload séparés.
- Clôturer par résultat structuré et horodatage.

Done : artisan destinataire seul traite la demande; tous les statuts/réponses utiles sont visibles du client.

### M5 — Espace partagé après intérêt/accord (P0 limité)

- Depuis une demande acceptée, créer ou lier un Project via Action idempotente.
- Garder le client owner; ajouter Artisan comme participant contextuel.
- Réutiliser Message avec contexte de demande/projet pour échanges asynchrones.
- Montrer résumé commun et activité minimale : soumission, consultation, clarification, réponse, clôture.
- Ajouter uniquement les commentaires/médias nécessaires au pilote; tâches/jalons simples si le parcours les justifie.
- La participation ne permet pas de publier le projet ni de modifier implicitement les informations structurantes du client.

Done : après accord, les deux parties partagent le brief et les échanges; un refus conserve le projet client.

### M6 — Qualité pilote et lancement (P0)

- Vérifier permissions objet par objet, statuts impossibles, accès avec identifiants modifiés, double envoi/réponse et idempotence.
- Auditer stockage privé, uploads, URLs, suppression et conservation.
- Auditer clavier, focus, labels, erreurs liées aux champs, contrastes, cibles tactiles et usage mobile.
- Chaque page principale doit avoir états vide, chargement, erreur, succès et reprise.
- Ajouter mentions/consentements et suppression/conservation minimales; ne pas journaliser brief, PII ou contenu privé.
- Emails transactionnels minimaux pour demande, clarification/réponse et décision importante.
- Suivre conversion vers aperçu, gate compte, envoi, première consultation, délai de réponse, clarifications, résultats et activation artisan.
- Valider le flux avec des clients/artisans pilotes avant d’étendre le périmètre.

## Inventaire de pages cible

Client : constructeur/reprise, aperçu, liste de projets/demandes, détail privé du projet, détail de demande, profil et réglages minimaux.

Artisan : création/édition/aperçu profil, portfolio, profil public, inbox, détail/traitement demande, projet partagé après accord, réglages de visibilité.

Toute page vide ou placeholder doit soit recevoir une responsabilité fonctionnelle et des états complets, soit être retirée de la navigation MVP. Aucun CTA principal ne doit mener à une page sans fonction.

## Garde-fous architecture et design

- Laravel : Form Requests, policies, relations Eloquent, migrations additives, Actions/Services pour transformations et états.
- Vue 3/Inertia/TypeScript sous l’arborescence actuelle; réutiliser layouts et composants existants.
- Réutiliser --color-*, --space-*, --radius-*, --shadow-*, --font-* et tokens/composants de resources/css/base/_root.scss; pas de palette ni stack parallèle.
- Mobile-first, profondeur de navigation ≤ 3, une action principale par écran, états visibles avec texte et pas seulement couleur.
- Client : vocabulaire projet/création et prochaine action; artisan : demande, échéance et traitement rapide.
- Accessibilité clavier, focus visible, labels explicites, erreurs associées et médias avec texte alternatif.
- Minimisation des données et séparation des données personnelles, métier et analytics. Pas de réutilisation d’images/textes pour entraînement sans base explicite.
- Chaque incrément respecte les conventions du dépôt et préserve les données existantes.

## Hors périmètre avant validation

Marketplace publique, envoi à plusieurs artisans, matching ou classement automatique, paiement/acompte/facturation/contrat, prix/disponibilité/faisabilité/allergènes automatiques, chat temps réel, appels, stock/production/comptabilité, réseau social/avis/favoris, agent IA autonome, publication automatique d’un projet privé et workflow complexe de consentement média.

Après pilote seulement : notifications configurables, calendrier léger, duplication de projet, export PDF, réponses modèles, recherche, puis assistance IA en lecture seule avec validation humaine et mesure de valeur.

## Risques et signaux

| Risque | Réduction / signal |
| --- | --- |
| Le client pense avoir réservé | Avertissement avant/après envoi; distinguer demande, accord et commande. |
| Mauvais accès à une demande | Destinataire serveur + policies; essais négatifs avec un autre artisan. |
| Gate trop tôt | Aperçu avant compte; mesurer abandon au gate. |
| Formulaire trop long | Première valeur rapide, réponses inconnues permises; mesurer complétion vers aperçu. |
| Trop de clarifications | Collecter thèmes et nombre de clarifications par demande. |
| Fausse garantie alimentaire | Information déclarative et confirmation directe artisan. |
| Média exposé/non autorisé | Stockage privé, ajout explicite au portfolio et purge. |
| Sur-conception/marketplace froide | Un seul destinataire, taxonomies minimales, vertical slice et pilotes. |

## Définition de fin du MVP

Un visiteur démarre depuis le profil d’un artisan, obtient un aperçu, crée/retrouve un compte et reprend le brouillon. Il envoie une demande privée au bon artisan. Celui-ci consulte, répond, clarifie ou décline; le client suit et répond. L’artisan gère son profil et jusqu’à trois créations distinctes des projets privés. Après accord, un espace partagé minimal conserve brief et échanges. Les permissions, transitions, erreurs, accessibilité et affichage mobile sont vérifiés; les métriques et retours pilotes permettent de prioriser la suite.

## Ordre d’exécution depuis le dépôt actuel

1. M0 — audit, routes publiques/protégées, règles d’accès et états.
2. M1 — profil artisan éditable, page publique, portfolio limité à trois créations.
3. M2 + M3 — vertical slice profil → projet sans compte → aperçu → gate → demande privée ciblée → suivi client.
4. M4 — inbox, consultation, clarification, réponse et clôture.
5. M5 — projet collaboratif minimal et messages contextualisés.
6. M6 — sécurité, qualité mobile/accessibilité, emails, métriques et test pilote.
7. Après pilote : étendre seulement ce que les usages justifient.


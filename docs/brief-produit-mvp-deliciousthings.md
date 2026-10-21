# Deliciousthings — Brief produit MVP

**Statut :** Brief de travail pour validation Produit / Design / Développement  
**Version :** 0.5 — 21 octobre 2026  
**Marché de lancement :** Berlin, Allemagne  
**Langue produit au lancement :** allemand  
**Catégorie initiale :** pâtisserie et cake design  
**Durée de pilote recommandée :** 8 semaines après ouverture publique

**Mode de réalisation :** développeur solo à temps partiel, assisté par Codex, travail par sessions du soir

## 1. Résumé de la décision produit

Deliciousthings est un marketplace pâtisserie orienté par l’offre : les pâtissiers présentent leurs profils, créations et réalisations ; les clients les découvrent puis les contactent en privé. Le produit réunit trois voies dans un même système :

1. Le client contacte directement un pâtissier de la plateforme.
2. Le client demande une aide privée à la conciergerie lorsqu’il ne sait pas quel pâtissier contacter.
3. Le pâtissier crée un projet pour un client existant et l’invite à le consulter.

Le compte n’est pas obligatoire pour envoyer une demande. Il permet de sauvegarder des projets et d’y revenir. Les pâtissiers répondent dans l’application ; le client reçoit un courriel lorsqu’une réponse arrive. La conciergerie peut aider, à titre privé et sur demande, les clients qui hésitent sur le professionnel à contacter. Les demandes des clients ne sont pas publiées publiquement dans le MVP.

Le MVP est une plateforme de découverte et de mise en relation, pas une plateforme transactionnelle : pas de réservation ferme, de paiement, de facturation ou de devis automatique.

**Pourquoi cette orientation :** elle rend la valeur visible dès l’arrivée sur la plateforme et donne la priorité à la qualité des profils et créations. Elle évite d’exposer les besoins des clients. En contrepartie, le lancement dépend d’un catalogue local assez convaincant et d’informations de disponibilité entretenues par les pâtissiers ; la conciergerie privée sert de solution de secours quand la découverte autonome ne suffit pas.

## 2. Objectifs et critères de réussite

### Objectifs

- Permettre au client de décrire son besoin sans devoir avoir toutes les réponses.
- Permettre l’envoi d’une demande sans compte et son suivi privé par lien sécurisé.
- Donner aux pâtissiers une boîte de réception simple pour lire, qualifier et traiter les demandes.
- Tester la découverte des profils et créations d’artisans, puis la prise de contact privée.
- Mesurer la qualité du brief, le taux de réponse et le temps nécessaire aux artisans pour qualifier une demande.
- Valider une Home page allemande qui sert les clients et facilite l’arrivée des pâtissiers sur la plateforme.

### Seuils proposés pour un pilote de 8 semaines

Condition d’ouverture du pilote public : 20 pâtissiers actifs à Berlin, chacun avec un profil et au moins une création publiée, une zone desservie et un engagement à répondre sous 3 jours ouvrables. Ce seuil ne bloque pas la réalisation d’un prototype ou d’une alpha privée.

- **Volume interprétable :** au moins 40 demandes valides envoyées pendant le pilote. Si le volume est inférieur, prolonger de 4 semaines avant de conclure.
- **Taux d’envoi :** au moins 40 % des visiteurs qui commencent le formulaire envoient une demande valide.
- **Réponses des pâtissiers :** au moins 80 % des demandes privées adressées à un professionnel reçoivent une première réponse sous 3 jours ouvrables. Les demandes envoyées à la conciergerie sont suivies séparément ; un membre de l’équipe en accuse réception dans le même délai.
- **Temps gagné côté artisan :** baisse d’au moins 25 % du temps médian passé à comprendre et qualifier une demande par rapport à la méthode habituelle. Faire un relevé manuel de référence avant et pendant le pilote.

Ces seuils sont des critères de décision du pilote, pas des moyennes sectorielles. À la fin : poursuivre si les trois seuils sont atteints ; ajuster et retester si deux le sont ; revoir la proposition de valeur si zéro ou un seuil est atteint. Tout incident d’accès non autorisé aux demandes privées suspend le parcours concerné jusqu’à correction.

## 3. Utilisateurs et rôles

### Visiteur / client

- Consulte la Home page et découvre les profils, créations, réalisations et collaborations publiés par les pâtissiers.
- Recherche/filtre les professionnels par spécialité, occasion et zone de service à Berlin.
- Envoie une demande privée à un pâtissier sans compte.
- Demande, s’il le souhaite, une aide privée à la conciergerie pour choisir un professionnel.
- Crée un compte pour sauvegarder et suivre ses projets.

### Pâtissier

- Gère son profil professionnel, ses spécialités, sa zone de service, ses créations et réalisations publiques.
- Reçoit les demandes privées adressées à son profil ou transmises par la conciergerie avec l’accord du client.
- Répond dans l’application, demande une précision, décline ou clôt la demande.
- Reçoit un courriel lors d’une nouvelle demande ; le client reçoit un courriel lors d’une réponse.
- Peut créer un projet pour un client connu et l’inviter par courriel. L’invitation donne accès au seul projet concerné.

### Équipe Deliciousthings / conciergerie

- Consulte seulement les demandes privées que le client a choisi de transmettre à la conciergerie.
- Aide le client à identifier des pâtissiers pertinents et transmet le brief à un artisan uniquement après accord du client.
- Ne parle pas au nom d’un pâtissier sur son prix, sa disponibilité ou sa faisabilité sans validation de celui-ci.
- Peut aider les pâtissiers à préparer des profils et contenus de qualité ; les contenus publics restent attribués à leur auteur professionnel.

## 4. Parcours principaux

### A. Découverte d’un pâtissier puis demande privée

1. Le client arrive depuis la Home page, une recherche, une création ou un lien de profil.
2. Il explore les professionnels, spécialités, zones et créations publiées.
3. Il choisit un pâtissier et démarre « Anfrage senden » depuis son profil ou une création.
4. Le formulaire progressif reprend le contexte disponible et permet de compléter le brief sans compte.
5. Le client vérifie le résumé et envoie une demande privée à cet artisan.
6. Il reçoit une confirmation et un lien privé sécurisé pour consulter la demande.
7. Le pâtissier reçoit la demande dans son espace et une notification par courriel.
8. Le pâtissier répond dans l’application ; le client reçoit une notification par courriel.

### B. Client → conciergerie (aide privée à la découverte)

1. Le client indique qu’il souhaite de l’aide pour trouver un pâtissier.
2. Il fournit les informations utiles au brief et un email de réponse, sans compte obligatoire.
3. La demande est visible uniquement par la conciergerie.
4. La conciergerie suggère un ou plusieurs profils et ne transmet le brief à un pâtissier qu’après accord du client.
5. Le pâtissier répond directement au client dans l’application ; le client reçoit un courriel.

### C. Pâtissier → client existant

1. Le pâtissier crée un projet, saisit le minimum de contexte et invite le client par courriel.
2. Le client ouvre un lien privé sécurisé, consulte le projet et peut rejoindre la plateforme ou répondre.
3. Le projet reste privé aux participants ; sa transformation éventuelle en réalisation publique suit un flux de publication et les autorisations prévues pour les médias.

### D. Découverte et contact depuis la Home page

La Home page met en avant les profils, créations, réalisations et collaborations des pâtissiers. Elle permet de rechercher un artisan, d’envoyer une demande privée, de demander une aide privée à la conciergerie et d’accéder à la création de compte ou à la connexion. Le compte reste facultatif avant l’envoi d’une demande.

## 5. Exigences fonctionnelles MVP

### 5.1 Home page et accès au compte

- Interface et contenus en allemand pour le lancement à Berlin.
- Accès visibles dans l’en-tête : **« Anmelden »** et **« Konto erstellen »**.
- CTA client : découvrir/rechercher des pâtissiers et envoyer une demande privée.
- Filtres de découverte MVP : spécialité/type de création, occasion, livraison ou retrait, et zone de service. Geoapify sert à saisir/normaliser une zone ou un code postal et à filtrer les zones desservies ; ne pas demander la géolocalisation précise du visiteur par défaut.
- CTA professionnel : créer un compte pâtissier et publier son profil.
- Les pages publiques présentent les profils, créations, réalisations et collaborations publiés par les artisans. Les demandes des clients restent privées.
- Ne pas afficher des statistiques, avis, certifications ou garanties qui ne sont pas réellement disponibles.

### 5.2 Profil pâtissier et offre

- Nom de profil public requis, description courte requise, spécialités, zone de service et modalités de livraison/retrait.
- Portfolio de **3 à 6 photos** pour publier le profil au MVP, avec texte alternatif et attribution selon la politique de droits d’image déjà définie.
- Profil en brouillon tant que les informations minimales et le portfolio ne sont pas présents ; possibilité de dépublication/modération côté administration.
- Vérifier l’adresse email, l’identité commerciale et les coordonnées professionnelles avant publication ; effectuer une revue manuelle initiale. Ne pas afficher de badge « vérifié » sans critères et preuves documentés.
- Avant d’accepter des offres commerciales de Konditor:innen/Bäcker:innen, faire confirmer par la Handwerkskammer Berlin ou un juriste si l’activité concernée exige une inscription à la Handwerksrolle et quels justificatifs demander. Les métiers de Bäcker et Konditor figurent à l’annexe A de la HwO ; l’application dépend de l’activité réellement exercée et du statut du professionnel.
- Bouton de contact clair, non assimilable à une réservation.

### 5.2.1 Créations du pâtissier

- Un pâtissier peut ajouter une création à tout moment depuis son espace professionnel.
- Champs : nom obligatoire ; description facultative ; prix facultatif en euros.
- Les créations publiées apparaissent sur le profil public et peuvent servir de point de départ à une demande privée.
- Aucun stock, réservation, calcul de prix ou statut de disponibilité complexe n’est requis au MVP.

### 5.3 Formulaire de demande

Questions proposées à partir des spécifications existantes :

- Occasion.
- Spécialité/type de création.
- Mode souhaité : livraison ou retrait, si applicable.
- Date de l’événement, avec réponse « noch nicht festgelegt ».
- Nombre de personnes.
- Ville ou lieu de livraison/retrait (Berlin peut être présélectionné ; quartier facultatif).
- Description libre de l’idée.
- Email nécessaire pour recevoir une réponse, avec vérification avant l’accès au suivi privé.

À garder facultatifs ou avec « weiß ich noch nicht » : fourchette de budget, style, couleurs, goûts, éléments à éviter et inspirations visuelles. Les préférences alimentaires peuvent être demandées avec un avertissement explicite ; aucune garantie de sécurité allergène n’est fournie par la plateforme.

### 5.4 Demandes et réponses

- Une demande a un propriétaire, un destinataire artisan (ou la conciergerie), une origine, des horodatages et un état. Les demandes clients sont toujours privées dans le MVP, donc aucun mode de publication publique n’est nécessaire.
- États minimaux proposés : brouillon, envoyée, en attente, réponse reçue, clarification demandée, clôturée, supprimée.
- Le pâtissier peut répondre, demander une précision, décliner ou clôturer.
- Une réponse peut inclure un message, une indication de disponibilité ou un prix indicatif saisi par l’artisan, clairement non contractuel.
- Les demandes clients ne disposent pas de page publique et ne sont pas diffusées aux artisans sans le choix du client.
- L’équipe peut consulter les demandes qui lui sont adressées et journaliser ses interventions.
- Tout email de suivi est lié à une action utilisateur ou à une demande. Les newsletters/communications commerciales font l’objet d’une inscription séparée.

### 5.5 Authentification progressive

- L’envoi d’une demande ne requiert pas de compte.
- Le compte est proposé pour sauvegarder, enrichir et retrouver les projets.
- Le brouillon anonyme peut être rattaché au compte après authentification, avec consentement/confirmation claire.
- Les liens d’accès sans compte sont non prédictibles, révocables et limités à la demande concernée.

### 5.6 Publication et modération

- Les demandes clients restent privées dans le MVP.
- Les profils, créations, réalisations et collaborations des artisans sont les contenus publics principaux.
- La publication de portfolio/projet suit les droits d’image et le processus déjà définis dans les documents de référence.
- Fonction « Signaler » accessible sur les contenus professionnels publics et file d’examen côté équipe.
- Modération légère mais réelle : vérification de l’email, revue manuelle du premier profil et de son portfolio avant publication, règles de contenu acceptées par l’artisan, puis traitement des signalements et possibilité de dépublier/suspendre.
- Avant publication : validation manuelle du profil, des coordonnées professionnelles et, lorsque requis pour l’activité, du justificatif d’inscription professionnelle. Ne collecter ni conserver une pièce d’identité officielle sans nécessité établie.
- Le DSA prévoit une vérification de traçabilité des professionnels pour les plateformes qui permettent aux consommateurs de conclure des contrats à distance avec eux. Le MVP vise une mise en relation sans réservation ni paiement, mais la qualification juridique doit être confirmée avant le pilote. Prévoir en tout état de cause un canal de signalement et une procédure de traitement/retrait des contenus illicites.
- Le partage éditorial sur Instagram reste manuel et soumis aux autorisations existantes relatives aux contenus professionnels.

### 5.7 Conciergerie : solution MVP

- Utiliser **support@deliciousthings.de** comme adresse de contact visible et boîte d’entrée de la conciergerie.
- Canal principal recommandé : formulaire privé « Persönliche Hilfe anfragen » dans la Home page. Il reprend les champs essentiels du brief et enregistre une demande privée dans l’application ; une notification est envoyée à support@.
- Canal email accepté en complément : le client peut écrire à support@. Tu crées alors une fiche interne courte liée au message, sans inscrire automatiquement l’adresse dans une liste marketing.
- File minimale côté application : nouvelle, en attente d’information, recherche de pâtissier, transmise avec accord du client, clôturée. Une note privée et la date du prochain suivi suffisent au début.
- Tu peux proposer un ou plusieurs profils, puis ne transmettre le brief à un pâtissier qu’après accord du client. Le pâtissier répond ensuite directement au client dans l’application.
- Brevo sert aux notifications transactionnelles de l’application. Brevo Conversations peut être envisagé plus tard pour centraliser l’inbox seulement après vérification du forfait, de la connexion de la boîte et de l’AVV/DPA. Éviter de dupliquer les demandes dans des listes marketing.
- Afficher un délai indicatif de réponse de 3 jours ouvrables et une phrase de confidentialité ; ne pas promettre une mise en relation garantie.

### 5.8 Inventaire des pages du MVP

Pages publiques :

1. **Home page** — proposition de valeur, recherche, sélection de créations/profils, accès client et pâtissier, connexion et création de compte.
2. **Découverte des pâtissiers** — liste et filtres par spécialité/type, occasion, livraison/retrait et zone de service (Geoapify).
3. **Profil public du pâtissier** — nom, description courte, spécialités, zone, modalités de livraison/retrait, portfolio de 3 à 6 photos et créations publiées.
4. **Détail d’une création** — photo(s), nom, description/prix si fournis, attribution et action pour contacter le pâtissier. Peut être une page séparée ou un état du profil selon le socle technique.
5. **Connexion / création de compte / récupération d’accès** — choix du rôle si nécessaire et accès aux projets.
6. **Demande privée au pâtissier** — formulaire accessible sans compte, récapitulatif et confirmation d’envoi.
7. **Demande d’aide à la conciergerie** — formulaire distinct ou variante du formulaire, avec confirmation de confidentialité.
8. **Accès privé à une demande** — consultation du statut et des réponses via compte ou lien sécurisé.
9. **Pages légales et contact** — Impressum, Datenschutz, conditions d’utilisation, réglages cookies et contact.

Espace client :

10. **Mes projets / demandes** — liste et statut des demandes sauvegardées dans le compte.
11. **Détail d’un projet** — brief, conversation avec le pâtissier, réponses, précisions et clôture.

Espace pâtissier :

12. **Accueil professionnel** — résumé et accès aux demandes et contenus.
13. **Boîte de réception** — demandes reçues et filtres d’état.
14. **Détail d’une demande / réponse** — brief privé, réponse, demande de précision, refus ou clôture.
15. **Édition du profil et du portfolio** — informations du profil, zone, livraison/retrait et gestion des 3 à 6 photos.
16. **Gestion des créations** — liste, ajout et modification à tout moment ; nom requis, description et prix facultatifs.

Espace conciergerie / administration :

17. **File de conciergerie** — demandes reçues par formulaire ou saisies après email, états, notes privées et rappels.
18. **Détail de conciergerie** — échange avec le client, suggestions de profils et journal de transmission après accord du client.
19. **File de modération** — revue des premiers profils/contenus et signalements, actions de dépublication ou suspension. Accès interne uniquement.

Les écrans 1 à 16 et 19 forment la base produit. Pour une alpha en quelques soirées, prioriser la Home, découverte, profil, demande client, inbox/réponse artisan et détail du projet. La gestion de la conciergerie peut d’abord être une file interne très simple. Les créations doivent pouvoir être ajoutées à tout moment dans le MVP ; la réalisation des écrans moins centraux peut être simplifiée, mais pas remplacée par des faux contenus.

### 5.9 User stories du MVP

**P0 — indispensable à l’alpha utilisable**

- **US-01 Visiteur — découvrir les créations :** en tant que visiteur, je veux parcourir les pâtissiers et leurs créations à Berlin afin de trouver une inspiration pertinente.
- **US-02 Visiteur — filtrer la découverte :** je veux filtrer par spécialité/type, occasion, livraison/retrait et zone de service afin de réduire les résultats pertinents.
- **US-03 Visiteur — consulter un profil :** je veux voir la description, le portfolio, les créations et les modalités de contact d’un pâtissier avant de le contacter.
- **US-04 Client — envoyer sans compte :** je veux envoyer une demande privée au pâtissier choisi sans créer de compte afin de contacter rapidement un professionnel.
- **US-05 Client — suivre ma demande :** je veux recevoir une confirmation et accéder de façon sécurisée à ma demande et aux réponses, avec ou sans compte.
- **US-06 Pâtissier — répondre :** je veux voir les demandes qui me sont adressées et y répondre dans l’application afin de poursuivre l’échange directement avec le client.
- **US-07 Client — recevoir une notification :** je veux recevoir un email lorsqu’un pâtissier répond afin de ne pas manquer le suivi.
- **US-08 Pâtissier — publier mon profil :** je veux renseigner mon nom de profil, une description courte, mes spécialités, ma zone et mes options de retrait/livraison afin d’être découvrable.
- **US-09 Pâtissier — gérer le portfolio :** je veux ajouter 3 à 6 photos à mon profil afin de présenter mon travail.
- **US-10 Pâtissier — gérer mes créations :** je veux ajouter et modifier une création à tout moment avec un nom obligatoire et une description/prix facultatifs afin de garder mon profil à jour.
- **US-11 Client — demander de l’aide :** je veux transmettre un besoin en privé à Deliciousthings afin d’obtenir des suggestions de pâtissiers sans publier ma demande.
- **US-12 Conciergerie — suivre une demande :** je veux voir les demandes d’aide reçues, noter mes actions et ne transmettre le brief qu’après accord du client afin de gérer le service manuellement.
- **US-13 Utilisateur — signaler un contenu :** je veux signaler un profil ou un contenu qui semble problématique afin qu’il soit examiné.
- **US-14 Artisan — contrôler mon contenu :** je veux modifier ou dépublier mon profil et mes créations afin de garder le contrôle sur mes informations publiques.
- **US-15 Utilisateur — créer un compte ou se connecter :** je veux créer un compte ou me connecter afin de retrouver les projets sauvegardés.

**P1 — inclure si le socle le permet, sinon après l’alpha**

- **US-16 Pâtissier — inviter un client existant :** je veux créer un projet privé et inviter le client par email afin de lui partager les informations utiles.
- **US-17 Client — sauvegarder un projet :** je veux rattacher une demande à mon compte afin de la retrouver après avoir fermé le lien email.
- **US-18 Équipe — traiter un signalement :** je veux examiner, dépublier ou rétablir un contenu et garder une trace de l’action afin de traiter les signalements de manière cohérente.
- **US-19 Pâtissier — recevoir une notification :** je veux être notifié par email d’une nouvelle demande afin de pouvoir répondre dans le délai annoncé.

**Critères transversaux :** les demandes et conversations ne sont accessibles qu’aux participants autorisés ; les liens sans compte sont non prédictibles et révocables ; aucune demande client n’est publiée ; l’envoi ne constitue ni commande ni réservation.

## 6. Exigences non fonctionnelles et conformité à intégrer au travail

- Contrôle d’accès côté serveur sur chaque projet, demande, message et média.
- Stockage privé des images d’inspiration ; validation des types, tailles, suppression et accès.
- Journalisation minimale des changements d’état et actions de conciergerie.
- Responsive, mobile-first, contrastes, navigation clavier, labels et messages d’erreur compréhensibles.
- Prévoir l’analyse d’applicabilité du BFSG aux services concernés et documenter les choix d’accessibilité.
- Collecter le minimum de données ; appliquer la politique de conservation proposée en section 6.1 et un processus d’effacement/anonymisation.
- Documenter les rôles et accords de traitement avec Hostinger, Geoapify et Brevo ; vérifier les sous-traitants, lieux de traitement et transferts dans les contrats/paramètres réellement associés aux comptes. Pour Geoapify, privilégier l’endpoint européen `api-eu.geoapify.com` si compatible avec l’intégration, et ne demander la géolocalisation précise qu’à la demande explicite du visiteur.
- Faire vérifier avant le lancement allemand : Impressum/DDG, politique de confidentialité et bases légales RGPD, consentements cookies/TDDDG, conditions d’utilisation, règles de contenu et de signalement/DSA, obligations de plateforme professionnelle/P2B et éventuelles obligations liées aux contrats à distance.
- Clarifier dans l’interface qu’une demande n’est ni commande, ni devis ferme, ni réservation.
- Faire valider les textes juridiques et la qualification du modèle par un juriste allemand avant ouverture publique.

### 6.1 Politique de conservation proposée (à faire valider)

Le RGPD impose une durée liée aux finalités, pas une conservation générale « jusqu’à ce que la personne pense à supprimer ». Proposition initiale à faire valider avant le lancement :

- Brouillon non envoyé : suppression après **30 jours d’inactivité**.
- Demande ou dossier de conciergerie : s’il reste ouvert sans activité, rappel puis clôture après **90 jours** ; suppression ou anonymisation des données identifiantes **12 mois après clôture**.
- Projet collaboratif fermé : suppression/anonymisation **12 mois après clôture**, sauf consentement/nécessité distincte pour le garder ou obligation de conservation applicable.
- Compte client : données actives tant que le compte existe ; à la suppression, effacement/anonymisation des données non soumises à une obligation de conservation.
- Profil artisan : reste public tant qu’il est actif et publié ; rappel après **6 mois sans activité**, dépublication si aucune confirmation après **12 mois**, puis suppression/anonymisation des données non nécessaires.
- Journaux techniques : minimisation et rotation courte, cible initiale **90 jours** ; sauvegardes purgées selon leur cycle, cible **90 jours maximum**.
- Contenu portfolio : supprimé de l’affichage lors de sa dépublication/suppression ; conserver séparément les médias uniquement si l’artisan en a toujours le contrôle et que la finalité reste valable.

Ces durées sont une proposition opérationnelle, pas des délais légaux universels. Le RGPD demande de ne pas conserver les données identifiantes au-delà de ce qui est nécessaire à la finalité. Séparer les éventuelles pièces comptables/contractuelles conservées par obligation légale des données produit ordinaires ; appliquer un gel ciblé uniquement en cas de litige ou d’obligation identifiée. Vérifier le calendrier final avec un professionnel allemand et publier une politique de conservation compréhensible.

## 7. Hors périmètre MVP

- Paiement, acompte, facturation, panier, réservation ferme et négociation contractuelle intégrée.
- Tarification, disponibilité ou faisabilité automatisées.
- Matching IA, recommandation algorithmique complexe et feed personnalisé.
- Réseau social complet, commentaires publics et messagerie de groupe.
- Republication automatique sur Instagram ou autres réseaux.
- Extension aux métiers hors pâtisserie/cake design avant validation du lancement berlinois.
- Monétisation des artisans pendant le premier pilote ; elle reste une hypothèse de long terme.

## 8. Plan d’exécution adapté au travail solo en soirée

### Objectif de livraison

Viser une **alpha fonctionnelle après 4 à 5 sessions du soir**, à raison d’environ 2 à 3 heures concentrées par session. L’objectif est un parcours vertical utilisable sur un environnement de préproduction : un client envoie une demande, un pâtissier la reçoit et répond, puis le client voit la réponse. Une Home page allemande simple et les actions de compte seront incluses.

Cette cible suppose que l’application Laravel/Vue/Inertia existante démarre déjà, que l’authentification de base fonctionne et qu’un service email est disponible ou déjà configuré. La première session vérifiera ces hypothèses. Si le dépôt est incomplet ou si les fonctions centrales n’existent pas, on réduira le périmètre pour préserver le parcours vertical et ajustera le nombre de sessions après inspection. Je t’assisterai en découpant chaque session en une petite tâche, en travaillant sur le code existant et en résumant ce qui reste à faire.

**Important :** l’alpha après quelques soirées n’est pas encore un lancement public déclaré conforme. Les 20 pâtissiers, la revue juridique allemande, les règles de conservation, la modération opérationnelle et la capacité à tenir le délai de réponse sont des conditions de lancement du pilote public.

### Préparation — avant la première session (15–30 minutes)

- Ouvrir le dépôt et s’assurer que le projet peut être lancé localement.
- Garder les décisions produit de ce brief comme source de vérité ; consigner les nouveaux arbitrages au fil de l’eau.
- Créer une liste de tâches courte et ordonnée ; ne pas commencer par une refonte technique générale.

### Soirée 1 — Audit express et premier écran

- Vérifier routes, modèles, authentification, email, styles et démarrage local.
- Noter uniquement les blocages qui empêchent le parcours vertical.
- Adapter la Home page allemande : proposition de valeur, CTA client, CTA pâtissier, liens « Anmelden » et « Konto erstellen ».
- **Livrable :** projet lançable et première Home page visible ; liste des écarts réels au plan.

### Soirée 2 — Demande privée sans compte

- Réutiliser ou créer un profil pâtissier minimal avec une création publiée, afin que le parcours commence par la découverte de l’offre.
- Ajouter le formulaire avec occasion, type de création, date ou « pas encore fixée », nombre de personnes, lieu, description et email ; garder budget/style facultatifs.
- Enregistrer une demande privée sans imposer de compte et afficher une confirmation.
- **Livrable :** le visiteur découvre un artisan réel/de démonstration et peut lui envoyer une demande privée.

### Soirée 3 — Inbox pâtissier et réponse

- Afficher les demandes reçues dans l’espace du pâtissier connecté.
- Permettre une réponse et une demande de précision avec un statut lisible.
- Ajouter les courriels transactionnels de nouvelle demande et de nouvelle réponse, selon la configuration disponible.
- **Jalon vertical :** le client envoie une demande, le pâtissier répond, le client retrouve la réponse via son compte ou son lien privé sécurisé.

### Soirée 4 — Offre pâtissier, découverte et conciergerie légère

- Permettre au pâtissier de publier/modifier son profil et ses créations, avec ajout possible à tout moment.
- Ajouter les filtres convenus : spécialité/type, occasion, livraison/retrait et zone de service (codes postaux/quartiers via Geoapify).
- Permettre l’ajout et la modification d’une création à tout moment avec nom requis, description et prix facultatifs.
- Créer une file de conciergerie minimale pour les demandes privées des clients qui demandent de l’aide.
- Si le temps manque, livrer d’abord le profil avec créations et un filtre minimal ; remettre la file conciergerie à une session suivante.
- **Livrable :** les clients découvrent une offre réelle et peuvent contacter un artisan ; la conciergerie ne reçoit que les demandes qui lui sont adressées.

### Soirée 5 — Parcours artisan-first et stabilisation alpha

- Ajouter, si le socle le permet, la création d’un projet par un pâtissier et l’invitation privée du client par email.
- Parcourir les trois flux avec des comptes de démonstration : demande privée à un artisan, demande privée à la conciergerie, invitation artisan-client.
- Corriger les blocages trouvés, vérifier les permissions essentielles et préparer un déploiement de préproduction.
- **Livrable :** alpha démontrable avec notes de limites et prochaines tâches.

### Priorité en cas de manque de temps

1. Demande privée client → réponse pâtissier → notification client.
2. Home page allemande avec « Anmelden » et « Konto erstellen ».
3. Profils et offres pâtissiers découvrables, avec filtres simples.
4. File privée de conciergerie et invitation artisan-first.
5. Polissage visuel, plus de contenus, feed et automatisations.

Ne pas couper les contrôles d’accès pour gagner du temps. Si les liens privés, les autorisations ou les emails ne peuvent pas être rendus sûrs/configurés pendant l’alpha, limiter les essais à des données fictives et à des comptes de démonstration.

### Après l’alpha — préparation du lancement

- Revue de conformité et des textes allemands avec un professionnel compétent ; appliquer les durées de conservation décidées et le processus de suppression.
- Finaliser signalement, modération et revue humaine des profils, offres et réalisations publiques.
- Onboarder 20 pâtissiers actifs à Berlin et confirmer leur disponibilité pour le délai de 3 jours ouvrables.
- Définir la charge hebdomadaire de conciergerie, le support et l’escalade des demandes sans réponse.
- Ouvrir le pilote de 8 semaines, instrumenter les trois seuils de succès et faire une revue hebdomadaire.

La vitesse recherchée vient d’un parcours vertical complet et de tâches petites, pas de la suppression de la sécurité, des choix produit ou des obligations nécessaires à un lancement public.

## 9. Décisions encore à fermer avant développement

1. La zone de service sera-t-elle saisie comme codes postaux, quartiers ou zones dessinées ? Recommandation MVP : codes postaux/quartiers déclarés par le pâtissier, avec Geoapify pour la recherche/normalisation et sans géolocalisation visiteur par défaut.
2. Les décisions de profil et de création sont fixées : portfolio de 3 à 6 photos ; nom de création requis, description et prix facultatifs ; ajout de créations à tout moment.
3. Faire valider par la Handwerkskammer Berlin/juriste les justificatifs requis selon les activités artisanales proposées et le statut des pâtissiers.
4. Confirmer la qualification DSA/contrats à distance du parcours sans réservation ni paiement.
5. Les durées proposées en section 6.1 sont-elles acceptables après revue juridique allemande ?
6. Quels emplacements et sous-traitants sont réellement activés dans les comptes Hostinger, Geoapify et Brevo, et l’endpoint européen Geoapify est-il adapté à l’intégration ?
7. Quelle est la capacité hebdomadaire de la conciergerie solo pour maintenir le délai de 3 jours ouvrables ?

## 10. Références produit

Ce brief reprend le parcours d’authentification progressive, le formulaire de projet, le registre des risques et l’architecture de demandes/projets déjà présents dans les documents Deliciousthings. Il constitue une consolidation de travail et non un avis juridique.
# Réponses aux questions

**Pourquoi le dossier /vendor ne doit-il pas être versionné ?**
 Il est entièrement régénérable via composer install à partir de composer.json. Le versionner unitule au dépot.

**Quelle différence existe entre un commit et un tag ?**
 Un commit enregistre un instantané du code à un moment donné et fait avancer l'historique. Un tag est un simple repère nommé pointant vers un commit précis , il ne modifie rien, il sert juste à identifier une version stable (ex. v0.0.0) pour pouvoir y revenir facilement.

**Pourquoi la branche main doit-elle rester stable ?**
Elle représente la version de référence du projet, potentiellement déployable à tout moment. Développer directement dessus risquerait d'y introduire du code cassé ; le travail en cours passe donc par des branches séparées qui ne sont mergées qu'une fois validées.


**Pourquoi placer index.php dans un dossier public ?**
→C'est le seul dossier exposé par le serveur web . Le reste de l'application (classes, config, connexion BDD) est hors de la racine web, donc inaccessible directement par URL.

**Pourquoi toutes les requêtes devraient-elles passer par ce fichier ?**
Front Controller : un point d'entrée unique permet de centraliser le chargement de l'autoload, la gestion des erreurs et le routage, plutôt que de dupliquer cette logique dans chaque fichier PHP accessible.

**Quels éléments ne devraient jamais se trouver dans le dossier public ?**
 Les classes métier, les fichiers de configuration (identifiants de connexion à la base), et tout fichier interne à l'application qui n'a pas besoin d'être servi directement au navigateur.

**Comment avez-vous réparti les responsabilités entre vos dossiers ?**
 Entity (objets métier), Controller (réception des requêtes), View (affichage), Repository (accès aux données), Servic (traitements applicatifs),`Config (configuration), Routing (résolution des URL) — chaque dossier correspond à une seule responsabilité, conformément au SRP déjà justifié en introduction.   
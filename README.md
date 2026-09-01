# Réponses aux questions

**Pourquoi le dossier /vendor ne doit-il pas être versionné ?**
 Il est entièrement régénérable via composer install à partir de composer.json. Le versionner unitule au dépot.

**Quelle différence existe entre un commit et un tag ?**
 Un commit enregistre un instantané du code à un moment donné et fait avancer l'historique. Un tag est un simple repère nommé pointant vers un commit précis , il ne modifie rien, il sert juste à identifier une version stable (ex. v0.0.0) pour pouvoir y revenir facilement.

**Pourquoi la branche main doit-elle rester stable ?**
Elle représente la version de référence du projet, potentiellement déployable à tout moment. Développer directement dessus risquerait d'y introduire du code cassé ; le travail en cours passe donc par des branches séparées qui ne sont mergées qu'une fois validées.
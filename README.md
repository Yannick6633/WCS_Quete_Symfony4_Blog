Symfony 4 : Série de plusieurs quêtes


Quêtes réalisées lors de ma formation à la Wild Code School Février 2019.


Critères de validation n°2 : Initialiser un projet Blog.

    Le dépôt contient uniquement les dossiers suivants : assets/, bin/, config/, public/, src/, templates/, tests/, translations/, var/ et quelques autres fichiers (.gitignore, composer.json, etc.).
    Le dépôt ne contient évidement pas les répertoire .idea/ et vendor/.
    Le correcteur peux installer le projet sur sa machine (voir étape bonus) et la page "Welcome to Symfony" s'affiche sur la route / en accédant à l'url http://localhost:8000/.


Critères de validation n°3 : Afficher une page de bienvenue.

    Il y a un fichier DefaultController.php dans src/Controller de l'arborescence.
    Ce fichier comporte une classe DefaultController et étend le AbstractController de base de Symfony.
    La route sur / est faite en annotation et est nommée app_index.
    Le méthode index() du contrôleur se finit par un $this->render('path_vers_un_twig');.
    Le fichier Twig default.html.twig étend base.html.twig et comprend un titre h1 "Bienvenue sur mon blog".
    L'URL http://localhost:8000/ est fonctionnelle, le titre s'affiche. :)


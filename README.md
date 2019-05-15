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
    
    
Critères de validation n°4 : Le routing avancé .

    La route est correctement définie, en annotations, et est reliée à la méthode show() de BlogController.
    Une vue templates/blog/show.html.twig est créée.
    La route blog/show/mon-super-article affiche bien une vue avec en titre "Mon Super Article" dans un <h1>.
    La route blog/show/article-du-1-janvier-1970 affiche bien une vue avec en titre "Article Du 1 Janvier 1970" dans un <h1>.
    La route blog/show/ affiche bien une vue avec "Article Sans Titre" dans un <h1>.
    La route blog/show/MonArticle n'affiche rien (erreur 404) car le paramètre contient des majuscules.
    La route blog/show/mon_article n'affiche rien (erreur 404) car le paramètre contient un underscore.
    
    
Critères de validation n°5 : Créer ta première entité avec Doctrine.

    Lance la commande doctrine:mapping:info, le résultat affiche bien les deux entités Category et Article.
    Lance la commande doctrine:schema:validate, le résultat affiche bien OK pour le mapping ET la base de données.
    Ton code devra être disponible sur un repository GitHub.


Critères de validation n°6 : Crée la relation ManyToOne.

    La propriété category est présente et privée.
    Le getter et setter correspondants sont présents et publics.
    Les annotations ManyToOne et JoinColumn sont présentes et correctement paramétrées (nullable=false, targetEntity)
    Le use nécessaire pour les annotations @ORM est en place.
    Ton code devra être disponible sur un repository GitHub.
    
    
Critères de validation n°7 : Récupérer des données stockées avec Doctrine.
    
    FindBy() : récupérer plusieurs objets avec des filtres
    
        Une nouvelle méthode showByCategory(string $categoryName) a été créée dans le controller BlogController.
        La route de cette méthode sera sous la forme : @Route("/category/{category}", name="show_category").
        Cette méthode retourne un tableau d'articles récupéré par une méthode de type findBy(), en limitant le nombre de résultats à 3, le tout trié par id décroissant.
        Un nouveau fichier a été créé templates/blog/category.html.twig.
        Ce fichier bouclera sur tous les articles afin d'afficher l'id, le titre et le contenu de chaque itération.
        L'URL http://localhost:8000/blog/category/javascript est fonctionnelle et renvoie bien tous les articles liés à la catégorie Javascript, ajoutée en début de quête.
        Ton code devra être disponible sur un repository GitHub
    






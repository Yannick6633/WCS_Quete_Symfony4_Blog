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
    
    
Critères de validation n°8 : Les relations bidirectionnelles avec Doctrine

    Rendre la quête avec un repository GitHub
    Avoir les deux classes Article et Category
    Les annotations inversedBy et mappedBy sont présentes
    Les méthodes addArticle() et removeArticle() sont présentes dans la classe Category
    Utiliser les méthodes getArticles() et getCategory()
    
    
Critères de validation n°9 : Le param converter.

        Dans blogController, la méthode showByCategory() permet de récupérer un objet Category via le param converter, à partir d'un name en paramètre de route,
    Dans showByCategory(), les articles associés à la categorie sont toujours récupérés par l’appel à $category->getArticles();,
    La méthode rend une vue affichant le nom de la catégorie et ses articles associés.
    
    
Critères de validation n°10 : Gardez la "form"

    La classe App\Form\CategoryType est présente dans le dossier src/Form.
    La route /category affiche bien le formulaire de création de catégorie.
    Le formulaire fonctionne (il crée une catégorie).
    Ton code est présent sur le même dépot github que tes précédentes quêtes Symfony.
    

Critères de validation n°11 : Générons du CRUD

    Le CRUD est généré pour l’entité Article.
    L’entité Article dispose des actions de lecture, écriture et suppression.
    Les routes sont cohérentes et fonctionnelles.
    Le CRUD agit bien avec la BDD (exemple : insérer un article depuis http://localhost:8000/article/new).
    Le code est disponible sur un dépot GitHub.
    
    
Critères de validation n°12 : Doctrine relations “Many-To-Many”


    Ton code est disponible sur github,
    Ton entité App\Entity\Tag est bien présente,
    Ta classe de migration générant les 2 nouvelles tables et les contraintes d'intégrité fonctionnent,
    La route vers la page de tag est fonctionnelle,
    Sur la page du tag, la liste des articles associés s'affiche.
    Sur la page des articles, la liste des tags associés s'affiche.
    Bonus : Sur la page de tag, lors du clic sur un article de la liste, l'utilisateur est redirigé vers la page de l'article sélectionné.
    Bonus II : Sur la page d'article, lors du clic sur un tag de la liste, l'utilisateur est redirigé vers la page du tag sélectionné.
    

Critères de validation n°13 : EntityType


    Le formulaire d’ajout d’un article affiche un champ tags (EntityType),
    Ce champ apparaît sous la forme de cases à cocher.
    Lorsque l’on ajoute un tag à un article, celui-ci est bien relié à l’article en BDD.
    Le tag s’affiche sur la page de l’article.
    
    
Critères de validation n°14 : Les fixtures


    Lorsque que php bin/console doctrine:fixtures:load est exécuté, il n y a pas de message d'erreur,
    Les fixtures génèrent 50 articles répartis dans au moins 5 différentes catégories disponibles,
    Les noms des catégories sont définis "à la main" dans la classe App\DataFixtures\CategoryFixtures,
    Les titres et contenus des articles sont générés (et en minuscules) aléatoirement grâce à la librairie Faker dans la classe App\DataFixtures\ArticleFixtures,
  
  
Critères de validation n°15 : Introduction aux "Services"


    Le service est appelé à chaque niveau de l’application où il y a un ajout/modification d'article.
    Le service Slugify créé auparavant avec une méthode generate(), permet de générer un slug à partir d'une chaîne de caractères.
    L'ajout de l'article : "PHPStorm, l'éditeur de code pour PHP à tester !" donne le slug "phpstorm-lediteur-de-code-pour-php-a-tester".
    Le changement du titre de l'article précédent en "PHPStorm, l'éditeur de code pour PHP idéal !" donne "phpstorm-lediteur-de-code-pour-php-ideal".
























<?php


namespace App\Controller;



use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @param $articles
     * @return Response A response instance
     */

    public function index(Request $request, SessionInterface $session): Response
    {

        if (!$session->has('total')) {
            $session->set('total', 0); // if total doesn’t exist in session, it is initialized.
        }

        $total = $session->get('total'); // get actual value in session with ‘total' key.
        // ...

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        $form = $this->createForm(
            ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

       $category = new Category();


       $formCategory = $this->createForm(CategoryType::class, $category);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            // $data contient les données du $_POST
            // Faire une recherche dans la BDD avec les infos de $data...
        }


        return $this->render('blog/index.html.twig',
            ['articles' => $articles,
                'form' => $form->createView(),
                'formCategory' => $formCategory->createView(),
            ]
        );


    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug the slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *      defaults={"slug" = null},
     *      name="blog_show")
     *
     * @return Response A response instance
     */

    public function show(?string $slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );

        }

        return $this->render(
        'blog/show.html.twig',
        [
            '$article' => $article,
            'slug' => $slug
        ]
    );

    }

    /**
     * @Route("/category/{name}", name="show_category")
     *
     * @param Category $categoryName
     * @return Response A response instance
     */

    public function ShowByCategory(Category $categoryName)
    {

        $articles = $categoryName->getArticles();

        return $this->render('blog/category.html.twig', [
            'articles' => $articles,
            'categoryName' => $categoryName
        ]);

    }


/*
    /**
     * @Route("/category/{categoryName}", name="show_category")
     *
     * @return Response A response instance
     */
/*
    public function ShowByCategory(string $categoryName)
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);


        /*$articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category], ['id' => 'DESC'], 3 );*//*

       $articles = $category->getArticles();


        return $this->render('blog/category.html.twig', ['articles' => $articles]);

    }*/

    /**
     * @Route("/pages/{slug}", name="blog_pages", requirements={"slug"="[a-z0-9-]+"})
     */
    public function pages($slug = 'article-sans-titre')
    {
        $slug = ucwords(implode(' ', explode('-', $slug)));
        return $this->render('blog/pages.html.twig', ['pages_slug' => $slug]);
    }






}




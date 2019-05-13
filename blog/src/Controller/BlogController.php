<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog_index")
     */

    public function index()
    {
        return $this->render('blog/index.html.twig', ['owner' => 'Yannick']);
    }

    /**
    * @Route("/blog/show/{slug<[a-z-0-9]+>}", methods={"GET"}, name="blog_show")
     */

    public function show($slug = "Article Sans Titre")
    {

        $slug = ucwords(str_replace("-"," ", $slug));
        return $this->render('blog/show.html.twig', ['slug' => $slug]);
    }
}
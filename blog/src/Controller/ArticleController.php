<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugify;

/**
 * @Route({
 *     "fr": "/article",
 *     "en": "/article",
 *     "es": "/artículo",
 *     })
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {


        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAllWithCategoriesAndTags(),
        ]);
    }

    /**
     * @Route({
     *     "fr": "/ajouter",
     *     "en": "/new",
     *     "es": "/nuevo",
     *     }, name="article_new", methods={"GET","POST"})
     * @param Request $request
     * @param Slugify $slugify
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function new(Request $request, Slugify $slugify, \Swift_Mailer $mailer): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

           $slug = $slugify->generate($article->getTitle());
           $article->setSlug($slug);


            $author = $this->getUser();
            $article->setAuthor($author);

            $entityManager->persist($article);
            $entityManager->flush();


        $message = (new\Swift_Message('Un nouvel article vient d\'être publié chez tata Yvonne!'))
            ->setFrom('yannickdec33@gmail.com')
            ->setTo('yannickdec33@gmail.com')
            ->setBody(
                $this->renderView('article/email/notification.html.twig',
                    ['article' => $article]
                ),
                'text/html'
            );

        $mailer->send($message);

        $this->addFlash('success', 'Nouvel article enregistré');

        return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'isFavorite' => $this->getUser()->isFavorite($article)

        ]);
    }

    /**
     * @Route({
     *     "fr": "/{id}/editer",
     *     "en": "/{id}/edit",
     *     "es": "/{id}/editar",
     *     }, name="article_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Article $article
     * @param Slugify $slugify
     * @return Response
     */
    public function edit(Request $request, Article $article, Slugify $slugify): Response
    {

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($this->isGranted('ROLE_ADMIN') or ($article->getAuthor() === $this->getUser()))

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setSlug($slugify->generate($article->getTitle()));
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Edition enregistrée');

            return $this->redirectToRoute('article_index', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();

            $this->addFlash('danger', 'Suppression effectuée');
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * @Route({
     *     "fr": "/{id}/favoris",
     *     "en": "/{id}/favorites",
     *     "es": "/{id}/favoritos",
     *     }, name="article_favorite", methods={"GET", "POST"})
     */
    public function favorite(Request $request, Article $article, ObjectManager $manager) : Response
    {
        if ($this->getUser()->getFavorites()->contains($article)) {
            $this->getUser()->removeFavorite($article);
        }
        else {
            $this->getUser()->addFavorite($article);
        }

        $manager->flush();

        return $this->json([
            'isFavorite' => $this->getUser()->isFavorite($article)
        ]);
    }
}

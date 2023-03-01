<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
    public function listAction()
    {
        $author = $this->getDoctrine()
            ->getRepository('App\Entity\Author')
            ->findAll();
        return $this->render('author/index.html.twig', [
            'author' => $author
        ]);
    }
}

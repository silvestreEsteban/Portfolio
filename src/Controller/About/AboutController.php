<?php

namespace App\Controller\About;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function aboutPage(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('about/about.html.twig');
    }
}
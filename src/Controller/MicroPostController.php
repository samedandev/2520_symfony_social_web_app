<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->findAll());
        // dd($posts->find(2));
        // dd($posts->findOneBy(['title' => 'Welcome to US']));
        // dd($posts->findBy([]));

        /* Content removed after 6.2+ */
        // ADD Post
        // $microPost = new MicroPost();
        // $microPost-> setTitle('It comes from the controller');
        // $microPost-> setText('Hi');
        // $microPost-> setCreated(new DateTime());
        /* END Content removed after 6.2+ */

        // EDIT Post
        $microPost = $posts->find(4);
        $microPost->setTitle('EDITED Welcome');
        $posts->add($microPost, true);

        // REMOVE Post
        $microPost = $posts->find(4);
        $posts->remove($microPost, true);

        // $posts->add($microPost, true);
        
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}

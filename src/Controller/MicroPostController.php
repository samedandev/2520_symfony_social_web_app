<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->findAll());
        return $this->render('micro_post/index.html.twig', [
            // 'posts' => $posts->findAll(),
            'posts' => $posts->findAllWithComments() // comes from MicroPostRepository.php
        ]);
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
        // $microPost = $posts->find(4);
        // $microPost->setTitle('EDITED Welcome');
        // $posts->add($microPost, true);

        // REMOVE Post
        // $microPost = $posts->find(4);
        // $posts->remove($microPost, true);

        // $posts->add($microPost, true);
        
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }

    // #[Route('/micro-post/{id}', name: 'app_micro_post_show')]
    // public function showOne($id, MicroPostRepository $posts): Response
    // {
    //     dd($posts->find($id));
    // }

    // Extra Bundle
    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post
        ]);
    }

    // Post Form
    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request, MicroPostRepository $posts): Response
    {
        // $microPost = new MicroPost();
        // $form = $this->createFormBuilder($microPost)
        //     ->add('title')
        //     ->add('text')
        //     // ->add('submit', SubmitType::class, ['label'=> 'Ajouter'])
        //     ->getForm();

        // MicroPost class
        $form = $this->createForm(MicroPostType::class, new MicroPost());  
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            // dd($post);
            $post->setCreated(new DateTime());
            $posts->add($post, true);

            // Add a flash message (in base.html.twig)
            $this->addFlash('success', 'Your micro post has been added');
            return $this->redirectToRoute('app_micro_post'); // /micro-post/
            // Redirect 
        }
        // return $this->renderForm('task/new.html.twig', [
        return $this->render('micro_post/add.html.twig', [
            'form' => $form
        ]);
    }

    

    // Edit Form
    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $posts): Response
    {
        // $form = $this->createFormBuilder($post)
        //     ->add('title')
        //     ->add('text')
        //     // ->add('submit', SubmitType::class, ['label'=> 'Ajouter'])
        //     ->getForm();  

        // MicroPost class
        $form = $this->createForm(MicroPostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            // dd($post);
            $posts->add($post, true); // 'add' works for edit also

            // Add a flash message (in base.html.twig)
            $this->addFlash('success', 'Edited successfully');
            return $this->redirectToRoute('app_micro_post'); // /micro-post/
            // Redirect 
        }
        // return $this->renderForm('task/new.html.twig', [
        return $this->render('micro_post/edit.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }

    // Add Comment Form
    #[Route('/micro-post/{post}/comment', name: 'app_micro_post_comment')]
    public function addComment(MicroPost $post, Request $request, CommentRepository $comments): Response
    {
       
        // MicroPost class
        $form = $this->createForm(CommentType::class, new Comment());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $comment->setPost($post);
            // dd($post);
            $comments->add($comment, true); // 'add' works for edit also

            // Add a flash message (in base.html.twig)
            $this->addFlash('success', 'Comment added successfully');
            return $this->redirectToRoute('app_micro_post_show', [
                'post' => $post->getId()
            ]); // /micro-post/
            // Redirect 
        }
        
        return $this->render('micro_post/comment.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
  private array $messages = [
    ['message' => 'Hello', 'created' => '2025/09/12'],
    ['message' => 'Hi', 'created' => '2025/08/12'],
    ['message' => 'Bye!', 'created' => '2021/05/12']
  ];

   #[Route('/', name: 'app_index')]
   public function index(UserProfileRepository $profiles, MicroPostRepository $posts, CommentRepository $comments): Response
   {
      // $post = new MicroPost();
      // $post->setTitle('Hello');
      // $post->setText('Hello');
      // $post->setCreated(new DateTime());

      ## Add To an existing post
      // $post = $posts->find(10);
      // $comment = new Comment();
      // $comment->setText('HelloComment');
      // $comment->setPost($post);
      // // $post->addComment($comment);
      // // $posts->add($post, true);
      // $comments->add($comment, true);

      ## Delete comment from existing post
      $post = $posts->find(10);
      // $comment = $post->getComments()->count();
      // $comment = $post->getComments()[0];
      $comment = $post->getComments();
      
      // dd($comment);
      // $post->removeComment($comment);
      // $posts->add($post, true);
      // dd($post);

      // $user = new User();
      // $user->setEmail('email@email.com');
      // $user->setPassword('1234');

      // $profile = new UserProfile();
      // $profile->setUser($user);
      // $profiles->add($profile, true);

      // $profile = $profiles->find(1);
      // $profiles->remove($profile, true);

      return $this->render(
        'hello/index.html.twig',
        ['messages' => $this->messages,
          'limit' => 3
        ]
      );
    //  return new Response(
    //    implode(', ', array_slice($this->messages, 0, $limit) )); 
   }

   // id<\d> = id is a number
   #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
   public function showOne(int $id): Response
   {
    return $this->render(
      'hello/show_one.html.twig',
      [
        'message' => $this->messages[$id]
      ]
    );
    //  return new Response($this->messages[$id]); 
   }
}

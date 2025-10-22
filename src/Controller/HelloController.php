<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
  private array $messages = [
   "Hello", "Hi", "Salut"
  ];

   #[Route('/{limit<\d+>?3}', name: 'app_index')]
   public function index(int $limit): Response
   {
     return new Response(
       implode(', ', array_slice($this->messages, 0, $limit) )); 
   }

   // id<\d> = id is a number
   #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
   public function showOne(int $id): Response
   {
     return new Response($this->messages[$id]); 
   }
}

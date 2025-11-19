<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FollowerController extends AbstractController
{
    #[Route('/follow/{id}', name: 'app_follow')]
    public function follow(
        User $userToFollow,
        ManagerRegistry $doctrine,
        Request $request
    ): Response
    {
        /**
         * @var User $currentUser
         */
       $currentUser = $this->getUser();
       // User cannot foolow themselves
       if($userToFollow->getId() !== $currentUser->getId() )
       {
        $currentUser->follow($userToFollow);
        $doctrine->getManager()->flush(); // 'flush' commits data to DBB, 'getManager' runs query
        // $this->addFlash('success', 'You follow that guy.');
       }
       return $this->redirect($request->headers->get('referer')); // redirect to last page
    }

    #[Route('/unfollow/{id}', name: 'app_unfollow')]
    public function unfollow(
        User $userToUnfollow,
        ManagerRegistry $doctrine,
        Request $request): Response
    {
       /**
         * @var User $currentUser
         */
       $currentUser = $this->getUser();
       // User cannot foolow themselves
       if($userToUnfollow->getId() !== $currentUser->getId() )
       {
        $currentUser->unfollow($userToUnfollow);
        $doctrine->getManager()->flush(); // 'flush' commits data to DBB, 'getManager' runs query
       }
       return $this->redirect($request->headers->get('referer')); // redirect to last page
    }
}

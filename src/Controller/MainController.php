<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Analytics;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/app', name: 'app_')]

class MainController extends AbstractController
{
    #[Route('/home', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/users', name: 'users')]
    public function users(EntityManagerInterface $entityManager): Response
    {

        // Fetch all users from the database
        $users = $entityManager->getRepository(User::class)->findAll();
        $totalUsers = count($users);

        // Pass the users to the template
        return $this->render('main/users.html.twig', [
            'users' => $users,
            'totalUsers' => $totalUsers,
        ]);
    }

    #[Route('/user/{id}/delete', name: 'delete')]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        // Handle user deletion logic here
        $entityManager->remove($user);
        $entityManager->flush();

        // Redirect to the users list after deletion
        return $this->redirectToRoute('app_users');
    }

    #[Route('/user/{id}/edit', name: 'edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('main/edit_user.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
    #[Route('/analytics', name: 'analytics')]
    public function analytics(EntityManagerInterface $entityManager): Response
    {
        // Fetch all analytics data from the database
        $analyticsData = $entityManager->getRepository(Analytics::class)->findAll();
        $totalOrders = count($analyticsData);
        $totalNbrVisits = array_reduce($analyticsData, function ($carry, $analytic) {
            return $carry + $analytic->getNbrVisits();
        }, 0);
        $totalNbrSubmits = array_reduce($analyticsData, function ($carry, $analytic) {
            return $carry + $analytic->getNbrSubmits();
        }, 0);
        $successRate = $totalNbrVisits > 0 ? ($totalNbrSubmits / $totalNbrVisits) * 100 : 0;
    
        // Pass the analytics data to the template
        return $this->render('main/analytics.html.twig', [
            'analyticsData' => $analyticsData,
            'totalOrders' => $totalOrders,
            'totalNbrVisits' => $totalNbrVisits,
            'totalNbrSubmits' => $totalNbrSubmits,
            'successRate' => $successRate,
        ]);
    }

    #[Route('/analytics/{id}/delete', name: 'analytics_delete')]
    public function deleteAnaltic(Analytics $Analytic, EntityManagerInterface $entityManager): Response
    {
        // Handle user deletion logic here
        $entityManager->remove($Analytic);
        $entityManager->flush();

        // Redirect to the users list after deletion
        return $this->redirectToRoute('app_analytics');
    }
    
}
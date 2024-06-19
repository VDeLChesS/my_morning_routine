<?php

namespace App\Controller\Admin;

use App\Entity\Challenges;
use App\Entity\Activities;
use App\Entity\User;
use App\Entity\MorningRoutines;
use App\Entity\Rewards;
use App\Entity\RoutineActivities;
use App\Entity\UserChallenges;
use App\Entity\UserRewards;
use App\Entity\Completions;
use App\Entity\Insights;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png"><span class="text-small"> My Morning Routine </span>')

            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Activities', 'fa-solid fa-rocket', Activities::class);
        yield MenuItem::linkToCrud('Morning Routines', 'fa-solid fa-calendar-day', MorningRoutines::class);
        yield MenuItem::linkToCrud('Routine Activities', 'fa-solid fa-route', RoutineActivities::class);
        yield MenuItem::linkToCrud('Challenges', 'fa-solid fa-dumbbell', Challenges::class);
        yield MenuItem::linkToCrud('Rewards', 'fa-solid fa-trophy', Rewards::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('User Challenges', 'fa-solid fa-user-ninja', UserChallenges::class);
        yield MenuItem::linkToCrud('User Rewards', 'fa-solid fa-user-check', UserRewards::class);
        yield MenuItem::linkToCrud('Completions', 'fa-solid fa-check', Completions::class);

        yield MenuItem::section('Urls');
        yield MenuItem::linkToUrl('Back to the website', 'fa fa-home', '/');
        yield MenuItem::linkToUrl('Search in Google', 'fab fa-google', 'https://google.com');
        yield MenuItem::linkToUrl('Logout', 'fa fa-sign-out', '/logout');

    }
}

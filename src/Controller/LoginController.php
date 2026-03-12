<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class LoginController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        if($request->isMethod('POST')){
            $username = $request->request->get('_username');
            $password = $request->request->get('_password');
            $role = $request->request->get('_roles');

            $user = new User();
            $user->setUsername($username);
            $user->setRoles($role);
            $passwordSecured = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($passwordSecured);

            $em->persist($user);
            $em->flush();

            return new Response ("Usuario ".$username." creado con éxito con el rol ".$role);
        }
        return $this->render('users/registro.html.twig');
    }
}

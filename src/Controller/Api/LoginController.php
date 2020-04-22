<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LoginController
 * @package App\Controller\Api
 * @Route("/api")
 */
class LoginController extends BaseController
{
    /**
     * @Route("/login", name="api_login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/logout", name="api_logout")
     */
    public function logout()
    {
    }
}

<?php

namespace App\Controller\Api;

use App\Constants\Serialization\UserSerialization;
use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller\Api
 * @Route("/api/users")
 */
class UserController extends BaseController
{
    /**
     * @Route("/", name="users_list")
     */
    public function index(UserManager $userManager)
    {
        return $this->jsonResponse($userManager->getUsersList(), UserSerialization::USERS_LIST);
    }

    /**
     * @Route("/get/{id}", name="user_details")
     */
    public function getUserDetails(int $id, UserManager $userManager)
    {
        return $this->jsonResponse($userManager->getUser($id), UserSerialization::USER_DETAILS);
    }

    /**
     * @Route("/create", name="user_add")
     */
    public function createUser(Request $request, UserManager $userManager)
    {
        $user = $userManager
            ->updateUser(
                $this->jsonDeserialize(
                    $request->getContent(),
                    User::class,
                    UserSerialization::USER_ADD
                )
            );

        return $this->jsonResponse($user, UserSerialization::USER_ADD, Response::HTTP_CREATED);
    }

    /**
     * @Route("/update/{id}", name="user_update")
     */
    public function updateUser(int $id, Request $request, UserManager $userManager)
    {
        $user = $userManager
            ->updateUser(
                $this->jsonDeserialize(
                    $request->getContent(),
                    User::class,
                    UserSerialization::USER_UPDATE,
                    $userManager->getUser($id)
                )
            );

        return $this->jsonResponse($user, UserSerialization::USER_UPDATE);
    }

    /**
     * @Route("/delete/{id}", name="user_remove")
     */
    public function removeUser(int $id, UserManager $userManager)
    {
        $userManager->removeUser($userManager->getUser($id));
        return $this->jsonResponse('Usunieto obiekt', []);
    }
}

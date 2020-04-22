<?php

namespace App\Controller\Api;

use App\Constants\Serialization\UserSerialization;
use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Class UserController
 * @package App\Controller\Api
 * @Route("/api/users")
 */
class UserController extends BaseController
{
    /**
     * @Route("/", name="users_list", methods={"GET"})
     */
    public function index(UserManager $userManager)
    {
        return $this->jsonResponse($userManager->getUsersList(), UserSerialization::USERS_LIST);
    }

    /**
     * @Route("/get/{id}", name="user_details", methods={"GET"})
     */
    public function getUserDetails(int $id, UserManager $userManager)
    {
        return $this->jsonResponse($userManager->getUser($id), UserSerialization::USER_DETAILS);
    }

    /**
     * @Route("/create", name="user_add", methods={"POST"})
     */
    public function createUser(Request $request, UserManager $userManager)
    {
        try {
            $user = $this->jsonDeserialize(
                $request->getContent(),
                User::class,
                UserSerialization::USER_ADD
            );

            $this->validate($user);

            return $this->jsonResponse(
                $userManager->updateUser($user),
                UserSerialization::USER_ADD,
                Response::HTTP_CREATED
            );
        } catch (ValidatorException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/update/{id}", name="user_update", methods={"PUT"})
     */
    public function updateUser(int $id, Request $request, UserManager $userManager)
    {
        try {
            if ($userManager->getUser($id)) {
                $user = $this->jsonDeserialize(
                    $request->getContent(),
                    User::class,
                    UserSerialization::USER_UPDATE,
                    $userManager->getUser($id)
                );

                $this->validate($user);

                return $this->jsonResponse($userManager->updateUser($user), UserSerialization::USER_UPDATE);
            }

            return $this->jsonResponse(['error' => 'Nie znaleziono obiektu'], [], Response::HTTP_NOT_FOUND);
        } catch (ValidatorException $exception) {
            return new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/delete/{id}", name="user_remove", methods={"DELETE"})
     */
    public function removeUser(int $id, UserManager $userManager)
    {
        if ($userManager->getUser($id)) {
            $userManager->removeUser($userManager->getUser($id));

            return $this->jsonResponse(['message' => 'Usunięto obiekt'], []);
        }

        return $this->jsonResponse(['error' => 'Nie znaleziono obiektu'], [], Response::HTTP_NOT_FOUND);
    }
}

<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager
{
    private $entityManager;
    private $userRepository;
    private $userPasswordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function getUsersList()
    {
        return $this->userRepository->findAll();
    }

    public function getUser(int $id)
    {
        return $this->userRepository->findOneBy(["id" => $id]);
    }

    /**
     * @param User|object $user
     *
     * @return User
     */
    public function updateUser(User $user): User
    {
        if ($user->getPlainPassword()) {
            $user->setPassword(
                $this->userPasswordEncoder->encodePassword(
                    $user,
                    $user->getPlainPassword()
                )
            );
        }

        if (!$user->getId()) {
            $this->entityManager->persist($user);
        }

        $this->entityManager->flush();

        return $user;
    }

    public function removeUser(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}

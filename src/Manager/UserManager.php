<?php

namespace App\Manager;


class UserManager extends BaseManager
{

    /**
     * @param $criteria
     * @param $limit
     * @param $offset
     * @param $UserRepository
     * @return mixed
     */
    public function listUser($criteria, $limit, $offset, $UserRepository)
    {
        $users = $userRepository->findBySomeField($criteria, $limit, $offset);

        return $users;
    }
}


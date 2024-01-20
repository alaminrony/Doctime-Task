<?php
namespace App\Service;

use App\Service\UserInterface;
use App\Repository\UserRepositoryInterface;

class UserService implements UserInterface{

    protected $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }


    public function getAllUserByPagination($request){

        return $this->userRepositoryInterface->getAllUserByPagination($request);
    }
}

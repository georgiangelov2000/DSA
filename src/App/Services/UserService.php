<?php

namespace App\Services;
use App\DAO\UsersDao;

class UserService
{
    protected UsersDao $userDAO;

    public function __construct(UsersDao $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function getUsers():array {
        return $this->userDAO->findAll();
    }
    
    public function getUsersCount():int {
        return $this->userDAO->getTotal();
    }

    public function getUser(string $id){
        return $this->userDAO->find($id);
    }
    
}

<?php
namespace App\Repository;


interface UserRepositoryInterface{

 public function getAllUserByPagination($request);
 public function redisKeyGenerate($request);

}



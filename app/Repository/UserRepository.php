<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getAllUserByPagination($request)
    {
        //Generate redis Key with my passing parameter
        $redisKey = $this->redisKeyGenerate($request);


        //Check, If Data alredy exists in Redis
        $cachedData = Redis::get($redisKey);

        if (!$cachedData) {
            // For filtering I used Laravel Scope. which is defined by User Model.
            $users = $this->userModel->filter($request)->paginate(20);

            //If no data found in Redis, Then Users data set to Redis with 60 Seconds expiry time.
            /*Here I used serialize() instead of json_encode(). Both are working fine.
            But only for PHP, serialize() is best option to store data in Memory Storage like Redis */

            Redis::setex($redisKey, 60, serialize($users));
        } else {
            $users = unserialize($cachedData);
        }

        return $users;
    }


    public function redisKeyGenerate($request)
    {
        $pageNo = $request->page ??  '1';

        $redisKey = "pagination:users:page_{$pageNo}";
        if (!empty($request->birth_year)) {
            $redisKey .= "_birth_year_{$request->birth_year}";
        }
        if (!empty($request->birth_month)) {
            $redisKey .= "_birth_month_{$request->birth_month}";
        }

        return $redisKey;
    }
}

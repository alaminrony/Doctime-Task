<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $startTime = microtime(true);

        $pageNo = $request->page ??  '1';

        $redisKey = "pagination:users:page_" . $pageNo;

        $cachedData = Redis::get($redisKey);

        if (!$cachedData) {
            $users = User::paginate(20);

            Redis::setex($redisKey, 60, serialize($users));
        } else {
            $users = unserialize($cachedData);
        }


        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        return view('user.index', compact('users', 'executionTime'));
    }
}

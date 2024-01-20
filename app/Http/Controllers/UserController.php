<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Service\UserInterface;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index(Request $request)
    {
        $startTime = microtime(true);

        $users = $this->userInterface->getAllUserByPagination($request);

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        return view('user.index', compact('users', 'executionTime'));
    }
}

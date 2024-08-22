<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected UserInterface $userInterface;

    /**
     * @param UserInterface $userInterface
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->userInterface->getAllUsers();
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->userInterface->getUserDetails($id));
    }
}

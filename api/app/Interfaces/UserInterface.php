<?php
namespace App\Interfaces;

interface UserInterface{
    public function getAllUsers(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function getUserDetails(string $id = null): array;
}

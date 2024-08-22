<?php
namespace App\Repositories;

use App\Interfaces\CacheInterface;
use App\Interfaces\PaginateInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WeatherInterface;
use App\Models\User;

class UserRepository implements UserInterface {
    protected WeatherInterface $weatherInterface;
    protected CacheInterface $cacheInterface;
    protected PaginateInterface $paginateInterface;
    protected User $model;

    /**
     * @param WeatherInterface $weatherInterface
     * @param CacheInterface $cacheInterface
     * @param PaginateInterface $paginateInterface
     * @param User $model
     */
    public function __construct(
        WeatherInterface $weatherInterface,
        CacheInterface $cacheInterface,
        PaginateInterface $paginateInterface,
        User $model
    ){
        $this->weatherInterface = $weatherInterface;
        $this->cacheInterface = $cacheInterface;
        $this->paginateInterface = $paginateInterface;
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllUsers(): \Illuminate\Contracts\Pagination\LengthAwarePaginator{
        $page = $this->paginateInterface->getPage();
        $users = $this->cacheInterface->getFromCache("users-page{$page}");
        if(empty($users)){
            $allUsers = $this->cacheInterface->getFromCache('all-users');
            if(empty($allUsers)){
                $allUsers = User::with('weather')->get();
                $this->cacheInterface->saveToCache('all-users', $allUsers);
            }

            $users = $this->paginateInterface->paginate($allUsers, $this->model, $page);
            $this->cacheInterface->saveToCache("users-page{$page}", $users);
        }

        return $users;
    }

    /**
     * @param string|null $id
     * @return array
     */
    public function getUserDetails(string $id = null): array{
        $user = $this->cacheInterface->getFromCache("user{$id}");
        if(empty($user)){
            $user = User::find($id);
            $this->cacheInterface->saveToCache("user{$id}", $user);
        }

        return [
            'user' => $user,
            'latitudeAndLongitude' => $this->weatherInterface->getUserWeather($user)
        ];
    }
}

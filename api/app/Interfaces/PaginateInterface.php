<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateInterface{
    public function paginate(mixed $items, Model $model, int $page = null, array $options = []): LengthAwarePaginator;
    public function getPage(int $page = null): int;
}

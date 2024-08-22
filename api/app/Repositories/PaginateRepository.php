<?php
namespace App\Repositories;

use App\Interfaces\PaginateInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PaginateRepository implements PaginateInterface {
    /**
     * @param mixed $items
     * @param Model $model
     * @param int|null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate(mixed $items, Model $model, int $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $this->getPage($page);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $perPage = $model->getPerPage();
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * @param int|null $page
     * @return int
     */
    public function getPage(int $page = null): int{
        return $page ?: (Paginator::resolveCurrentPage() ?: 1);
    }
}

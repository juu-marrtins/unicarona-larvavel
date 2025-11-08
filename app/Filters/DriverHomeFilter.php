<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class DriverHomeFilter
{
    public function __construct(
        protected Builder $builder,
        protected array $data
    ) {}

    public function applyFilter(): Builder
    {
        $this->search();
        return $this->builder;
    }

    public function search(): void
    {
        if ($term = data_get($this->data, 'search')) {
            $this->builder->where(function ($query) use ($term) {
                $query->whereHas('passanger', function ($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                    ->orWhere('user_title', 'like', "%{$term}%");
                });
            });
        }
    }
}   
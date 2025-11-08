<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PassangerHomeFilter
{
    public function __construct(
        protected Builder $builder,
        protected array $data
    ){}

    public function applyFilter()
    {
        $this->search();

        return $this->builder;
    }

    public function search()
    {
    
        if($term = data_get($this->data, 'search')) {
            $this->builder = $this->builder->where(function ($query) use ($term) {
            $query->whereHas('origin', function ($q) use ($term) {
                $q->where('street', 'like', "%{$term}%")
                ->orWhere('number', 'like', "%{$term}%")
                ->orWhere('district', 'like', "%{$term}%")
                ->orWhere('city', 'like', "%{$term}%")
                ->orWhere('state', 'like', "%{$term}%");
            })
            ->orWhereHas('destination', function ($q) use ($term) {
                $q->where('street', 'like', "%{$term}%")
                ->orWhere('number', 'like', "%{$term}%")
                ->orWhere('district', 'like', "%{$term}%")
                ->orWhere('city', 'like', "%{$term}%")
                ->orWhere('state', 'like', "%{$term}%");
                });
            });
        }
    }
}
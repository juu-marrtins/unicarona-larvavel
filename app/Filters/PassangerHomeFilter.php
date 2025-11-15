<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PassangerHomeFilter
{
    public function __construct(
        protected Builder $builder,
        protected String $data
    ){}

    public function applyFilter()
    {
        $this->search();

        return $this->builder;
    }

    public function search()
    {
    
        if($term = $this->data) {
            $this->builder = $this->builder->where(function ($query) use ($term) {
            $query->whereHas('origin', function ($q) use ($term) {
                $q->where('street', 'ILIKE', "%{$term}%")
                ->orWhere('number', 'ILIKE', "%{$term}%")
                ->orWhere('district', 'ILIKE', "%{$term}%")
                ->orWhere('city', 'ILIKE', "%{$term}%")
                ->orWhere('state', 'ILIKE', "%{$term}%");
            })
            ->orWhereHas('destination', function ($q) use ($term) {
                $q->where('street', 'ILIKE', "%{$term}%")
                ->orWhere('number', 'ILIKE', "%{$term}%")
                ->orWhere('district', 'ILIKE', "%{$term}%")
                ->orWhere('city', 'ILIKE', "%{$term}%")
                ->orWhere('state', 'ILIKE', "%{$term}%");
                });
            });
        }
    }
}
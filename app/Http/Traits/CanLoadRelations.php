<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait CanLoadRelations
{
    public function loadRelations(Model|Builder|EloquentBuilder|HasMany $for, ?array $relations = null) : Model|Builder|EloquentBuilder|HasMany
    {
        $relations = $relations ?? $this->relations ?? [];
        foreach ($relations as $relation){
            $for->when(
                $this->shouldIncludeRelation($relation),
                fn($q) => $for instanceof Model ? $q->load($relation) : $q->with($relation)
            );
        }

        return $for;
    }
}

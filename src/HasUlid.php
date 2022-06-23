<?php
namespace Rorecek\Ulid;

trait HasUlid
{
    protected static function bootHasUlid()
    {
        $column = property_exists(static::class, 'ulidColumn') ? static::$ulidColumn : 'id';

        static::creating(function ($model) use ($column) {
            if (! $model->{$column}) {
                $model->{$column} = Ulid::generate();
            }
        });

        static::saving(function ($model) use ($column) {
            $originalUlid = $model->getOriginal($column);
            if ($originalUlid !== $model->{$column}) {
                $model->{$column} = $originalUlid;
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}

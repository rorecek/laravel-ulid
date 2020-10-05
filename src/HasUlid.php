<?php
namespace Rorecek\Ulid;

trait HasUlid
{
    protected static function bootHasUlid()
    {
        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = \Ulid::generate();
            }
        });

        static::saving(function ($model) {
            $originalUlid = $model->getOriginal('id');
            if ($originalUlid !== $model->id) {
                $model->id = $originalUlid;
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }
}

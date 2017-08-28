<?php
namespace Rorecek\Ulid\Facades;

use Illuminate\Support\Facades\Facade;

class Ulid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ulid';
    }
}
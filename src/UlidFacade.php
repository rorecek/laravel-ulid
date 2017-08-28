<?php
namespace Rorecek\Ulid;

use Illuminate\Support\Facades\Facade;

class UlidFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ulid';
    }
}
<?php
namespace Rorecek\Ulid\Contracts;

interface Factory
{
    public function generate(): string;
}
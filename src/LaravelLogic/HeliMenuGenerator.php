<?php

namespace Helilabs\HeliMenuGenerator\LaravelLogic;

use Illuminate\Support\Facades\Facade;

Class HeliMenuGenerator extends Facade {

	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'Helilabs\HeliMenuGenerator'; }

}
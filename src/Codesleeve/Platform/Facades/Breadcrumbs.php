<?php namespace Codesleeve\Platform\Facades;

class Breadcrumbs extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'platform.breadcrumbs'; }
}
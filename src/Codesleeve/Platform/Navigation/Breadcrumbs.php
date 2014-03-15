<?php namespace Codesleeve\Platform\Navigation;

use Route;

class Breadcrumbs
{
	/**
	 * URL String
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Name of Breadcrumb
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Sets the active class
	 *
	 * @var string
	 */
	public $active;

	/**
	 * Create an array of breadcrumbs to use if needed on a page
	 *
	 * @return array
	 */
	public function fromCurrentUrl()
	{
		$breadcrumbs = array();

		$paths = explode('/', trim(Route::getCurrentRoute()->getPath(), '/'));

		$url = "";

        foreach ($paths as $path)
        {
            if (strpos($path, '{') === false && strpos($path, '}') === false)
            {
                $url .= "/{$path}";
                $name = $path;
            }
            else
            {
            	$name = substr($path, 1, -1);
            	$param = Route::getCurrentRoute()->getParameter($name);
            	$name = $this->singular($name);
            	$url .= "/" . $param;
            }

            $breadcrumbs[] = $this->newInstance($name, $url);
		}

	    return $breadcrumbs;
	}

	/**
	 * Create a new instance of a breadcrumb
	 *
	 * @param  string $name
	 * @param  string $url
	 * @param  string $active
	 *
	 * @return Breadcrumb
	 */
	protected function newInstance($name, $url, $active = "")
	{
		$breadCrumb = new Breadcrumbs;

		$breadCrumb->name = ucfirst(str_replace('-', ' ', $name));
		$breadCrumb->url = $url;
		$breadCrumb->active = $active;

		return $breadCrumb;
	}

	/**
	 * Create a singular version of this name. Allows us to override
	 * any names that str_singular doesn't do correctly.
	 *
	 * @param  string $name
	 * @return string
	 */
	protected function singular($name)
	{
		if ($name == "menus")
		{
			return "menu";
		}

		return str_singular($name);
	}
}
<?php

/*
|--------------------------------------------------------------------------
| to_javascript
|--------------------------------------------------------------------------
|
| This macro will convert an array of models into json data and script tags
| that we can use to access our data via javascript. It is useful for doing
| simple stuff with angularjs without having to call backend api resources.
|
*/
if (!function_exists('to_javascript'))
{
	function to_javascript($models)
	{
		$javascript = '';

		foreach ($models as $fqn => $model)
		{
			$namespaces = explode('.', $fqn);
			$builtNamespace = 'window';

			if (is_string($fqn))
			{
				foreach ($namespaces as $index => $namespace)
				{
					$builtNamespace .= ".{$namespace}";
					$javascript .= "{$builtNamespace} = (typeof {$builtNamespace} === 'undefined') ? {} : {$builtNamespace};" . PHP_EOL;
				}
			}

			$json = json_encode($model);

			// try to use toJSON() if it is available
			try { $json = $model->toJSON(); } catch (Exception $e) { }

			$javascript .= "{$builtNamespace} = " . $json . PHP_EOL;
		}

		return '<script>' . $javascript . '</script>';
	}
}


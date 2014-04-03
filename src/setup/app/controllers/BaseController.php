<?php

class BaseController extends \Codesleeve\Platform\Controllers\BaseController
{
	/**
	 * Layout we should use for the main layout
	 *
	 * @var string
	 */
	protected $layout = 'layouts.application';

	/**
	 * There is no namespace we are in
	 *
	 * @var string
	 */
	protected $namespace = false;

}
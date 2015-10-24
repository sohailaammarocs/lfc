<?php namespace Cartalyst\Widgets\Laravel;
/**
 * Part of the Widgets package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Widgets
 * @version    1.1.1
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Cartalyst\Widgets\WidgetResolver;
use Illuminate\Support\ServiceProvider;

class WidgetsServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		$blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

		$blade->extend(function($value) use ($blade)
		{
			$matcher = $blade->createMatcher('widget');

			return preg_replace($matcher, '<?php echo app(\'widgets\')->make$2; ?>', $value);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$this->app['widgets'] = $this->app->share(function($app)
		{
			return new WidgetResolver($app, $app['extensions']);
		});
	}

}

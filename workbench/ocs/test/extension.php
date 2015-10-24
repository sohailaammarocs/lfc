<?php

use Illuminate\Foundation\Application;
use Cartalyst\Extensions\ExtensionInterface;
use Cartalyst\Settings\Repository as Settings;
use Cartalyst\Permissions\Container as Permissions;

return [

	/*
	|--------------------------------------------------------------------------
	| Name
	|--------------------------------------------------------------------------
	|
	| This is your extension name and it is only required for
	| presentational purposes.
	|
	*/

	'name' => 'Test',

	/*
	|--------------------------------------------------------------------------
	| Slug
	|--------------------------------------------------------------------------
	|
	| This is your extension unique identifier and should not be changed as
	| it will be recognized as a new extension.
	|
	| Ideally, this should match the folder structure within the extensions
	| folder, but this is completely optional.
	|
	*/

	'slug' => 'ocs/test',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'sohaila ammar',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'aaaa',

	/*
	|--------------------------------------------------------------------------
	| Version
	|--------------------------------------------------------------------------
	|
	| Version should be a string that can be used with version_compare().
	| This is how the extensions versions are compared.
	|
	*/

	'version' => '0.1.0',

	/*
	|--------------------------------------------------------------------------
	| Requirements
	|--------------------------------------------------------------------------
	|
	| List here all the extensions that this extension requires to work.
	| This is used in conjunction with composer, so you should put the
	| same extension dependencies on your main composer.json require
	| key, so that they get resolved using composer, however you
	| can use without composer, at which point you'll have to
	| ensure that the required extensions are available.
	|
	*/

	'require' => [],

	/*
	|--------------------------------------------------------------------------
	| Autoload Logic
	|--------------------------------------------------------------------------
	|
	| You can define here your extension autoloading logic, it may either
	| be 'composer', 'platform' or a 'Closure'.
	|
	| If composer is defined, your composer.json file specifies the autoloading
	| logic.
	|
	| If platform is defined, your extension receives convetion autoloading
	| based on the Platform standards.
	|
	| If a Closure is defined, it should take two parameters as defined
	| bellow:
	|
	|	object \Composer\Autoload\ClassLoader      $loader
	|	object \Illuminate\Foundation\Application  $app
	|
	| Supported: "composer", "platform", "Closure"
	|
	*/

	'autoload' => 'composer',

	/*
	|--------------------------------------------------------------------------
	| Service Providers
	|--------------------------------------------------------------------------
	|
	| Define your extension service providers here. They will be dynamically
	| registered without having to include them in app/config/app.php.
	|
	*/

	'providers' => [

		'Ocs\Test\ProductsServiceProvider',
		'Ocs\Test\YyyServiceProvider',

	],

	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| any custom routing logic here.
	|
	| The closure parameters are:
	|
	|	object \Cartalyst\Extensions\ExtensionInterface  $extension
	|	object \Illuminate\Foundation\Application        $app
	|
	*/

	'routes' => function(ExtensionInterface $extension, Application $app)
	{
		Route::group([
				'prefix'    => admin_uri().'/test/products',
				'namespace' => 'Ocs\Test\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.test.products.all', 'uses' => 'ProductsController@index']);
				Route::post('/', ['as' => 'admin.ocs.test.products.all', 'uses' => 'ProductsController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.test.products.grid', 'uses' => 'ProductsController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.test.products.create', 'uses' => 'ProductsController@create']);
				Route::post('create', ['as' => 'admin.ocs.test.products.create', 'uses' => 'ProductsController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.test.products.edit'  , 'uses' => 'ProductsController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.test.products.edit'  , 'uses' => 'ProductsController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.test.products.delete', 'uses' => 'ProductsController@delete']);
			});

		Route::group([
			'prefix'    => 'test/products',
			'namespace' => 'Ocs\Test\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'ProductsController@index');
		});

					Route::group([
				'prefix'    => admin_uri().'/test/yyys',
				'namespace' => 'Ocs\Test\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.test.yyys.all', 'uses' => 'YyysController@index']);
				Route::post('/', ['as' => 'admin.ocs.test.yyys.all', 'uses' => 'YyysController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.test.yyys.grid', 'uses' => 'YyysController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.test.yyys.create', 'uses' => 'YyysController@create']);
				Route::post('create', ['as' => 'admin.ocs.test.yyys.create', 'uses' => 'YyysController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.test.yyys.edit'  , 'uses' => 'YyysController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.test.yyys.edit'  , 'uses' => 'YyysController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.test.yyys.delete', 'uses' => 'YyysController@delete']);
			});

		Route::group([
			'prefix'    => 'test/yyys',
			'namespace' => 'Ocs\Test\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'YyysController@index');
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Database Seeds
	|--------------------------------------------------------------------------
	|
	| Platform provides a very simple way to seed your database with test
	| data using seed classes. All seed classes should be stored on the
	| `database/seeds` directory within your extension folder.
	|
	| The order you register your seed classes on the array below
	| matters, as they will be ran in the exact same order.
	|
	| The seeds array should follow the following structure:
	|
	|	Vendor\Namespace\Database\Seeds\FooSeeder
	|	Vendor\Namespace\Database\Seeds\BarSeeder
	|
	*/

	'seeds' => [

	],

	/*
	|--------------------------------------------------------------------------
	| Permissions
	|--------------------------------------------------------------------------
	|
	| Register here all the permissions that this extension has. These will
	| be shown in the user management area to build a graphical interface
	| where permissions can be selected to allow or deny user access.
	|
	| For detailed instructions on how to register the permissions, please
	| refer to the following url https://cartalyst.com/manual/permissions
	|
	*/

	'permissions' => function(Permissions $permissions)
	{
		$permissions->group('products', function($g)
		{
			$g->name = 'Products';

			$g->permission('products.index', function($p)
			{
				$p->label = trans('ocs/test::products/permissions.index');

				$p->controller('Ocs\Test\Controllers\Admin\ProductsController', 'index, grid');
			});

			$g->permission('products.create', function($p)
			{
				$p->label = trans('ocs/test::products/permissions.create');

				$p->controller('Ocs\Test\Controllers\Admin\ProductsController', 'create, store');
			});

			$g->permission('products.edit', function($p)
			{
				$p->label = trans('ocs/test::products/permissions.edit');

				$p->controller('Ocs\Test\Controllers\Admin\ProductsController', 'edit, update');
			});

			$g->permission('products.delete', function($p)
			{
				$p->label = trans('ocs/test::products/permissions.delete');

				$p->controller('Ocs\Test\Controllers\Admin\ProductsController', 'delete');
			});
		});

		$permissions->group('yyy', function($g)
		{
			$g->name = 'Yyys';

			$g->permission('yyy.index', function($p)
			{
				$p->label = trans('ocs/test::yyys/permissions.index');

				$p->controller('Ocs\Test\Controllers\Admin\YyysController', 'index, grid');
			});

			$g->permission('yyy.create', function($p)
			{
				$p->label = trans('ocs/test::yyys/permissions.create');

				$p->controller('Ocs\Test\Controllers\Admin\YyysController', 'create, store');
			});

			$g->permission('yyy.edit', function($p)
			{
				$p->label = trans('ocs/test::yyys/permissions.edit');

				$p->controller('Ocs\Test\Controllers\Admin\YyysController', 'edit, update');
			});

			$g->permission('yyy.delete', function($p)
			{
				$p->label = trans('ocs/test::yyys/permissions.delete');

				$p->controller('Ocs\Test\Controllers\Admin\YyysController', 'delete');
			});
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Widgets
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| all your custom widgets here. Of course, Platform will guess the
	| widget class for you, this is just for custom widgets or if you
	| do not wish to make a new class for a very small widget.
	|
	*/

	'widgets' => function()
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	|
	| Register any settings for your extension. You can also configure
	| the namespace and group that a setting belongs to.
	|
	*/

	'settings' => function(Settings $settings, Application $app)
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Menus
	|--------------------------------------------------------------------------
	|
	| You may specify the default various menu hierarchy for your extension.
	| You can provide a recursive array of menu children and their children.
	| These will be created upon installation, synchronized upon upgrading
	| and removed upon uninstallation.
	|
	| Menu children are automatically put at the end of the menu for extensions
	| installed through the Operations extension.
	|
	| The default order (for extensions installed initially) can be
	| found by editing app/config/platform.php.
	|
	*/

	'menus' => [

		'admin' => [
			[
				'slug' => 'admin-ocs-test',
				'name' => 'Test',
				'class' => 'fa fa-circle-o',
				'uri' => 'test',
				'regex' => '/:admin\/test/i',
				'children' => [
					[
						'slug' => 'admin-ocs-test-products',
						'name' => 'Products',
						'class' => 'fa fa-circle-o',
						'uri' => 'test/products',
					],
					[
						'slug' => 'admin-ocs-test-yyy',
						'name' => 'Yyys',
						'class' => 'fa fa-circle-o',
						'uri' => 'test/yyys',
					],
				],
			],
		],
		'main' => [
			
		],
	],

];

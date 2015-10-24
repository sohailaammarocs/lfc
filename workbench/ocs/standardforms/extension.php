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

	'name' => 'Standardforms',

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

	'slug' => 'ocs/standardforms',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'Sohaila Ammar',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'standard forms',

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

		'Ocs\Standardforms\ContactusformServiceProvider',
		'Ocs\Standardforms\JoincompetitionServiceProvider',
		'Ocs\Standardforms\BookrefereesServiceProvider',

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
				'prefix'    => admin_uri().'/standardforms/contactusforms',
				'namespace' => 'Ocs\Standardforms\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.standardforms.contactusforms.all', 'uses' => 'ContactusformsController@index']);
				Route::post('/', ['as' => 'admin.ocs.standardforms.contactusforms.all', 'uses' => 'ContactusformsController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.standardforms.contactusforms.grid', 'uses' => 'ContactusformsController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.standardforms.contactusforms.create', 'uses' => 'ContactusformsController@create']);
				Route::post('create', ['as' => 'admin.ocs.standardforms.contactusforms.create', 'uses' => 'ContactusformsController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.standardforms.contactusforms.edit'  , 'uses' => 'ContactusformsController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.standardforms.contactusforms.edit'  , 'uses' => 'ContactusformsController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.standardforms.contactusforms.delete', 'uses' => 'ContactusformsController@delete']);
			});

		Route::group([
			'prefix'    => 'standardforms/contactusforms',
			'namespace' => 'Ocs\Standardforms\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'ContactusformsController@index');
		});

					Route::group([
				'prefix'    => admin_uri().'/standardforms/joincompetitions',
				'namespace' => 'Ocs\Standardforms\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.standardforms.joincompetitions.all', 'uses' => 'JoincompetitionsController@index']);
				Route::post('/', ['as' => 'admin.ocs.standardforms.joincompetitions.all', 'uses' => 'JoincompetitionsController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.standardforms.joincompetitions.grid', 'uses' => 'JoincompetitionsController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.standardforms.joincompetitions.create', 'uses' => 'JoincompetitionsController@create']);
				Route::post('create', ['as' => 'admin.ocs.standardforms.joincompetitions.create', 'uses' => 'JoincompetitionsController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.standardforms.joincompetitions.edit'  , 'uses' => 'JoincompetitionsController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.standardforms.joincompetitions.edit'  , 'uses' => 'JoincompetitionsController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.standardforms.joincompetitions.delete', 'uses' => 'JoincompetitionsController@delete']);
			});

		Route::group([
			'prefix'    => 'standardforms/joincompetitions',
			'namespace' => 'Ocs\Standardforms\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'JoincompetitionsController@index');
		});

					Route::group([
				'prefix'    => admin_uri().'/standardforms/bookreferees',
				'namespace' => 'Ocs\Standardforms\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.standardforms.bookreferees.all', 'uses' => 'BookrefereesController@index']);
				Route::post('/', ['as' => 'admin.ocs.standardforms.bookreferees.all', 'uses' => 'BookrefereesController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.standardforms.bookreferees.grid', 'uses' => 'BookrefereesController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.standardforms.bookreferees.create', 'uses' => 'BookrefereesController@create']);
				Route::post('create', ['as' => 'admin.ocs.standardforms.bookreferees.create', 'uses' => 'BookrefereesController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.standardforms.bookreferees.edit'  , 'uses' => 'BookrefereesController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.standardforms.bookreferees.edit'  , 'uses' => 'BookrefereesController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.standardforms.bookreferees.delete', 'uses' => 'BookrefereesController@delete']);
			});

		Route::group([
			'prefix'    => 'standardforms/bookreferees',
			'namespace' => 'Ocs\Standardforms\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'BookrefereesController@index');
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
		$permissions->group('contactusform', function($g)
		{
			$g->name = 'Contactusforms';

			$g->permission('contactusform.index', function($p)
			{
				$p->label = trans('ocs/standardforms::contactusforms/permissions.index');

				$p->controller('Ocs\Standardforms\Controllers\Admin\ContactusformsController', 'index, grid');
			});

			$g->permission('contactusform.create', function($p)
			{
				$p->label = trans('ocs/standardforms::contactusforms/permissions.create');

				$p->controller('Ocs\Standardforms\Controllers\Admin\ContactusformsController', 'create, store');
			});

			$g->permission('contactusform.edit', function($p)
			{
				$p->label = trans('ocs/standardforms::contactusforms/permissions.edit');

				$p->controller('Ocs\Standardforms\Controllers\Admin\ContactusformsController', 'edit, update');
			});

			$g->permission('contactusform.delete', function($p)
			{
				$p->label = trans('ocs/standardforms::contactusforms/permissions.delete');

				$p->controller('Ocs\Standardforms\Controllers\Admin\ContactusformsController', 'delete');
			});
		});

		$permissions->group('joincompetition', function($g)
		{
			$g->name = 'Joincompetitions';

			$g->permission('joincompetition.index', function($p)
			{
				$p->label = trans('ocs/standardforms::joincompetitions/permissions.index');

				$p->controller('Ocs\Standardforms\Controllers\Admin\JoincompetitionsController', 'index, grid');
			});

			$g->permission('joincompetition.create', function($p)
			{
				$p->label = trans('ocs/standardforms::joincompetitions/permissions.create');

				$p->controller('Ocs\Standardforms\Controllers\Admin\JoincompetitionsController', 'create, store');
			});

			$g->permission('joincompetition.edit', function($p)
			{
				$p->label = trans('ocs/standardforms::joincompetitions/permissions.edit');

				$p->controller('Ocs\Standardforms\Controllers\Admin\JoincompetitionsController', 'edit, update');
			});

			$g->permission('joincompetition.delete', function($p)
			{
				$p->label = trans('ocs/standardforms::joincompetitions/permissions.delete');

				$p->controller('Ocs\Standardforms\Controllers\Admin\JoincompetitionsController', 'delete');
			});
		});

		$permissions->group('bookreferees', function($g)
		{
			$g->name = 'Bookreferees';

			$g->permission('bookreferees.index', function($p)
			{
				$p->label = trans('ocs/standardforms::bookreferees/permissions.index');

				$p->controller('Ocs\Standardforms\Controllers\Admin\BookrefereesController', 'index, grid');
			});

			$g->permission('bookreferees.create', function($p)
			{
				$p->label = trans('ocs/standardforms::bookreferees/permissions.create');

				$p->controller('Ocs\Standardforms\Controllers\Admin\BookrefereesController', 'create, store');
			});

			$g->permission('bookreferees.edit', function($p)
			{
				$p->label = trans('ocs/standardforms::bookreferees/permissions.edit');

				$p->controller('Ocs\Standardforms\Controllers\Admin\BookrefereesController', 'edit, update');
			});

			$g->permission('bookreferees.delete', function($p)
			{
				$p->label = trans('ocs/standardforms::bookreferees/permissions.delete');

				$p->controller('Ocs\Standardforms\Controllers\Admin\BookrefereesController', 'delete');
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
				'slug' => 'admin-ocs-standardforms',
				'name' => 'Standardforms',
				'class' => 'fa fa-circle-o',
				'uri' => 'standardforms',
				'regex' => '/:admin\/standardforms/i',
				'children' => [
					[
						'slug' => 'admin-ocs-standardforms-contactusform',
						'name' => 'Contactusforms',
						'class' => 'fa fa-circle-o',
						'uri' => 'standardforms/contactusforms',
					],
					[
						'slug' => 'admin-ocs-standardforms-joincompetition',
						'name' => 'Joincompetitions',
						'class' => 'fa fa-circle-o',
						'uri' => 'standardforms/joincompetitions',
					],
					[
						'slug' => 'admin-ocs-standardforms-bookreferees',
						'name' => 'Bookreferees',
						'class' => 'fa fa-circle-o',
						'uri' => 'standardforms/bookreferees',
					],
				],
			],
		],
		'main' => [
			
		],
	],

];

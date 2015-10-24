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

	'name' => 'Finance',

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

	'slug' => 'ocs/finance',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'Mona Hashem',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'Finance',

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

		'Ocs\Finance\StatementServiceProvider',
		'Ocs\Finance\TransactionServiceProvider',

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
				'prefix'    => admin_uri().'/finance/statements',
				'namespace' => 'Ocs\Finance\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.finance.statements.all', 'uses' => 'StatementsController@index']);
				Route::post('/', ['as' => 'admin.ocs.finance.statements.all', 'uses' => 'StatementsController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.finance.statements.grid', 'uses' => 'StatementsController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.finance.statements.create', 'uses' => 'StatementsController@create']);
				Route::post('create', ['as' => 'admin.ocs.finance.statements.create', 'uses' => 'StatementsController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.finance.statements.edit'  , 'uses' => 'StatementsController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.finance.statements.edit'  , 'uses' => 'StatementsController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.finance.statements.delete', 'uses' => 'StatementsController@delete']);
			});

		Route::group([
			'prefix'    => 'finance/statements',
			'namespace' => 'Ocs\Finance\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'StatementsController@index');
		});

					Route::group([
				'prefix'    => admin_uri().'/finance/transactions',
				'namespace' => 'Ocs\Finance\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.ocs.finance.transactions.all', 'uses' => 'TransactionsController@index']);
				Route::post('/', ['as' => 'admin.ocs.finance.transactions.all', 'uses' => 'TransactionsController@executeAction']);

				Route::get('grid', ['as' => 'admin.ocs.finance.transactions.grid', 'uses' => 'TransactionsController@grid']);

				Route::get('create' , ['as' => 'admin.ocs.finance.transactions.create', 'uses' => 'TransactionsController@create']);
				Route::post('create', ['as' => 'admin.ocs.finance.transactions.create', 'uses' => 'TransactionsController@store']);

				Route::get('{id}'   , ['as' => 'admin.ocs.finance.transactions.edit'  , 'uses' => 'TransactionsController@edit']);
				Route::post('{id}'  , ['as' => 'admin.ocs.finance.transactions.edit'  , 'uses' => 'TransactionsController@update']);

				Route::delete('{id}', ['as' => 'admin.ocs.finance.transactions.delete', 'uses' => 'TransactionsController@delete']);
			});

		Route::group([
			'prefix'    => 'finance/transactions',
			'namespace' => 'Ocs\Finance\Controllers\Frontend',
		], function()
		{
			Route::get('/', 'TransactionsController@index');
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
		$permissions->group('statement', function($g)
		{
			$g->name = 'Statements';

			$g->permission('statement.index', function($p)
			{
				$p->label = trans('ocs/finance::statements/permissions.index');

				$p->controller('Ocs\Finance\Controllers\Admin\StatementsController', 'index, grid');
			});

			$g->permission('statement.create', function($p)
			{
				$p->label = trans('ocs/finance::statements/permissions.create');

				$p->controller('Ocs\Finance\Controllers\Admin\StatementsController', 'create, store');
			});

			$g->permission('statement.edit', function($p)
			{
				$p->label = trans('ocs/finance::statements/permissions.edit');

				$p->controller('Ocs\Finance\Controllers\Admin\StatementsController', 'edit, update');
			});

			$g->permission('statement.delete', function($p)
			{
				$p->label = trans('ocs/finance::statements/permissions.delete');

				$p->controller('Ocs\Finance\Controllers\Admin\StatementsController', 'delete');
			});
		});

		$permissions->group('transaction', function($g)
		{
			$g->name = 'Transactions';

			$g->permission('transaction.index', function($p)
			{
				$p->label = trans('ocs/finance::transactions/permissions.index');

				$p->controller('Ocs\Finance\Controllers\Admin\TransactionsController', 'index, grid');
			});

			$g->permission('transaction.create', function($p)
			{
				$p->label = trans('ocs/finance::transactions/permissions.create');

				$p->controller('Ocs\Finance\Controllers\Admin\TransactionsController', 'create, store');
			});

			$g->permission('transaction.edit', function($p)
			{
				$p->label = trans('ocs/finance::transactions/permissions.edit');

				$p->controller('Ocs\Finance\Controllers\Admin\TransactionsController', 'edit, update');
			});

			$g->permission('transaction.delete', function($p)
			{
				$p->label = trans('ocs/finance::transactions/permissions.delete');

				$p->controller('Ocs\Finance\Controllers\Admin\TransactionsController', 'delete');
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
				'slug' => 'admin-ocs-finance',
				'name' => 'Finance',
				'class' => 'fa fa-circle-o',
				'uri' => 'finance',
				'regex' => '/:admin\/finance/i',
				'children' => [
					[
						'slug' => 'admin-ocs-finance-statement',
						'name' => 'Statements',
						'class' => 'fa fa-circle-o',
						'uri' => 'finance/statements',
					],
					[
						'slug' => 'admin-ocs-finance-transaction',
						'name' => 'Transactions',
						'class' => 'fa fa-circle-o',
						'uri' => 'finance/transactions',
					],
				],
			],
		],
		'main' => [
			
		],
	],

];

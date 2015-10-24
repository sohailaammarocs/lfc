<?php namespace Cartalyst\ComposerInstallers;
/**
 * Part of the Composer Installers package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Composer Installers
 * @version    1.2.1
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class BaseInstaller extends LibraryInstaller {

	/**
	 * Paths array.
	 *
	 * @var array
	 */
	protected $paths = [
		'base'   => '/../../../..',
		'public' => '/../../../../public',
	];

	/**
	 * Returns the path.
	 *
	 * @param  string  $path
	 * @return string
	 */
	protected function getPath($path)
	{
		$pathsFile = __DIR__.'/../../../../bootstrap/paths.php';

		if (file_exists($pathsFile))
		{
			$paths = require $pathsFile;
		}

		return isset($paths[$path]) ? $paths[$path] : __DIR__.$this->paths[$path];
	}

}

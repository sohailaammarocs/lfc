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

class ThemeInstaller extends BaseInstaller {

	/**
	 * {@inheritDoc}
	 */
	public function getPackageBasePath(PackageInterface $package)
	{
		$package = explode('/', $package->getPrettyName());

		$path = str_replace('-', '/', $package[1]);

		$basePath = $this->getPath('public');

		return $basePath.'/themes/'.$path;
	}

	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return $packageType == 'platform-theme';
	}

}

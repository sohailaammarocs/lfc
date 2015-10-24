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

class ExtensionInstaller extends BaseInstaller {

	/**
	 * {@inheritDoc}
	 */
	public function getPackageBasePath(PackageInterface $package)
	{
		$basePath = $this->getPath('base');

		return $basePath.'/extensions/'.$package->getPrettyName();
	}

	/**
	 * {@inheritDoc}
	 */
	public function supports($packageType)
	{
		return $packageType == 'platform-extension';
	}

}

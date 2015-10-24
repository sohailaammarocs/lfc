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

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class ThemeInstallerPlugin implements PluginInterface {

	/**
	 * {@inheritDoc}
	 */
	public function activate(Composer $composer, IOInterface $io)
	{
		$installer = new ThemeInstaller($io, $composer);

		$composer->getInstallationManager()->addInstaller($installer);
	}

}

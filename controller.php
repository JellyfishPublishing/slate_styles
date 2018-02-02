<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
/**
 * Installer for Slate Styles Package
 *
 * @package concrete5-package-slate-styles
 * @author Ali Zandieh <www.ali-zandieh.com>
 **/
class SlateStylesPackage extends Package {
    
    protected $pkgHandle = 'slate_styles';
	protected $appVersionRequired = '5.4.1.1';
	protected $pkgVersion = '1.0';
	
	/**
	 * C5 function
	 *
	 * @access public
	 * @return string
	 */
	public function getPackageDescription() {
		return t('The Slate theme customized CSS');
	}
	
	/**
	 * C5 function
	 *
	 * @access public
	 * @return string
	 */
	public function getPackageName() {
		return t('Slate Styles');
	}
	
	/**
	 * Add the creative dashboard single page
	 *
	 * @access public
	 * @return void
	 **/
	public function install() {
	    $pkg = parent::install();
	    
	    Loader::model('single_page');
	    $creative = SinglePage::add('/dashboard/slate_styles/', $pkg);
	    $creative->update(array('cName'=>t('Slate Styles'), 'cDescription'=> 'Upload slate stylesheet'));
	}
    
} 
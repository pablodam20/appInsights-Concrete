<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

require_once 'vendor/autoload.php';
require_once 'vendor/microsoft/application-insights/vendor/autoload.php';

class AppInsightsPackage extends Package{
    
    protected $pkgHandle = 'appinsights';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '1.0';
	protected $page;
	public function getPackageDescription() {
		return t("Integrates a Concrete5 site with Microsoft Application Insights");
	}
	
	public function getPackageName() {
		return t("Application Insights");
	}
    
	public function on_start() {
		Events::extend('on_render_complete', 'AppInsightsPackage', 'on_render_complete', 'packages/'.$this->pkgHandle.'/Controller.php');
		Events::extend('on_before_render', 'AppInsightsPackage', 'on_before_render', 'packages/'.$this->pkgHandle.'/Controller.php');

	}
	public function on_before_render() {
		$page = Page::getCurrentPage();
		if (!$page->isEditMode())
		{
        // Enables client-side instrumentation
		$_instrumentationKey = 'Poner_Aca_IK';
        $clientInstrumentation = new ApplicationInsights\Joomla\Client_Instrumentation();
        $clientInstrumentation->addPrefix($_instrumentationKey,$page->getCollectionName());
		}
	}
	public function on_render_complete(){
		$page = Page::getCurrentPage();
		if (!$page->isEditMode())
		{
		// Enables server-side instrumentation
		$_instrumentationKey = 'Poner_Aca_IK';
		$serverInstrumentation = new ApplicationInsights\Joomla\Server_Instrumentation($_instrumentationKey,$page->getCollectionName());
		register_shutdown_function(array($serverInstrumentation, 'endRequest'));
		}
	}

	
	public function install() {
		$pkg = parent::install();
		// install block		
		BlockType::installBlockTypeFromPackage('appinsights', $pkg);
	}
	

    
}

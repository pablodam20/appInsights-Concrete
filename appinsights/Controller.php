<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

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
	//$_instrumentationKey = 'Poner aca Instrumentation Key';
	//$serverInstrumentation = new \packages\appinsights\src\Server_Instrumentation($_instrumentationKey);
	//Events::extend('on_render_complete', 'Server_Instrumentation', 'endRequest', 'packages/' . $this->pkgHandle . '/src/Server_Instrumentation.php',array("Poner_aca_la_IK"));
	}

	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('appinsights', $pkg);
	}
	
	//Functin for Backend and Frontend
	$c; if ($c->isEditMode()) { 
		//This function get a bollean value, True is you are in the backend
		//if the function get false is because you are in the frontend
		//This area is for code
	} 
	else { 
		//This area is for code
	}
    
}

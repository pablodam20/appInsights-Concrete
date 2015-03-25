<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
class AppInsightsBlockController extends BlockController {
    
    protected $btName = 'Application Insights';
    protected $btDescription = 'Integrates a Concrete5 site with Microsoft Application Insights';
    
    public function getBlockTypeDescription() {
		return t("Integrates a Concrete5 site with Microsoft Application Insights");
	}
    
	public function getBlockTypeName() {
		return t("Application Insights");
	}
}
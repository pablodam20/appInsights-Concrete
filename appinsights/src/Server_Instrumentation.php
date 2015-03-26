<?php
namespace ApplicationInsights\Concrete;
defined('C5_EXECUTE') or die(_("Access Denied."));
class Server_Instrumentation
{
    private $_telemetryClient;
    
    public function __construct($_instrumentationKey)
    {
        $this->_telemetryClient = new \ApplicationInsights\Telemetry_Client();
        $this->_telemetryClient->getContext()->setInstrumentationKey($_instrumentationKey);   
        set_exception_handler(array($this, 'exceptionHandler'));
    }
    
    function endRequest()
    {
        //cambiar condición a función que diga si es frontend
        //if (is_page() || is_single() || is_category() || is_home() || is_archive())
        {
            $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            $requestName = $this->getRequestName();
            $startTime = $_SERVER["REQUEST_TIME"];
            $duration = ($this->getMicrotime() - $this->_startTime) * 1000;
            $this->_telemetryClient->trackRequest($requestName, $url, $startTime, $duration);
            // Flush all telemetry items
            $this->_telemetryClient->flush(); 
			
        }
    }

    function getRequestName()
    {
            $page = Page::getCurrentPage();
            if ($page->getCollectionID == HOME_CID)
            {
                return 'Home';
            }
            else
            {
              return $page->getCollectionName();   
            }

    }

    function getMicrotime()
    {
        list($useg, $seg) = explode(" ", microtime());
        return ((float)$useg + (float)$seg);
    }
    
    
    function exceptionHandler(\Exception $exception)
    {
        if ($exception != NULL)
        {
            $this->_telemetryClient->trackException($exception);
            $this->_telemetryClient->flush();
        }
    }
}



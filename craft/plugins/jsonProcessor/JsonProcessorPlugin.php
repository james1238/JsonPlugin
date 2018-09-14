<?php
namespace Craft;

class JsonProcessorPlugin extends BasePlugin
{

	function getName()
	{
		return Craft::t('Json Processor');
	}

	function getVersion()
	{
		return '0.1';
	}

	function getDeveloper()
	{
		return 'JB';
	}

	function getDeveloperUrl()
	{
		return 'http://jamesbarnard.xyz';
	}

	function hasCpSection()
    {
        return true;
    }
    
    public function registerCpRoutes()
    {
        return array(

    	//user this area for custom CP routes

        );

	}

}

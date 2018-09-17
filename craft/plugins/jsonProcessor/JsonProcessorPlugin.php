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
		return '0.1.2';
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

	/**
	 * Plugin settings.
	 *
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'jsonFeedUrl'   => array(AttributeType::String)
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('jsonProcessor/settings/_settings', array(
			'settings' => $this->getSettings()
		));
	}
    
    public function registerCpRoutes()
    {
        return array(

    	//user this area for custom CP routes

        );

	}

}

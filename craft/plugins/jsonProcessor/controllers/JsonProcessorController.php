<?php
namespace Craft;

class JsonProcessorController extends BaseController
{

    protected $allowAnonymous = true;


   public function actionRefreshFeed() {

        craft()->userSession->requireAdmin();

        $settings = craft()->plugins->getPlugin('JsonProcessor')->getSettings();
        $feedUrl = $settings->jsonFeedUrl;

        if(!isset($feedUrl)) {
            $feedUrl = 'http://api.letsride.co.uk/public/v1/rides';
        }

        $feedResponce = craft()->jsonProcessor_json->getFeedData($feedUrl);

        $jsonModelArray = array(
            'url' 			    => $feedUrl,
            'rawJson' 			=> $feedResponce);
        $jsonModel = JsonProcessor_JsonModel::populateModel($jsonModelArray);

        craft()->jsonProcessor_json->saveFeedData($jsonModel);

        $this->processFeed($feedResponce);

        $this->returnJson('done');

   }

    private function processFeed($feedResponce){

        $array = json_decode($feedResponce,1);
        $this->updateNextFeedUrl('test');

        if($array) {

            //var_dump($array);
            if($array['next']) {
                $this->updateNextFeedUrl($array['next']);
            }

            if($array['items']) {
                craft()->jsonProcessor_entries->process($array['items']);
            }

        }

    }

    private function updateNextFeedUrl($url) {
        //Todo - store these in their own table in the future ability to add multiple feeds etc

        $plugin = craft()->plugins->getPlugin('JsonProcessor');
        craft()->plugins->savePluginSettings( $plugin, array('jsonFeedUrl' => $url));

    }

    public function actionGetEntries() {

        $entriesQuery = craft()->jsonProcessor_entries->listEntries(0,100);

        $this->returnJson($entriesQuery);

    }
    public function actionListJson() {
        //Todo - store these in their own table in the future ability to add multiple feeds etc

        $imports = $this->returnJson(craft()->jsonProcessor_json->listImports());

        return $this->returnJson(craft()->jsonProcessor_json->listImports());

    }




}
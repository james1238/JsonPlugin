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
            $feedUrl = 'http://api.letsride.co.uk/public/v1/rides?afterTimestamp=3000&afterId=30000';
        }

        $feedResponce = craft()->jsonProcessor_json->getFeedData($feedUrl);

       if($feedResponce) {

           $jsonModelArray = array(
               'url' => $feedUrl,
               'rawJson' => $feedResponce);
           $jsonModel = JsonProcessor_JsonModel::populateModel($jsonModelArray);

           craft()->jsonProcessor_json->saveFeedData($jsonModel);

           $this->processFeed($feedResponce);

           $this->returnJson('done');
       }

       $this->returnJson('error');

   }

    private function processFeed($feedResponce){

        $array = json_decode($feedResponce,1);

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

    public function actionDeleteAllData() {

        craft()->userSession->requireAdmin();

        craft()->jsonProcessor_entries->deleteAll();
        craft()->jsonProcessor_json->deleteAll();

        $this->returnJson('done');

    }

    public function actionGetEntries() {

        $entriesQuery = craft()->jsonProcessor_entries->listEntries(0,100);

        $this->returnJson($entriesQuery);

    }


    public function actionListJson() {

        $imports = $this->returnJson(craft()->jsonProcessor_json->listImports());

        return $this->returnJson($imports);

    }


    public function actionListImport($id) {

        $import = craft()->jsonProcessor_json->downloadImport($id);

        return $this->returnFormattedJson($import[0]['rawJson']);


    }

    public function returnFormattedJson($var = '')
    {
        // Set the 'application/json' Content-Type header
        JsonHelper::setJsonContentTypeHeader();

        // Output it into a buffer, in case TasksService wants to close the connection prematurely
        ob_start();
        echo $var;

        craft()->end();
    }




}
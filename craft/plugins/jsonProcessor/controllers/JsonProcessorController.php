<?php
namespace Craft;

class JsonProcessorController extends BaseController
{

    protected $allowAnonymous = true;


   public function actionRefreshFeed() {

        craft()->userSession->requireAdmin();

        $settings = craft()->plugins->getPlugin('JsonProcessor')->getSettings();

        $feedUrl = $settings->jsonFeedUrl;

        $feedResponce = craft()->jsonProcessor_json->getFeedData($feedUrl);

        $jsonModelArray = array(
            'url' 			    => $feedUrl,
            'rawJson' 			=> $feedResponce
        );

        $jsonModel = JsonProcessor_JsonModel::populateModel($jsonModelArray);

        craft()->jsonProcessor_json->saveFeedData($jsonModel);

       $this->returnJson('done');


    }


}
<?php
namespace Craft;


class JsonProcessor_JsonService extends BaseApplicationComponent
{

    protected $jsonUrl;

    public function getFeedData($url){

        $client = new \Guzzle\Http\Client();

        $request = $client->get($url);
        $response = $request->send();

        //var_dump($responce); exit;

        return $response->getBody();

    }

    public function saveFeedData(jsonProcessor_JsonModel $jsonModel)
    {

        $jsonRecord = new JsonProcessor_JsonRecord();

        $jsonRecord->setAttribute('url', $jsonModel->url);
        $jsonRecord->setAttribute('rawJson', $jsonModel->rawJson);

        $jsonRecord->save();

    }

}
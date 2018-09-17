<?php
namespace Craft;


class JsonProcessor_JsonService extends BaseApplicationComponent
{
    protected $jsonUrl;

    public function getFeedData($url){

        $client = new \Guzzle\Http\Client();
        $request = $client->get($url);

        try {
            $response = $request->send();
        }
        catch (\Exception $e)
        {
            craft()->errorHandler->logException($e);
        }

        if($response->getStatusCode() !== 200) {
            JsonProcessorPlugin::log('Status 200 not recived? check the url?', LogLevel::Error);
        }

        return $response->getBody();

    }

    public function saveFeedData(jsonProcessor_JsonModel $jsonModel)
    {
        if(!$jsonModel->validate()){
            //Todo - return error here, it won't save anyway but you know
        }

        $jsonRecord = new JsonProcessor_JsonRecord();

        $jsonRecord->setAttribute('url', $jsonModel->url);
        $jsonRecord->setAttribute('rawJson', $jsonModel->rawJson);

        $jsonRecord->save();


    }

}
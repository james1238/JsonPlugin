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

        if(!isset($response) || $response->getStatusCode() !== 200) {
            JsonProcessorPlugin::log('Status 200 not recived? check the url?', LogLevel::Error);
            return '';
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
        $jsonRecord->setAttribute('dateProcessed', new DateTime('now'));

        $jsonRecord->save();


    }

    public function deleteAll()
    {
        craft()->db->createCommand()->delete('jsonProcessor_json');

        return;
    }

    public function downloadImport($id)
    {
        $listImport = craft()->db->createCommand()
            ->select('rawJson')
            ->where(array('id' => $id))
            ->from('jsonProcessor_json')->queryAll();

        return $listImport;
    }

    public function listImports()
    {
        $listImports = craft()->db->createCommand()
            ->select('*')
            ->from('jsonProcessor_json')->queryAll();

        return $listImports;
    }


}
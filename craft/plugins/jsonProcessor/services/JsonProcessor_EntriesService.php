<?php
namespace Craft;


class JsonProcessor_EntriesService extends BaseApplicationComponent
{
    private $_allEntries;
    private $_deleteArray;

    public function _allEntries()
    {
        $this->_allEntries = craft()->db->createCommand()
            ->select('*')
            ->from('jsonProcessor_entries')
            ->queryColumn();

        return $this->_allEntryIds;
    }

    public function process(array $items) {

        foreach($items as $item) {

            //Todo - this will have to be run as a task as execution size increases
            if($item['state'] == "delete") {
                //Todo - add to delete array and skip
            }

          /*  $entriesModelArray = array (
                'identifier' => $item['id'],
                'modified'  => $item['modified'],
                //'kind'  => $item['kind'],
                'name'  => $item['data']['name']
                //'rawData' => json_encode($item['data']),
            );*/

            $entriesRecord = new JsonProcessor_EntriesRecord();

            $entriesRecord->setAttribute('identifier', $item['id'] ?? '');
            $entriesRecord->setAttribute('kind', $item['data']['activity'][0]['prefLabel'] ?? '');
            $entriesRecord->setAttribute('modified', $item['modified'] ?? '');
            $entriesRecord->setAttribute('name', $item['data']['name'] ?? '');
            $entriesRecord->setAttribute('rawData', json_encode($item['data'] ?? ''));
            $entriesRecord->setAttribute('description', $item['data']['programme']['description'] ?? '');
            $entriesRecord->setAttribute('url', $item['data']['url'] ?? '');
            $entriesRecord->setAttribute('logo', $item['data']['programme']['logo'] ?? '');
            $entriesRecord->setAttribute('image', $item['image'] ?? '');
            $entriesRecord->setAttribute('level', $item['data']['level'][0] ?? '');
            $entriesRecord->setAttribute('address', $item['location']['address']['postalCode'] ?? '');
            $entriesRecord->setAttribute('description', $item['data']['programme']['description'] ?? '');


            if(isset($item['data']['startDate'])) {
                //Todo - validate this object
                $date = new \DateTime($item['data']['startDate']);
                $entriesRecord->setAttribute('startDate', $date);
            }

            $entriesRecord->setAttribute('latitude', $item['data']['location']['geo']['latitude'] ?? '');
            $entriesRecord->setAttribute('longitude', $item['data']['location']['geo']['longitude'] ?? '');

            $entriesRecord->validate();

            $recordErrors = $entriesRecord->getErrors();
            if($recordErrors) {
                foreach($recordErrors as $k => $error) {
                    JsonProcessorPlugin::log('Parse Error:'. serialize($error), LogLevel::Error);
                    $entriesRecord->setAttribute($k,'');
                }
            }

            if($entriesRecord->validate()) {
                $entriesRecord->save();
            }

            /* don't have time to do something like this for v1

             if(is_array($item)) {

            }
            $thingsWeNeedFromArray = array(
                'email-address-new',
                'email-address-new'
            );

            foreach ($bla as $k => $v) {
                if (in_array($k, $filterKeys)) {
                    setAttribute($submission[$k]);
                }
            } */

            //$entriesModel = JsonProcessor_EntriesModel::populateModel($entriesModelArray);


            //$entriesRecord->setAttribute('name','james');

            //$entriesRecord->identifier = $item['id'];


            //exit;

        }
    }
    public function listEntries($start,$limit,$orderBy = 'startDate')
    {

        //Todo - a nicer way of doing this would be to get it from the record then pass an array to exclude
        $colunmsToinclude = array(
            'identifier',
            //'modified',
            'kind',
            'name',
            'url',
            'startDate',
            'activity',
            'description',
            'logo',
            'images',
            'level',
            'address',
            'latitude',
            'longitude',
            //'rawData'
        );

        $entriesQuery = craft()->db->createCommand()
            ->select($colunmsToinclude)
            ->from('jsonProcessor_entries')
            ->order($orderBy . ' desc')
            ->queryAll();

        return $entriesQuery;
    }


    public function deleteAll()
    {
        craft()->db->createCommand()->delete('jsonProcessor_entries');

        return;
    }


}
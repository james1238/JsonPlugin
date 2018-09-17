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

            //var_dump($entriesModelArray); exit;

            //$entriesRecord->setAttributes($entriesModelArray);

            $entriesRecord->setAttribute('identifier', $item['id']);
            $entriesRecord->setAttribute('kind', $item['kind']);
            $entriesRecord->setAttribute('modified', $item['modified']);
            $entriesRecord->setAttribute('name', $item['data']['name']);
            $entriesRecord->setAttribute('rawData',  json_encode($item['data']));
            $entriesRecord->validate();
            $entriesRecord->save();
            //var_dump($item['data']['name']); exit;

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
}
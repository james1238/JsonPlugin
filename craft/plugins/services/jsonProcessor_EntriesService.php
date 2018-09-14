<?php
namespace Craft;


class jsonProcessor_EntriesService extends BaseApplicationComponent
{
    private $_allEntries;

    public function _allEntries()
    {
        $this->_allEntries = craft()->db->createCommand()
            ->select('*')
            ->from('formbuilder2_entries')
            ->queryColumn();

        return $this->_allEntryIds;
    }
}
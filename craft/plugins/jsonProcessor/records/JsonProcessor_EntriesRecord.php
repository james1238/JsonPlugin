<?php
namespace Craft;

class JsonProcessor_EntriesRecord extends BaseRecord
{
    /**
     * Get Table Name
     *
     */
    public function getTableName()
    {
        return 'jsonprocessor_entries';
    }

    /**
     * Define Attributes
     *
     */
    public function defineAttributes()
    {
        return array(
            'eventId'      => AttributeType::Number,
            'title'        => AttributeType::String,
            'url'          => AttributeType::String,
            'lat'          => AttributeType::Mixed,
            'long'         => AttributeType::Mixed,
        );
    }

}
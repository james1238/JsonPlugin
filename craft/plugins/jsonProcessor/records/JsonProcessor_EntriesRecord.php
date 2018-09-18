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
            'identifier'    => AttributeType::Number,
            'modified'      => AttributeType::Number,
            'kind'          => AttributeType::String,
            'name'          => AttributeType::String,
            'url'           => AttributeType::String,
            'startDate'     => AttributeType::DateTime,
            'activity'      => AttributeType::String,
            'description'   => AttributeType::Mixed,
            'logo'          => AttributeType::String,
            'images'        => AttributeType::String,
            'level'         => AttributeType::String,
            'address'       => AttributeType::String,
            'latitude'      => array(AttributeType::Number => array('min' => 0, 'max' => 3, 'decimals' => 10)),
            'longitude'     => array(AttributeType::Number => array('min' => 0, 'max' => 3, 'decimals' => 10)),
            'rawData'       => AttributeType::Mixed
        );
    }

    public function defineIndexes()
    {
        return array(
            array('columns' => array('identifier'), 'unique' => true),
        );
    }

}
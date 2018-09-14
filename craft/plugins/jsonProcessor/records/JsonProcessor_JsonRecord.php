<?php
namespace Craft;

class JsonProcessor_JsonRecord extends BaseRecord
{
    /**
     * Get Table Name
     *
     */
    public function getTableName()
    {
        return 'jsonProcessor_json';
    }

    /**
     * Define Attributes
     *
     */
    public function defineAttributes()
    {
        return array(
            'rawJson'      => AttributeType::Number,
            'url'          => AttributeType::String
        );
    }
    
}
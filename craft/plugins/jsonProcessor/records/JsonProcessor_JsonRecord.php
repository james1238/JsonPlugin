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
        return 'jsonprocessor_json';
    }

    /**
     * Define Attributes
     *
     */
    public function defineAttributes()
    {
        return array(
            'rawJson'       => array(AttributeType::Mixed, 'column' => ColumnType::MediumText),
            'url'           => AttributeType::String,
            'dateProcessed' => AttributeType::DateTime
        );
    }
    
}
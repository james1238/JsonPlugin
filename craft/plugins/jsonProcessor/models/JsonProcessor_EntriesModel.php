<?php
namespace Craft;

class JsonProcessor_EntriesModel extends BaseElementModel
{

    protected function defineAttributes()
    {
        return array(
            'identifier'    => AttributeType::Number,
            'modified'      => AttributeType::Number,
            'kind'          => AttributeType::String,
            'name'          => AttributeType::String,
            'url'           => AttributeType::String,
            'startDate'     => AttributeType::DateTime,
            'activity'      => AttributeType::String,
            'description'   => AttributeType::String,
            'logo'          => AttributeType::String,
            'images'        => AttributeType::String,
            'level'         => AttributeType::String,
            'address'       => AttributeType::String,
            'latitude'      => AttributeType::Number,
            'longitude'     => AttributeType::Number,
            'rawData'       => AttributeType::Mixed
        );
    }


}
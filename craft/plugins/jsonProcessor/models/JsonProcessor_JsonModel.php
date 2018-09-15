<?php
namespace Craft;

class JsonProcessor_JsonModel extends BaseElementModel
{
    protected function defineAttributes()
    {
        return array(
            'rawJson'      => AttributeType::String,
            'url'          => AttributeType::String
        );
    }
}
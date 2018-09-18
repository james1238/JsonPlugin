<?php
namespace Craft;

class JsonProcessorVariable
{

    public function getImports()
    {
        return craft()->jsonProcessor_json->listImports();
    }
}
<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DyanmicDropdown\CustomOptions in options provider class
 */
class Resolution implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return "db_value_1";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items = new DataObject\Resolution\Listing();
        $items->setOrderKey("Resolution");
        $items->setOrder('asc');
        $arr = [];

        foreach ($items as $item) {
            array_push($arr, ["value" => $item->getResolution(), "key" => $item->getResolution()]);
        }

        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}

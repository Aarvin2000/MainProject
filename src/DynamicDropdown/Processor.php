<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DyanmicDropdown\CustomOptions in options provider class
 */
class Processor implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return "db_value_1";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items = new DataObject\Processor\Listing();
        $items->setOrderKey("Processor");
        $items->setOrder('asc');
        $arr = [];

        foreach ($items as $item) {
            array_push($arr, ["value" => $item->getProcessor(), "key" => $item->getProcessor()]);
        }

        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}

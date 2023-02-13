<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DyanmicDropdown\CustomOptions in options provider class
 */
class ScreenSize implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return "db_value_1";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items = new DataObject\ScreenSize\Listing();
        $items->setOrderKey("ScreenSize");
        $items->setOrder('asc');
        $arr = [];

        foreach ($items as $item) {
            array_push($arr, ["value" => $item->getScreenSize(), "key" => $item->getScreenSize()]);
        }

        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}

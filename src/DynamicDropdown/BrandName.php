<?php

namespace App\DynamicDropdown;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;
use Pimcore\Model\DataObject;

/**
 * Need to provide App\DyanmicDropdown\CustomOptions in options provider class
 */
class BrandName implements SelectOptionsProviderInterface
{
    public function getDefaultValue($context, $fieldDefinition)
    {
        return " ";
    }

    function getOptions($context, $fieldDefinition)
    {
        $items = new DataObject\Ebrands\Listing();
        $items->setOrderKey("brandName");
        $items->setOrder('asc');
        $arr = [];

        foreach ($items as $item) {
            array_push($arr, ["value" => $item->getBrandName(), "key" => $item->getBrandName()]);
        }

        return $arr;
    }

    function hasStaticOptions($context, $fieldDefinition)
    {
        return true;
    }
}

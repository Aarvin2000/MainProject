<?php

namespace App\Controller;

use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\DataObject\Manufacturer;

use Pimcore\Model\DataObject\Localizedfield;

class CalculatorController implements CalculatorClassInterface
{
    /**     
     * @param Request $request     
     * @return Response     
     */

    public function compute(Concrete $object, CalculatedValue $context):string {
        if ($context->getFieldname() == "description") {
            $language = $context->getPosition();
            return  $object->getbrandName($language). " " . $object->getModelName($language). " " . $object->getProductColor($language);
        } else {
            \Logger::error("unknown field");
        }
    }
    
    public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string
    {
        $language = $context->getPosition();
        $result = $this->compute($object, $context);
        return $result;
    }
}

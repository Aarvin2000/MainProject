<?php

namespace App\Controller;

use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Manufacturer;

use Pimcore\Model\DataObject\Localizedfield;

class ManCalc implements CalculatorClassInterface
{
    /**     
     * @param Request $request     
     * @return Response     
     */

    public function compute(Concrete $object, CalculatedValue $context):string {
        if ($context->getFieldname() == "brandName") {
            $language = $context->getPosition();
            // return $object->getGender($language) . " " . $object->getProductName($language)   $object->getManufacturer()->getName($language) . ;
            return  $object->getManufacturer()->getName($language);
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

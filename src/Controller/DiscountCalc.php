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

class DiscountCalc implements CalculatorClassInterface
{
    /**     
     * @param Request $request     
     * @return Response     
     */

    public function compute(Concrete $object, CalculatedValue $context):string {
        if ($context->getFieldname() == "displayPrice") {
            $language = $context->getPosition();
            $dis = $object->getdiscountPercentage();
            $price = $object->getPrice()->getValue($language);
            return  $price - ($price * $dis)/100;
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

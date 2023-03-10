<?php
namespace App\Controller;
 
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Cloth;
use Pimcore\Model\DataObject\Localizedfield;
 
class ClothingCalculatorController implements CalculatorClassInterface
{
 /**     
 * @param $data     
 * @param $object     
 * @param $params     
 *     
 * @return string     
 */
 
 /**     
 * @param Request $request     
 * @return Response     
 */
 
 public function compute(Concrete $object, CalculatedValue $context):string {
 if ($context->getFieldname() == "fullName") {
 $language = $context->getPosition();
 return $object->getNameAddition($language) . " " . $object->getItemModelNumber($language) . " " . $object->getManufacturer()->getName($language) ;
 } else {
 \Logger::error("unknown field");
 }
 }
 public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string {
 $language = $context->getPosition();
 $result = $this->compute($object, $context);
 return $result;
 }
}
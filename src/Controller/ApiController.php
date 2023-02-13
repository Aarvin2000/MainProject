<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\DataObject;
class ApiController extends FrontendController
{
  

/**
* @Route("/electronicapi", methods={"GET","POST"})
*/
public function ElectronicApi(): Response
{ //$object_array=[];
$items = new DataObject\Electronics\Listing();
$items->setOrderKey("sku");
$items->setOrder("asc");

$tablet=[];
$laptop=[];
$phone=[];
$earphone=[];

foreach ($items as $item) {
    //$data_one_obj=[];
    $data_one_obj=['sku'=>$item->getSku(),
'description'=>$item->getDescription(),
'model'=>$item->getModelName(),
'brand'=>$item->getBrandName(),
'description'=>$item->getDescription(),
// 'price'=>$item->getPrice()->getValue(),
'discount'=>$item->getDiscountPercentage(),
'color'=>$item->getProductColor(),
'discount'=>$item->getDiscountPercentage(),
// 'battery'=>$item->getBatteryCapacity()->getValue(),
'discount'=>$item->getDiscountPercentage(),
'quickCharge'=>$item->getQuickCharging(),
'Bluetooth'=>$item->getBluetooth(),
'connectivity'=>$item->getConnectivity(),
'wi-fi'=>$item->getWifi(),
'os'=>$item->getOperatingSystem(),
'mfd'=>$item->getManufacturingDate(),
'warranty'=>$item->getWarranty(),
'discount'=>$item->getDiscountPercentage(),
//'manufacturer'=>$item->getManufacturer()->getName(),
//'seller'=>$item->getSellerDetails()[0]->getName(),
'discount'=>$item->getDiscountPercentage(),
];


if ($item->getProductSpecific()->getTablet()) {
    $specific=
['RAM'=>$item->getProductSpecific()->getTablet()->getRAM(),
'Storage'=>$item->getProductSpecific()->getTablet()->getInternalStorage(),
'Processor'=>$item->getProductSpecific()->getTablet()->getProcessor(),
'ScreenSize'=>$item->getProductSpecific()->getTablet()->getScreenSize(),
'Resolution'=>$item->getProductSpecific()->getTablet()->getResolution()




];

$tablet[]=array_merge( $data_one_obj,$specific);
}

else if ($item->getProductSpecific()->getLaptop()) {
    $specific=
['RAM'=>$item->getProductSpecific()->getLaptop()->getRAM(),
'Storage'=>$item->getProductSpecific()->getLaptop()->getInternalStorage(),
'Processor'=>$item->getProductSpecific()->getLaptop()->getProcessor(),
'ScreenSize'=>$item->getProductSpecific()->getLaptop()->getScreenSize(),
'Resolution'=>$item->getProductSpecific()->getLaptop()->getResolution(),
'graphicCardName'=>$item->getProductSpecific()->getLaptop()->getGraphicCardName(),
'graphicCardSize'=>$item->getProductSpecific()->getLaptop()->getGraphicCardSize(),
'camera'=>$item->getProductSpecific()->getLaptop()->getCamera()




];

$laptop[]=array_merge( $data_one_obj,$specific);
}


else if ($item->getProductSpecific()->getMobile()) {
    $specific=
['RAM'=>$item->getProductSpecific()->getMobile()->getRAM(),
'Storage'=>$item->getProductSpecific()->getMobile()->getInternalStorage(),
'Processor'=>$item->getProductSpecific()->getMobile()->getProcessor(),
'ScreenSize'=>$item->getProductSpecific()->getMobile()->getScreenSize(),
// 'Resolution'=>$item->getProductSpecific()->getMobile()->getResolution(),
// 'graphicCardName'=>$item->getProductSpecific()->getMobile()->getGraphicCardName(),
// 'graphicCardSize'=>$item->getProductSpecific()->getMobile()->getGraphicCardSize(),
'camera'=>$item->getProductSpecific()->getMobile()->getCamera()




];

$phone[]=array_merge( $data_one_obj,$specific);
}

else if ($item->getProductSpecific()->getEarphone()) {
    $specific=
['DeviceType'=>$item->getProductSpecific()->getEarphone()->getDeviceType(),
'EarphoneType'=>$item->getProductSpecific()->getEarphone()->getEarphoneType()




];

$earphone[]=array_merge( $data_one_obj,$specific);
}
else{
    
}




}





return $this->json(['tablet'=>$tablet,'laptops'=>$laptop,'phone'=>$phone,'earphone'=>$earphone]);


}
}
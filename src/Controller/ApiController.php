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
    public function ElectronicApi(Request $request): Response
    { //$object_array=[];
        $category = $request->get("category");
        $items = new DataObject\Electronics\Listing();
        $items->setOrderKey("sku");
        $items->setOrder("asc");

        $tablet = [];
        $laptop = [];
        $phone = [];
        $earphone = [];

        foreach ($items as $item) {
            //$data_one_obj=[];
            $data_one_obj = [
                'sku' => $item->getSku(),
                'model' => $item->getModelName(),
                'brand' => $item->getBrandName(),
                'description' => $item->getDescription(),
                'color' => $item->getProductColor(),
                'discount' => $item->getDiscountPercentage(),
                'quickCharge' => $item->getQuickCharging(),
                'Bluetooth' => $item->getBluetooth(),
                'wi-fi' => $item->getWifi(),
                'os' => $item->getOperatingSystem(),
                'connectivity' => $item->getConnectivity(),
                'mfd' => $item->getManufacturingDate(),
                'warranty' => $item->getWarranty(),
                'discount' => $item->getDiscountPercentage(),
            ];


            if ($item->getProductSpecific()->getTablet()) {
                $specific =
                    [
                        'RAM' => $item->getProductSpecific()->getTablet()->getRAM(),
                        'Storage' => $item->getProductSpecific()->getTablet()->getInternalStorage(),
                        'Processor' => $item->getProductSpecific()->getTablet()->getProcessor(),
                        'ScreenSize' => $item->getProductSpecific()->getTablet()->getScreenSize(),
                        'Resolution' => $item->getProductSpecific()->getTablet()->getResolution()
                    ];

                $tablet[] = array_merge($data_one_obj, $specific);
            } else if ($item->getProductSpecific()->getLaptop()) {
                $specific =
                    [
                        'RAM' => $item->getProductSpecific()->getLaptop()->getRAM(),
                        'Storage' => $item->getProductSpecific()->getLaptop()->getInternalStorage(),
                        'Processor' => $item->getProductSpecific()->getLaptop()->getProcessor(),
                        'ScreenSize' => $item->getProductSpecific()->getLaptop()->getScreenSize(),
                        'Resolution' => $item->getProductSpecific()->getLaptop()->getResolution(),
                        'graphicCardName' => $item->getProductSpecific()->getLaptop()->getGraphicCardName(),
                        'graphicCardSize' => $item->getProductSpecific()->getLaptop()->getGraphicCardSize(),
                        'camera' => $item->getProductSpecific()->getLaptop()->getCamera()
                    ];

                $laptop[] = array_merge($data_one_obj, $specific);
            } else if ($item->getProductSpecific()->getMobile()) {
                $specific =
                    [
                        'RAM' => $item->getProductSpecific()->getMobile()->getRAM(),
                        'Storage' => $item->getProductSpecific()->getMobile()->getInternalStorage(),
                        'Processor' => $item->getProductSpecific()->getMobile()->getProcessor(),
                        'ScreenSize' => $item->getProductSpecific()->getMobile()->getScreenSize(),
                        'Resolution'=>$item->getProductSpecific()->getMobile()->getResolution(),
                        'camera' => $item->getProductSpecific()->getMobile()->getCamera()
                    ];

                $mobile[] = array_merge($data_one_obj, $specific);
            } else if ($item->getProductSpecific()->getEarphone()) {
                $specific =
                    [
                        'DeviceType' => $item->getProductSpecific()->getEarphone()->getDeviceType(),
                        'EarphoneType' => $item->getProductSpecific()->getEarphone()->getEarphoneType()
                    ];

                $earphone[] = array_merge($data_one_obj, $specific);
            } else {
            }
        }

        if ($category == "tablet") {
            return $this->json(['tablet' => $tablet]);
        } else if ($category == "laptop") {
            return $this->json(['laptops' => $laptop]);
        } else if ($category == "mobile") {
            return $this->json(['mobile' => $mobile]);
        } else if ($category == "earphone") {
            return $this->json(['earphone' => $earphone]);
        } 
        else if ($category == "all") {
            return $this->json(['tablet' => $tablet, 'laptops' => $laptop, 'mobile' => $mobile, 'earphone' => $earphone]);
        } 
        else { 
            return $this->json(['message'=>"Please enter valid category ie laptop,mobile,tablet,earphone "]);   
        }
    }
}

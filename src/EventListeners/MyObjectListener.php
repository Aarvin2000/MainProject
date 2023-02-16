<?php

namespace App\EventListeners;
// use Pimcore\Event\Model\AssetEvent;
// use App\Services\funProvider;
// use Exception;

use App\Controller\NotificationController;
use Pimcore\Model\DataObject\Electronics;
use Pimcore\Model\DataObject\Seller;
use Pimcore\Model\Notification\Service\NotificationService;
use Pimcore\Model\Notification\Service;

class MyObjectListener
{
    public function beforeUpdate(\Pimcore\Event\Model\DataObjectEvent $event)
    {
        $object = $event->getObject();
        if ($object instanceof Seller) {
                $obj = new NotificationController;
                $userService = new Service\UserService;
                $notificationService = new NotificationService($userService);
                $obj->sendNotification($notificationService,"Seller");
        }
    }


    public function onObjectPreUpdate(\Pimcore\Event\Model\DataObjectEvent $e)
    {
        $obj = $e->getObject();
        if ($obj instanceof Electronics) {
            $objmfd = $obj->getManufacturingDate();
            //$mfd=date(substr($objmfd,0,10));
            $date=date_create(substr($objmfd,0,10));
           $d1=date_format($date,"Y-m-d");
            
            $current = date("Y-m-d");

            if($d1>$current){
                throw new \Exception("Manufacturing Date cant be greater than Curent Date");
            }
        }
    }
}








































































            // $mail = new \Pimcore\Mail();
            // $mail->to('rajat.sharma2@happiestminds.com');
            // //$str=$name." 's feedback .User like : ".$likes." other product suggestions ".$other;           
            // $mail->html("<h3> object successfully created</h3>");
            // $mail->send();  
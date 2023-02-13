<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\DataObject;

class DefaultController extends FrontendController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function defaultAction(Request $request): Response
    {
        return $this->render('default/default.html.twig');
    }

    /**

     * @Route("/clothesapi", methods={"GET","POST"})

     */
    public function ClothesApi(): Response
    {

        $items = new DataObject\Clothing\Listing();
        // $items->setOrderKey("price");
        // $items->setOrder("asc");
        $clothes = [];

        foreach ($items as $item) {

            $data_one_obj = ['productId' => $item->getProductId(), 'ProductName' => $item->getProductName(), 'gender' => $item->getGender(), 'description' => $item->getDescription(), 'Material' => $item->getMaterial(), 'Occasion' => $item->getOccasion(), 'Fit' => $item->getFit(), 'Color' => $item->getColor(), 'mfd' => $item->getManufacturingDate()];
            $clothes[] = $data_one_obj;
        }



        return $this->json(['clothes' => $clothes]);
    }
}

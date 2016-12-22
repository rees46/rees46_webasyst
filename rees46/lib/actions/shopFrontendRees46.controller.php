<?php

/**
* @desc контроллер плагина рекомендаций REES46
*/
class shopFrontendRees46Controller extends waJsonController
{    
    /**
    * @desc Возвращаем JSON массив с данными о товарах
    */
    function execute()
    {        
        // список ID товаров
        $product_ids = waRequest::get('product_ids');
        $intval_ids = array();
        foreach (explode(",", $product_ids) as $id) {
            $intval_ids[] = intval($id);
        }

        $collection = new shopProductsCollection('id/' . implode(',', $intval_ids));
        $coll_products = $collection->getProducts();

        $products = array();
        $currency = wa()->getConfig()->getCurrency();

        foreach ($coll_products as $product) {
            if ($product != null && $product['count'] !== '0'){
                $image_url = '';
                if (isset($product['image_id']) && (!empty($product['image_id'])) ){
                    $image_url = shopImage::getUrl(array('product_id' => $product['id'], 'id' => $product['image_id'], 'ext' => $product['ext']), 200);
                } 

                $p = Array(
                    'id' => $product["id"],
                    'name' => $product["name"],
                    'url' =>  $product["frontend_url"] . '?recommended_by=',
                    'price' => (float)($product['price']),
                    'print_price' => wa_currency($product["price"], $currency, $format='%{h}'),
                    'image_url' => $image_url
                );
                array_push($products, $p);
            }
        }

        // Standart JSON response {"status":"ok","data":$products}
        $this->response = $products;
    }

}
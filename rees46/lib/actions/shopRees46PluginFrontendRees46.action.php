<?php

/**
* @desc класс плагина рекомендаций REES46
*/
class shopRees46PluginFrontendRees46Action extends shopFrontendAction {

    /**
    * @desc Возвращаем JSON массив с данными о товарах
    */
    public function execute() {
        $product_ids = waRequest::get('product_ids'); // получаем список ID товаров
        $product_ids_arr = explode(",", $product_ids);

        $products = array();
        $productModel = new shopProductModel();



        foreach ($product_ids_arr as $value) {
            $id = intval($value);
            $product = $productModel->getById($id);
            

            if ($product != null && $product['count'] !== '0'){

                $p = Array(
                    'id' => $product["id"],
                    'name' => $product["name"],
                    'url' =>  $product["url"] . '/?recommended_by=',
                    'price' => intval($product['price']),
                    'image_url' => shopImage::getUrl(array('product_id' => $product['id'], 'id' => $product['image_id'], 'ext' => $product['ext']), 200)
                );

                array_push($products, $p);
                
            // если товар неправильный, или его нет в наличии
            } else {

                $app_settings_model = new waAppSettingsModel();
                $rees46_shop_id = $app_settings_model->get(array('shop', 'rees46'), 'shop_id');                
                $rees46_secret_key = $app_settings_model->get(array('shop', 'rees46'), 'secret_key');

                // Если есть ключи в настрйоках отправляем api запрос, чтобы данный товар больне не рекомендовался
                if (!empty($rees46_shop_id) && !empty($rees46_secret_key)) {
                    $api_url = 'http://api.rees46.com/import/disable';
                    $api_url .= '?shop_id=' . $rees46_shop_id;
                    $api_url .= '&shop_secret=' . $rees46_secret_key;
                    $api_url .= '&item_ids=' . $id;
                    $result = file_get_contents($api_url);                    
                }
            }
        }

        header('Content-Type: application/json');
        die(json_encode(Array('products' => $products)));

    }
 
}
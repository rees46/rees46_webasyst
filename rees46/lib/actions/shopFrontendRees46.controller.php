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

        $products = array();
        $productModel = new shopProductModel();

        foreach (explode(",", $product_ids) as $product_id) {
            $id = intval($product_id);
            $product = $productModel->getById($id);            

            if ($product != null && $product['count'] !== '0'){
                $image_url = '';
                if (isset($product['image_id']) && (!empty($product['image_id'])) ){
                    $image_url = shopImage::getUrl(array('product_id' => $product['id'], 'id' => $product['image_id'], 'ext' => $product['ext']), 200);
                } 

                $p = Array(
                    'id' => $product["id"],
                    'name' => $product["name"],
                    'url' =>  $product["url"] . '/?recommended_by=',
                    'price' => (float)($product['price']),
                    'image_url' => $image_url
                );
                array_push($products, $p);

            // если товар неправильный, или его нет в наличии            
            } else {

                $app_settings_model = new waAppSettingsModel();                
                $rees46_shop_id = $app_settings_model->get(array('shop', 'rees46'), 'shop_id');
                $rees46_secret_key = $app_settings_model->get(array('shop', 'rees46'), 'secret_key');

                // Если есть ключи в настройках отправляем api запрос, чтобы данный товар больше не рекомендовался (для улучшения, не критичный запрос)
                // если есть curl или включен allow_url_fopen
                // иначе не отправляем запрос (данные все равно обновяться при просмотре товара)
                if (!empty($rees46_shop_id) && !empty($rees46_secret_key)) {
                    $api_url = 'http://api.rees46.com/import/disable';
                    $api_url .= '?shop_id=' . $rees46_shop_id;
                    $api_url .= '&shop_secret=' . $rees46_secret_key;
                    $api_url .= '&item_ids=' . $id;

                    // если allow_url_fopen работает
                    if (ini_get('allow_url_fopen') == true) {
                        $result = file_get_contents($api_url);                        

                    // иначе если есть curl
                    } else if(function_exists('curl_version')){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $api_url);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        $result = curl_exec($ch);

                        curl_close($ch);
                    }
                }
            }
        }

        // Standart JSON response {"status":"ok","data":$products}
        $this->response = $products;
    }

}
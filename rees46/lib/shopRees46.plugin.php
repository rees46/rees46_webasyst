<?php

/**
* @desc Основной класс плагина рекомендаций REES46
*/

class shopRees46Plugin extends shopPlugin
{
    /**
    * @desc Встраиваем JS код REES46 в <HEAD> магазина        
    */  
    public function frontendHead()
    {

        $status = $this->getSettings('is_enabled');

        if (!$status) {return;} // если скрипт в настройках выключен -> выходим

        $view = wa()->getView();

        $is_batch = $this->getSettings('is_batch');
        $view->assign('is_batch', $is_batch);

        $modification = $this->getSettings('modification');
        $view->assign('modification', $modification);  
        
        $rees46_shop_id = $this->getSettings('shop_id'); 
        $view->assign('rees46_shop_id', $rees46_shop_id);  

        $currency = wa()->getSetting('currency', 'RUB', 'shop');
        $view->assign('currency', $currency);

        $rees46_query = waRequest::get('query');
        $rees46_query = htmlspecialchars($rees46_query);
	$view->assign('rees46_query', $rees46_query);

        $content = $view->fetch($this->path.'/templates/frontendHead.html');
        return $content;
    }

    /**
    * @desc Пакетная расстановка блоков: встраиваем блоки на страницу поиска
    */ 

    public function frontendSearch()
    {
        $html = '<div class="rees46 rees46-recommend" data-type="search" data-batch="1" style="margin-top: 20px;"></div>';
        return $html;    
    }


    /**
    * @desc Пакетная расстановка блоков: встраиваем блок на страницу с корзиной
    */  
    public function frontendCart()
    {
        $html = '<div class="rees46 rees46-recommend" data-type="see_also" data-batch="1" style="margin-top: 20px;"></div>';
        return $html;    
    }


    /**
    * @desc Пакетная расстановка блоков: встраиваем блок на главную страницу
    */  
    public function frontendHomepage()
    { 
        $html = '<div class="rees46 rees46-recommend" data-type="popular" data-batch="1" style="margin-top: 20px;"></div>';
        return $html;    
    }


    /**
    * @desc Пакетная расстановка блоков: встраиваем блоки на страницу категорий внизу
    */ 

    public static function frontendCategoryBottom()
    {
        $html = '<div class="rees46 rees46-recommend" data-type="interesting" data-batch="1" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="recently_viewed" data-batch="1" style="margin-top: 20px;"></div>';
        return $html;    
    }


    /**
    * @desc Пакетная расстановка блоков: встраиваем блок на страницу категорий вверху
    */ 
    public function frontendCategory($category)
    {
        $html = '<div class="rees46 rees46-recommend" data-type="popular" data-batch="1" style="margin-top: 20px;"></div>';
        // для lazy loading, если скрипт уже был инициализован,
        // то запускаем функцию показа рекомендаций
        $html .= '<script type="text/javascript">';
        $html .= 'if (document.is_rees46_init == true) {';
        $html .= '  document.currentCategoryId = \'' . $category['id'] . '\';';
        $html .= '  setREES46();';
        $html .= '}';
        $html .= '</script>';
        return $html;    
    }

    /**
    * @desc Пакетная расстановка блоков: встраиваем блок на страницу продукта внизу
    */ 

    public static function frontendProductBottom()
    {
        $html = '<div class="rees46 rees46-recommend" data-type="similar" data-batch="1" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="also_bought" data-batch="1" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="interesting" data-batch="1" style="margin-top: 20px;"></div>';
        return $html;    
    }

    /**
    * @desc Ручная расстановка блоков
    */ 
    public static function REES46_recommender ($recommender_type, $recommender_data_limit)
    {
    static $type;

        if (!is_int($recommender_data_limit) || $recommender_data_limit<0 || $recommender_data_limit>10) {$recommender_data_limit=10;};

        $recommender_type = strtolower($recommender_type);
        switch ($recommender_type) {
            case 'popular':
                $type = $recommender_type;
                break;
            case 'interesting':
                $type = $recommender_type;
                break;
            case 'recently_viewed':
                $type = $recommender_type;
                break;
            case 'similar':
                $type = $recommender_type;
                break;
            case 'also_bought':
                $type = $recommender_type;
                break;
            case 'see_also':
                $type = $recommender_type;
                break;
            case 'buying_now':
                $type = $recommender_type;
                break;
            case 'search':
                $type = $recommender_type;
                break;
            default:
                $type = null;
        }
        if ($type) {
            $html = '<div class="rees46 rees46-recommend" data-type="'.$type.'" data-limit="'.$recommender_data_limit.'"data-batch="0" style="margin-top: 20px;"></div>';
            return $html;
        }
    }

    /**
    * @desc Отслеживаем событие: создание заказа
    */ 
    public function orderActionCreate($order)
    {     

        $orderItemsModel = new shopOrderItemsModel();
        $items = $orderItemsModel->getItems($order['order_id']); // получаем список товаров заказа

        foreach ($items as $value) {
            $rees46_items[] = array('item_id' => $value["product_id"], 'amount' => intval($value["quantity"]), 'price' => $value["price"]);
        }

        $cookie_data = json_encode(array("items" => $rees46_items, "order_id" => $order['order_id']));
        setcookie('rees46_track_purchase', $cookie_data, 0, '/'); // save data to cookies, JS will track data from cookies            

    }



}

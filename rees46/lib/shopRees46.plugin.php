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
        $plugin_id = array('shop', 'rees46');

        $sett = new waAppSettingsModel();
        $status = $sett->get($plugin_id, 'is_enabled');

        if (!$status) {return;} // если скрипт в настройках выключен -> выходим

        $view = wa()->getView();

        $rees46_shop_id = $sett->get($plugin_id, 'shop_id');
        $view->assign('rees46_shop_id', $rees46_shop_id);        

        $content = $view->fetch($this->path.'/templates/frontendHead.html');
        return $content;
    }

    /**
    * @desc Встраиваем блок рекомендации на страницу с корзиной
    */  
    public function frontendCart()
    { 
        $html = '<div class="rees46 rees46-recommend" data-type="see_also" style="margin-top: 20px;"></div>';
        return $html;    
    }

    /**
    * @desc Встраиваем блок рекомендации на главную страницу
    */  
    public function frontendHomepage()
    { 
        $html = '<div class="rees46 rees46-recommend" data-type="popular" style="margin-top: 20px;"></div>';
        return $html;    
    }


    /**
    * @desc Встраиваем блок рекомендации на страницу категорий внизу
    */ 
    public static function frontendCategoryBottom()
    {       
        $html = '<div class="rees46 rees46-recommend" data-type="recently_viewed" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="interesting" style="margin-top: 20px;"></div>';

        return $html;    
    }

    /**
    * @desc Встраиваем блок рекомендации на страницу категорий вверху
    */ 
    public function frontendCategory($category)
    { 
        $html = '<div class="rees46 rees46-recommend" data-type="popular" style="margin-top: 20px;"></div>';
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
    * @desc Встраиваем блок рекомендации на страницу продукта внизу
    */ 
    public static function frontendProductBottom()
    { 
        $html = '<div class="rees46 rees46-recommend" data-type="also_bought" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="similar" style="margin-top: 20px;"></div>';
        $html .= '<div class="rees46 rees46-recommend" data-type="interesting" style="margin-top: 20px;"></div>';
        return $html;    
    }

    /**
    * @desc Отслеживаем событие: создание заказа
    */ 
    public function orderActionCreate($order)
    {     

      $orderItemsModel = new shopOrderItemsModel();
      $items = $orderItemsModel->getItems($order['order_id']); // получаем список товаров заказа

      foreach ($items as $value) {
        $rees46_items[] = array('item_id' => $value["product_id"], 'amount' => intval($value["quantity"]));
      }

      $cookie_data = json_encode(array("items" => $rees46_items, "order_id" => $order['order_id']));
      setcookie('rees46_track_purchase', $cookie_data, 0, '/'); // save data to cookies, JS will track data from cookies            

    }



}
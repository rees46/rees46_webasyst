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

        $rees46_shop_id = trim($this->getSettings('shop_id'));
        $view->assign('rees46_shop_id', $rees46_shop_id);  

        $currency = wa()->getConfig()->getCurrency();

        $view->assign('currency', $currency);

        $rees46_query = waRequest::get('query');
        if (is_null($rees46_query)) {
            $url = wa()->getRouting()->getCurrentUrl();
            $url = trim($url, "/");
            if (preg_match("/search\/.+\/?/", $url)) {
                $rees46_query = preg_replace("/search\/(.+)\/?/", '$1', $url);
            }
        }
        if (!empty($rees46_query)) {
            $rees46_query = htmlspecialchars($rees46_query);
            $view->assign('rees46_query', $rees46_query);
        }

        $email = wa()->getUser()->get('email', 'default');
        $id = wa()->getUser()->get('id');
        $gender = wa()->getUser()->get('sex');

        $view->assign('user_info', '{id: \''.$id.'\', email: \''.$email.'\', gender: \''.$gender.'\'}');

        $content = $view->fetch($this->path.'/templates/frontendHead.html');
        return $content;
    }

    /**
    * @desc Ручная расстановка блоков (методы сохранены, чтобы не сломать сайт тем, кто ранее использовал этот способ расстановки блоков)
    */ 

    public static function frontendCategoryBottom()
    {
        return '';
    }

    public static function frontendProductBottom()
    {
        return '';
    }

    public static function REES46_recommender ($recommender_type, $recommender_data_limit)
    {
        return '';
    }

    /**
    * @desc Отслеживаем событие: создание заказа
    */ 
    public function orderActionCreate($param)
    {     
        if($param['step'] === 'success') {
            $order_id = waSystem::getInstance()->getStorage()->get('shop/order_id');
            $order_model = new shopOrderModel();
            $order = $order_model->getOrder($order_id);
            $order_price = 0;
            $items = $order['items'];
            $user = $order['contact'];

            foreach ($items as $item) {
                $products[] = array('id' => $item["product_id"], 'amount' => intval($item["quantity"]), 'price' => $item["price"]);
                $order_price += intval($item["price"]);
            }
            $html = '<script type="text/javascript">window._r46_order_info=\''.json_encode(array("order" => $order_id, "order_price" => $order_price, "products" => $products, "user" => $user)).'\';</script>';
            return $html;
        }
    }
}

<?php

return array(
    'name' => 'REES46: рекомендательная система',
    'description' => 'REES46: рекомендательная система для повышения продаж',
    'img'=>'img/rees46.png',
    'version' => '1.0.1',
    'vendor' => 1009320,
    'shop_settings' => true,
    'frontend'    => true,
    'icons'=>array(
        16 => 'img/rees46.png',
    ),
    'handlers' => array(        
        'frontend_head' => 'frontendHead',
        'frontend_product' => 'frontendProduct',
        'frontend_category' => 'frontendCategory',
        'frontend_homepage' => 'frontendHomepage',
        'frontend_cart' => 'frontendCart',
        'order_action.create' => 'orderActionCreate'
    ),
);

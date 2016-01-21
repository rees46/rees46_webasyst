<?php

return array(
    'name' => 'REES46: рекомендательная система',
    'description' => 'Система товарных рекомендаций для повышения продаж в интернет-магазине',
    'img'=>'img/rees46.png',
    'version' => '2.0.1',
    'vendor' => 1009320,
    'frontend'    => true,
    'icons'=>array(
        16 => 'img/rees46.png',
    ),
    'handlers' => array(        
        'frontend_head' => 'frontendHead',
        'frontend_homepage' => 'frontendHomepage',
        'frontend_category' => 'frontendCategory',
        'frontend_cart' => 'frontendCart',
        'order_action.create' => 'orderActionCreate',
	'frontend_search' => 'frontendSearch'
    ),
);

<?php

return array(
    'name' => 'REES46: центр управления конверсией',
    'description' => 'REES46 — сервис, предоставляющий все многообразие инструментов для электронной торговли без сложной интеграции',
    'img'=>'img/rees46.png',
    'version' => '3.0.5',
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
        'frontend_checkout' => 'orderActionCreate',
        'frontend_search' => 'frontendSearch'
    ),
);

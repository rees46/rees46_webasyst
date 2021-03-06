<?php

return array(
    'name' => 'REES46: центр управления конверсией',
    'description' => 'REES46 — сервис, предоставляющий все многообразие инструментов для электронной торговли без сложной интеграции',
    'img'=>'img/rees46.png',
    'version' => '3.0.12',
    'vendor' => 1009320,
    'frontend'    => true,
    'icons'=>array(
        16 => 'img/rees46.png',
    ),
    'handlers' => array(        
        'frontend_head' => 'frontendHead',
        'frontend_checkout' => 'orderActionCreate',
    ),
);

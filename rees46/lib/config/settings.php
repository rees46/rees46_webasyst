<?php

return array(
    'shop_id' => array(
        'title' => 'Код магазина',
        'description' => 'Код вашего магазина на rees46.com',
        'control_type' => waHtmlControl::INPUT,        
    ),
    'secret_key' => array(
        'title' => 'Секретный ключ',
        'description' => 'Секретный ключ вашего магазина на rees46.com',
        'control_type' => waHtmlControl::INPUT,        
    ),
    'is_enabled' => array(
        'title' => 'Статус',
        'description' => 'Включение выключение модуля рекомендации в вашем магазине',
        'control_type' => waHtmlControl::SELECT,
        'options' => array(
            array(
                'value' => 1,
                'title' => 'Включен',
            ),
            array(
                'value' => 0,
                'title' => 'Выключен',
            ),
        ),
        'value' => 0,
    )
);
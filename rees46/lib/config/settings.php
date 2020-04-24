<?php

return array(
    'shop_id' => array(
        'title' => 'Код магазина',
        'description' => 'Код вашего магазина в REES46<br><a href="http://rees46.com/" target="_blank" style="color:#03c;">Зарегистрироваться и получить код прямо сейчас</a><br><br>',
        'control_type' => waHtmlControl::INPUT,        
    ),
    'secret_key' => array(
        'title' => 'Секретный ключ',
        'description' => 'Секретный ключ вашего магазина в REES46<br><br>',
        'control_type' => waHtmlControl::INPUT,        
    ),
    'is_enabled' => array(
        'title' => 'Статус',
        'description' => 'Включение/выключение модуля.<br>Воспользуйтесь <a href="http://docs.rees46.com/pages/viewpage.action?pageId=2424930" target="_blank" style="color:#03c;">документацией</a> для завершения интеграции и настройки сервиса<br><br>',
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
        'value' => 1,
    )
);

                                
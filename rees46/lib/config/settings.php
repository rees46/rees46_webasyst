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
    'is_batch' => array(
        'title' => 'Способ расстановки блоков рекомендаций',
        'description' => '',
        'control_type' => waHtmlControl::RADIOGROUP,
        'options' => array(
            array(
                'value' => 1,
                'title' => 'Пакетная расстановка блоков рекомендаций',
                'description' => 'Режим пакетной установки автоматически устанавливает блоки рекомендаций на главную страницу и страницу корзины.<br><a href="http://docs.rees46.com/pages/viewpage.action?pageId=2424930" target="_blank" style="color:#03c;">Подробная документация</a><br>',
            ),
            array(
                'value' => 0,
                'title' => 'Самостоятельная расстановка блоков рекомендаций',
                'description' => 'Режим самостоятельной установки позволяет расставить блоки рекомендаций по собственному усмотрению.<br><a href="http://docs.rees46.com/pages/viewpage.action?pageId=2424930" target="_blank" style="color:#03c;">Подробная документация</a><br><br>',
            ),
        ),
        'value' => 1,
    ),
    'is_enabled' => array(
        'title' => 'Статус',
        'description' => 'Включение/выключение модуля.<br><br>',
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

                                
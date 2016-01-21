<?php

return array(
    'shop_id' => array(
        'title' => 'Код магазина',
        'description' => 'Код вашего магазина в REES46<br><a href="http://rees46.com/" target="_blank">Зарегистрироваться и получить код прямо сейчас</a><br><br>',
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
                'description' => 'Режим пакетной установки автоматически устанавливает блоки рекомендаций на главную страницу и страницу корзины.<br>Установку дополнительных блоков на страницу категории и страницу карточки товара необходимо выполнить самостоятельно,<br>блоки при этом будут установлены пакетно.<br>',
            ),
            array(
                'value' => 0,
                'title' => 'Самостоятельная расстановка блоков рекомендаций',
                'description' => 'Режим самостоятельной установки позволяет расставить блоки рекомендаций по собственному усмотрению.<br>Расстановка блоков по рекомендуемой схеме позволяет добиться максимальной эффективности.<br><br>',
            ),
        ),
        'value' => 1,
    ),
    'modification' => array(
        'title' => 'Модификация алгоритма рекомендаций для тарифа "Отраслевой"',
        'description' => '<a href="http://rees46.com/ecommerce#prices" target="_blank">Узнать подробнее о тарифе "Отраслевой"</a>',
        'control_type' => waHtmlControl::SELECT,
        'options' => array(
            array(
                'value' => null,
                'title' => 'Без модификаций',
            ),
            array(
                'value' => 'appliances',
                'title' => 'Бытовая техника',
            ),
            array(
                'value' => 'child',
                'title' => 'Детские товары',
            ),
            array(
                'value' => 'cosmetic',
                'title' => 'Косметика',
            ),
            array(
                'value' => 'coupon',
                'title' => 'Купоны, акции и скидки',
            ),
            array(
                'value' => 'fashion',
                'title' => 'Одежда, обувь, аксессуары',
            ),
            array(
                'value' => 'construction',
                'title' => 'Строительные материалы',
            ),
            array(
                'value' => 'animal',
                'title' => 'Товары для животных',
            ),
            array(
                'value' => 'fmcg',
                'title' => 'FMCG/CPG',
            ),
        ),
        'value' => null,
    ),
    'is_enabled' => array(
        'title' => 'Статус',
        'description' => 'Включение выключение модуля рекомендации в вашем магазине.<br><br>',
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


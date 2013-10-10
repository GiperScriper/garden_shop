<?php
    //var_dump($_POST);
    
    if(isset($_POST['quantity_string']) && !empty($_POST['quantity_string'])) {
        $quantity_array = explode(',', $_POST['quantity_string']);
    } 

    

    $headers = "From: Garden@mail.ru\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    
    $subject = 'Ваш заказ';  
    
    $message = "
        <p>Здравствуйте, $client_name!</p>
        <p>Благодарим Вас за оформление заказа в нашей компании!</p>
        <p>Наш менеджер свяжется с вами по указанному номеру <strong>$client_phone</strong>.</p>";         
    
    $i = 0;
         
    $message .= "<ol>";
    
    foreach ($goods as $item) {        
        
        if ($quantity_array) {
            $message .= "<li>{$item['category']}, цена: <strong>{$item['price']}</strong> руб., Кол-во: <strong>{$quantity_array[$i]}</strong><span> шт.</li>";
        } else {
            $message .= "<li>{$item['category']}, цена: <strong>{$item['price']}</strong> руб., Кол-во: <strong>1</strong><span> шт.</li>";
        }        
        
        $i++;
        $sum += $item['price'] * $item['quantity'];
    }

    if(isset($_POST['total_price']) && !empty($_POST['total_price'])) {
        $sum = $_POST['total_price'];
    }

    $message .= "</ol>

        <p>К оплате: <strong>{$sum} рублей</strong>, без учёта доставки.</p>
        <p>Доставка: <strong>{$delivery_type}</strong>.</p>
        
        <p>Мы осуществляем доставку наших товаров по всей России и странам СНГ 
        почтой России и экспресс почтой EMS. Стоимость и сроки доставки зависит 
        от местонахождения вашего населённого пункта. Вы можете самостоятельно 
        рассчитать стоимость доставки почтой России 
        <a href='http://www.emspost.ru/ru/calc/'>здесь</a></p>

        <p>Доставки почтой EMS <a href='http://www.emspost.ru/ru/calc/'>здесь</a></p>

        <p>Дождитесь звонка нашего менеджера!</p>

        <p>Внимание! Отправка товара осуществляется в течение 3 рабочих дней,
        после оплаты полной стоимости вашей покупки и стоимости почтовой 
        отправки в ваш населённый пункт.</p>

        <p>Оплата покупки при получении возможна при доставке 
        курьером и самовывозе, в г. Москве.</p>

        <p>По Москве осуществляется доставка курьером. Стоимость доставки: 
            <ul>
                <li>по центру города в пределах кольцевой линии метро - 300 рублей.</li> 
                <li>от кольцевой линии метро до МКАД - 500 рублей.</li>
            </ul>
        </p>

        <p>Так же возможен самовывоз в Москве в районе м.Калужская.</p>

        <p>При оформлении заказа укажите предпочтительный для вас способ доставки!</p>        

        <p>Оплата:
        <br>Яндекс: <strong>№ 41001720773645</strong>

        <br>WebMoney: <strong>№ 355253403421</strong>

        <br>Киви: <strong>№ 9250853800</strong></p>

        <p>Технические характеристики товара могут отличаться, уточняйте 
        технические характеристики товара на момент покупки и оплаты.</p>
        
        <p>Если у Вас есть вопросы, Вы можете связаться с нами по телефону 
        +7-495-641-64-67 или по электронной почте dobriy_sad@mail.ru.
        Спасибо, что Выбрали Добрый сад!</p>
        --------------------------------------------------";
<?php

namespace frontend\modules\api\tickets\aviasales\controllers;

use frontend\modules\api\tickets\aviasales\model\Aviasales;
use Yii;
use yii\web\Controller;


class DefaultController extends Controller
{

    const TOKEN = '1172d141de167a3862ace465a176174e';

    public function actionGetTikets()
    {
//        $json = json_decode(file_get_contents('http://api.travelpayouts.com/data/ru/airlines.json'), true);

        /*currency — валюта цен на билеты. Значение по умолчанию — rub.
origin — пункт отправления. IATA-код города. Длина — 3 символа. Значение по умолчанию — LED.
destination — пункт назначения. IATA-код города. Длина — 3 символа. Значение по умолчанию — HKT.
Обратите внимание! Если не указывать пункт отправления и назначения, то API вернёт список самых дешевых билетов, которые были найдены за последние 48 часов.

show_to_affiliates — false — все цены, true — только цены, найденные с партнёрским маркером (рекомендовано). Значение по умолчанию — true.
month — первый день месяца, в формате «YYYY-MM-DD». По умолчанию используется месяц, следующий за текущим.
trip_duration — длительность пребывания в неделях. Если не указано, то в результате будут билеты в одну сторону
        */


        for ($i = 1; $i <= 12; $i++) {
            $param = [
                'currency' => 'rub',
                'origin' => 'MOW',
                'destination' => 'IST',
                'show_to_affiliates' => true,
                'month' => "2021-{$i}-01",
//            'trip_duration' => 7,
                'token' => self::TOKEN,
            ];


            $aviasales = Aviasales::getTicketsMonthMatrix($param);
            echo "<pre>";
            print_r($aviasales);
        }
        die();

        $aviasales = Aviasales::getTicketsMonthMatrix($param);


        echo "<pre>";
        print_r($aviasales);
        die();
    }


    public function actionMainPage()
    {

    }


}


<?php

namespace frontend\modules\api\tickets\aviasales\controllers;

use frontend\modules\api\tickets\aviasales\model\Aviasales;
use frontend\modules\api\tickets\model\Tickets;
use Yii;
use yii\web\Controller;
use thewulf7\travelPayouts\Travel;


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

        $origin = 'MOW';
        $destination = 'IST';
        $monthArr = [
            1 => '01',
            2 => '02',
            3 => '03',
            4 => '04',
            5 => '05',
            6 => '06',
            7 => '07',
            8 => '08',
            9 => '09',
            10 => '10',
            11 => '11',
            12 => '12',
        ];


        for ($i = 1; $i <= 12; $i++) {
//            $param = [
//                'url' => 'http://api.travelpayouts.com/v2/prices/month-matrix',
//                'currency' => 'rub',
//                'origin' => $origin,
//                'destination' => $destination,
//                'show_to_affiliates' => true,
//                'month' => "2021-{$i}-01",
////            'trip_duration' => 7,
//                'token' => self::TOKEN,
//                'currency' => 'rub',
//                'show_to_affiliates' => true,
//                'Accept-Encoding' => "gzip,%20deflate",
//            ];


            $param = [
                'url' => 'http://api.travelpayouts.com/v1/prices/cheap',
                'origin' => $origin,
                'destination' => $destination,
                'depart_date' => "2021-$monthArr[$i]",
//                'return_date' => "2021-$monthArr[$i]",
                'currency' => 'rub',
                'token' => self::TOKEN,
            ];


            $aviasales[] = Aviasales::getSendCUrl($param);
        }


        echo "<pre>";
        print_r($aviasales);
        die();

        die();

        foreach ($aviasales as $aviasaleGroupMonth) {

            foreach ($aviasaleGroupMonth as $item) {

                $Tickets = new Tickets();

                $Tickets->attributes = $item;

                $Tickets->save();
                if ($Tickets->errors) {
                    echo "<pre>";
                    print_r($Tickets);
                    die();
                }
            }

        }

        echo "<pre>";
        print_r($aviasales);
        die();


        die();
        echo "<pre>";
        print_r($aviasales);
        die();
    }

    public function actionGetFlightService()
    {
        //$travel = new thewulf7\travelPayouts\Travel(self::TOKEN);
        $travel = new Travel(self::TOKEN);

        $ticketService = $travel->getTicketService();
        echo "<pre>"; print_r($ticketService);die();

        $origin = "MOW";
        $destination = "IST";
        $month = "2020-10-01";

        $tickets = $travel->getMonthMatrix($origin, $destination, $month, $currency = 'rub', $show_to_affiliates = true);


        echo "<pre>";
        print_r($tickets);
        die();

        $flightService = $travel->getFlightService();
        $flightService
            ->setIp('127.0.0.1')
            ->setHost('aviasales.ru')
            ->setMarker('300849')
            ->addPassenger('adults', 1)
            ->addSegment('MOW', 'IST', '2021-07-22');

        $searchData = $flightService->search('ru', 'Y');
        echo "<pre>";
        print_r($searchData);
        die();
        $searchResults = $flightService->getSearchResults($searchData['search_id']);
        echo "<pre>";
        print_r($searchResults);
        die();
    }

}


<?php

namespace frontend\modules\api\tickets\aviasales\model;

class Aviasales extends \yii\base\Model
{

    const TOKEN = '1172d141de167a3862ace465a176174e';
    const MARKER = '300849';
    const LINK_AVIASALES = 'http://www.aviasales.ru/search?';

    public function getSendCUrl($param = [], $cacheDebug = false)
    {

        $cacheDiff = ($cacheDebug) ? rand(1, 32312312312312) : '';

        $nameForCache = md5(print_r($param, true)) . $cacheDiff;

        $cache = \Yii::$app->cache;

        $data = $cache->getOrSet($nameForCache, function () use ($param) {
            $url = $param['url'];
            unset($param['url']);

            $query = http_build_query($param);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . '?' . $query,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $data = $response['data'];

            curl_close($curl);

            return $data;
        });

        return $data;


    }

    /*
   origin_iata	Пункт отправления. IATA-код города	Москва (MOW)
destination_iata	Пункт прибытия. IATA-код города	Санкт-Петербург (LED)
depart_date	Дата отправления. Рекомендуемый формат: «Y-m-d» («yy-mm-dd» — JQuery).	—
return_date	Дата возвращения. Рекомендуемый формат: «Y-m-d» («yy-mm-dd» — JQuery).	—
oneway	Флаг «в одну сторону», значения true или false	0
adults	Количество взрослых (старше 12 лет)	1
children	Количество детей (2—12 лет)	0
infants	Количество младенцев (0—2 года)	0
trip_class	Класс перелёта (Эконом — 0, Бизнес — 1)	0
with_request	Инициализировать ли поиск (true — поиск запускается, false — заполняется форма, поиск не запускается)	false
currency	Валюта результатов (RUB, USD, EUR, UAH, CNY, KZT, AZN, BYN, THB, KGS, UZS)	RUB
locale	Язык результатов поиска	en
    $param['']
     */

    public static function createPartnerLink($data, $param)
    {
      
        $paramForLink = [
            'origin_iata' => $param['origin'],
            'destination_iata' => $param['destination'],
            'depart_date' => $param['depart_date'],
//            'return_date' => $param['return_date'] ?? '',
            'oneway' => '',
            'adults' => '',
            'children' => '',
            'infants' => '',
            'trip_class' => 0,
            'with_request' => true,
            'currency' => 'RUB',
            'locale' => 'ru',
        ];


        $paramForLink['marker'] = self::MARKER;
        $link = self::LINK_AVIASALES . http_build_query($paramForLink);


        print_r($link);
        die();
        return $link;
    }
}
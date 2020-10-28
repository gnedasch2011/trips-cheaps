<?php

namespace frontend\modules\api\tickets\aviasales\model;

class Aviasales extends \yii\base\Model
{


    public function getTicketsMonthMatrix($param = [])
    {

        $nameForCache = md5(print_r($param, true));

        $cache = \Yii::$app->cache;

        $data = $cache->getOrSet($nameForCache, function () use ($param) {
            $query = http_build_query($param);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.travelpayouts.com/v2/prices/month-matrix?currency=rub&show_to_affiliates=true&Accept-Encoding=gzip,%20deflate&" . $query,
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
}
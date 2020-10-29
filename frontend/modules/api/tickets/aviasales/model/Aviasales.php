<?php

namespace frontend\modules\api\tickets\aviasales\model;

class Aviasales extends \yii\base\Model
{


    public function getSendCUrl($param = [])
    {

        $nameForCache = md5(print_r($param, true)) . rand(1, 32312312312312);

        $cache = \Yii::$app->cache;
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


//        $data = $cache->getOrSet($nameForCache, function () use ($param) {
//            $query = http_build_query($param);
//
//            $curl = curl_init();
//
//            $url = $param['url'] . '?' . $query;
//
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => $url,
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "GET",
//            ));
//
//            $response = curl_exec($curl);
//            $response = json_decode($response, true);
//            $data = $response['data'];
//            echo "<pre>";
//            print_r($data);
//            die();
//            curl_close($curl);
//            return $data;
//        });

        return $data;


    }
}
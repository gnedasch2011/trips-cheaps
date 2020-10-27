<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 09.10.2020
 * Time: 9:10
 */

namespace common\helpers;

class HelperCommon extends \yii\base\Model
{
// Функция транслитерации
    public static function transliterate($string)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'i', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'kh', 'ц' => 'tc',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
            'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'iu', 'я' => 'ia',
            '’' => ' ', '.' => '',

            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'I', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Tc',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch',
            'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Iu', 'Я' => 'Ia',
        );

        $resStr = str_replace(' ', '-', lcfirst(strtr($string, $converter)));


        return $resStr;
    }

}
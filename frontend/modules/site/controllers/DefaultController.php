<?php

namespace frontend\modules\site\controllers;

use frontend\modules\page\model\Page;
use frontend\modules\url\components\ControllerWithParam;
use Yii;
use yii\web\Controller;


class DefaultController extends ControllerWithParam
{
    public function actionMainPage()
    {
        return $this->render('MainPage', [
        ]);
    }


}


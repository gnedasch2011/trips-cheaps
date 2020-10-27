<?php
/**
 * Created by PhpStorm.
 * User: 2000
 * Date: 30.09.2020
 * Time: 10:01
 */

namespace frontend\modules\category\model;

use frontend\modules\items\model\Items;

class Category extends CategoryBase
{
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['id' => 'item_id'])
            ->viaTable('items_categorys', ['category_id' => 'id']);
    }

    public function getSubCat()
    {
        $res = [];

        $res = self::find()->where(['parent_id' => $this->id])->all();

        return $res;
    }

    public function getUrl()
    {
        return $this->name_transliteration;
    }
}
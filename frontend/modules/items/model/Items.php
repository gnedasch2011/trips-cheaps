<?php

namespace frontend\modules\items\model;

use frontend\modules\category\model\Category;
use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id  [id] => 1\n    [qustion] => Ждали маму с молоком,<br>А пустили волка в дом…<br>Кем же были эти<br>Маленькие дети?\n    [answer] => Семеро козлят\n    [cat_ids] => 1305,669\n    [img] =>
 * @property string $qustion
 * @property string $img
 * @property string $answer
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qustion'], 'string'],
            [['img', 'answer'], 'string', 'max' => 450],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qustion' => 'Qustion',
            'img' => 'Img',
            'answer' => 'Answer',
        ];
    }

    public function getCategories()
    {

        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('items_categorys', ['item_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])
            ->viaTable('items_categorys', ['item_id' => 'id']);
    }


    public function getDetailUrl()
    {
        $detailUrl = '';
        $category = $this->category;
        $detailUrl = $category->name_transliteration . '/' . $this->id;

        return $detailUrl;
    }

}

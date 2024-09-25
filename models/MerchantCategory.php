<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant_categories".
 *
 * @property int $merchant_id
 * @property int $category_id
 *
 * @property Categories $category
 * @property Merchants $merchant
 */
class MerchantCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merchant_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'category_id'], 'required'],
            [['merchant_id', 'category_id'], 'integer'],
            [['merchant_id', 'category_id'], 'unique', 'targetAttribute' => ['merchant_id', 'category_id']],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Merchants::class, 'targetAttribute' => ['merchant_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'merchant_id' => 'Merchant ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Merchant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchants::class, ['id' => 'merchant_id']);
    }
}

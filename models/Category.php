<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property MerchantCategories[] $merchantCategories
 * @property Merchants[] $merchants
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[MerchantCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerchantCategories()
    {
        return $this->hasMany(MerchantCategories::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Merchants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMerchants()
    {
        return $this->hasMany(Merchants::class, ['id' => 'merchant_id'])->viaTable('merchant_categories', ['category_id' => 'id']);
    }
}

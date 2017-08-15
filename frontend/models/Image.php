<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property string $id
 * @property string $cat_id
 * @property string $title
 * @property string $ext
 * @property string $alias
 * @property string $description
 * @property string $meta_keys
 * @property string $meta_desc
 * @property string $create_at
 * @property string $update_at
 *
 * @property Category[] $categories
 * @property Category $cat
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'ext'], 'required'],
            [['cat_id', 'create_at', 'update_at'], 'integer'],
            [['description', 'meta_keys', 'meta_desc'], 'string'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 15],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'title' => 'Title',
            'ext' => 'Ext',
            'alias' => 'Alias',
            'description' => 'Description',
            'meta_keys' => 'Meta Keys',
            'meta_desc' => 'Meta Desc',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['main_image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }
}

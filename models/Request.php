<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $Id_category
 * @property int $id_user
 * @property string $name
 * @property string $description
 * @property string $number
 *
 * @property Category $category
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'number'], 'required'],
            [['Id_category', 'id_user'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 30],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            ['id_user', 'default', 'value' => Yii::$app->user->identity->getId()],
            ['Id_category', 'default', 'value' => 1],
            [['Id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['Id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Id_category' => 'Статус',
            'id_user' => 'Id User',
            'name' => 'Название',
            'description' => 'Описание',
            'number' => 'Номер машины',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'Id_category']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}

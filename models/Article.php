<?php

namespace app\models;

use Yii;
use app\models\ImageUpload;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property string $text
 * @property string $image
 * @property string $date
 * @property int $viewed
 * @property int $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'desc', 'text', 'category_id'], 'required'],
            ['title', 'unique'],
            [['desc', 'text'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'text' => 'Text',
            'image' => 'Image',
            'date' => 'Date',
            'viewed' => 'Viewed',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
    
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
    
    public static function getArticlesByCategoryId($category_id)
    {
        return self::find()->select('*')->from('article')->where(['like', 'category_id', $category_id])->all();
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }
    
    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }
    
    public function beforeDelete() {
        $this->deleteImage();
        return parent::beforeDelete();
    }
    
    public function viewedCount()
    {
        $this->viewed += 1;
        
        return $this->save(false);
    }
}

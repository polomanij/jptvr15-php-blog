<?php

namespace app\models;

use yii\base\Model;
use \yii\web\UploadedFile;
use Yii;

class ImageUpload extends Model{
    
    public $image;
    
    public function imageUpload(UploadedFile $file)
    {
        $file->saveAs(__DIR__ . '/../web/uploads/' . $file->name);
        
        return $file->name;
    }
    
}

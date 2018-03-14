<?php

namespace app\models;

use yii\base\Model;
use \yii\web\UploadedFile;
use Yii;

class ImageUpload extends Model
{
    
    public $image;
    
    public function rules()
    {
        return [
            ['image', 'required'],
            ['image', 'file', 'extensions' => 'jpg, png']
        ];
    }

        public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        
        if ($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage($file);
        }
    }
    
    public function deleteCurrentImage($currentImage)
    {
        if (is_file($this->getUploadsFolder() . $currentImage)) {
            unlink($this->getUploadsFolder() . $currentImage);
        }
    }
    
    private function getUploadsFolder()
    {
        return __DIR__ . '/../web/uploads/';
    }
    
    private function generateFileName()
    {
        return md5(uniqid($this->image->baseName)) . '.' . $this->image->extension;
    }
    
    private function saveImage($file)
    {
        $fileName = $this->generateFileName();
        
        $file->saveAs($this->getUploadsFolder() . $fileName);

        return $fileName;
    }
}

<?php

/**
 * This is the model class for table "file".
 *
 * The followings are the available columns in table 'file':
 * @property integer $id
 * @property string $mime_type
 * @property integer $size
 * @property string $name
 * @property string $filename
 */
class File extends CActiveRecord
{
    public $file;
    public $secureFileNames = false;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return File the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('file', 'safe'),
            array('file', 'file', 'allowEmpty' => FALSE, 'types' => 'jpg, jpeg, gif, png'),
			array('size', 'numerical', 'integerOnly'=>true),
			array('mime_type, name', 'length', 'max'=>255),
			array('filename', 'length', 'max'=>4000),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mime_type, size, name, filename', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'file' => 'Файл',
			'mime_type' => 'Mime Type',
			'size' => 'Size',
			'name' => 'Name',
			'filename' => 'Filename',
		);
	}

    public function getReadableFileSize($retstring = null) {
        // adapted from code at http://aidanlister.com/repos/v/function.size_readable.php
        $sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

        if ($retstring === null) { $retstring = '%01.2f %s'; }

        $lastsizestring = end($sizes);

        foreach ($sizes as $sizestring) {
            if ($this->size < 1024) { break; }
            if ($sizestring != $lastsizestring) { $this->size /= 1024; }
        }
        if ($sizestring == $sizes[0]) { $retstring = '%01d %s'; } // Bytes aren't normally fractional
        return sprintf($retstring, $this->size, $sizestring);
    }

    /**
     * A stub to allow overrides of thumbnails returned
     * @since 0.5
     * @author acorncom
     * @return string thumbnail name (if blank, thumbnail won't display)
     */
    public function getThumbnailUrl($publicPath) {
        return $publicPath.$this->filename;
    }

    /**
     * Change our filename to match our own naming convention
     * @return bool
     */
    public function beforeValidate() {

        //(optional) Generate a random name for our file to work on preventing
        // malicious users from determining / deleting other users' files
        if($this->secureFileNames)
        {
            $this->filename = sha1( Yii::app( )->user->id.microtime( ).$this->name);
            $this->filename .= ".".$this->file->getExtensionName( );
        }

        return parent::beforeValidate();
    }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
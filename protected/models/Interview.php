<?php

/**
 * This is the model class for table "Interview".
 *
 * The followings are the available columns in table 'Interview':
 * @property integer $id
 * @property string $iframe
 * @property string $iframe_thumbnail
 * @property string $title
 * @property integer $file_id
 * @property integer $published
 */
class Interview extends CActiveRecord
{
    public static $num = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Interview the static model class
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
		return 'interview';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id', 'numerical', 'integerOnly'=>true),
            array('title, iframe', 'required'),
            array('iframe', 'validateYouTube'),
            array('text, published', 'safe'),
			array('iframe', 'length', 'max'=>5000),
            array('iframe', 'filter', 'filter' => array($this, 'setIframeSizes')),
            array('iframe_thumbnail', 'filter', 'filter' => array($this, 'setIframeThumbnailSizes')),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iframe, title, file_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * Проверка на ввод валидного кода для вставки видео с YouTube
     */
    public function validateYouTube()
    {
        if (strlen($this->iframe) < 1)
        {
            return;
        }
        $message = Yii::t('app', 'Некорректный html код для вставки видео');

        $dom = new DOMDocument();
        $dom->loadHTML($this->iframe);

        /**
         * @var DOMElement $iframe
         */
        $iframe = $dom->getElementsByTagName('iframe')->item(0);

        if (!$iframe instanceof DOMElement || mb_strlen($iframe->getAttribute('src')) < 1)
        {
            $this->addError('iframe', $message);
            return;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $iframe->getAttribute('src'),
            CURLOPT_FILETIME => true,
            CURLOPT_NOBODY => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Host: www.youtube.com'
            )
        ));
        curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        if ($info['http_code'] < 200 || $info['http_code'] >= 400)
        {
            $this->addError('iframe', $message);
        }
    }

    public function setIframeSizes($value)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($value);
        $dom->removeChild($dom->firstChild);
        $dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild);
        $iframe = $dom->getElementsByTagName('iframe')->item(0);
        $iframe->setAttribute('width', 560);
        $iframe->setAttribute('height', 315);
        return $dom->saveHTML();
    }

    public function setIframeThumbnailSizes($value)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($value);
        $dom->removeChild($dom->firstChild);
        $dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild);
        $iframe = $dom->getElementsByTagName('iframe')->item(0);
        $iframe->setAttribute('width', 200);
        $iframe->setAttribute('height', 117);
        return $dom->saveHTML();
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
			'iframe' => 'Код для вставки видео YouTube',
			'title' => 'Заголовок',
			'file_id' => 'File',
            'text' => 'Описание',
            'published' => 'Опубликовано'
		);
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
		$criteria->compare('iframe',$this->iframe,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('file_id',$this->file_id);
//        $criteria->compare('published', ($this->published == 'нет') ? 1 : 0);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getNum()
    {
        return self::$num++;
    }

    public function saveInterview(array $data)
    {
        $this->setAttributes($data);
        $this->iframe_thumbnail = $this->iframe;

        if (!$this->validate())
        {
            return FALSE;
        }

        $this->save();

        return TRUE;

    }
}
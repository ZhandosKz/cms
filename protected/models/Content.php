<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $text
 * @property string $meta_d
 * @property string $meta_k
 * @property string $title
 * @property string $url
 * @property int is_homepage
 * @property int published
 */
class Content extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meta_d, meta_k, title, url', 'length', 'max'=>255),
			array('text, title', 'required'),
            array('url', 'unique'),
            array('url', 'match', 'pattern' => '/^[\w\d\/-]{1,}$/', 'on' => 'noHomePage'),
            array('url', 'required', 'on' => 'noHomePage'),
            array('is_homepage, published', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text, meta_d, meta_k, title, url, is_homepage', 'safe', 'on'=>'search'),
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
			'text' => 'Текст',
			'meta_d' => 'Мета-описание (для поисковых систем)',
			'meta_k' => 'Ключевые слова (для поисковых систем)',
			'title' => 'Заголовок',
            'url' => 'Адрес страницы',
            'is_homepage' => 'Является главной страницей',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('meta_d',$this->meta_d,true);
		$criteria->compare('meta_k',$this->meta_k,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Сохранение контента
     * @param array $data
     * @return bool
     */
    public function saveContent(Array $data)
    {
        $this->setAttributes($data);

        if ($this->is_homepage < 1)
        {
            $this->setScenario('noHomePage');
        }

        if ($this->validate())
        {

            /**
             * @var CDbConnection $connection
             * @var CDbTransaction $transaction
             */
            $connection = Yii::app()->db;

            $transaction = $connection->beginTransaction();

            try
            {
                if ($this->is_homepage > 0)
                {
                    $connection->createCommand()->update($this->tableName(), array('is_homepage' => FALSE));
                    $this->url = NULL;
                    $this->published = TRUE;
                }

                $this->save();
                $transaction->commit();
            }
            catch (Exception $e)
            {
                $transaction->rollback();
            }

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public static function isHomePage($value)
    {
        return ($value > 0) ? 'Да' : 'Нет';
    }

    public static function homePageStatuses()
    {
        return array(NULL, 1);
    }

}
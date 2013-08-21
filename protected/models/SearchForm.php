<?php

/**
 * SearchForm class.
 * Searchform is the data structure for searching from the home page
 * 
 */
class SearchForm extends CFormModel
{

	public $bride;
	public $groom;
	public $startAge;
	public $endAge;
	public $religion;
	public $motherTounge;
	public $caste;
	public $state;
	public $district;
	public $photo;
	public $heightStart;
	public $heightLimit;
	public $bodyType;
	public $bodyColor;
	
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
		);
	}

	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bride' => 'Looking For',
			'startAge' => 'Age',
			'religion' => 'Religion',
			'motherTounge' => 'Mother Tounge',
			'caste' => 'Caste/Division',
			'state' => 'State',
			'district' => 'District',
			'heightStart' => 'Height',
			'photo' => 'Only with Photo',
			 'bodyType' => 'Body Type',
			'bodyColor' => 'Body Color',
			'landNo' => 'Landline No',
			'emailId' => 'E-mail',
			'password' => 'password',
		
		);
	}

}

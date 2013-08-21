<?php

/**
 * UserForm class.
 * Userform is the data structure for keeping
 * user register data. It is used by the
 */
class UserForm extends CFormModel
{

	public $name;
	public $date;
	public $month;
	public $year;
	public $gender;
	public $religion;
	public $motherTounge;
	public $caste;
	public $country;
	public $state;
	public $mobileNo;
	public $landNo;
	public $emailId;
	public $password;
	public $coupon;
	
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,date,month,year,gender,religion,motherTounge,caste,country,state,mobileNo,landNo,emailId,password','required'),
			array('emailId','email'),
			array('mobileNo', 'numerical', 'integerOnly'=>true),
			array('marryId, emailId, password', 'length', 'max'=>100),
			array('name', 'length', 'max'=>250),
			array('gender', 'length', 'max'=>1),
			array('landNo,mobileNo','match','pattern'=>'/^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/'),
			array('dob, createdOn', 'safe'),
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
			'name' => 'Name',
			'date' => 'Date of Birth',
			'gender' => 'Gender',
			'religion' => 'Religion',
			'motherTounge' => 'Mother Tounge',
			'caste' => 'Caste/Division',
			'country' => 'Country',
			'state' => 'State',
			'mobileNo' => 'Mobile No',
			'landNo' => 'Landline No',
			'emailId' => 'E-mail',
			'password' => 'Password',
			'coupon' => 'Coupon code',
		);
	}

}

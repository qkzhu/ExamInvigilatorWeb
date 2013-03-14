<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_config extends CI_Model 
{

	/**
	 * Constant variables
	 */
	public $CONS_MALE = 'm';
	public $CONS_FEMALE = 'f';
	public $CONS_PHOTO_TRUE = 1;	// photo has been uploaded
	public $CONS_PHOTO_FALSE = 0;	// photo has NOT been upload

	/**
	 * Columns names for student table.
	 */
	public $STD_TABLE = "student";
	public $STD_NUM = "student_number";
	public $STD_NAME = "student_name";
	public $STD_IC = "ic_passport";
	public $STD_GENDER = "gender";
	public $STD_DEP = "department";
	public $STD_YEAR = "enrol_year";
	public $STD_PHOTO = "has_photo";


	/**
	 * Column names for department table
	 */
	public $DEP_TABLE = "department";
	public $DEP_ID = "id";
	public $DEP_NAME = "name";


	/**
	 * Column names for module table
	 */
	public $MOD_TABLE = "module";
	public $MOD_ID = "id";
	public $MOD_CODE = "module_code";
	public $MOD_NAME = "name";


	/**
	 * Colunm names for map_student_module table
	 */
	public $MAP_TABLE = "map_student_module";
	public $MAP_SID = "student_id";
	public $MAP_MID = "module_id";


}// end Model_shop_list
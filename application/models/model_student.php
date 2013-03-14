<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_student extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('model_config');
	}


	function create_new_student($std_num, $std_name, $std_ic, $std_gender, $std_dep, $year, $std_photo)
	{
		$data = array(
			$this->model_config->STD_NUM => $std_num,
			$this->model_config->STD_NAME => $std_name,
			$this->model_config->STD_IC => $std_ic,
			$this->model_config->STD_GENDER => $std_gender,
			$this->model_config->STD_DEP => $std_dep,
			$this->model_config->STD_YEAR => $year,
			$this->model_config->STD_PHOTO => $std_photo
		);
		
		$this->db->insert($this->model_config->STD_TABLE, $data);

	} // end create_new_student


	function update_std_info($std_num, $std_name, $std_ic, $std_gender, $std_dep, $year, $std_photo)
	{
		$data = array(
			$this->model_config->STD_NUM => $std_num,
			$this->model_config->STD_NAME => $std_name,
			$this->model_config->STD_IC => $std_ic,
			$this->model_config->STD_GENDER => $std_gender,
			$this->model_config->STD_DEP => $std_dep,
			$this->model_config->STD_YEAR => $year,
			$this->model_config->STD_PHOTO => $std_photo
		);
		
		$this->db->where($this->model_config->STD_NUM, $std_num);
		$this->db->update($this->model_config->STD_TABLE, $data);

	} // end update_std_info


	/**
	 * Returns a list with 2 columns, which are department id => name
	 */
	function get_all_department() 
	{

		$this->db->select($this->model_config->DEP_ID);
		$this->db->select($this->model_config->DEP_NAME);
		$query = $this->db->get($this->model_config->DEP_TABLE);
		
		$query_result = $query->result();
		$result = array();
		foreach ( $query_result as $r ) {
			$result[$r->{$this->model_config->DEP_ID}] = $r->{$this->model_config->DEP_NAME};
		}

		return $result;

	} // end get_all_department


	/**
	 * Returns a list with 3 columns, which are: module id => [code] name
	 */
	function get_all_module() 
	{

		$this->db->select($this->model_config->MOD_ID);
		$this->db->select($this->model_config->MOD_CODE);
		$this->db->select($this->model_config->MOD_NAME);
		$query = $this->db->get($this->model_config->MOD_TABLE);
		
		$query_result = $query->result();
		$result = array();
		foreach ( $query_result as $r ) {
			$result[$r->{$this->model_config->MOD_ID}] = 
					"[" . $r->{$this->model_config->MOD_CODE} . "] " 
					. $r->{$this->model_config->MOD_NAME};
		}

		return $result;

	} // end get_all_module


	/**
	 * Primary key map table between student & module
	 */
	function create_std_mod_map($std_id, $mod_id) 
	{

		$data = array(
			$this->model_config->MAP_SID => $std_id,
			$this->model_config->MAP_MID => $mod_id
		);
		
		$this->db->insert($this->model_config->MAP_TABLE, $data);

	} // end create_std_mod_map


} // end class
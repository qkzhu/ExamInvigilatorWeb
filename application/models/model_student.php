<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_student extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('model_config');
	}




	/**
	  *  insert student info into database and return the last inserted id. 
	  */ 
	function create_new_student( $std_num, $std_name, $std_ic, $std_gender, $std_dep, $year, $std_photo )
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

		return $this->db->insert_id();

	} // end create_new_student





	/**
	 * Update student infomation
	 */
	function update_std_info( $std_id, $std_name, $std_ic, $std_gender, $std_dep, $year, $std_photo )
	{
		$data = array(
			$this->model_config->STD_NAME => $std_name,
			$this->model_config->STD_IC => $std_ic,
			$this->model_config->STD_GENDER => $std_gender,
			$this->model_config->STD_DEP => $std_dep,
			$this->model_config->STD_YEAR => $year,
			$this->model_config->STD_PHOTO => $std_photo
		);
		
		$this->db->where($this->model_config->STD_ID, $std_id);
		$this->db->update($this->model_config->STD_TABLE, $data);

	} // end update_std_info



	/**
	 * Return array with format: id => student_num
	 */
	function get_all_students()
	{

		$this->db->select( $this->model_config->STD_ID );
		$this->db->select( $this->model_config->STD_NUM );
		$query = $this->db->get( $this->model_config->STD_TABLE );

		$query_result = $query->result();
		$result = array(-1 => '-');
		foreach ( $query_result as $r ) {
			$result[ $r->{$this->model_config->STD_ID} ] = $r->{$this->model_config->STD_NUM};
		}

		return $result;

	} // end get_all_students




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

		$this->db->select( $this->model_config->MOD_ID );
		$this->db->select( $this->model_config->MOD_CODE );
		$this->db->select( $this->model_config->MOD_NAME );
		$query = $this->db->get( $this->model_config->MOD_TABLE );
		
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
	 * Returns all module ids associated with student id
	 */
	function get_all_module_by_sid( $std_id )
	{
		$queryString = 
			sprintf( 'SELECT m.id FROM module m, student s, map_student_module map WHERE '
					. 'map.student_id = s.id and map.module_id = m.id and s.id = %s', $std_id);

		$query = $this->db->query( $queryString );
		$query_result = $query->result();

		$result = array();		
		foreach ( $query_result as $r ) {
			array_push($result, $r->id);
		}

		return $result;
		
	} // end get_all_module_by_sid






	/**
	 * Returns module name by given module id.
	 */
	function get_module_by_mid( $mid ) {
		$this->db->select( $this->model_config->MOD_CODE );
		$this->db->select( $this->model_config->MOD_NAME );
		$this->db->where( $this->model_config->MOD_ID, $mid );
		$query = $this->db->get( $this->model_config->MOD_TABLE );

		$result = $query->result();

		if ( isset($result) && sizeof($result) )
			return "[" 
					. $result[0]->{ $this->model_config->MOD_CODE }
					. "] "
					. $result[0]->{ $this->model_config->MOD_NAME };
		else return '';
	}






	/**
	 * Primary key map table between student & module
	 */
	function create_std_mod_map($std_id, $mod_id_arr) 
	{
		foreach($mod_id_arr as $index => $mid) {
			$data = array(
				$this->model_config->MAP_SID => $std_id,
				$this->model_config->MAP_MID => $mid
			);
		
			$this->db->insert($this->model_config->MAP_TABLE, $data);
		}

	} // end create_std_mod_map





	/**
	 * Remove all mappping between student id and module id, for the given student id
	 */
	function remove_std_mode_map( $std_id )
	{

		$this->db->where( $this->model_config->MAP_SID, $std_id );
		$this->db->delete( $this->model_config->MAP_TABLE );

	} // end remove_std_mode_map






	/**
	 * Return all student's infomation by given student id
	 */
	function get_student_info_by_sid( $std_id )
	{
		if ( !isset($std_id) || trim($std_id) == '') return array();

		$this->db->from( $this->model_config->STD_TABLE );
		$this->db->where( $this->model_config->STD_ID, $std_id );
		
		$query = $this->db->get();
		$query_result = $query->first_row();

		if ( sizeof($query_result) == 1 ) return $query_result;
		else return array();

	} // end get_student_info_by_sid


} // end class
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InfoUpdate extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model( 'model_student' );
		$this->load->model( 'model_config' );
	}

	function index()
	{
		$data = $this->getPageComponents();
		$data['main'] = 'view_update';
		$this->load->view( 'includes/template', $data );
	}

	/**
	 * Get all neccessary component to form a completed page for each time loading.
	 * But need to define 'main' for different situation.
	 */
	private function getPageComponents()
	{
		// reset $data in case returned from upload_success page
		$data=null;

		$data['dep_arr']	= $this->model_student->get_all_department();
		$data['year_arr']	= $this->model_config->gen_year_arr();
		$data['module_arr'] = $this->model_student->get_all_module();
		$data['std_list']	= $this->model_student->get_all_students();
		$data['error']		= '';

		return $data;
	}



	/**
	 * To handle student search by using the dropdown list.
	 */
	function stdSearch()
	{
		$data['selected_sid'] = $this->input->post('select_std_id');

		if ( $data['selected_sid'] == -1 ) echo "wrong selection";
		else echo $data['selected_sid'];
		echo "<br />";
		die();
	} // end stdSearch



} // end class InfoUpdate
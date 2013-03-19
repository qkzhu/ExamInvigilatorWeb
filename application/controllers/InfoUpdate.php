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
		$data = $this->getPageComponents();

		$data['selected_sid'] = $this->input->post( 'select_std_id' );

		if ( $data['selected_sid'] != -1 ):

		$std_info = $this->model_student->get_student_info_by_sid( $data['selected_sid'] );

		$data['std_name'] = $std_info->{ $this->model_config->STD_NAME };
		$data['std_ic'] = $std_info->{ $this->model_config->STD_IC };
		$data['gender'] = $std_info->{ $this->model_config->STD_GENDER };
		$data['gender'] = ( $data['gender'] == 'm' ) ? 'Male' : 'Female';
		$data['dep'] = $std_info->{ $this->model_config->STD_DEP };
		$data['year'] = $std_info->{ $this->model_config->STD_YEAR };
		$data['std_module'] = $this->model_student->get_all_module_by_sid( $data['selected_sid'] );

		endif;


		$data['main'] = 'view_update';
		$this->load->view( 'includes/template', $data );
		
		// $std_name = $$this->model_student->
	} // end stdSearch



	/**
	 * For handling form request to update user info
	 */
	function do_update()
	{

		$data = $this->getPageComponents();	

		$data['main'] = 'view_update';

		// get inputs
		$data['std_id'] = $this->input->post('select_std_id');
		$data['std_num'] = $this->input->post('std_num');
		$data['std_name'] = $this->input->post('std_name');
		$data['std_ic'] = $this->input->post('std_ic');
		$data['gender'] = $this->input->post('gender');
		$data['dep'] = $this->input->post('dep');
		$data['year'] = $this->input->post('year');
		$data['std_module'] = $this->input->post('selected_module');


		// set field to display error message individually
		$my_rules = array(
						// array(
						// 	'field' => 'std_num', 
						// 	'label' => 'Student Number',
						// 	'rules' => 'trim|required|exact_length[9]'
						// 	),
						array(
							'field' => 'std_name', 
							'label' => 'Student Name',
							'rules' => 'trim|required|min_length[3]|max_length[50]'
							),
						array(
							'field' => 'std_ic', 
							'label' => 'NRIC / Passport',
							'rules' => 'trim|required'
							),
						array(
							'field' => 'gender', 
							'label' => 'Gender',
							'rules' => 'required'
							),
						array(
							'field' => 'dep', 
							'label' => 'Department',
							'rules' => 'required'
							),
						array(
							'field' => 'year', 
							'label' => 'Year of Enrolment',
							'rules' => 'required'
							),
						array(
							'field' => 'selected_module', 
							'label' => 'Registered Module',
							'rules' => 'required'
							),
						// array(
						// 	'field' => 'userfile', 
						// 	'label' => 'Choose file',
						// 	'rules' => 'required'
						// 	)
				);

		$this->form_validation->set_rules($my_rules);

		// set error message for student number field
		$this->form_validation->set_message( 'exact_length', 'Invalid Student Number Format');


		if ( $this->form_validation->run() === FALSE ) 
		{
			$this->load->view('includes/template', $data);
		}

		else 
		{

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name']  = $data['std_num'];

			$this->model_student->update_std_info(
					$data['std_id'], $data['std_name'], $data['std_ic'], 
					$data['gender'], $data['dep'], $data['year'], 
					$this->model_config->CONS_PHOTO_TRUE );

			$this->model_student->remove_std_mode_map( $data['std_id'] );
			$this->model_student->create_std_mod_map( $data['std_id'], $data['std_module'] );

			/*
			$this->load->library('upload', $config);

			// $data = null;
			if ( ! $this->upload->do_upload() )
			{
				$data['error'] = array( 'error' => $this->upload->display_errors() );
				$data['main'] = 'view_update';
			}
			else
			{
				// update student details to database
				$new_sid = $this->model_student->update_std_info(
									$data['std_id'], $data['std_name'], $data['std_ic'], 
									$data['gender'], $data['dep'], $data['year'], 
									$this->model_config->CONS_PHOTO_TRUE );

				$this->model_student->create_std_mod_map( $new_sid, $data['std_module'] );

				// insert moduels with student map into database
				// $this->model_student->create_std_mod_map();

				$data = array('upload_data' => $this->upload->data());
				$data['main'] = 'view_upload_success';
			}
			*/

			$this->load->view('includes/template', $data);
		}

	} // end do_update

} // end class InfoUpdate
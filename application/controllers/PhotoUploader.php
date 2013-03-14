<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhotoUploader extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_student');
		$this->load->model('model_config');
	}

	function index()
	{
		$data = $this->getPageComponents();
		$data['main'] = 'view_main';
		$this->load->view('includes/template', $data);
	}


	/**
	 * Get all neccessary component to form a completed page for each time loading.
	 * But need to define 'main' for different situation.
	 */
	private function getPageComponents()
	{
		// reset $data in case returned from upload_success page
		$data=null;

		$data['dep_arr'] = $this->model_student->get_all_department();
		$data['year_arr'] = $this->model_config->gen_year_arr();
		$data['module_arr'] = $this->model_student->get_all_module();
		$data['error'] = '';

		return $data;
	}


	// TODO: check if same student has uploaded photo before
	function do_upload()
	{
		// print_r( $_FILES );

		$data = $this->getPageComponents();		

		// get inputs
		$data['std_num'] = $this->input->post('std_num');
		$data['std_name'] = $this->input->post('std_name');
		$data['std_ic'] = $this->input->post('std_ic');
		$data['gender'] = $this->input->post('gender');
		$data['dep'] = $this->input->post('dep');
		$data['year'] = $this->input->post('year');
		$data['module'] = $this->input->post('module');


		// set field to display error message individually
		$field = array(
					array(
						'field' => 'std_num', 
						'label' => 'Student Number',
						'rules' => 'trim|required|exact_length[9]'
						),
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
						'field' => 'module', 
						'label' => 'Registered Module',
						'rules' => 'required'
						),
					array(
						'field' => 'userfile', 
						'label' => 'Choose file',
						'rules' => 'required'
						)
				);
		$this->form_validation->set_rules($field);

		// set error message for student number field
		$this->form_validation->set_message( 'exact_length', 'Invalid Student Number Format');


		if ( $this->form_validation->run() === FALSE ) 
		{
			$data['main'] = 'view_main';
			$this->load->view('includes/template', $data);
		}

		else 
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpeg|jpg';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name']  = $data['std_num'];


			$this->load->library('upload', $config);

			// $data = null;

			if ( ! $this->upload->do_upload() )
			{
				$data['error'] = array( 'error' => $this->upload->display_errors() );
				$data['main'] = 'view_main';
				$data['for_testing'] = 'hhhh';
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$data['main'] = 'view_upload_success';
				$data['for_testing'] = 'tttt';
			}

			$this->load->view('includes/template', $data);
		}

	}// end do_upload()

	
	function download_zip()
	{
		$this->load->library('zip');
		$this->load->model('MY_Zip');

		$folder_in_zip = ""; //root directory of the new zip file

		$path = 'uploads/';
		$this->MY_Zip->get_files_from_folder($path, $folder_in_zip);

		$this->MY_Zip->download('StudentPhotos.zip');

		$this->index();
	}


} // end class PhotoUploader
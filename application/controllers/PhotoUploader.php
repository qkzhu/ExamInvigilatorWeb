<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhotoUploader extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'model_student' );
		$this->load->model( 'model_config' );

		// echo '<script type="text/javascript">document.cookie = "hasJS=true";</script>';

		// $this->session->set_userdata( array('user_selected_modules' => array()) );
	}

	function index()
	{
		// if ( isset( $_COOKIE['hasJS'] ) ) echo '<h1>yes</h1>';
		// else echo '<h1>no</h1>';

		// if ( isset($_POST['hasJS']) ) echo '<h1>yes2</h1>';
		// else echo '<h1>no2</h1>';
		
		// if ( isset($_SESSION['user_selected_modules']) ) session_destroy();
		// session_start();
		// $this->session->set_userdata( array('user_selected_modules' => array()) );

		// $_SESSION['user_selected_modules'] = array();
		$data = $this->getPageComponents();
		$data['main'] = 'view_main';
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

		$data['dep_arr'] = $this->model_student->get_all_department();
		$data['year_arr'] = $this->model_config->gen_year_arr();
		$data['module_arr'] = $this->model_student->get_all_module();
		$data['error'] = '';

		return $data;
	}


	/**
	 * Two situiations: with js enabled & with js disabled
	 * 1. js disabled:
	 * 		all forms done except the module selection part
	 *		solution: use mutiple select box only, no need update it, and
	 *					there is no add and remove button
	 *
	 * 2. js enabled:
	 *		a. all forms need to add js verification.
	 *		b. for module selection, need to use add and remove button.
	 *			however, it's easy select from a dropdown list, but not sure what
	 *			what UI is better to add up to with remove button, maybe just a label with remove button.
	 *		
	 */
	// TODO: check if matric number exists
	//		if so, send error.
	function do_upload()
	{
		// print_r( $_FILES );

		// $action = $this->input->post( 'submit' );

		$data = $this->getPageComponents();	

		// get inputs
		$data['std_num'] = $this->input->post('std_num');
		$data['std_name'] = $this->input->post('std_name');
		$data['std_ic'] = $this->input->post('std_ic');
		$data['gender'] = $this->input->post('gender');
		$data['dep'] = $this->input->post('dep');
		$data['year'] = $this->input->post('year');
		$data['std_module'] = $this->input->post('selected_module');

		// print_r($data['std_module']); die();



		/*
		if ( $action == 'Add' ):

			$data['mid'] = $this->input->post('module');

			// $selected_modules = $this->session->userdata('user_selected_modules');
			$selected_modules = $_SESSION['user_selected_modules'];
			echo "<br/>1. retrive array:<br/>";
			print_r($selected_modules);

			array_push($selected_modules, $data['mid']);
			echo "<br/>2. update array:<br/>";
			print_r($selected_modules);

			// $this->session->set_userdata( 'user_selected_modules',  $selected_modules );
			$_SESSION['user_selected_modules'] = $selected_modules;
			echo "<br/>3. update session:<br/>";
			print_r($_SESSION['user_selected_modules']);

			$data['main'] = 'view_main';
			$this->load->view('includes/template', $data);

		elseif ( $action == 'Remove' ):
			
			// $data['selected_modules'] = $this->model_student->get_module_by_mid( $data['mid'] );
			$data['main'] = 'view_main';
			$this->load->view('includes/template', $data);

		else:
		*/

		// set field to display error message individually
		$my_rules = array(
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
			$data['main'] = 'view_main';
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


			$this->load->library('upload', $config);

			// $data = null;
			if ( ! $this->upload->do_upload() )
			{
				$data['error'] = array( 'error' => $this->upload->display_errors() );
				$data['main'] = 'view_main';
			}
			else
			{
				// $data = array('upload_data' => $this->upload->data());
				$data['upload_data'] = $this->upload->data();
				$data['main'] = 'view_upload_success';

				// insert student details to database
				$new_sid = $this->model_student->create_new_student(
									$data['std_num'], $data['std_name'], $data['std_ic'], 
									$data['gender'], $data['dep'], $data['year'], 
									$this->model_config->CONS_PHOTO_TRUE,
									$data['upload_data']['file_name'] );

				$this->model_student->create_std_mod_map( $new_sid, $data['std_module'] );

				// insert moduels with student map into database
				// $this->model_student->create_std_mod_map();
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

	} // end download_zip


} // end class PhotoUploader
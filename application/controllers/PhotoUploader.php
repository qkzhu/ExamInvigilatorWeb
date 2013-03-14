<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhotoUploader extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		// reset $data in case returned from upload_success page
		$data=null;

		$data['main'] = 'view_main';
		$data['error'] = '';
		$this->load->view('includes/template', $data);
	}


	// TODO: check if same student has uploaded photo before
	function do_upload()
	{

		$this->load->library( 'form_validation' );
		$this->form_validation->set_error_delimiters('<span class="error"', '</span>');

		$this->form_validation->set_rules('std_num', 'Student Number', 'trim|required|exact_length[9]');

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
			$config['file_name']  = $_POST['std_num'];


			$this->load->library('upload', $config);

			$data = null;

			if ( ! $this->upload->do_upload())
			{
				$data['error'] = array('error' => $this->upload->display_errors());
				$data['main'] = 'view_main';
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$data['main'] = 'view_upload_success';
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


	function ttt()
	{
		$this->load->model('model_student');
		
		// $this->model_student->update_std_info('123456789', 'name_test', 's8464736W', 'f', '1', 2006, '1');
		// $data = $this->model_student->get_all_department();
		// $data = $this->model_student->get_all_module();
		// $this->model_student->create_std_mod_map(1,10);
		// $this->model_student->create_std_mod_map(1,12);
		
		// echo '<p>';

		// echo $data[0]->id;

		// echo '</p>';

		// foreach ($data as $d) { echo $d->name . '<br />'; }

		return;
	}

} // end class PhotoUploader
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

		// $action = $this->input->post('submit');

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']  = $_POST['std_num'];


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('view_main', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('view_upload_success', $data);
		}

	}// end do_upload()






} // end class PhotoUploader
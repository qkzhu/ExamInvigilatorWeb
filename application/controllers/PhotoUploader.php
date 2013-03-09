<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhotoUploader extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['main'] = 'view_main';
		$data['error'] = '';
		$this->load->view('includes/template', $data);
	}


	// TODO: check if same student has uploaded photo before
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('view_main', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$data['std_num'] = $_POST['std_num'];

			$this->load->view('view_upload_success', $data);
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
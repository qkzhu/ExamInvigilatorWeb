<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InfoUpdate extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model( 'model_student' );
		$this->load->model( 'model_config' );

		echo '<script type="text/javascript">document.cookie = "hasJS=true";</script>';

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

}
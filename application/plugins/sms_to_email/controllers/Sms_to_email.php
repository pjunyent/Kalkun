<?php
/**
 * Kalkun
 * An open source web based SMS Management
 *
 * @package		Kalkun
 * @author		Kalkun Dev Team
 * @license		https://spdx.org/licenses/GPL-3.0-or-later.html
 * @link		https://kalkun.sourceforge.io/
 */

// ------------------------------------------------------------------------

/**
 * Sms_to_email Class
 *
 * @package		Kalkun
 * @subpackage	Plugin
 * @category	Controllers
 */
include_once(APPPATH.'plugins/Plugin_controller.php');

class Sms_to_email extends Plugin_controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('sms_to_email_model');
	}

	function index()
	{
		$this->load->helper('form');
		$data['title'] = 'SMS to Email Settings';
		$data['main'] = 'index';
		$data['settings'] = $this->sms_to_email_model->get_setting($this->session->userdata('id_user'));
		if ($data['settings']->num_rows() === 1)
		{
			$data['mode'] = 'edit';
		}
		else
		{
			$data['mode'] = 'add';
		}
		$this->load->view('main/layout', $data);
	}

	function save()
	{
		if ($_POST)
		{
			$this->sms_to_email_model->save_setting();
			redirect('plugin/sms_to_email');
		}
	}
}

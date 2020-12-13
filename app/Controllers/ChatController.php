<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class ChatController extends BaseController
{
	public function __construct()
	{
		if(\Config\Services::session()->get('id')=='')
		{
			header('Location: '.base_url('login'));
			exit;
		}
	}

	public function index()
	{
		return view('chat/index');
	}
}
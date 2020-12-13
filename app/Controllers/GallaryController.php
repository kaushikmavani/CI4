<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class GallaryController extends BaseController
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
		$gallaries = $this->db->table('gallary')->where('user_id', $this->session->get('id'))->get()->getResult();
		return view('gallary/index', ['gallaries'=>$gallaries]);
	}
	
	public function upload()
	{
		return view('gallary/upload');
	}

	public function upload_image()
	{
		// For upload user profile 
		$gallary_img = $this->request->getFile('file');
		$img_path = FCPATH . 'public/images/gallary';
		$img_name = $gallary_img->getRandomName();
		if(!is_dir($img_path))
		{
			mkdir($img_path,0755,TRUE);
		}
		$demo = $gallary_img->move($img_path,$img_name);

		$data = [
			'user_id'	=>	$this->session->get('id'),
			'image'		=>	$img_name
		];
		$gallary = $this->db->table('gallary')->insert($data);

		$single_image = $this->db->table('gallary')->where('user_id', $this->session->get('id'))->where('image',$img_name)->get()->getRow();
	}

	public function delete($id)
	{
		$gallary = $this->db->table('gallary')->where('id', $id)->get()->getRow();
		if($gallary)
		{
			// For delete user profile image
			@unlink(FCPATH . "public/images/gallary/" . $gallary->image );

			if($this->db->table('gallary')->where('id', $id)->delete())
			{
				return true;
			}
		}
	}
}
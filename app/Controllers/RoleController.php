<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Role;

class RoleController extends BaseController
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
		$role = new Role;
		$roles = $role->findAll();
		return view('role/index', ['roles'=>$roles, 'permission'=>$this->permission]);
	}

	public function create()
	{
		return view('role/create', ['validation'=>$this->validation]);
	}

	public function store()
	{
		$this->validation->setRules([
			'role'		=>	'required|alpha|min_length[3]'
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$role = new Role();
			$data = [
				'role'	=>	$this->request->getPost('role')
			];
			if($role->save($data))
			{
				$this->session->setFlashdata('success', 'Role created successfully.');
				return redirect()->route('role');
			}
		}
	}

	public function edit($id)
	{
		$role = new Role();
		$role_data = $role->find($id);
		return view('role/edit', ['role'=>$role_data, 'validation'=>$this->validation]);
	}

	public function update($id)
	{
		$this->validation->setRules([
			'role'		=>	'required|alpha|min_length[3]'
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$role = new Role();
			$data = [
				'id'	=>	$id,
				'role'	=>	$this->request->getPost('role')
			];
			if($role->save($data))
			{
				$this->session->setFlashdata('success', 'Role updated successfully.');
				return redirect()->route('role');
			}
		}
	}

	public function delete($id)
	{
		$role = new Role();
		if($role->delete($id))
		{
			return true;
		}
	}
}
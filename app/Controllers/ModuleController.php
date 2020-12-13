<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Module;

class ModuleController extends BaseController
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
		$module = new Module;
		$modules = $module->findAll();
		return view('module/index', ['modules'=>$modules, 'permission'=>$this->permission]);
	}

	public function create()
	{
		return view('module/create', ['validation'=>$this->validation]);
	}

	public function store()
	{
		$this->validation->setRules([
			'module'		=>	'required|alpha|min_length[3]'
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$module = new Module();
			$data = [
				'module'	=>	$this->request->getPost('module')
			];
			if($module->save($data))
			{
				$this->session->setFlashdata('success', 'Module created successfully.');
				return redirect()->route('module');
			}
		}
	}

	public function edit($id)
	{
		$module = new Module();
		$module_data = $module->find($id);
		return view('module/edit', ['module'=>$module_data, 'validation'=>$this->validation]);
	}

	public function update($id)
	{
		$this->validation->setRules([
			'module'		=>	'required|alpha|min_length[3]'
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$module = new Module();
			$data = [
				'id'	=>	$id,
				'module'	=>	$this->request->getPost('module')
			];
			if($module->save($data))
			{
				$this->session->setFlashdata('success', 'Module updated successfully.');
				return redirect()->route('module');
			}
		}
	}

	public function delete($id)
	{
		$module = new module();
		if($module->delete($id))
		{
			return true;
		}
	}
}
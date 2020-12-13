<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;

class UserController extends BaseController
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
		$user = new User();
		$users = $user->where('role', 2)->findAll();

		$custom_users = $user->where('role', 2)->paginate(10, 'users');
		$custom_users_pager = $user->pager;

		$user_table = new \CodeIgniter\View\Table();
		$user_table->setHeading('Id', 'First Name', 'Last Name', 'Email', 'Gender', 'Phone No.', 'Role', 'Status', 'Profile', 'Action');
		$template = [
		    'table_open' => '<table id="user_table" class="table table-bordered table-striped">'
		];
		$user_table->setTemplate($template);

		foreach ($users as $key => $single_user) {
			$img = ''; 
			if($single_user['profile'] != '') 
			{ 
				if(file_exists(FCPATH."public\images\userProfile\\".$single_user['profile'])) 
				{
					$img = base_url()."/public/images/userProfile/".$single_user['profile'];
				} 
				else 
				{ 
					$img = base_url()."/public/dist/img/default.png";
				}
			} 
			else 
			{ 
				$img = base_url()."/public/dist/img/default.png"; 
			}

			$action = '';
			if($this->permission->check('users_edit')) { 
	            $action .= '<a href="'. base_url('user/edit/'.$single_user['id']) .'" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit User"><i class="fa fa-edit" style="font-size: 12px"></i></a>';
	        }
	        if($this->permission->check('users_delete')) {
	            $action .= '<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete User" onclick="delete_user('. $single_user['id'] .')"><i class="fa fa-trash" style="font-size: 12px"></i></button>';
	        }
	        if($this->permission->check('users_permission')) {
	            $action .= '<a href="'. base_url('user/permission/'.$single_user['id']) .'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="User Permission"><i class="fas fa-shield-alt" style="font-size: 12px"></i></a>';
	        }

			$user_table->addRow($single_user['id'], $single_user['firstname'], $single_user['lastname'], $single_user['email'], $single_user['gender'], $single_user['phone_no'], ($single_user['status'] == 1) ? 'Active' : 'Inactive', ($single_user['role'] == 1) ? 'Admin' : 'User', '<img src="'.$img.'" width="50" height="50">', $action);
		}

		return view('user/index', ['users'=>$users, 'permission'=>$this->permission, 'custom_users'=>$custom_users, 'pager'=>$custom_users_pager, 'user_table'=>$user_table]);
	}

	public function create()
	{
		$role = new Role;
		$roles = $role->findAll();
		return view('user/create', ['roles'=>$roles, 'validation'=>$this->validation]);
	}

	public function store()
	{
		$this->validation->setRules([
		    'firstname'		=>	'required|alpha_numeric_space|min_length[3]',
		    'lastname' 		=>	'required|alpha_numeric_space|min_length[3]',
		    'email' 		=>	'required|valid_email|is_unique[users.email]',
		    'password' 		=>  'required|min_length[6]|max_length[8]',
		    'cpassword' 	=>  'required_with[password]|matches[password]',
		    'gender' 		=>  'required',
		    'phone_no'		=>	'required|numeric|min_length[10]|max_length[10]',
		    'role'			=>	'required',
		    'profile'		=>	['uploaded[profile]', 'mime_in[profile,image/jpg,image/jpeg,image/gif,image/png]', 'max_size[profile,2048]']
		],
		[
			'firstname' 	=>	[
	        	'required'		=>	'The first name field is required.',
	        	'min_length'	=>	'The first name field must be at least 3 characters in length.',
	        ],
	        'lastname' 		=>	[
	        	'required'		=>	'The last name field is required.',
	        	'min_length'	=>	'The last name field must be at least 3 characters in length.',
	        ],
	        'cpassword' 	=>	[
	        	'required_with'	=>	'The confirm password field is required when password is present.',
	        	'matches'		=>  'The confirm password field does not match the password field.',
	        ],
	        'phone_no' 		=>	[
	        	'required'		=>	'The phone no. field is required.',
	        	'numeric'		=>  'The phone no. field must contain only numbers.',
	        	'min_length'	=>  'The phone no. field must be at least 10 characters in length.',
	        	'max_length'	=>  'The phone no. field cannot exceed 10 characters in length.',
	        ],
			'profile'		=>	[
				'uploaded'		=>	'The profile filed is required.',
				'mime_in'		=>	'profile does not have a valid mime type, You must be upload image of jpg, jpeg, png type.',
				'max_size'		=>	'Your image file is very large, You must be upload image of max 2048.'
			]
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation->listErrors());
		}
		else
		{
			// For upload user profile 
			$profile_img = $this->request->getFile('profile');
			$img_path = FCPATH . 'public/images/userProfile';
			$img_name = $profile_img->getRandomName();
			if(!is_dir($img_path))
			{
				mkdir($img_path,0755,TRUE);
			}
			$demo = $profile_img->move($img_path,$img_name);

			$user = new User();
			$password_hash = $user->hashPassword(['password'=>$this->request->getPost('password')]);
			$data = [
				'firstname'		=>	$this->request->getPost('firstname'),
				'lastname'		=>	$this->request->getPost('lastname'),
				'email'			=>	$this->request->getPost('email'),
				'password'		=>	$password_hash,
				'gender'		=>	$this->request->getPost('gender'),
				'role'			=>	$this->request->getPost('role'),
				'phone_no'		=>	$this->request->getPost('phone_no'),
				'status'		=>	1,
				'profile'		=>	$img_name,
				'email_verify'	=>	1
			];
			if($user->save($data))
			{
				$this->session->setFlashdata('success', 'User Created Successfully!');
				return redirect()->route('user');
			}
		}
	}

	public function edit($id)
	{
		$user = new User();
		$user_data = $user->find($id);
		$role = new Role;
		$role_data = $role->findAll();
		return view('user/edit', ['validation'=>$this->validation, 'user'=>$user_data, 'roles'=>$role_data]);
	}

	public function update($id)
	{
		$this->validation->setRules([
		    'firstname'		=>	'required|alpha_numeric_space|min_length[3]',
		    'lastname' 		=>	'required|alpha_numeric_space|min_length[3]',
		    'email' 		=>	'required|valid_email',
		    'gender' 		=>  'required',
		    'phone_no'		=>	'required|numeric|min_length[10]|max_length[10]',
		    'role'			=>	'required',
		    'profile'		=>	['mime_in[profile,image/jpg,image/jpeg,image/gif,image/png]', 'max_size[profile,2048]']
		],
		[
			'firstname' 	=>	[
	        	'required'		=>	'The first name field is required.',
	        	'min_length'	=>	'The first name field must be at least 3 characters in length.',
	        ],
	        'lastname' 	=>	[
	        	'required'		=>	'The last name field is required.',
	        	'min_length'	=>	'The last name field must be at least 3 characters in length.',
	        ],
	        'phone_no' 	=>	[
	        	'required'		=>	'The phone no. field is required.',
	        	'numeric'		=>  'The phone no. field must contain only numbers.',
	        	'min_length'	=>  'The phone no. field must be at least 10 characters in length.',
	        	'max_length'	=>  'The phone no. field cannot exceed 10 characters in length.',
	        ],
			'profile'		=>	[
				'mime_in'		=>	'profile does not have a valid mime type, You must be upload image of jpg, jpeg, png type.',
				'max_size'		=>	'Your image file is very large, You must be upload image of max 2048.'
			]
		]);

		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation->listErrors());
		}
		else
		{
			$user = new User();
			$data = [
				'id'			=>	$id,
				'firstname'		=>	$this->request->getPost('firstname'),
				'lastname'		=>	$this->request->getPost('lastname'),
				'gender'		=>	$this->request->getPost('gender'),
				'role'			=>	$this->request->getPost('role'),
				'phone_no'		=>	$this->request->getPost('phone_no')
			];

			$profile_img = $this->request->getFile('profile');
			if($profile_img != '')
			{
				$user_data = $user->find($id);
				@unlink(FCPATH . "public/images/userProfile/" . $user_data['profile'] );

				$img_path = FCPATH . 'public/images/userProfile';
				$img_name = $profile_img->getRandomName();
				if(!is_dir($img_path))
				{
					mkdir($img_path,0755,TRUE);
				}
				$demo = $profile_img->move($img_path,$img_name);

				$data['profile']	=	$img_name;
			}
			if($user->save($data))
			{
				$this->session->setFlashdata('success', 'User updated successfully!');
				return redirect()->route('user');
			}
		}
	}

	public function delete($id)
	{
		$user = new User();
		$user_data = $user->find($id);

		// For delete user profile image
		@unlink(FCPATH . "public/images/userProfile/" . $user_data['profile'] );

		if($user->delete($id))
		{
			return true;
		}
	}

	public function permission($id)
	{
		$user = new User();
		$user_data = $user->find($id);
		$module = new Module();
		$modules = $module->findAll();

		$permission = $this->db->table('role_permission')->where('user_id', $id)->get()->getRow();
		$permission_data = [];
		if($permission != '')
		{
			$permission_data = json_decode($permission->permission);
		}

		return view('user/permission', ['user'=>$user_data, 'permission'=>$permission_data]);
	}

	public function update_permission($id)
	{
		$data = [
			'permission' 	=> 	$this->request->getPost('permission')
		];

		$permission = $this->db->table('role_permission')->where('user_id', $id)->get()->getRow();
		if($permission)
		{
			$set_permission = $this->db->table('role_permission')->where('user_id', $id)->update($data);
		}
		else
		{
			$data = [
				'user_id'		=>	$id,
				'permission'	=>	$this->request->getPost('permission')
			];
			$set_permission = $this->db->table('role_permission')->insert($data);
		}

		return true;
	}

	public function search()
	{
		$search = $this->request->getPost('search');
		$limit = $this->request->getPost('limit');

		$user = new User();
		$user_data = $user->groupStart()
                        ->like('firstname', $search)
                        ->orLike('lastname', $search)
                        ->orLike('email', $search)
                	->groupEnd()
					->where('role', 2)
					->paginate($limit, 'users');

		$custom_users_pager = $user->pager;

		return view('user/search_user_table', ['custom_users'=>$user_data, 'permission'=>$this->permission, 'pager'=>$custom_users_pager]);
	}

	public function sorting()
	{
		$search = $this->request->getPost('search');
		$limit = $this->request->getPost('limit');
		$sorting_key = $this->request->getPost('sorting');
		$sorting_type = $this->request->getPost('sorting_type');

		$sorting = '';
		if($sorting_type=='sorting')
        {
          $sorting = 'desc';
        }
        else if($sorting_type=='sorting_desc')
        {
          $sorting = 'asc';
        }
        else if($sorting_type=='sorting_asc')
        {
          $sorting = 'desc';
        }

		$user = new User();
		$user_data = $user->groupStart()
                        ->like('firstname', $search)
                        ->orLike('lastname', $search)
                        ->orLike('email', $search)
                	->groupEnd()
					->where('role', 2)
					->orderBy($sorting_key, $sorting)
					->paginate($limit, 'users');

		$custom_users_pager = $user->pager;

		return view('user/search_user_table', ['custom_users'=>$user_data, 'permission'=>$this->permission, 'pager'=>$custom_users_pager]);
	}
}

?>
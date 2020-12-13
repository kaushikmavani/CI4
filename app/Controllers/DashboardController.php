<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class DashboardController extends BaseController
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
		if($this->session->get('id') == '')
		{
			return redirect()->route('login');
		}
		return view('dashboard');
	}

	public function changePassword()
	{
		return view('auth/change_password', ['validation'=>$this->validation]);
	}

	public function updatePassword()
	{
		$this->validation->setrules([
			'password'		=>	'required|min_length[6]|max_length[8]',
			'newpassword'	=>	'required|differs[password]|min_length[6]|max_length[8]',
			'newcpassword'	=>	'required|matches[newpassword]'
		],
		[ 
	        'newpassword' 	=>	[
	        	'required'	=>	'The new password field is required.',
	        	'min_length'=>  'The new password field must be at least 6 characters in length.',
	        	'max_length'=>  'The new password field cannot exceed 8 characters in length..',
	            'differs' 	=> 	'The new password field must different from the password field.',
	        ],
	        'newcpassword' 	=> 	[
	        	'required'	=>	'The confirm new password field is required.',
	            'matches' 	=> 	'The new confirm password field does not match the new password field.'
	        ]
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$user = new User();
			$user_data = $user->find($this->session->get('id'));

			$matchpassword = $user->verifyPassword($this->request->getPost('password'), $user_data['password']);
			if($matchpassword)
			{
				$password_hash = $user->hashPassword(['password'=>$this->request->getPost('newpassword')]);
				$data = [
					'id'		=>	$user_data['id'],
					'password'	=>	$password_hash
				];
				if($user->save($data))
				{
					$this->session->setFlashdata('success','Your password has been changed successfully!');
					return redirect()->route('changePassword');
				}
			}
			else
			{
				$this->session->setFlashdata('error', 'Your current password is wrong.');
				return redirect()->route('changePassword');
			}
		}
	}

	public function profile()
	{
		$user = new User();
		$user_data = $user->find($this->session->get('id'));
		return view('profile', ['user'=>$user_data]);
	}

	public function editProfile()
	{
		$user = new User();
		$user_data = $user->find($this->session->get('id'));
		return view('edit_profile', ['validation'=>$this->validation, 'user'=>$user_data]);
	}

	public function updateProfile()
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
				'id'			=>	$this->session->get('id'),
				'firstname'		=>	$this->request->getPost('firstname'),
				'lastname'		=>	$this->request->getPost('lastname'),
				'gender'		=>	$this->request->getPost('gender'),
				'role'			=>	$this->request->getPost('role'),
				'phone_no'		=>	$this->request->getPost('phone_no')
			];

			$profile_img = $this->request->getFile('profile');
			if($profile_img != '')
			{
				$user_data = $user->find($this->session->get('id'));
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
				$user_data = $user->find($this->session->get('id'));
				$this->session->set('firstname', $user_data['firstname']);
				$this->session->set('lastname', $user_data['lastname']);
				$this->session->set('role', $user_data['role']);
				$this->session->set('profile', $user_data['profile']);
				$this->session->setFlashdata('success', 'Your profile updated successfully!');
				return redirect()->route('profile');
			}
		}
	}

	public function logout()
	{
		$this->session->destroy();

		return redirect()->route('login');
	}

	public function language()
	{
		return view('language');
	}

	public function setLanguage()
	{
		$language = \Config\Services::language();
		$language->setLocale($this->request->getPost('language'));

		$this->session->set('language',$this->request->getPost('language'));
    	$this->session->set('locale',$language->getLocale());
	}
}

?>
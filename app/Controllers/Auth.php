<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class Auth extends BaseController
{
	public function __construct()
	{
		if(\Config\Services::session()->get('id')!='')
		{
			header('Location: '.base_url('dashboard'));
			exit;
		}
	}

	public function index()
	{
		return view('auth/login', ['validation' => $this->validation]);
	}

	public function attemptlogin()
	{
		$this->validation->setRules([
		    'email' 		=>	'required|valid_email',
		    'password' 		=>  'required|min_length[6]|max_length[8]'
		]);

		if($this->validation->withRequest($this->request)->run() == false)
		{
			return redirect()->back()->withInput()->with('validation', $this->validation);
		}
		else
		{
			$user = new User();
			$user_data = $user->where('email', $this->request->getPost('email'))->first();
			if(!is_null($user_data))
			{
				if($user_data['email_verify'] == 1)
				{
					$matchpassword = $user->verifyPassword($this->request->getPost('password'), $user_data['password']);
					if($matchpassword)
					{
						$this->session->set('id', $user_data['id']);
						$this->session->set('firstname', $user_data['firstname']);
						$this->session->set('lastname', $user_data['lastname']);
						$this->session->set('email', $user_data['email']);
						$this->session->set('role', $user_data['role']);
						$this->session->set('profile', $user_data['profile']);
						return redirect()->route('dashboard');
					}
					else
					{
						$this->session->setFlashdata('error', 'Email and password are not match.');
						return redirect()->route('login');
					}
				}
				else
				{
					$this->session->setFlashdata('error', 'Your account is not active yet, Please check your email and verify it.');
					return redirect()->route('login');
				}
			}
			else
			{
				$this->session->setFlashdata('error', 'Email not exist.');
				return redirect()->route('login');
			}
		}
	}

	public function register()
	{
		if($this->session->get('id') != '')
		{
			return redirect()->route('dashboard');
		}

		return view('auth/register', ['validation' => $this->validation]);
	}

	public function attemptregister()
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
	        'lastname' 	=>	[
	        	'required'		=>	'The last name field is required.',
	        	'min_length'	=>	'The last name field must be at least 3 characters in length.',
	        ],
	        'cpassword' 	=>	[
	        	'required_with'	=>	'The confirm password field is required when password is present.',
	        	'matches'		=>  'The confirm password field does not match the password field.',
	        ],
	        'phone_no' 	=>	[
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
			helper('text');
			$string = random_string('alnum', 32);
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
				'verification_token' 	=>  $string
			];
			if($user->save($data))
			{
				$user_data = $user->where('email', $this->request->getPost('email'))->first();
				$username = ucwords($user_data['firstname'].' '.$user_data['lastname']);
				$url = base_url().'/emailVerification/'.$string;
				$message = view('mail/email_verify', ['username'=>$username, 'url'=>$url]);
				$email = \Config\Services::email();
				$email->initialize([
					'mailType' => 'html'
				]);
				$email->setFrom('test.vpninfotech@gmail.com', 'Your Name');
				$email->setTo($user_data['email']);
				$email->setSubject('Email registration');
				$email->setMessage($message);
				if($email->send())
				{
					$this->session->setFlashdata('success', 'Your registration is successfully, Please check your email and verify it.');
					return redirect()->route('login');
				}
				else
				{
					$this->session->setFlashdata('error', 'Email could not be sent.');
					return redirect()->route('register');
				}
				
			}
		}
	}

	public function emailVerification($key)
	{
		$user = new User();
		$user_data = $user->where('verification_token', $key)->first();

		if(!is_null($user_data))
		{
			$data = [
				'id'			=>	$user_data['id'],
				'email_verify'	=>	1,
				'verification_token'	=>	''
			];
			if($user->save($data))
			{
				$data = [
					'user_id'	=>	$user_data['id'],
					'permission'	=>	'["users_index","users_create","users_edit","users_delete","users_permission","roles_index","roles_create","roles_edit","roles_delete","modules_index","modules_create","modules_edit","modules_delete"]'
				];
				$this->db->table('role_permission')->insert($data);
				return redirect()->route('emailVerified');
			}
		}
		return redirect()->route('login');
	}

	public function forgotPassword()
	{
		if($this->session->get('id') != '')
		{
			return redirect()->route('dashboard');
		}

		return view('auth/forgot_password', ['validation' => $this->validation]);
	}

	public function resetPassword()
	{
		$this->validation->setRules([
			'email'		=>	'required|valid_email'
		]);
		if($this->validation->withRequest($this->request)->run() == false)
		{	
			return view('auth/forgot_password',  ['validation' => $this->validation]);
		}
		else
		{
			$user = new User();
			$user_data = $user->where('email', $this->request->getPost('email'))->first();
			if(!is_null($user_data))
			{
				helper('text');
				$string = random_string('alnum', 32);
				$data = [
					'id'				=>	$user_data['id'],
					'resetpass_token' 	=>  $string,
				];
				if($user->save($data))
				{
					$username = ucwords($user_data['firstname'].' '.$user_data['lastname']);
					$url = base_url().'/forgotResetPassword/'.$string;
					$message = view('mail/resetpass', ['username'=>$username, 'url'=>$url]);
					$email = \Config\Services::email();
					$email->initialize([
						'mailType' => 'html'
					]);
					$email->setFrom('test.vpninfotech@gmail.com', 'Your Name');
					$email->setTo($user_data['email']);
					$email->setSubject('Reset Passowrd');
					$email->setMessage($message);
					if($email->send())
					{
						$this->session->setFlashdata('success', 'Email has been sent successfullly, Please check your email address.');
					}
					else
					{
						$this->session->setFlashdata('error', 'Email could not be sent.');
					}
					return redirect()->route('forgotPassword');
				}
			}
			else
			{
				$this->session->setFlashdata('error', 'Email not exist.');
				return redirect()->route('forgotPassword');
			}
		}
	}

	public function forgotResetPassword($key)
	{
		$user = new User();
		$user_data = $user->where('resetpass_token', $key)->first();
		if(!is_null($user_data))
		{
			return view('auth/forgot_reset_pass', ['validation'=>$this->validation, 'user'=>$user_data]);
		}
		else
		{
			return redirect()->route('login');
		}
		
	}

	public function updateForgotResetPassword()
	{
		$this->validation->setrules([
			'email'			=>	'required|valid_email',
			'newpassword'	=>	'required|min_length[6]|max_length[8]',
			'newcpassword'	=>	'required|matches[newpassword]'
		],
		[ 
	        'newpassword' 	=>	[
	        	'required'	=>	'The new password field is required.',
	        	'min_length'=>  'The new password field must be at least 6 characters in length.',
	        	'max_length'=>  'The new password field cannot exceed 8 characters in length..',
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
			$user_data = $user->where('email', $this->request->getPost('email'))->first();

			if(!is_null($user_data))
			{
				$password_hash = $user->hashPassword(['password'=>$this->request->getPost('newpassword')]);
				$data = [
					'id'		=>	$user_data['id'],
					'password'	=>	$password_hash,
					'resetpass_token'	=>	''
				];
				if($user->save($data))
				{
					$this->session->setFlashdata('success','Your password has been reset successfully!');
				}
			}
			else
			{
				$this->session->setFlashdata('error', 'Email not exist.');
			}
			return redirect()->route('login');
		}
	}

	public function emailVerified()
	{
		return view('verification');
	}
}

?>
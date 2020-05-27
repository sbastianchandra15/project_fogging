<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model("menu_model");
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
    }


	function index(){
		if ($this->session->userdata('loginuser') == 0){
			$username 		= $this->input->post('username');
			$password		= $this->input->post('password');
            //test($username,1);
			$this->form_validation->set_rules('username','Username');
            $this->form_validation->set_rules('password','Password');

			if ($username == '' ){       
                $this->load->view('login/login');            
            }else{
            	$usr_result = $this->user_model->get_user($username,$password);
                $row = $this->user_model->detail_user($username,$password);

                // $menus      = $this->menu_model->get_menu($row->hak_akses));
                // $submenu    = $this->menu_model->get_submenu();

                if ($usr_result > 0 ){
                	$session_data = array(  'id'            => $row->id,
                                            'nama'          => $row->nama,
                                            'username'      => $row->username,
                                            'hak_akses'     => $row->hak_akses,
                                            'loginuser'     => TRUE
                                            // 'menus'         => $this->menu_model->get_menu($row->hak_akses),
                                            // 'submenu'       => $this->menu_model->get_submenu()
                                         );
                	$this->session->sess_expiration = '60'; // 1 menit
                    $this->session->sess_expiration_on_close = 'true';
                    $this->session->set_userdata($session_data);

                    // $data['id']            	= $this->session->userdata('id');
                    // $data['nama']  			= $this->session->userdata('nama');
                    // $data['hak_akses']      = $this->session->userdata('hak_akses');
                    // $data['my_content']     = '';    
                    // //test('oke',1);
                    // $this->load->view('index', $data);
                    redirect('welcome');

                }else{
                	$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><font size="2">NIK Atau Password Anda salah</font></div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    redirect('login');
                }
            } 
		}else{
            //redirect('welcome');
		}
	}

	function logout() {
         //remove all session data
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('loginuser');
        $this->session->sess_destroy();
        $this->load->view('login/login');
    }

    function view_user(){
        $data['data_user']= $this->user_model->user_all();

        $this->template->load('template', 'master/user_view', $data);
    }

    function delete($id){
        $this->user_model->act_delete($id);
        redirect('user/view_user');
    }

    function form(){
        $this->template->load('template', 'master/user_form');
    }

    function form_act(){
        $this->user_model->act_form();

        redirect('user/view_user');
    }

    function edit($id){
        $data['data_user'] = $this->user_model->data_user($id);
        $this->template->load('template', 'master/user_edit', $data);
    }

    function edit_act(){
        $this->user_model->act_edit();

        redirect('user/view_user');
    }

}

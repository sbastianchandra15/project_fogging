<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');  
        $this->load->model("customer_model");
    }

	function index(){
        $data['data_view']= $this->customer_model->get_data();
        $this->template->load('template', 'customer/view', $data);
    }

    function delete(){
        $this->load->model("customer_model");
        $no_ktp             = $this->input->post('no_ktp');
        $delete             = $this->customer_model->act_delete($no_ktp);
    }

    function form(){
        $this->template->load('template', 'customer/form');
    }

    function form_act(){
        $this->load->model("customer_model");
        $save       = $this->customer_model->act_form();
    }

    function edit($id){
        $this->load->model("customer_model");
        $data['detail']         = $this->customer_model->detail($id);

        $this->template->load('template', 'customer/edit', $data);
    }

    function edit_act(){
        $this->load->model("customer_model");
        $save       = $this->customer_model->act_edit();
    }

    function report(){
        $this->load->model("customer_model");
        $data['data_barang']= $this->customer_model->get_barang();
        $this->template->load('template', 'report/report_barang', $data);
    }

    function login_customer(){
        $this->load->view('login/login_customer');
    }

    function login_act(){
        if ($this->session->userdata('loginuser') == 0){
            $username       = $this->input->post('username');
            $password       = $this->input->post('password');
            //test($username,1);
            $this->form_validation->set_rules('username','Username');
            $this->form_validation->set_rules('password','Password');

            if ($username == '' ){       
                $this->load->view('login/login_customer');            
            }else{
                $usr_result = $this->customer_model->get_user($username,$password);
                $row = $this->customer_model->detail_user($username,$password);

                // $menus      = $this->menu_model->get_menu($row->hak_akses));
                // $submenu    = $this->menu_model->get_submenu();

                if ($usr_result > 0 ){
                    $session_data = array(  'id'            => $row->no_ktp,
                                            'nama'          => $row->nama,
                                            'username'      => $row->username,
                                            'loginuser'     => TRUE
                                            // 'menus'         => $this->menu_model->get_menu($row->hak_akses),
                                            // 'submenu'       => $this->menu_model->get_submenu()
                                         );
                    $this->session->sess_expiration = '60'; // 1 menit
                    $this->session->sess_expiration_on_close = 'true';
                    $this->session->set_userdata($session_data);

                    // $data['id']              = $this->session->userdata('id');
                    // $data['nama']            = $this->session->userdata('nama');
                    // $data['hak_akses']      = $this->session->userdata('hak_akses');
                    // $data['my_content']     = '';    
                    // //test('oke',1);
                    // $this->load->view('index', $data);
                    redirect('welcome/customer');

                }else{
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><font size="2">NIK Atau Password Anda salah</font></div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    redirect('login_cust');
                }
            } 
        }else{
            redirect('welcome');
        }
    }

    function logout() {
         //remove all session data
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('loginuser');
        $this->session->unset_userdata('nama');
        $this->session->sess_destroy();
        redirect('login_cust');
        
    }

    function add_file($no_ktp){
        $config['upload_path'] = './file_upload/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png|gif|zip|rar|doc|docx|xls|xlsx|ods|odt|odp';
        $config['file_name'] = $no_ktp;

        $this->load->library('upload', $config);
        $this->upload->overwrite = true;

        if (!$this->upload->do_upload('file_quotation')) {
            $error = $this->upload->display_errors();
            test($error,1);
        } else {
            $result = $this->upload->data();
            test($result,1);
        }   
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: manegow
 * Date: 1/19/16
 * Time: 11:01 AM
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function loginUser()
    {
        if ($this->input->post("userID") && $this->input->post("password")) {
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('userID', 'userID', 'trim|required|valid_email|xss_clean');

            if ($this->form_validation->run() == false) {
                echo "Formulario incompleto";
            } else {
                $this->load->model("login_model");
                $userID = $this->input->post("userID");
                $password = $this->input->post("password");
                $loginUser = $this->login_model->loginUser($userID, $password);
                if ($loginUser == true) {
                    echo "success";
                    $datos_sesion = array(
                        "userID" => $userID
                    );
                    $this->session->set_userdata($datos_sesion);
                    redirect(base_url('home'));
                } else {
                    echo "failed";

                }
            }
        } else {
            echo "Formulario incompleto";
        }

    }

    public function logoutUser()
    {
        $this->session->sess_destroy();
        redirect(base_url('login', 'refresh'));
    }

}
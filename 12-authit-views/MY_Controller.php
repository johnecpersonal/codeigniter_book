<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected function build_ui($content, $data = null)
    {
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view($content, $data);
        $this->load->view('footer');
    }
}

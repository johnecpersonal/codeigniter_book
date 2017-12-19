<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

    public function __construct()
    {
        // Run the parent's constructor
        parent::__construct();

        // Make sure the user is logged in
        if(!logged_in()) redirect('auth/login');

        // Load purchases model
        $this->load->model('purchases_model');
    }

    protected function setup_pager($base_url, $total_rows, $per_page)
    {
        // Load the pagination library
        $this->load->library('pagination');

        // Pager Configuration
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;

        // Pager Text Configuration
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = "Next";
        $config['prev_link'] = 'Previous';

        // Pager HTML/CSS Configuration
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        // Initialize the pager
        $this->pagination->initialize($config);
    }

    public function browse($offset = null)
    {
        // Setup the pager
        $base_url = site_url('purchases/browse');
        $total_rows = $this->purchases_model->count_purchases();
        $per_page = 20;
        $this->setup_pager($base_url, $total_rows, $per_page);

        // Fetch the purchases using the model
        $data['purchases'] = $this->purchases_model->get_purchases($per_page, $offset);

        // Load the view files
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('browse', $data);
        $this->load->view('footer');
    }

    protected function setup_form()
    {
        // Load the form helper
        $this->load->helper('form');

        // Load the form validation library
        $this->load->library('form_validation');

        // Set the error delimiters to red text
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        // Set the validation rules
        $this->form_validation->set_rules('date', 'Date', 'required|callback_valid_date');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    public function create()
    {
        // Set up form
        $this->setup_form();

        // Show the form or success message
        if ($this->form_validation->run() === FALSE) {
            // Load the view files
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('create');
            $this->load->view('footer');
        } else {
            // Set up purchase array
            $purchase = [
                'date' => $this->input->post('date'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
            ];

            // Store the validated purchase
            $this->purchases_model->store_purchase($purchase);

            // Redirect to the form again
            redirect('/purchases/create');
        }
    }

    public function valid_date($date)
    {
        if (!$this->validateDate($date)) {
            $this->form_validation->set_message('valid_date', 'The {field} field has to be a valid date in YYYY-MM-DD format');
            return false;
        } else {
            return true;
        }
    }

    protected function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function edit($id)
    {
        // Fetch the purchase using the model
        $data['purchase'] = $this->purchases_model->get_purchase($id);

        // Set up form
        $this->setup_form();

        // Show the form or success message
        if ($this->form_validation->run() === FALSE) {
            // Load the view files
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('edit', $data);
            $this->load->view('footer');
        } else {
            // Set up purchase array
            $purchase = [
                'date' => $this->input->post('date'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
            ];

            // Update the validated purchase
            $this->purchases_model->update_purchase($id, $purchase);

            // Redirect to the browse page
            redirect('/purchases/browse');
        }
    }

    public function delete($id)
    {
        // Load the form helper
        $this->load->helper('form');

        // Load the view files
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('confirm', compact('id'));
        $this->load->view('footer');
    }

    public function destroy()
    {
        // Fetch the id from the request
        $id = $this->input->post('id');

        // Delete the purchase using the model
        $this->purchases_model->delete_purchase($id);

        // Redirect to the Browse page
        redirect('/purchases/browse');
    }

    public function seed()
    {
        // Comment out the die statement to seed the db
        die('Database seeding halted');

        // Set up purchases array
        $purchases = [
            [
                'date' => '2017-12-11',
                'price' => 20,
                'description' => 'Dog Food'
            ],
            [
                'date' => '2017-12-12',
                'price' => 50,
                'description' => 'Gas'
            ],
            [
                'date' => '2017-12-12',
                'price' => 2,
                'description' => 'Chips'
            ],
            [
                'date' => '2017-12-13',
                'price' => 1000,
                'description' => 'Laptop'
            ],
            [
                'date' => '2017-12-13',
                'price' => 2,
                'description' => 'Coffee'
            ],
        ];

        // Loop through the array and insert the purchases
        foreach ($purchases as $purchase) {
            $this->db->insert('purchases', $purchase);
        }

        // Echo success
        echo 'Purchases inserted';
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller {

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
        // Fetch logged in user's id
        $user_id = user('id');

        // Setup the pager
        $base_url = site_url('purchases/browse');
        $total_rows = $this->purchases_model->count_purchases($user_id);
        $per_page = 20;
        $this->setup_pager($base_url, $total_rows, $per_page);

        // Fetch the purchases using the model
        $data['purchases'] = $this->purchases_model->get_purchases($per_page, $offset, $user_id);

        // Load the view files
        $this->build_ui('browse', $data);
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
            $this->build_ui('create');
        } else {
            // Set up purchase array
            $purchase = [
                'date' => $this->input->post('date'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'user_id' => user('id'),
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
            $this->build_ui('edit', $data);
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
        $this->build_ui('confirm', compact('id'));
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

    public function reports()
    {
        // Get user id
        $user_id = user('id');

        // Today
        $today = new DateTime('today');
        $today = $today->format('Y-m-d');
        $today = $this->purchases_model->get_sum($today, null, $user_id);

        // Yesterday
        $yesterday = new DateTime('yesterday');
        $yesterday = $yesterday->format('Y-m-d');
        $yesterday = $this->purchases_model->get_sum($yesterday, null, $user_id);

        // Last 7 Days
        $date1 = new DateTime('- 7 days');
        $date1 = $date1->format('Y-m-d');
        $date2 = new DateTime('yesterday');
        $date2 = $date2->format('Y-m-d');
        $last7 = $this->purchases_model->get_sum($date1, $date2, $user_id);

        // Last 30 days
        $date1 = new DateTime('- 30 days');
        $date1 = $date1->format('Y-m-d');
        $date2 = new DateTime('yesterday');
        $date2 = $date2->format('Y-m-d');
        $last30 = $this->purchases_model->get_sum($date1, $date2, $user_id);

        // Create data array
        $data = [
            'today' => $today,
            'yesterday' => $yesterday,
            'last7' => $last7,
            'last30' => $last30,
        ];

        // Load views
        $this->build_ui('reports', $data);
    }
}

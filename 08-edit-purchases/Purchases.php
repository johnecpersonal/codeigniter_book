<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

    public function __construct()
    {
        // Run the parent's constructor
        parent::__construct();

        // Load purchases model
        $this->load->model('purchases_model');
    }

    public function browse()
    {
        // Fetch the purchases using the model
        $data['purchases'] = $this->purchases_model->get_purchases();

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
            // Store the validated purchase
            $this->purchases_model->store_purchase();
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
            // Update the validated purchase
            $this->purchases_model->update_purchase($id);

            // Redirect to the browse page
            redirect('/purchases/browse');
        }
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

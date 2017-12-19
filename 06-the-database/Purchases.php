<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

    public function browse()
    {
        // Load purchases model
        $this->load->model('purchases_model');

        // Fetch the purchases using the model
        $data['purchases'] = $this->purchases_model->get_purchases();

        // Load the view files
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('browse', $data);
        $this->load->view('footer');
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

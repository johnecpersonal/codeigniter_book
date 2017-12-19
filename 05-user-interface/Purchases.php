<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

    public function browse()
    {
        // Fetch purchases (hard-coded for now)
        $purchases = [
            [
                'id' => 1,
                'date' => '2017-12-11',
                'price' => 20,
                'description' => 'Dog Food'
            ],
            [
                'id' => 2,
                'date' => '2017-12-12',
                'price' => 50,
                'description' => 'Gas'
            ],
            [
                'id' => 3,
                'date' => '2017-12-12',
                'price' => 2,
                'description' => 'Chips'
            ],
            [
                'id' => 4,
                'date' => '2017-12-13',
                'price' => 1000,
                'description' => 'Laptop'
            ],
            [
                'id' => 5,
                'date' => '2017-12-13',
                'price' => 2,
                'description' => 'Coffee'
            ],
        ];

        // Add purchases to data array
        $data['purchases'] = $purchases;

        // Load the view files
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('browse', $data);
        $this->load->view('footer');

    }

}

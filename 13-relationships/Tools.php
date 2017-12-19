<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller
{
    public function __construct()
    {
        // Run the parent's constructor
        parent::__construct();

        // Die if we're not in CLI
        if (!is_cli()) {
            die('Have to run these Tools from the command line.');
        }
    }

    public function create($number, $user_id)
    {
        // Load purchases model
        $this->load->model('purchases_model');

        // Require the Faker autoloader
        require_once FCPATH . 'application/third_party/Faker-master/src/autoload.php';

        // Create a Faker\Generator instance
        $faker = Faker\Factory::create();

        // Loop through the number of purchases
        for ($i = 1; $i < $number + 1; $i++) {
            // Create fake purchase data
            $purchase = [
                'date' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'price' => $faker->randomFloat(2, 1, 100),
                'description' => ucfirst($faker->words(2, true)),
                'user_id' => $user_id,
            ];

            // Store the fake purchase in the database
            $this->purchases_model->store_purchase($purchase);

            // Give command line feedback
            echo 'Created ' . $i . ' of ' . $number . ' purchase(s)' . ' for user ' . $user_id . PHP_EOL;
        }
    }
}

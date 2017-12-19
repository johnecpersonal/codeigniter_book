<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases_model extends CI_Model
{
    public function get_purchases()
    {
        // Order by the date column descending
        $this->db->order_by('date', 'DESC');

        // Query the purchases table in the database
        $query = $this->db->get('purchases');

        // Return the result as an array
        return $query->result_array();
    }
}

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

    public function get_purchase($id)
    {
        // Limit to the id
        $this->db->where('id', $id);

        // Query the purchases table in the database
        $query = $this->db->get('purchases');

        // Return the result as an array
        return $query->row_array();
    }

    public function store_purchase($purchase)
    {
        // Insert the purchase into database
        return $this->db->insert('purchases', $purchase);
    }

    public function update_purchase($id, $purchase)
    {
        // Update the purchase in the database
        return $this->db->update('purchases', $purchase, ['id' => $id]);
    }

    public function delete_purchase($id)
    {
        // Delete the purchase from the database
        return $this->db->delete('purchases', ['id' => $id]);
    }
}

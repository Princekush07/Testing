<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flower_Pots extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Flower_Pot_Model', 'flower_pot');
    }

    /**
     * Controller default page
     */
    public function index()
    {
        redirect('flower-pots/all');
    }

    /**
     * Retrieves and displays all records
     * (AJAX Endpoint)
     */
    public function get_all()
    {
        $response = array(
            'items' => $this->flower_pot->get_all()
        );

        http_response_code(200);
        $this->output->set_output(json_encode($response));
    }

    /**
     * Retrieves and displays a single record based on a given id
     * (AJAX Endpoint)
     *
     * @param $id
     */
    public function get($id = NULL)
    {
        if ($id === NULL) {
            show_404();
        }

        $response = array(
            'item' => $this->flower_pot->get($id)
        );

        http_response_code(200);
        $this->output->set_output(json_encode($response));
    }

    /**
     * Creates a new record from $_POST data
     * (AJAX Endpoint)
     */
    public function create()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'water_morning' => $this->input->post('water_morning')? $this->input->post('water_morning') : 0,
            'water_noon' => $this->input->post('water_noon')? $this->input->post('water_noon') : 0,
            'water_afternoon' => $this->input->post('water_afternoon')? $this->input->post('water_afternoon') : 0,
            'updated_at' => '0000-00-00 00:00:00'
        );

        if ($id = $this->flower_pot->insert($data)) {
            http_response_code(200);
            $response = array(
                'insertId' => $id,
                'message' => lang('create_success')
            );
        } else {
            http_response_code(400);
            $response = array('message' => lang('general_error'));
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Updates a record based on $_POST data
     * (AJAX Endpoint)
     */
    public function update()
    {
        if ( ! $this->input->post('id')) {
            show_404();
        }

        $data = array(
            'name' => $this->input->post('name'),
            'water_morning' => $this->input->post('water_morning')? $this->input->post('water_morning') : 0,
            'water_noon' => $this->input->post('water_noon')? $this->input->post('water_noon') : 0,
            'water_afternoon' => $this->input->post('water_afternoon')? $this->input->post('water_afternoon') : 0
        );

        if ($this->flower_pot->update($this->input->post('id'), $data)) {
            http_response_code(200);
            $response = array('message' => lang('update_success'));
        } else {
            http_response_code(400);
            $response = array('message' => lang('general_error'));
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Deletes a record based on given id
     * (AJAX Endpoint)
     *
     * @param null $id
     */
    public function delete($id = NULL)
    {
        if ($id === NULL) {
            show_404();
        }

        if ($this->flower_pot->delete($id)) {
            http_response_code(200);
            $response = array('message' => lang('delete_success'));
        } else {
            http_response_code(400);
            $response = array('message' => lang('general_error'));
        }

        $this->output->set_output(json_encode($response));
    }

    /**
     * Populates the table with dummy data
     * -- accessible on dev mode only
     *
     * @param int $rows
     * @return $this
     */
    public function populate($rows = 10)
    {
        if (ENVIRONMENT != 'development') {
            show_404();
            return;
        }

        for ($i = 0; $i < $rows; $i++) {
            $item = array(
                'name' => random_string('alnum', 15),
                'water_morning' => rand(0, 1),
                'water_noon' => rand(0, 1),
                'water_afternoon' => rand(0, 1)
            );

            $this->flower_pot->insert($item);
        }

        $this->output->set_output('populate success' . br());

        return $this;
    }

    /**
     * Truncates the table
     * -- accessible on dev mode only
     */
    public function truncate()
    {
        if (ENVIRONMENT != 'development') {
            show_404();
            return;
        }

        $this->flower_pot->truncate();

        $this->output->set_output('truncate success' . br());

        return $this;
    }

    /**
     * Empties and repopulates the table with dummy data
     * -- accessible on dev mode only
     *
     * @param int $rows
     */
    public function repopulate($rows = 10)
    {
        if (ENVIRONMENT != 'development') {
            show_404();
            return;
        }

        $this
            ->truncate()
            ->populate($rows);
    }
}
// End of file Flower_Pots.php
// Location: ./application/controllers/Flower_Pots.php
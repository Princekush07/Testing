<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings Controller
 */
class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Setting_Model', 'setting');
    }

    /**
     * Default controller page
     */
    public function index()
    {
        redirect('settings/get-all');
    }

    /**
     * Retrieves and displays all records
     * (AJAX Endpoint)
     */
    public  function get_all()
    {
        $items = $this->setting->get_all();
        $f_items = array();

        // restructure data
        foreach ($items as $item) {
            $f_items[$item->name] = $item->value;
        }

        $response = $f_items;

        http_response_code(200);
        $this->output->set_output(json_encode($response));
    }

    /**
     * Updates a record based on $_POST data
     * (AJAX Endpoint)
     */
    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE)
        {
            http_response_code(400);
            $response = array('message' => validation_errors());

            $this->output->set_output(json_encode($response));
            return;
        }

        $settings = array(
            'user_email' => $this->input->post('user_email'),
            'morning_water_time' => $this->input->post('morning_water_time'),
            'noon_water_time' => $this->input->post('noon_water_time'),
            'afternoon_water_time' => $this->input->post('afternoon_water_time'),
            'alert_advance_minutes' => $this->input->post('alert_advance_minutes')
        );

        foreach ($settings as $key => $value) {
            // get record  to extract id
            $item = $this->setting->get_by('name', $key);

            // update record
            $this->setting->update($item->id, array('value' => $value));
        }

        http_response_code(200);
        $response = array('message' => lang('settings_update_success'));

        $this->output->set_output(json_encode($response));
    }
}

// End of file Settings.php
// Location: ./application/controllers/Settings.php
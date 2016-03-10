<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flower_Pot_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();

        $this->_table = 'flower_pots';
        $this->after_get = array('convert_timeformat');
        $this->before_create = array('created_at');
        $this->before_update = array('updated_at');
    }

    public function convert_timeformat($item)
    {
        $item->created_at = (new DateTime($item->created_at))->format(DateTime::ISO8601);
        $item->updated_at = (new DateTime($item->updated_at))->format(DateTime::ISO8601);

        return $item;
    }
}
// End of file Flower_Pot_Model.php
// Location: ./application/models/Flower_Pot_Model.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();

        $this->_table = 'settings';
    }
}
// End of file Setting_Model.php
// Location: ./application/models/Setting_Model.php
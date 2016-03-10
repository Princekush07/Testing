<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();

        $this->_table = 'flags';
    }
}
// End of file Flag_Model.php
// Location: ./application/models/Flag_Model.php
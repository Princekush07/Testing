<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Notifier Class
 */
class Notifier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Flower_Pot_Model', 'flower_pot');
        $this->load->model('Setting_Model', 'setting');
        $this->load->model('Flag_Model', 'flag');
    }

    /**
     * Sends an email notification the user when it's time to water flowers
     */
    public function cron()
    {
        // get settings, flags
        $settings = $this->setting->get_all();
        $flags = $this->flag->get_all();

        // restructure data
        $f_settings = array();

        foreach ($settings as $item) {
            $f_settings[$item->name] = $item->value;
        }

        $settings = $f_settings;

        $f_flags = array();

        foreach ($flags as $flag) {
            $f_flags[$flag->name] = $flag->value;
        }

        $flags = $f_flags;

        // figure out if whether to notify or not
        $mwt_adv_time = strtotime($settings['morning_water_time']) - time();

        if ($mwt_adv_time <= ($settings['alert_advance_minutes'] * 60) && $mwt_adv_time >= 0) {
            if (time() - strtotime($flags['morning_water_last_notification']) >= 86400) {
                // configure notification
                $notification = array(
                    'items' => $this->flower_pot->get_many_by(array('water_morning' => '1')),
                    'period' => 'morning',
                    'water_time'  => $settings['morning_water_time'],
                    'user_email' => $settings['user_email']
                );

                if ($this->_send_notification($notification)) {
                    // set last notification time
                    $notif_flag = $this->flag->get_by(array('name' => 'morning_water_last_notification'));
                    $this->flag->update($notif_flag->id, array('value' => date(DATE_RFC2822)));
                } else {
                    echo $this->email->print_debugger(array('headers'));
                }
            }
        }

        $nwt_adv_time = strtotime($settings['noon_water_time']) - time();

        if ($nwt_adv_time <= ($settings['alert_advance_minutes'] * 60) && $nwt_adv_time >= 0) {
            if (time() - strtotime($flags['noon_water_last_notification']) >= 86400) {
                // configure notification
                $notification = array(
                    'items' => $this->flower_pot->get_many_by(array('water_noon' => '1')),
                    'period' => 'morning',
                    'water_time'  => $settings['noon_water_time'],
                    'user_email' => $settings['user_email']
                );

                if ($this->_send_notification($notification)) {
                    // set last notification time
                    $notif_flag = $this->flag->get_by(array('name' => 'noon_water_last_notification'));
                    $this->flag->update($notif_flag->id, array('value' => date(DATE_RFC2822)));
                } else {
                    echo $this->email->print_debugger(array('headers'));
                }
            }
        }

        $mwt_adv_time = strtotime($settings['afternoon_water_time']) - time();

        if ($mwt_adv_time <= ($settings['alert_advance_minutes'] * 60) && $mwt_adv_time >= 0) {
            if (time() - strtotime($flags['afternoon_water_last_notification']) >= 86400) {
                // configure notification
                $notification = array(
                    'items' => $this->flower_pot->get_many_by(array('water_afternoon' => '1')),
                    'period' => 'morning',
                    'water_time'  => $settings['afternoon_water_time'],
                    'user_email' => $settings['user_email']
                );

                if ($this->_send_notification($notification)) {
                    // set last notification time
                    $notif_flag = $this->flag->get_by(array('name' => 'afternoon_water_last_notification'));
                    $this->flag->update($notif_flag->id, array('value' => date(DATE_RFC2822)));
                } else {
                    echo $this->email->print_debugger(array('headers'));
                }
            }
        }
    }

    private function _send_notification($notification) {
        $this->load->library('email');

        $this->email->from('noreply@epam.dev', 'EPAM Notification');
        $this->email->to($notification['user_email']);

        $this->email->subject('Almost time to Water Plants (' . $notification['period'] . ')');
        $this->email->message($this->load->view('email/water_notification', $notification, TRUE));

        return $this->email->send(FALSE);
    }
}

// End of file Notifier.php
// Location: ./application/controllers/Notifier.php
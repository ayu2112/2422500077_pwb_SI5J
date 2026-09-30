<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function is_admin_logged_in()
{
  $ci = &get_instance();
  if (!$ci->session->userdata('admin_login')) {
    redirect('admin/login');
  }
}

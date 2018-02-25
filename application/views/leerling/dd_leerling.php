<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="leerling_container container">
    <?php
    $attributes = ['class' => 'dropdown_box1 label #leerling'];
    echo form_label('Leerlingnaam :', 'leerlingnaam', $attributes);
    echo form_dropdown('leerling_id', $leerlingen, $this->session->userdata('sv_leerling_id'), $attributes);
    ?>
</div>



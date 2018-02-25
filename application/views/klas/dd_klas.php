<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="klas_container container">
    <?php
    $attributes = ['class' => 'dropdown_box1 label #klas'];
    echo form_label('Klasnaam :', 'klasnaam', $attributes);
    echo form_dropdown('klas_id', $klassen, $this->session->userdata('sv_klas_id'), $attributes);
    ?>
</div>



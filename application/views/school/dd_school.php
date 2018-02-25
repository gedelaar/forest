<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="school_container container">
    <?php
    $attributes = ['class' => 'dropdown_box1 label #school'];
    echo form_label('Schoolnaam :', 'schoolnaam', $attributes);
    echo form_dropdown('school_id', $scholen, $this->session->userdata('sv_school_id'), 'id="#school" ');
    ?>
</div>


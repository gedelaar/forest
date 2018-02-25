<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="nl">
    <body>
        <div id="container">
            <?php
            echo form_open('klas/handle_form', ['method' => 'post']);

            $attributes = ['class' => 'veld'];
            echo form_fieldset('School Informatie', $attributes);
            echo "<span>";

            //schoolnaam
            $attributes1 = ['class' => 'schoolnaam label'];
            echo form_label('Schoolnaam :', 'schoolnaam', $attributes1);
            $data1 = ['name' => 'schoolnaam',
                'placeholder' => 'Geef de schoolnaam in',
                'value' => $schoolobj->school_naam,
                'readonly' => true,
                'class' => 'input_box'];
            echo form_input('schoolnaam', $schoolobj->school_naam, $data1);
            echo form_error('schoolnaam');

            echo "</span><span>";

            // klasnaam
            $attributes2 = ['class' => 'klasnaam label'];
            echo form_label('Klasnaam :', 'klasnaam', $attributes2);
            $data2 = ['name' => 'klasnaam',
                'placeholder' => 'Geef klasnaam in',
                'value' => set_value('klasnaam'),
                'class' => 'input_box'];
            echo form_input('klasnaam', $klasobj->klas_naam, $data2);
            echo form_error('klasnaam');
            echo "</span>";

            echo form_fieldset_close();
            echo form_hidden('school_id', $klasobj->school_id);
            echo form_hidden('klas_id', $klasobj->klas_id);
            echo form_submit('submit', 'Update');
            echo form_submit('submit', 'Delete');

            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>


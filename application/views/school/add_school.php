<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="nl">
    <body>
        <div id="container">
            <?php
            if ($this->session->flashdata('true')) {
                echo "<div class='alert alert-success'>";
                echo $this->session->flashdata('true');
            } else if ($this->session->flashdata('err')) {
                echo '<div class = "alert alert-success">';
                echo $this->session->flashdata('err');
                echo " </div>";
            }
            echo form_open('school/handle_form', ['method' => 'post']);

            $attributes = ['class' => 'veld'];
            echo form_fieldset('School Informatie', $attributes);
            echo "<span>";

            //schoolnaam
            $attributes1 = ['class' => 'schoolnaam label'];
            echo form_label('Schoolnaam :', 'schoolnaam', $attributes1);
            $data1 = ['name' => 'schoolnaam',
                'placeholder' => 'Geef de schoolnaam in',
                'value' => set_value('schoolnaam'),
                'class' => 'input_box'];
            echo form_input($data1);
            echo form_error('schoolnaam');
            echo "</span><span>";

            // schooljaar
            $attributes2 = ['class' => 'schooljaar label'];
            echo form_label('Schooljaar :', 'schooljaar', $attributes2);
            $data2 = ['name' => 'schooljaar',
                'placeholder' => 'Geef het schooljaar in',
                'value' => set_value('schooljaar'),
                'class' => 'input_box'];
            echo form_input($data2);
            echo form_error('schooljaar');
            echo "</span>";

            echo form_fieldset_close();
            echo form_submit('submit', 'Toevoegen');
            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="nl">
    <body>
        <div id="container">
            <?php
            //print_r($klasobj);
            //echo form_hidden($data);
            if ($this->session->flashdata('true')) {
                echo "<div class='alert alert-success'>";
                echo $this->session->flashdata('true');
            } else if ($this->session->flashdata('err')) {
                echo '<div class = "alert alert-success">';
                echo $this->session->flashdata('err');
                echo " </div>";
            }
            echo form_open('klas/handle_form', ['method' => 'post']);

            $attributes = ['class' => 'veld'];
            echo form_fieldset('School Informatie', $attributes);
            echo "<div id='container'><span>";

            //schoolnaam
            echo "</span><span>";
            echo $dd_school;
            echo "</span><span>";
            //klasnaam
            $attributes1 = ['class' => 'klasnaam label'];
            echo form_label('Klasnaam :', 'klasnaam', $attributes1);
            $data = ['name' => 'klasnaam',
                'placeholder' => 'Geef de naam van de klas in',
                'value' => set_value('klasnaam'),
                'class' => 'input_box'];
            echo form_input($data);
            echo form_error('klasnaam');
            echo "</span></div>";

            echo form_fieldset_close();
            echo form_submit('submit', 'Toevoegen');
            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>


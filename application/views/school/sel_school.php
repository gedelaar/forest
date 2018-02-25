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

            echo $dd_content;

            echo form_fieldset_close();
            echo form_submit('submit', 'Selecteren');
            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>


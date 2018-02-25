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
            echo form_open('leerling/handle_form', ['method' => 'post']);

            $attributes = ['class' => 'veld'];
            echo form_fieldset('Leering Informatie', $attributes);
            echo "<div id='container'><span>";

            //schoolnaam
            echo "</span><span>";
            echo $dd_school;
            echo $dd_klassen;
            echo "</span><span>";
            //leerlingachternaam
            $attributes1 = ['class' => 'leerlingachternaam label'];
            echo form_label('Achternaam :', 'leerlingachternaam', $attributes1);
            $data1 = ['name' => 'leerlingachternaam',
                'placeholder' => 'Geef de achternaam van de leerling in',
                'value' => set_value('leerlingachternaam'),
                'class' => 'input_box'];
            echo form_input($data1);
            echo form_error('achternaam');
            echo "</span><span>";
            //leerlingtussenvoegsel
            $attributes2 = ['class' => 'leerlingtussenvoegsel label'];
            echo form_label('Tussenvoegsel :', 'leerlingtussenvoegsel', $attributes2);
            $data2 = ['name' => 'leerlingtussenvoegsel',
                'placeholder' => 'Geef het tussenvoegsel van de leerling in',
                'value' => set_value('leerlingtussenvoegsel'),
                'class' => 'input_box'];
            echo form_input($data2);
            echo form_error('tussenvoegsel');
            echo "</span><span>";
            //leerlingvoornaam
            $attributes3 = ['class' => 'leerlingvoornaam label'];
            echo form_label('Voornaam :', 'leerlingvoornaam', $attributes3);
            $data3 = ['name' => 'leerlingvoornaam',
                'placeholder' => 'Geef de voornaam van de leerling in',
                'value' => set_value('leerlingvoornaam'),
                'class' => 'input_box'];
            echo form_input($data3);
            echo form_error('voornaam');

            echo "</span></div>";

            echo form_fieldset_close();
            echo form_submit('submit', 'Toevoegen');
            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>


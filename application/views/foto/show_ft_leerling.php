<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="nl">
    <body>
        <div id="container">
            <?php
            echo form_open('foto/handle_form', ['method' => 'post']);

            $attributes = ['class' => 'veld'];
            echo form_fieldset('Leerling Informatie', $attributes);
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
            echo "</span>";

            // klasnaam
            echo "<span>";
            $attributes2 = ['class' => 'klasnaam label'];
            echo form_label('Klasnaam :', 'klasnaam', $attributes2);
            $data2 = ['name' => 'klasnaam',
                'placeholder' => 'Geef klasnaam in',
                'value' => set_value('klasnaam'),
                'class' => 'input_box'];
            echo form_input('klasnaam', $klasobj->klas_naam, $data2);
            echo form_error('klasnaam');
            echo "</span>";

            // leerlingachternaam
            echo "<span>";
            $attributes2 = ['class' => 'leerlingachternaam label'];
            echo form_label('Achternaam :', 'leerlingachternaam', $attributes2);
            $data2 = ['name' => 'leerlingachternaam',
                'placeholder' => 'Geef achternaam in',
                'value' => set_value('leerlingachternaam'),
                'class' => 'input_box'];
            echo form_input('leerlingachternaam', $leerlingobj->achternaam, $data2);
            echo form_error('leerlingachternaam');
            echo "</span>";

            // leerlingtussenvoegsel
            echo "<span>";
            $attributes2 = ['class' => 'leerlingtussenvoegsel label'];
            echo form_label('Tussenvoegsel :', 'leerlingtussenvoegsel', $attributes2);
            $data2 = ['name' => 'leerlingtussenvoegsel',
                'placeholder' => 'Geef tussenvoegsel in',
                'value' => set_value('leerlingtussenvoegsel'),
                'class' => 'input_box'];
            echo form_input('leerlingtussenvoegsel', $leerlingobj->tussenvoegsel, $data2);
            echo form_error('leerlingtussenvoegsel');
            echo "</span>";

            // leerlingvoornaam
            echo "<span>";
            $attributes2 = ['class' => 'leerlingvoornaam label'];
            echo form_label('Voornaam :', 'leerlingvoornaam', $attributes2);
            $data2 = ['name' => 'leerlingvoornaam',
                'placeholder' => 'Geef voornaam in',
                'value' => set_value('leerlingvoornaam'),
                'class' => 'input_box'];
            echo form_input('leerlingvoornaam', $leerlingobj->voornaam, $data2);
            echo form_error('leerlingvoornaam');
            echo "</span>";

            echo form_fieldset_close();
            echo form_hidden('school_id', $klasobj->school_id);
            echo form_hidden('klas_id', $klasobj->klas_id);
            echo form_hidden('leerling_id', $leerlingobj->leerling_id);
            echo form_submit('submit', 'Foto select');

            echo form_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });

        </script>
    </body>
</html>


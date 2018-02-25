<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <script src="<?php echo JQUERY; ?>"></script>
    <body>
        <div id="container">
            <?php
            echo form_open('foto/handle_form', ['method' => 'post']);
            $attributes = ['class' => 'veld'];
            echo form_fieldset('Leerling Informatie', $attributes);
            echo $dd_school; //dropdown scholen
            echo $dd_klassen; //dropdown klassen             
            echo $dd_leerlingen; //dropdown leerlingen
            echo form_submit('submit', 'Foto selectie');
            echo form_fieldset_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
        <script>

            $(document).ready(ddLeerlingen);
            function ddLeerlingen() {

                $('select[name="klas_id"]').on('change', function () {
                    var klas_id = $(this).val();
                    if (klas_id) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>' + 'leerling/get_leerlingen/' + klas_id,
                            type: "POST",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="leerling_id"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="leerling_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        });
                    } else {
                        $('select[name="leerling_id"]').empty();
                    }
                });
            }


        </script>

    </body>
</html>


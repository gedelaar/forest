<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <script src="<?php echo JQUERY; ?>"></script>
    <body>
        <div id="container">
            <?php
            echo form_open('klas/handle_form', ['method' => 'post']);
            $attributes = ['class' => 'veld'];
            echo form_fieldset('School Informatie', $attributes);
            echo $dd_school; //dropdown scholen
            echo $dd_klassen; //dropdown klassen             
            echo form_submit('submit', 'Selecteren');
            echo form_fieldset_close();
            ?>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
        <script>

            $(document).ready(ddKlassen);
            function ddKlassen() {

                $('select[name="school_id"]').on('change', function () {
                    var school_id = $(this).val();
                    if (school_id) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>' + 'klas/get_klassen/' + school_id,
                            type: "POST",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="klas_id"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="klas_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        });
                    } else {
                        $('select[name="klas_id"]').empty();
                    }
                });
            }

        </script>

    </body>
</html>


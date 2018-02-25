<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
?>
<div style="border: 1px solid blue; background-color: #99CCFF; padding: 5px; width: 150px;">
    <a id="show_School" href="javascript:toggle2('hide_school','show_School');" >School</a>
</div>
<div id="hide_school" style="display:block">
    <?php
    echo anchor('school/add_school', 'School toevoegen<br>');
    echo anchor('school/sel_school', 'School selecteren<br>');
    ?>
</div>
<?php
?>
<div style="border: 1px solid blue; background-color: #99CCFF; padding: 5px; width: 150px;">
    <a id="show_Klas" href="javascript:toggle2('hide_Klas','show_Klas');" >Klas</a>
</div>
<div id="hide_Klas" style="display:block">
    <?php
    echo anchor('klas/add_klas', 'Klas toevoegen<br>');
    echo anchor('klas/sel_klas', 'Klas selecteren<br>');
    ?>
</div>

<div style="border: 1px solid blue; background-color: #99CCFF; padding: 5px; width: 150px;">
    <a id="show_Leerling" href="javascript:toggle2('hide_Leerling','show_Leerling');" >Leerling</a>
</div>
<div id="hide_Leerling" style="display:block">
    <?php
    echo anchor('leerling/add_leerling', 'Leerling toevoegen<br>');
    echo anchor('leerling/sel_leerling', 'Leerling selecteren<br>');
    ?>
</div>

<div style="border: 1px solid blue; background-color: #99CCFF; padding: 5px; width: 150px;">
    <a id="show_foto" href="javascript:toggle2('hide_foto','show_foto');" >Fotograferen</a>
</div>
<div id="hide_foto" style="display:block">
    <?php
    echo anchor('foto', 'Leerling fotograferen<br>');
//    echo anchor('leerling/sel_leerling', 'Leerling selecteren<br>');
    ?>
</div>

<?php
//echo 'menu';
//echo anchor('phpinfo', phpinfo());
?>
<script type='text/javascript' src="<?php echo JS; ?>/functions.js"></script>
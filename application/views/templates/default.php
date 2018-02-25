<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//echo "template =";
//print_r($template);
?>
<div class="container">
    <html>
        <div class="header">
            <?php echo $page_header; ?>
        </div>
        <div class="colums">
            <div class="colum-left">
                <?php echo $page_menu; ?>
            </div>
            <div class="colum-right">
                <body>
                    <div class="body">
                        <?php echo $page_content; ?>
                    </div>
                </body>


            </div>

        </div>
        <div class="footer">
            <?php echo $page_footer; ?>
        </div>

    </html>
</div>
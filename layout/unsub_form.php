<?php include("public_header.html"); ?>
<h2>Desinscrever</h2>
<?php
if ($message) {
    echo $message;
} else {
    ?>
    <div id="subscribe_form">
        <p>Por-favor entre com seu email para desinscrever:</p>
        <form action="" method="post"> 
            <div class="form_elements">
                <label>Email</label><input type="text" name="email" value="" class="input_text"> 
            </div>

            <div class="form_elements">
                <input type="submit" name="login" value="Desinscrever">
            </div>
        </form>
    </div>
<?php }
include("public_footer.html");
?>
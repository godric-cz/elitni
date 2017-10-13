<?php

if(post('heslo')) {
    if(post('heslo') === $GLOBALS['CONFIG']['hesloAdmin']) {
        setcookie('admin_klic', $GLOBALS['CONFIG']['klicAdmin']);
    } else {
        cookie_flag_push('admin_spatne_heslo');
    }
    back();
}

$prihlasen = ($_COOKIE['admin_klic'] ?? 'x') === $GLOBALS['CONFIG']['klicAdmin'];

if(!$prihlasen) {
?>



<style type="text/css">
    form { margin: 10em auto; width: 200px; text-align: center; }
    input { display: block; width: 200px; }
</style>

<form method="post">
    <?php if(cookie_flag_pop('admin_spatne_heslo')) { ?>
        nesprávné heslo<br>
    <?php } ?>
    <input type="password" name="heslo" placeholder="heslo">
    <input type="submit" value="zobrazit">
</form>



<?php
exit();
}

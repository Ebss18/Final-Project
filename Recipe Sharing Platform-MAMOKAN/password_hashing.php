<?php
function password_hashing($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}
?>
    
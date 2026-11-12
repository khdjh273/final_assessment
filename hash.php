<?php

include "db.php";

echo password_hash("admin", PASSWORD_DEFAULT);

// INSERT INTO users (name, password_hash)
// VALUES ('admin, '$2y$12$/nq9psyJZORaz0FzvC04SO8edkhF2ScV/qrFlcHWQZt6IUQZ0KilG')


?>
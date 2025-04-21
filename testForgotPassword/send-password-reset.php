
// ALTER TABLE user
//   ADD `reset_token_hash` VARCHAR(64) NULL DEFAULT NULL,
//   ADD `reset_token_expires_at` DATETIME NULL DEFAULT NULL,
//   ADD UNIQUE (`reset_token_hash`);
//run this ql per n datbaz qe t shtohen gjerata
<?php
$email = $_POST["email"];
//krijojm tokenin per passwrod reset
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
//e bejm q t jet valide vec per gjys ore si token
date("y-m-d h:i:s",time() + 60*30);



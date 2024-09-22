<?php
// Expire the cookie by setting the expiration time
$cookie = "user_cookie";// Named it user_cookie
$cookieExpire = time() - 3600; // 1 hour ago
setcookie($cookie, "", $cookieExpire, "/");

// Redirect to home page after logout
header("Location: https://obi.kean.edu/~marsanto@kean.edu/CPS3740/"); 
exit;
?>

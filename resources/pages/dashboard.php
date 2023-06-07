<?php

if (!$_SESSION['user_logged_in']) {
    header('HTTP/1.1 302 Redirect');
    header('Location: /view/login');
    exit();
}

include "head.php";

echo "Hello, user with email " . $_SESSION['user_email'] . ' you succesfully logged in our system. 🎉';

?>


<form action="/view/logout" target="_self">
    <button type="submit">Logout</button>
</form>

<?php

include "footer.php";

?>
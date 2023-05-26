<?php
use App\model\User;

try {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (empty($_POST)) {
        throw new Exception('');
    }

    if (!$email) {
        throw new Exception('Invalid email');
    }

    $password = filter_input(INPUT_POST, 'password');
    if (!$password || mb_strlen($password) < 8) {
        throw new Exception('Password must contain 8+ characters');
    }

    $passwordHash = password_hash(
        $password,
        PASSWORD_DEFAULT,
        ['cost' => 12]
    );

    $person                = new User();
    $person->email         = $email;
    $person->password_hash = $passwordHash;
    $return                = $person->save();

    if ($return) {
        header('HTTP/1.1 302 Redirect');
        header('Location: /login');
        exit();
    } else {
        $alert = "An error ocorred! If it keep happening call the support.";
    }

} catch (\Exception $e) {
    $alert = $e->getMessage();
}
?>

<body>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Sign Up</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <form class="text-center" action="register" method="post">
                                <p class="text-danger">
                                    <?= $alert ?? '' ?>
                                </p>
                                <div class="mb-3"><input class="form-control" type="email" name="email"
                                        placeholder="Email" value="<?= $email ?>"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="password"
                                        placeholder="Password"></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Sign
                                        Up</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
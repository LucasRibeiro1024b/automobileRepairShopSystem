<?php
$alert = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);

include "head.php";

?>
<section class="py-4 py-xl-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Login</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <form class="text-center" action="view/login" method="post" target="_self">
                            <p class="text-danger">
                                <?= $alert ?? '' ?>
                            </p>
                            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="mb-3"><input class="form-control" type="password" name="password"
                                    placeholder="Password"></div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Login</button>
                            </div>
                            <p class="text-muted"><a href="view/register" target="_self">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";

?>
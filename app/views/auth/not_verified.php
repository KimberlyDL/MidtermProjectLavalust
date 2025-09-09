<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Email Verification Required</title>
    <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css'); ?>">
</head>

<body class="bg-light">

    <?php
    $LAVA = &lava_instance();
    $prefill = $LAVA->session->flashdata('unverified_email') ?? '';
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Verify Your Account</h3>

                        <?php
                        if (function_exists('flash_alert')) {
                            flash_alert();
                        }
                        ?>

                        <p>
                            Hi! Your account has not been verified yet.
                            Please check your email inbox for the verification link.
                            Didn’t receive it? You can request a new one below:
                        </p>

                        <form action="<?= site_url('auth/resend-verification') ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    value="<?= html_escape($prefill); ?>"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Resend Verification Email
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="<?= base_url('auth/login'); ?>">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
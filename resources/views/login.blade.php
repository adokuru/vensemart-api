<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vensemart | Log in</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo URL::to('/assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo URL::to('/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo URL::to('/assets/dist/css/adminlte.min.css'); ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0);">Vensemart </a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="username" class="form-control" placeholder="Email"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>


                    <div class="input-group mb-3">
                        <input type="password" name="password" id="pass" class="form-control"
                            placeholder="Password" required>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <!--<p class="mb-1"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">I forgot my password</a></p>-->
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                placeholder="Enter email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo URL::to('/assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo url::to('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo URL::to('/assets/dist/js/adminlte.min.js'); ?>"></script>
</body>

</html>

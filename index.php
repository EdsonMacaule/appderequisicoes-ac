<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SGPI - gerenciamos os seus pedidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!--favicon-->
    <link rel="icon" href="" type="image/x-icon" />
    <!--end favicon-->
    <!--Begin Plugins CSS-->
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!--End Plugins CSS-->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
</head>

<body>
    <div id="form-group" class="container">
        <div class="row login-container column-seperation">
            <div class="col-md-5 col-md-offset-1" style="margin-right: 50px">
                <h1 style="font-size: 6.5em; font-family: 'Source Sans Pro', sans-serif;">
                    SGR
                </h1>
            </div>
            <div class="col-md-5">
                <br>
                <form method="POST" action="controllers/utilizador/acess.php">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input class="form-control" type="email" placeholder="Usuário" name="email_utilizador"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input class="form-control" type="password" placeholder="Senha" name="senha_utilizador"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="control-group col-md-10">
                            <div class="checkbox checkbox check-success">
                                <a href="views/utilizadores/cadastro.php"><strong>Faça o seu Cadastro</strong></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn btn-primary btn-cons pull-right" type="submit" name="login" id="login"
                                onclick="location.href='home.php'">Login</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

</body>

</html>
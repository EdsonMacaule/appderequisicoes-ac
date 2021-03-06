<?php
session_start();
require_once 'models/main.php';
$u=new Usuario;
?>
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
    <link rel="icon" href="assets/img/favicon-32x32.png" type="image/x-icon" />
    <!--end favicon-->
    <!--Begin Plugins CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />-->
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!--End Plugins CSS-->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
</head>
<!--#1B1E24-->

<body>
    <style>
    body {
        background-color: #1B1E24;
        overflow: hidden;
    }

    div.row.login-container.column-seperation {
        justify-content: center;
        align-items: center;
        padding: 30px;
        padding-top: 10%;
        /*border: 1px solid red;*/
    }

    div.col-md-5.col-md-offset-1 {
        border-right: 3px solid #5f6775;
        margin-right: 50px;
        /*border: 1px solid white;*/
    }

    div.col-md-5.col-md-offset-1 img {
        margin-top: -20px;
        /*border: 1px solid green;*/
        padding: 10px;
    }

    /*div.col-md-5{*/
    /*    border: 1px solid yellow;*/
    /*}*/


    div#adduserModal {
        height: 70%;
        overflow: hidden;
    }

    @media screen and (max-width: 414px) {
        div.row.login-container.column-seperation {
            padding-top: 5% !important;
        }

        div.col-md-5.col-md-offset-1 {
            border-right: none !important;
            margin-left: 10px;
        }

        div.col-md-5.col-md-offset-1 img {
            /*padding: 2px;*/
            padding-right: 40px !important;
            margin-top: 0px;
        }

        div.col-md-5 {
            margin-left: 30px;
        }

        div#adduserModal {
            height: 85%;
        }
    }

    @media screen and (max-width: 1024px) {
        div.row.login-container.column-seperation {
            padding-top: 15%;
        }

        div.col-md-5.col-md-offset-1 {
            border-right: 2px solid #5f6775;
            margin-left: 20px;
        }

        div.col-md-5.col-md-offset-1 img {
            /*padding: 2px;*/
            padding-right: 40px;
            margin-top: -25px;
        }

        div#adduserModal {
            height: 70%;
        }
    }

    @media screen and (max-width: 990px) {
        div.row.login-container.column-seperation {
            justify-content: normal;
            align-items: normal;
            padding: 20px;
            padding-top: 20%;
            /*border: 1px solid red;*/
        }

        div.col-md-5.col-md-offset-1 {
            border-right: 2px solid #5f6775;
            margin-left: 20px;
            /*border: 1px solid yellow;*/
            height: 50%;
        }

        div.col-md-5.col-md-offset-1 img {
            /*padding: 2px;*/
            padding-right: 100px;
            margin-top: -25px;
        }

        /*div.col-md-5{*/
        /*    border: 1px solid red;*/
        /*}*/

        div.col-md-5 form input {
            width: 280px;
        }

        div.col-md-5 form div#submeter {
            margin-left: 22%;
        }

        div.col-md-5 form div.row div.col-md-10 button#login_form {
            margin-top: 5%;
        }

        div#adduserModal {
            height: 85%;
        }
    }

    @media screen and (max-width: 360px) {
        div.row.login-container.column-seperation {
            padding-top: 10%;
        }

        div.col-md-5.col-md-offset-1 {
            border-right: none;
            margin-left: 0px;
            /*border: 1px solid red;*/
        }

        div.col-md-5.col-md-offset-1 img {
            /*border: 2px solid whitesmoke;*/
            padding-right: 60px;
            margin-top: 0px;
        }

        div#adduserModal {
            height: 87%;
        }
    }
    </style>

    <!-- Modal submit Request-->
    <div class="modal fade bd-example-modal-sm" id="adduserModal" tabindex="-1" role="dialog"
        aria-labelledby="RequestModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adduserModalLabel"><strong>Fa??a aqui o seu registro</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="controllers/utilizador/register.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="name" placeholder="Nome Completo" id="nome_utilizador"
                                name="nome_utilizador">
                        </div>
                        <div class="form-group">

                            <input class="form-control" type="email" placeholder="Escreva seu email"
                                id="email_utilizador" name="email_utilizador">

                        </div>
                        <div class="form-group" style="display: none;">
                            <?php $result= $u->email_usuario(); ?>
                            <select name="email_user" id="email_user" class="form-control">
                                <?php foreach ($result as $row): ?>
                                <option value="<?php echo $row["email_utilizador"];?>"></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <?php $result = $u->cargo(); ?>
                            <select class="form-control" name="cargo" id="cargo" aria-label="Default select example">
                                <?php foreach ($result as $row): ?>
                                <option class="optionnivel" value="<?php echo $row["id_cargo"];?>">
                                    <?php echo $row["nome_cargo"]; ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="display: none">

                            <input class="form-control" type="text" placeholder="Perfil" value="user"
                                id="perfil_utilizador" name="perfil_utilizador">

                        </div>
                        <div class="form-group ">

                            <input class="form-control" type="password" placeholder="Senha" id="senha_utilizador"
                                name="senha_utilizador">

                        </div>
                    </div>
                    <div class="alert alert-error hide" style="display: none">Erro de registo, verifique se todos campos
                        est??o devidamente preenchidos ou o email ja esteja cadastrado!</div>
                    <div class="alert alert-success hide" style="display: none">Seu Registo foi submetido com sucesso
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="adicionar" name="adicionar">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal submit Request-->
    <div id="form-group" class="container">
        <div class="row login-container column-seperation">
            <div class="col-md-5 col-md-offset-1">
                <img src="assets/img/sgpi-01.png" alt="some text" width=320 height=200>
                <!--                <h1 style="font-size: 6.5em; font-family: 'Source Sans Pro', sans-serif;">-->
                <!--                    SGPI-->
                <!--                    -->
                <!--                </h1>-->
            </div>
            <hr>
            <hr>
            <div class="col-md-5">
                <br>
                <form method="POST" action="controllers/utilizador/acess.php">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input class="form-control" type="email" placeholder="Escreva seu Email"
                                id="email_utilizador" name="email_utilizador" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input class="form-control" type="password" placeholder="Escreva sua Senha"
                                id="senha_utilizador" name="senha_utilizador" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="control-group col-md-10">
                            <div class="checkbox checkbox check-success">
                                <a href="index.php#adduserModal" class="badge badge-info edit_btn " data-toggle="modal"
                                    data-target="#adduserModal" style="padding:5px;">Fa??a o seu Cadastro</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="alert alert-error hide" style="display: none">Erro de registo, verifique se todos campos
                        est??o devidamente preenchidos ou o email ja esteja cadastrado!</div>
                    <div class="alert alert-success hide" style="display: none">Seu Registo foi submetido com sucesso
                    </div> -->
                    <div class="row">
                        <div class="col-md-10" id="submeter">
                            <button class="btn btn-primary btn-cons pull-right" type="submit" name="login_form"
                                id="login_form" onclick="location.href='home.php'">Iniciar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('#adicionar').click(function(e) {
            e.preventDefault();
            // alert('Ola Macaule Adicionar');
            var utilizador_nome = $('#nome_utilizador').val();
            var utilizador_email = $('#email_utilizador').val();
            var utilizador_cargo = $('#cargo').val();
            var utilizador_perfil = $('#perfil_utilizador').val();
            var utilizador_senha = $('#senha_utilizador').val();
            var email_user = $('#email_user').val();
            // alert(pedido_nome);
            if (utilizador_nome == "" || utilizador_email == email_user || utilizador_cargo == "" ||
                utilizador_perfil == "" || utilizador_senha == "") {
                $('.alert-error').show();
            } else {
                $.ajax({
                    type: 'POST',
                    // dataType: 'json',
                    url: "controllers/utilizador/register.php",
                    // async: true,
                    data: {
                        'adicionar': true,
                        nome_utilizador: utilizador_nome,
                        email_utilizador: utilizador_email,
                        cargo: utilizador_cargo,
                        perfil_utilizador: utilizador_perfil,
                        senha_utilizador: utilizador_senha,

                    },
                    success: function(data) {
                        // console.log(data);
                        $('.alert-success').show();
                        $('.alert-error').hide();
                        // alert('Requisi????o submetida com Sucesso!')
                        location.href = "index.php";
                    }

                });

            }


        });

    });
    </script>

</body>

</html>
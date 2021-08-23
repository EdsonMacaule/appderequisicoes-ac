<?php
require "../../models/main.php";
$u = new Usuario;

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
    <link rel="icon" href="" type="image/x-icon" />
    <!--end favicon-->

    <!--Begin Plugins CSS-->
    <link href="../../assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../../assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!--End Plugins CSS-->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
</head>

<body>
    <style>
    body {
        background-color: #C0D1C2;
    }

    div.row {
        justify-content: center;
        align-items: center;
        margin: 2% 0 10% 20%;
    }

    @media screen and (max-width: 991px) {
        div.row {
            margin: 0 0 0 0;
        }

    }

    @media screen and (max-width: 800px) {
        div.row {

            margin: 0 0 0 0;
        }
    }
    </style>

    <div class="container" style="background-color: whitesmoke;">
        <h2 class="center-text" style="margin-top: 5%;"><strong>Faça aqui o seu registro</strong></h2>
        <br><br>
        <div class="col-md-10">
            <div class="row">
                <br>
                <form method="POST" action="../../controllers/utilizador/register.php">
                    <div class="form-group">

                        <input class="form-control" type="name" placeholder="Nome Completo" name="nome_utilizador">

                    </div>
                    <div class="form-group">

                        <input class="form-control" type="email" placeholder="Usuário" name="email_utilizador">

                    </div>
                    <div class="form-group">

                        <?php $result = $u->cargo(); ?>
                        <select class="form-control" name="cargo" aria-label="Default select example">
                            <?php foreach ($result as $row): ?>
                            <option class="optionnivel" value="<?php echo $row["id_cargo"];?>">
                                <?php echo $row["nome_cargo"]; ?></option><?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group" style="display: none">

                        <input class="form-control" type="text" placeholder="Perfil" value="user"
                            name="perfil_utilizador">

                    </div>
                    <div class="form-group ">

                        <input class="form-control" type="password" placeholder="Senha" name="senha_utilizador">

                    </div>
                    <div class="form-group">

                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="adicionar"
                            id="adicionar">Registar</button>

                    </div>
                    <!--                <div class="form-group">-->
                    <!---->
                    <!--                        <div class="checkbox checkbox check-success">-->
                    <!--                            <a href="../home/home.php"><strong>Dashboard</strong></a>-->
                    <!---->
                    <!--                    </div>-->
                    <!--                </div>-->

                </form>
            </div>
        </div>

    </div>

</body>

</html>
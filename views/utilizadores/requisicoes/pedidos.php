<?php
session_start();
require "../../../models/main.php";
$u = new Usuario;
//$id=$_GET['id_usuario'];
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
    <link href="../../../assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../../../assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--End Plugins CSS-->
    <!--SweetAlert-->
    <link href="../../../assets/plugins/sweetalert/dist/sweetalert2.min.css">
    <!--End SweetAlert-->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="../../../webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
</head>

<body>
    <style>
    body {
        background-color: #C0D1C2;
    }
    </style>
    <div class="container" style="background-color: whitesmoke;">

        <h2 class="center-text" style="margin-top: 5%; color: black;">Faça suas requisições aqui</h2>
        <br>
        <div class="col-lg-6">
            <a href="../users.php" style="font-size: 8mm;">Voltar</a>
        </div>
        <br><br><br><br>
        <div class="col-md-12">
            <div class="row">
                <form method="POST" action="../../../controllers/utilizador/olderuser.php">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" style="color: black;">Escreva seu pedido</label>
                        <textarea class="form-control" id="nome_pedido" name="nome_pedido" maxlength=""
                            rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1" style="color: black;">Remetente</label>

                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="<?php echo $_SESSION['nome_usuario']; ?> "
                            style="text-transform: uppercase; font-weight: bold;" disabled>

                    </div>
                    <div class="form-group" style="color: black; display: none;">
                        <label for="exampleFormControlInput1" style="color: black;">Remetente</label>

                        <select class="form-control" name="id_utilizador" id="id_utilizador">
                            <option class="optionnivel" value="<?php echo $_SESSION['id_usuario']; ?>">
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="color: black;">Qual é o seu departamento?</label>
                        <!--                    <select class="form-control" id="exampleFormControlSelect1">-->
                        <?php $result = $u->departamento(); ?>
                        <select class="form-control" name="id_departamento" id="id_departamento">
                            <?php foreach ($result as $row): ?>
                            <option class="optionnivel" value="<?php echo $row["id_departamento"];?>">
                                <?php echo $row["nome_departamento"]; ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="color: black;">Estado do pedido</label>
                        <select class="form-control" id="id_estado" name="id_estado"
                            aria-label="Disabled select example" disabled>
                            <option value="1" selected>Pedendete</option>
                            <option value="2">Em revisão</option>
                            <option value="3">Aprovado</option>
                            <option value="4">Feito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="color: black;">Qual é a prioridade do seu
                            pedido?</label>
                        <select class="form-control" id="id_prioridade" name="id_prioridade"
                            aria-label="Disabled select example">
                            <option value="1" selected>Baixa</option>
                            <option value="2">Media</option>
                            <option value="3">Alta</option>
                        </select>
                    </div>
                    <br>
                    <div class="alert alert-error hide">Preencha todos Campos!</div>
                    <div class="alert alert-success hide">Requisição submetida com Sucesso</div>
                    <div class="col-vlg-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="submeter_form"
                            name="submeter_form">Submeter Pedido</button>

                    </div>
                    <br><br>
                </form>
            </div>


        </div>
    </div>
    <!--SweetAlert-->
    <script type="text/javascript" src="../../../assets/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>
    <!--End SweetAlert-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--<script src="../../assets/plugins/jquery/jquery.min.js" ></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js//bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>-->

    <script type="text/javascript">
    $(document).ready(function() {

        $('#submeter_form').click(function(e) {
            e.preventDefault();
            // alert('Ola Joaquim');
            var pedido_nome = $('#nome_pedido').val();
            var utilizador = $('#id_utilizador').val();
            var departamento = $('#id_departamento').val();
            var tipo_estado = $('#id_estado').val();
            var tipo_prioridade = $('#id_prioridade').val();

            $.ajax({
                type: 'POST',
                // dataType: 'json',
                url: "../../../controllers/utilizador/olderuser.php",
                // async: true,
                data: {
                    'submeter_form': true,
                    pedido: pedido_nome,
                    utilizador: utilizador,
                    dep: departamento,
                    estado: tipo_estado,
                    prioridade: tipo_prioridade,

                },
                success: function(data) {
                    // console.log(data);
                    // $('.alert-success').show();
                    alert('Requisição submetida com Sucesso!')
                    location.href = "../users.php";
                }

            });

        });
    });
    </script>
</body>

</html>
<?php
require_once '../../models/main.php';
$u = new Usuario;
session_start();
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['id_usuario'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../../index.php"); exit;
}
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--    <link href="../../assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="../../assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--    <link href="../../assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />-->
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

    table thead tr th {
        text-align: center;
    }

    table tbody tr td {
        text-align: center;
    }

    div#RequestModal {
        height: 92%;
        overflow: hidden;
    }
    div#outside{
        float: right;
    }
    div.container{
        width: auto !important;
    }
    div#outside a {
        margin-left: 90%;
        font-size: 16px;
    }
    div.container p {
        /*font-size: 9pt;*/
        text-align: center;
    }

    @media screen and (max-width: 414px) {
        div.container {
            width: auto !important;
            height: auto !important;
        }

        div.container h2 {
            font-size: 14pt;
            font-weight: bold;
        }

        div.container p {
            font-size: 9pt;
            text-align: center;
        }

        div.col-lg-8 .btn {
            width: 250px;
            font-size: large;
            /*margin-right: 10%;*/
            text-align: center;
        }

        div.col-lg-12 table {
            width: auto;
        }

        div#RequestModal {
            height: 100%;
        }
        div#outside a {
            font-size: 14px;
        }

    }
    </style>
    <!-- Modal submit Request-->
    <div class="modal fade bd-example-modal-sm" id="RequestModal" tabindex="-1" role="dialog"
        aria-labelledby="RequestModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RequestModalLabel">Submeter Requisições</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../../controllers/home/olders.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" style="color: black;">Escreva seu pedido</label>
                            <textarea class="form-control" id="nome_pedido" name="nome_pedido" rows="2"></textarea>
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
                            <label for="exampleFormControlSelect1" style="color: black;">Qual é o seu
                                departamento?</label>
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
                    </div>
                    <div class="alert alert-error hide">Erro de registo, verifique se todos campos estão devidamente
                        preenchidos!</div>
                    <div class="alert alert-success hide">Sua requisição foi submetida com sucesso</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submeter_form"
                            name="submeter_form">Submeter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal submit Request-->
    <div class="container" style="background-color: whitesmoke; max-height: auto !important;">
        <br>
        <h2 class="center-text col-lg-pull-0" style="margin-top: 5%;">Bem-vindo ao Sistema de Gestão de Requisições - Usuário</h2>
        <br>
        <p style="text-transform: uppercase; font-weight: bold;">Olá, <?php echo $_SESSION['nome_usuario']; ?>, Nesta
            Janela tem todas suas requisições!</p>
        <!--Informando o nome do usuário logo que acessa o sistema-->
        <div class="col-md-5" id="outside">
            <a href="home.php" style="font-size: 12pt;">Voltar</a>
        </div>
        <!--    --><?php //echo $_SESSION['id_usuario']; ?>
        <br><br><br>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info"
                                style=" border-radius: 10px; background:linear-gradient(#d62839 70%,#ffffff 50%);">
                                <div class="inner" style=" border-radius: 5px;">
                                    <?php $id_utilizador=$_SESSION['id_usuario'];  $result= $u->pedidos_pedentes_usuario($id_utilizador); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm;text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Pedentes']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições Pedentes</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style="background-color: #d62839;border-radius: 5px; padding: 1mm; ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffffff">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    </svg>
                                </div>
                                <!--                            <a href="#" class="small-box-footer">Mais informações</a>-->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success"
                                style=" border-radius: 10px;background: linear-gradient(#ffd100 70%,#ffffff 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $id_utilizador=$_SESSION['id_usuario'];  $result= $u->reviw_older_user($id_utilizador); ?>
                                    <h3 style="color: black; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_EM_Revisao']; ?></strong>
                                    </h3>
                                    <p style="color: black; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições em Revisão</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style=" background-color: #ffd100; border-radius: 5px ;padding: 1mm;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-half" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffffff">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                    </svg>
                                </div>
                                <!--                            <a href="#" class="small-box-footer">Mais informações</a>-->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning"
                                style="border-radius: 10px; background:linear-gradient(#38b000 70%,#ffffff 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $id_utilizador=$_SESSION['id_usuario'];  $result= $u->older_user_aprov($id_utilizador); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Aprovados']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm;font-size: 12pt; text-align: center;">
                                        Requisições Aprovadas</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style=" background-color: #38b000; border-radius: 5px ;padding: 1mm;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-fill" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffffff">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg>
                                </div>
                                <!--                            <a href="#" class="small-box-footer">Mais informações</a>-->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger"
                                style="border-radius: 5px; background:linear-gradient(#386fa4 70%,#ffffff 50%)">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $id_utilizador=$_SESSION['id_usuario'];  $result= $u->older_user_done($id_utilizador); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Feitos']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições Finalizadas</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style="background-color: #386fa4;border-radius: 5px;padding: 1mm;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check2-all" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffffff">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>
                                </div>
                                <!--                            <div class="icon" style="background-color: #137cb8;">-->
                                <!--                            <a href="#" class="small-box-footer" >Mais informações</a>-->
                                <!--                            </div>-->
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->
            </section>
            <br><br><br>
        </div>
        <div class="col-lg-12" style="display: flex;">
            <div class="col-lg-8" style="margin-left: 18%;">
                <button type="submit" name="btn" class="btn btn-primary btn-lg btn-block"
                    onclick="location.href='admin.php#RequestModal'" style="border-radius: 10px;" data-toggle="modal"
                    data-target="#RequestModal">Nova Requisição</button>
            </div>
        </div>
        <br><br><br><br>
        <h4 style="color: #606060; text-transform: uppercase; font-size: 12pt;"><strong>Veja a baixo as suas
                requisições</strong></h4>
        <div class="col-lg-18">
            <table class="table table-hover table-responsive" align="center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: left;" >Descrição </th>
                        <th style="text-align: left;" >Remetente</th>
                        <th style="text-align: left;" >Departamento</th>
                        <th>Estado</th>
                        <th>Prioridade</th>
                        <th>Data de Emissão</th>
                        <th>Data de Actualização</th>
                    </tr>
                    <?php $id_utilizador=$_SESSION['id_usuario']; $result = $u->userquest($id_utilizador); ?>
                </thead>
                <tbody>
                    <?php $con=1; foreach ($result as $row): ?>
                    <tr>
                        <th scope="row"><?php echo $con; ?></th>
                        <td style="text-align: left;"><?php echo $row["descricao_pedido"]; ?></td>
                        <td style="text-align: left;" ><?php echo $row["nome_utilizador"]; ?></td>
                        <td style="text-align: left;" ><?php echo $row["nome_departamento"]; ?></td>
                        <td  ><?php echo ($row["nome_estado"]==1 ? '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#d62839">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    </svg>' : ($row["nome_estado"]==2 ?'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-half" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffd100">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                    </svg>' : ($row["nome_estado"]==3 ?'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-fill" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#32C441">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check2-all" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#386fa4">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>'))); ?>
                        </td>
                        <td><?php echo ($row["nome_prioridade"] == 1 ? '<button class=" btn btn-success"  >Baixa</button>' : ($row["nome_prioridade"] == 2 ? '<button class="btn btn-primary" >Media</button>' : '<button class="btn btn-danger" >Alta</button>')); ?></button>
                        </td>
                        <td><?php echo $row["data_pedido"]; ?></td>
                        <td><?php echo $row["update_data"]; ?></td>
                    </tr>

                    <?php $con++; endforeach;?>
                </tbody>
            </table>
            <br><br>
        </div>
    </div>

    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
    <!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <!--<script src="../../assets/plugins/sweetalert/dist/sweetalert2.all.min.js" ></script>-->
    <!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
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
            // alert('Ola Macaule');
            var pedido_nome = $('#nome_pedido').val();
            var utilizador = $('#id_utilizador').val();
            var departamento = $('#id_departamento').val();
            var tipo_estado = $('#id_estado').val();
            var tipo_prioridade = $('#id_prioridade').val();
            // alert(pedido_nome);
            if (pedido_nome == "") {
                $('.alert-error').show();
            } else {
                $.ajax({
                    type: 'POST',
                    // dataType: 'json',
                    url: "../../controllers/home/olders.php",
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
                        $('.alert-success').show();
                        $('.alert-error').hide();
                        // alert('Requisição submetida com Sucesso!')
                        location.href = "admin.php";
                    }

                });

            }


        });
    });
    </script>

</body>

</html>
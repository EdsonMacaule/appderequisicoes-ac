<?php
session_start();
require_once "../../models/main.php";
$u= new Usuario;
//require_once '../../dashead.php';
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['id_usuario'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../../login.php"); exit;
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
    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">-->
    <!--    <link href="../../assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="../../assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--    <link href="../../assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />-->
    <link href="../../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <!--    <link rel="stylesheet" href="../../assets/plugins/sweetalert/dist/sweetalert2.min.css">-->
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

    div#statusModal {
        height: 55%;
        overflow: hidden;

    }
    div#outside{
        float: right;
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
            width: auto;
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
        div#outside a {
           font-size: 14px;
        }

    }
    </style>
    <!-- Modal Update Status-->
    <div class="modal fade bd-example-modal-sm" id="statusModal" tabindex="-1" role="dialog"
        aria-labelledby="statusModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Estado das Requisições</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="status.php">
                    <div class="modal-body">
                        <div class="form-group" style="display: none">
                            <input type="text" class="pedido" name="pedido_id" id="pedido_id" value="" disabled>
                        </div>

                        <div class="form-group" style="display: none;">
                            <?php $result = $u->status_request(); ?>
                            <select name="estado_id" id="estado_id" class="form-control" disabled>
                                <?php foreach ($result as $row): ?>
                                <option value="<?php echo $row["id_estado"];?>">
                                    <?php echo  ($row["nome_estado"]==1 ? 'Pedente' : ($row["nome_estado"]==2 ?'Em Revisão' : ($row["nome_estado"]==3 ?'Aprovado' : 'Feito'))); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="">Prioridade</label>
                                <?php $result = $u->prioridade(); ?>
                                <select name="prioridade_id" id="prioridade_id" class="form-control">
                                    <?php foreach ($result as $row): ?>
                                    <option value="<?php echo $row["id_prioridade"]; ?>">
                                        <?php echo  ($row["nome_prioridade"] == 1 ? 'Baixa' : ($row["nome_prioridade"] == 2 ? 'Media' : 'Alta'));?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!--                        <input type="text" class="form-control" name="estado" id="estado" value=""  disabled >-->
                        <div class="form-group">
                            <label for="">Escolha o estado</label>
                            <?php $result = $u->status_request(); ?>
                            <select name="update_estado" id="update_estado" class="form-control">
                                <?php foreach ($result as $row): ?>
                                <option value="<?php echo $row["id_estado"];?>">
                                    <?php echo  ($row["nome_estado"]==1 ? 'Pedente' : ($row["nome_estado"]==2 ?'Em Revisão' : ($row["nome_estado"]==3 ?'Aprovado' : 'Feito'))); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-error hide">Erro de actualização, o estado deve ser diferente do actual!
                    </div>
                    <div class="alert alert-success hide">Estado actualizado com sucesso</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update_form"
                            name="update_form">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal Update Status-->


    <div class="container" style="background-color: whitesmoke;height: auto;">
        <br>
        <h2 class="center-text col-lg-pull-0" style="margin-top: 5%;">Bem-vindo ao Sistema de Gestão de Requisições
            (SGR)</h2>
        <br>
        <p style="text-transform: uppercase; font-weight: bold;">Olá, <?php echo $_SESSION['nome_usuario']; ?>, esta
            janela reflete a todas Requisições feitas a nivel do sistema!</p>
        <!--Informando o nome do usuário logo que acessa o sistema-->
        <div class="col-md-5" id="outside">
            <strong><a href="../../logout.php">Sair</a></strong>
        </div>
        <br><br><br>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info"
                                style=" border-radius: 10px; background:linear-gradient(#B82923 70%,#ffffff 50%);">
                                <div class="inner" style=" border-radius: 5px;">
                                    <?php $result= $u->allrequest_pedind(); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm;text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Pedentes']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições Pedentes</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style="background-color: #B82923;border-radius: 5px; padding: 1mm; ">
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
                                style=" border-radius: 10px;background: linear-gradient(#D3E625 70%,#ffffff 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_review(); ?>
                                    <h3 style="color: black; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_EM_Revisao']; ?></strong>
                                    </h3>
                                    <p style="color: black; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições em Revisão</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style=" background-color: #D3E625; border-radius: 5px ;padding: 1mm;">
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
                                style="border-radius: 10px; background:linear-gradient(#32C441 70%,#ffffff 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_aprov(); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Aprovados']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm;font-size: 12pt; text-align: center;">
                                        Requisições Aprovadas</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style=" background-color: #32C441; border-radius: 5px ;padding: 1mm;">
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
                                style="border-radius: 5px; background:linear-gradient(#3390B6 70%,#ffffff 50%)">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_done(); ?>
                                    <h3 style="color: white; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_Feitos']; ?></strong>
                                    </h3>
                                    <p style="color: whitesmoke; padding: 0.5mm; font-size: 12pt; text-align: center;">
                                        Requisições Finalizadas</p>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="icon" style="background-color: #3390B6;border-radius: 5px;padding: 1mm;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check2-all" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#ffffff">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>
                                </div>

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
            <!--    <div class="col-lg-8">-->
            <!--        <button type="submit" name="btn challenge" class="btn btn-primary btn-lg btn-block" onclick="location.href='requisicoes/requisicao.php'" style="border-radius: 10px;">Nova Requisição</button>-->
            <!--    </div>-->
            <div class="col-lg-8" id="requestmaster" style="margin-left: 18%;">
                <button type="submit" name="btn challenge" class="btn btn-primary btn-lg btn-block"
                    onclick="location.href='admin.php'">Suas Requisições</button>
            </div>
        </div>
        <br><br><br><br>
        <div class="col-lg-18">
            <table class="table table-hover table-responsive ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="text-align: left;" >Descrição </th>
                        <th style="text-align: left;" >Remetente</th>
                        <th style="text-align: left;" >Departamento</th>
                        <th>Estado</th>
                        <th>Action</th>
                        <th>Prioridade</th>
                        <th>Data de Emissão</th>
                        <th>Data de Actualização</th>
                    </tr>
                    <?php $result = $u->allrequest(); ?>
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
                                        style="margin-left: 20px; padding-top: 5px;" color="#B82923">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    </svg>' : ($row["nome_estado"]==2 ?'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-half" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#D3E625">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                    </svg>' : ($row["nome_estado"]==3 ?'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-circle-fill" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#32C441">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check2-all" viewBox="0 0 16 16"
                                        style="margin-left: 20px; padding-top: 5px;" color="#3390B6">
                                        <path
                                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                    </svg>'))); ?>
                        </td>
                        <td style=""><button class="btn btn-success"><a href="home.php#statusModal" id_pedido="<?php echo $row["id_pedido"]; ?>"
                                nome_estado="<?php echo  $row["nome_estado"];?>" prioridade="<?php echo $row["nome_prioridade"]; ?>" class="badge badge-info edit_btn "
                                data-toggle="modal" data-target="#statusModal" style="font-size: 14px;" >Editar</a></button>
                        <td><?php echo ($row["nome_prioridade"] == 1 ? '<button class=" btn btn-success"  >Baixa</button>' : ($row["nome_prioridade"] == 2 ? '<button class="btn btn-primary" >Media</button>' : '<button class="btn btn-danger" >Alta</button>')); ?>
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
        $('.edit_btn').click(function(e) {
            e.preventDefault();

            var pedidos = $(this).attr('id_pedido');
            var dados = $(this).attr('nome_estado');
            var prio = $(this).attr('prioridade');

            document.getElementById("pedido_id").value = pedidos;
            document.getElementById("update_estado").value = dados;
            document.getElementById("estado_id").value = dados;
            document.getElementById("prioridade_id").value = prio;


        });

        $('#update_form').click(function(e) {
            e.preventDefault();
            // alert('Ola Macaule');
            var estado = $('#update_estado').val();
            var pedido = $('#pedido_id').val();
            var last_status = $('#estado_id').val();
            var prioridade = $('#prioridade_id').val();
            // alert(pedido);

            if (estado != last_status) {
                $.ajax({
                    type: 'POST',
                    // dataType: 'json',
                    url: "status.php",
                    // async: true,
                    data: {
                        'update_form': true,
                        update_estado: estado,
                        id_prioridade: prioridade,
                        pedido_id: pedido,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.alert-success').show();
                        $('.alert-error').hide();
                        location.href = "home.php";
                    }

                });

            } else {
                $('.alert-error').show();
            }



        });

    });
    </script>

</body>

</html>
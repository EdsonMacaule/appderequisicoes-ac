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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap.min.js" ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" ></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js" ></script>
    <title>SGPI - gerenciamos os seus pedidos</title>
    <script>
        $(document).ready(function() {
            $('#resquesting').DataTable( {
                "language": {
                    "search": "Pesquisar:",
                    "Next": "Próximo",
                    "lengthMenu": "Mostrar _MENU_ por página",
                    "zeroRecords": "Nada foi encontrado - desculpe",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhuma requisição disponivel",
                    "infoFiltered": "(filtered from _MAX_ total records)"

                },

            } );

        } );
    </script>
</head>

<body>
    <style>
    body {
        background-color: #C0D1C2 !important;
    }
    table thead tr th {
        text-align: center !important;
    }
    table tbody tr td {
        text-align: center !important;
    }
    table#resquesting tbody tr td button a:link {
        text-decoration: none !important;
    }
    table#resquesting tbody tr td button a:hover {
        color: white !important;
    }
    div#statusModal {
        height: 100% !important;
        overflow: hidden !important;

    }
    div#outside {
        /*float: right;*/
        /*border: 1px solid red;*/
        width: 10% !important;
        margin-top: -35px !important;
        margin-left: 90% !important;
    }
    div#outside a {
        /*margin-left: 30%;*/
        font-size: 18px !important;
        color: #a5a58d !important;
        text-decoration: none !important;

        /*padding-top: -10%;*/
    }

    div#outside a:hover{
        color: red !important;
    }
    div#outside svg:hover{
        color: red !important;
    }
    div.container p {
        /*font-size: 9pt;*/
        text-align: center !important;
    }
    /*div#requestmaster{*/
    /*    !*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/
    /*    margin-left: 20%;*/
    /*    width: 180px;*/
    /*    margin-top: 50px;*/
    /*}*/
    button#requestmaster_button{
        width: 180px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
        margin-left: 70% !important;
        margin-top: 50px !important;
    }

    ul {
        list-style-type: none !important;
    }
    div#resquesting_filter label{
        text-align: left !important;
    }

    @media screen and (max-width: 414px) {
        div#dashboard{
            padding: 5px !important;
        }

        div.container h2 {
            font-size: 8pt !important;
            font-weight: bold !important;
            text-align: center !important;
        }

        div.container p {
            font-size: 7pt !important;
            text-align: center !important;
        }

        div.col-lg-12 table {
            width: auto !important;
        }
        /*div#requestmaster{*/
        /*    !*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/
        /*    width: 350px;*/
        /*    margin-left: -8%;*/
        /*    border-radius: 5px;*/
        /*    !*border: 1px solid #444;*!*/
        /*}*/
        button#requestmaster_button{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
            width: 180px !important;
            /*box-shadow: black;*/
            margin-left: 0% !important;
            /*border: 1px solid red;*/
        }

        div#outside{
            margin-left: 70% !important;
            width: 25% !important;
            /*border: 1px solid red;*/
        }
        div#outside a#sair_do {
            margin-left: 0% !important;
            font-size: 12px !important;
            /*border: 1px solid red;*/
        }


    }
    @media screen and (max-width: 1024px){
        div#dashboard{
            padding: 5px;
        }
        div.container h2 {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }
        div.container p {
            font-size: 10pt;
            text-align: center;
        }
        div.col-lg-12 table {
            width: auto;
        }
        /*div#requestmaster{*/
        /*    !*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/

        /*    width: 600px;*/
        /*    !*padding-left: -20%;*!*/
        /*    border-radius: 10px;*/
        /*    !*border: 1px solid red;*!*/
        /*}*/
        button#requestmaster_button{
            width: 180px;
            /*border-radius: 20px;*/
            /*box-shadow: black;*/
            /*padding-right: 80%;*/
        }
        div#outside {
            /*float: right;*/
            width: 10%;
            margin-top: -30px;
        }
        div#outside a {
            /*margin-left: 60%;*/
            font-size: 14px;
        }

    }
    @media screen and (max-width: 990px){
        div#dashboard{
            padding: 5px;
        }
        /*div#requestmaster{*/
        /*    !*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/

        /*    width: 450px;*/
        /*    !*padding-left: -20%;*!*/
        /*    border-radius: 10px;*/
        /*    !*border: 1px solid red;*!*/
        /*}*/
        button#requestmaster_button{
            width: 180px;
            margin-left: 0% !important;
            /*border-radius: 20px;*/
            /*box-shadow: black;*/
            /*padding-right: 80%;*/
        }
        div#outside {
            /*float: right;*/
            width: 20% !important;
            margin-left: 80% !important;
            margin-top: -30px;
        }

    }
    @media screen and (max-width: 360px){
        /*div#requestmaster{*/
        /*    !*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*!*/

        /*    width: 330px;*/
        /*    !*padding-left: -20%;*!*/
        /*    border-radius: 10px;*/
        /*    !*border: 1px solid red;*!*/
        /*}*/
        button#requestmaster_button{
            width: 180px;
            margin-left: 10%;
            /*border-radius: 20px;*/
            /*box-shadow: black;*/
            /*padding-right: 80%;*/
        }
       div.container div#outside{
            width: 30% !important; ;
            margin-left: 65% !important;
            /*border: 1px solid red;*/
        }
        div#outside a {
            /*margin-left: -1%;*/
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
                    <h5 class="modal-title" id="statusModalLabel">Alterar o estado e prioridade da requisição</h5>
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
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
                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="" style="font-weight: bold">Escolha a prioridade</label>
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
                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="" style="font-weight: bold">Escolha o estado</label>
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
                    <div class="alert alert-error hide" style="display:none; color: red">Erro de actualização, o estado deve ser
                        diferente do actual!
                    </div>
                    <div class="alert alert-success hide" style="display:none; color: green ">Estado e prioridade actualizados com sucesso</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="update_form"
                            name="update_form">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal Update Status-->
    <div class="container" style="background-color: whitesmoke;height: auto; ">

        <button type="submit" id="requestmaster_button" class="btn btn-primary btn-block" onclick="location.href='admin.php'">Minhas Requisições</button>
        <div class="col-md-5" id="outside">
            <ul>
                <li>
                    <strong>
                        <a href="../../logout.php" id="sair_do" >
                            <span style="color: #a5a58d;" id="spann_id">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd"
                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />

                                </svg>
                            </span>
                            Sair</a>
                    </strong>
                </li>
            </ul>
        </div>
        <h2 class="center-text col-lg-pull-0" style="margin-top: 5%; text-align:center; ">Sistema de Gestão
            de Requisições
            (SGR)</h2>
        <br>
        <p style="text-transform: lowercase; font-weight: normal;" >Olá <?php echo $_SESSION['nome_usuario']; ?>, esta
            janela reflete a todas Requisições feitas!</p>
        <!--Informando o nome do usuário logo que acessa o sistema-->
        <!--        <div class="col-md-5" id="outside">-->
        <!--            <strong><a href="../../logout.php">Sair</a></strong>-->
        <!--        </div>-->
        <br>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6" id="dashboard">
                            <!-- small box -->
                            <div class="small-box bg-info"
                                style=" border-radius: 10px; background:linear-gradient(#d62839 70%,whitesmoke 50%);">
                                <div class="inner" style=" border-radius: 5px;">
                                    <?php $result= $u->allrequest_pedind(); ?>
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
                        <div class="col-lg-3 col-6" id="dashboard">
                            <!-- small box -->
                            <div class="small-box bg-success"
                                style=" border-radius: 10px;background: linear-gradient(#ffd100 70%,whitesmoke 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_review(); ?>
                                    <h3 style="color: #444; padding: 0.5mm; padding-top: 3mm; text-align: center;">
                                        <strong><?php  echo $result['Pedidos_EM_Revisao']; ?></strong>
                                    </h3>
                                    <p style="color: #444; padding: 0.5mm; font-size: 12pt; text-align: center;">
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
                        <div class="col-lg-3 col-6" id="dashboard">
                            <!-- small box -->
                            <div class="small-box bg-warning"
                                style="border-radius: 10px; background:linear-gradient(#38b000 70%,whitesmoke 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_aprov(); ?>
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
                        <div class="col-lg-3 col-6" id="dashboard">
                            <!-- small box -->
                            <div class="small-box bg-danger"
                                style="border-radius: 5px; background:linear-gradient(#386fa4 70%,whitesmoke 50%)">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $result= $u->allrequest_done(); ?>
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
<!--        <div class="col-lg-12">-->
<!--            <div class="col-lg-8" id="requestmaster">-->
<!--                <button type="submit" id="requestmaster_button" class="btn btn-primary btn-block" onclick="location.href='admin.php'">Suas-->
<!--                    Requisições</button>-->
<!--            </div>-->
<!--        </div>-->
        <br><br>
        <div class="col-lg-14">
            <table id="resquesting" class="display responsive nowrap" style="width:95%">
                <thead>
                    <tr>
                        <th style="text-align: left;" >#</th>
                        <th style="text-align: left;" >Descrição </th>
                        <th style="text-align: left;" >Remetente</th>
                        <th style="text-align: left;" >Departamento</th>
                        <th>Estado</th>
                        <th>Action</th>
                        <th>Prioridade:</th>
                        <th>Data de Emissão:</th>
                        <th>Data de Actualização:</th>
                    </tr>
                    <?php $result = $u->allrequest(); ?>
                </thead>
                <tbody>
                    <?php $con=1; foreach ($result as $row): ?>
                    <tr>
                        <td style="text-align: center;" scope="row" ><?php echo $con; ?></td>
                        <td style="text-align: left;"><?php echo $row["descricao_pedido"]; ?></td>
                        <td style="text-align: left;" ><?php echo $row["nome_utilizador"]; ?></td>
                        <td style="text-align: left;" ><?php echo $row["nome_departamento"]; ?></td>
                        <td><?php echo ($row["nome_estado"]==1 ? '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
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
                                    </svg>'))); ?></td>
                        <td><button class="btn btn-primary"><a href="home.php#statusModal" id_pedido="<?php echo $row["id_pedido"]; ?>"
                                nome_estado="<?php echo  $row["nome_estado"];?>"
                                prioridade="<?php echo $row["nome_prioridade"]; ?>" class="badge badge-info edit_btn "
                                data-toggle="modal" data-target="#statusModal" style="font-size: 14px;">Editar</a></button>
                        </td>
                        <td><?php echo ($row["nome_prioridade"] == 1 ? '<button class=" btn btn-success"  >Baixa</button>' : ($row["nome_prioridade"] == 2 ? '<button class="btn btn-primary" >Media</button>' : '<button class="btn btn-danger" >Alta</button>')); ?>
                        </td>
                        <td><?php echo $row["data_pedido"]; ?></td>
                        <td><?php echo $row["update_data"]; ?></td>
                    </tr>
                    <?php $con++; endforeach;?>
                </tbody>
                <tfoot>
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
                </tfoot>
            </table>
            <br><br>
            <p style="color: #b7b7a4" ><strong>powered by Agência Criativa - 2021</strong></p>
            <br>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>


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
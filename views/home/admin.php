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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="../../assets/css/admin/style.css">-->
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
        background-color: #C0D1C2;
    }
    /*aqui*/
    table thead tr th {
        text-align: center !important;
    }
    table tbody tr td {
        text-align: center !important;
    }
    div#RequestModal {
        height: 100% !important;
        overflow: hidden !important;

    }
    div.container div#outside {
        width: 10% !important;
        margin-top: -35px !important;
        margin-left: 90% !important;
        /*border: 1px solid red;*/
    }
    div#outside a {
        font-size: 18px !important;
        color: #a5a58d !important;
        text-decoration: none !important;
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
    div#requestmaster{
        width: 250px !important;
        margin-left: 28% !important;

    }
    div#requestmaster .btn{
        width: 250px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
        font-size: 12pt !important;
    }
    ul {
        list-style-type: none !important;
    }
    div#resquesting_filter label{
        text-align: left !important;
    }
    div.container button#allrequestmaster_button{
        width: 180px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
        margin-left: 80% !important;
        margin-top: 50px !important;
        /*border: 1px solid red;*/
    }
    @media screen and (max-width: 414px) {
        div#dashboard{
            padding: 5px;
        }

        div.container h2 {
            font-size: 8pt;
            font-weight: bold;
            text-align: center;
        }

        div.container p {
            font-size: 7pt;
            text-align: center;
        }

        div.col-lg-12 table {
            width: auto;
        }
        div#req_star div#requestmaster{
            width: 220px;
            margin-left: 80px;
            border-radius: 5px;
        }
        div#requestmaster button#requestmaster_button{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; ;
            width: 180px !important;
            font-size: 12pt;
            margin-left: -4% !important;
        }

       div.container button#allrequestmaster_button{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
            width: 180px !important;
            margin-left: 4%;
            font-size: 10pt !important;
            /*border: 2px solid white;*/
        }

       /*div.container div#outside{*/
       /*     margin-left: 70% !important;*/
       /*     width: 30% !important;*/
       /* }*/
       /* div#outside a#sair_do {*/
       /*     font-size: 12px !important;*/
       /* }*/

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
        button#allrequestmaster_button{
            width: 180px;
            margin-left: 70%;
            /*border: 1px solid red;*/
        }
        div#req_star div#requestmaster{
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/

            width: 220px;
            /*padding-left: -20%;*/
            border-radius: 10px;
            /*border: 1px solid red;*/
            margin-left: 0% !important;
        }
        div#requestmaster button#requestmaster_button{
            width: 220px  ;
            /*border-radius: 20px;*/
            /*box-shadow: black;*/
            /*padding-right: 80%;*/
        }
        div#outside {
            /*float: right;*/
            width: 10%;
            margin-top: -30px;
            /*border: 1px solid red;*/
        }
        div#outside a {
            /*margin-left: 60%;*/
            font-size: 14px;
        }

    }
    @media screen and (max-width: 990px){
        div#dashboard{
            padding: 5px !important;
        }
        div#req_star div#requestmaster{
            width: 250px !important;
            margin-left: 5% !important;
            border-radius: 10px !important;
        }
        div.container button#allrequestmaster_button{
            width: 180px !important;
            margin-left: 65% !important;
            font-size: 11pt !important;
        }
        button#requestmaster_button{
            width: 250px !important;
            font-size: 11pt !important;

        }
        div#RequestModal{
            overflow: scroll !important;
        }
        div.container div#outside {
            width: 15% !important;
            margin-left: 80% !important;
            margin-top: -30px !important;
        }
        div#outside a{
            margin-left: 0% !important;
        }

    }
    @media screen and (max-width: 360px){
        div#requestmaster{
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/

            width: 330px;
            /*padding-left: -20%;*/
            border-radius: 10px;
            /*border: 1px solid red;*/
        }
        div.container button#allrequestmaster_button{
            width: 180px !important;
            margin-left: 45% !important;
            font-size: 10pt !important;
        }
        div#req_star div#requestmaster button#requestmaster_button{
            width: 180px !important;
            font-size: 10pt !important;
            text-align: center !important;
            margin-left: -4% !important;
        }
        div.container div#outside{
            width: 25% !important;
            margin-left: 70% !important;
        }

        div.container div#outside a {
            margin-left: -1%;
            font-size: 14px;
        }
    }
</style>
    <!-- Start Modal submit Request-->
    <div class="modal fade bd-example-modal-sm" id="RequestModal" tabindex="-1" role="dialog"
        aria-labelledby="RequestModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RequestModalLabel">Submeter nova requisição</h5>
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
                </div>
                <form method="POST" action="../../controllers/home/olders.php">
                    <div class="modal-body">
                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="exampleFormControlTextarea1" style="color: #444; font-weight: bold ">Escreva seu pedido</label>
                            <textarea class="form-control" id="nome_pedido" name="nome_pedido" rows="2"></textarea>
                        </div>

                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="exampleFormControlInput1" style="color: #444; font-weight: bold">Remetente</label>

                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="<?php echo $_SESSION['nome_usuario']; ?> "
                                style="text-transform: uppercase; font-weight: bold;" disabled>

                        </div>
                        <div class="form-group" style="color: #444; font-weight: bold; display: none;">
                            <label for="exampleFormControlInput1" style="color: black;">Remetente</label>

                            <select class="form-control" name="id_utilizador" id="id_utilizador">
                                <option class="optionnivel" value="<?php echo $_SESSION['id_usuario']; ?>">
                            </select>

                        </div>
                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="exampleFormControlSelect1" style="color: #444; font-weight: bold ">Qual é o seu
                                departamento?</label>
                            <!--                    <select class="form-control" id="exampleFormControlSelect1">-->
                            <?php $result = $u->departamento(); ?>
                            <select class="form-control" name="id_departamento" id="id_departamento">
                                <?php foreach ($result as $row): ?>
                                <option class="optionnivel" value="<?php echo $row["id_departamento"];?>">
                                    <?php echo $row["nome_departamento"]; ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="padding-bottom: 10px;" >
                            <label for="exampleFormControlSelect1" style="color: #444; font-weight: bold ">Estado do pedido</label>
                            <select class="form-control" id="id_estado" name="id_estado"
                                aria-label="Disabled select example" disabled>
                                <option value="1" selected>Pedendete</option>
                                <option value="2">Em revisão</option>
                                <option value="3">Aprovado</option>
                                <option value="4">Feito</option>
                            </select>
                        </div>
                        <div class="form-group" style="padding-bottom: 10px" >
                            <label for="exampleFormControlSelect1" style="color: #444; font-weight: bold ">Qual é a prioridade do seu
                                pedido?</label>
                            <select class="form-control" id="id_prioridade" name="id_prioridade"
                                aria-label="Disabled select example">
                                <option value="1" selected>Baixa</option>
                                <option value="2">Media</option>
                                <option value="3">Alta</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-error hide" style="display: none; color: red" >Erro de registo, verifique se todos campos estão devidamente
                        preenchidos!</div>
                    <div class="alert alert-success hide" style="display: none; color: green " >Sua requisição foi submetida com sucesso</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="submeter_form"
                            name="submeter_form">Submeter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal submit Request-->
    <div class="container" style="background-color: whitesmoke;height: auto;">
        <button type="submit" id="allrequestmaster_button" class="btn btn-primary btn-block" onclick="location.href='home.php'">Todas requisições</button>
<!--        <div class="col-md-5" id="outside">-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <strong>-->
<!--                        <a href="../../logout.php" id="sair_do" >-->
<!--                            <span style="color: #a5a58d;" id="spann_id">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"-->
<!--                                     class="bi bi-box-arrow-right" viewBox="0 0 16 16">-->
<!--                                    <path fill-rule="evenodd"-->
<!--                                          d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />-->
<!--                                    <path fill-rule="evenodd"-->
<!--                                          d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />-->
<!---->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            Sair</a>-->
<!--                    </strong>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        <h2 class="center-text col-lg-pull-0" style="margin-top: 5%; text-align:center;">Sistema de Gestão de Requisições - Usuário</h2>
        <br>
        <p style="text-transform: lowercase; font-weight: normal;">Olá <?php echo $_SESSION['nome_usuario']; ?>, Nesta
            Janela tem suas requisições!</p>
        <!--Informando o nome do usuário logo que acessa o sistema-->
<!--        <div class="col-md-5" id="outside">-->
<!--            <a href="home.php" id="voltar_do" style="font-size: 12pt;">Voltar</a>-->
<!--        </div>-->
        <!--    --><?php //echo $_SESSION['id_usuario']; ?>
        <br>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6" id="dashboard">
                            <!-- small box -->
                            <div class="small-box bg-info"
                                style=" border-radius: 10px; background:linear-gradient(#d62839 70%, whitesmoke 50%);">
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
                        <div class="col-lg-3 col-6" id="dashboard" >
                            <!-- small box -->
                            <div class="small-box bg-success"
                                style=" border-radius: 10px;background: linear-gradient(#ffd100 70%,whitesmoke 50%);">
                                <div class="inner" style="border-radius: 5px;">
                                    <?php $id_utilizador=$_SESSION['id_usuario'];  $result= $u->reviw_older_user($id_utilizador); ?>
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
                        <div class="col-lg-3 col-6" id="dashboard" >
                            <!-- small box -->
                            <div class="small-box bg-warning"
                                style="border-radius: 10px; background:linear-gradient(#38b000 70%,whitesmoke 50%);">
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
                        <div class="col-lg-3 col-6" id="dashboard" >
                            <!-- small box -->
                            <div class="small-box bg-danger"
                                style="border-radius: 5px; background:linear-gradient(#386fa4 70%,whitesmoke 50%)">
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
        <div class="col-lg-12" id="req_star">
            <div class="col-lg-8" id="requestmaster">
                <button type="submit" name="btn" id="requestmaster_button" class="btn btn-primary btn-lg btn-block"
                    onclick="location.href='admin.php#RequestModal'" style="border-radius: 8px;" data-toggle="modal"
                    data-target="#RequestModal">Criar nova requisição</button>
            </div>
        </div>
        <br><br>
        <h4 style="color: #606060; text-transform: uppercase; font-size: 12pt;"><strong>Veja a baixo as suas requisições</strong></h4>
        <div class="col-lg-14">
            <table id="resquesting" class="display responsive nowrap" style="width:98%">
                <thead>
                    <tr>
                        <th style="text-align: left;">#</th>
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
                        <th style="text-align: center;" scope="row"><?php echo $con; ?></th>
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
                <tfoot>
<!--                <tr>-->
<!--                    <th>#</th>-->
<!--                    <th style="text-align: left;" >Descrição </th>-->
<!--                    <th style="text-align: left;" >Remetente</th>-->
<!--                    <th style="text-align: left;" >Departamento</th>-->
<!--                    <th>Estado</th>-->
<!--                    <th>Prioridade</th>-->
<!--                    <th>Data de Emissão</th>-->
<!--                    <th>Data de Actualização</th>-->
<!--                </tr>-->
<!--                </tfoot>-->
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
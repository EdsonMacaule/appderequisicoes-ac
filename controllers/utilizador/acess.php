<?php
require_once "../../models/main.php";
$u = new Usuario;

if(isset($_POST['email_utilizador'])){
    $email_utilizador = $_POST['email_utilizador'];
    $senha_utilizador = $_POST['senha_utilizador'];
    if (!empty($email_utilizador) && !empty($senha_utilizador)){
        $u->conectar();
        if ($u->msgErro==""){
            if($u->login($email_utilizador,$senha_utilizador)){
//                header("location:../users.php");
            }else{
                echo '<head>';
                echo '<script src="../../assets/plugins/jquery/jquery.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>';
                echo '</head>';
                echo '
            <script type="text/javascript">
            
            $(document).ready(function(){
            
              swal({
                position: "top-end",
                type: "warning",
                icon: \'warning\',
                title: "Acesso ao Sistema",
                text: "Email e/ou Senha invalidos!",
                
                showConfirmButton: false,
                timer: 15000
                
              })
              .then(function() {
                  //Redirecionando o usuario
                window.location.href = "../../index.php";
              })
              
            });
            //window.location.href = "../../views/home/home.php";
            </script>
            ';
                /*?>
<div class="msg-erro">
    Email e/ou Senha invalidos!
</div>
<?php*/
            }
        }else{
            echo '<head>';
            echo '<script src="../../assets/plugins/jquery/jquery.min.js"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>';
            echo '</head>';
            echo '
            <script type="text/javascript">
            
            $(document).ready(function(){
            
              swal({
                position: "top-end",
                type: "error",
                icon:\'error\',
                title: "Acesso ao Sistema",
                text:"Usuário não Registado!",
                
                showConfirmButton: false,
                timer: 15000
                
              }).then(function() {
                  //Redirecionando o usuario
                window.location.href = "../../index.php";
              })
              
            });
            //window.location.href = "../../views/home/home.php";
            </script>
            ';
        }
    }else{
        echo '<head>';
        echo '<script src="../../assets/plugins/jquery/jquery.min.js"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>';
        echo '</head>';
        echo '
            <script type="text/javascript">
            
            $(document).ready(function(){
            
              swal({
                position: "top-end",
                type: "warning",
                icon:\'warning\',
                title: "Acesso ao Sistema",
                text:"Preencha todos so Campos!",
                
                showConfirmButton: false,
                timer: 15000
                
              }).then(function() {
                  //Redirecionando o usuario
                window.location.href = "../../index.php";
              })
              
            });
            //window.location.href = "../../views/home/home.php";
            </script>
            ';
        /*?>
<div class="msg-erro">
    Preencha todos so Campos
</div>
<?php*/
    }
}
?>
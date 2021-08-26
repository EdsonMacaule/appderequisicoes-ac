<?php
session_start();
Class Usuario {

    //public $pdo;
    public $msgErro="";

//$u->conectar("lifelife_dbgame","51.38.121.199","lifelife_balango","Balango@dev1");
//    public $pdo;
// Fazendo a conexao com a base de dados usando PDO;
    public function conectar($banco="lifelife_sgpi", $hostname="51.38.121.199", $usuario="lifelife_balango", $senha="Balango@dev1" ){
    global $pdo;
       
try{
    $pdo = new PDO("mysql:dbname=".$banco.";host=".$hostname,$usuario,$senha);
  
    $pdo->query("SET NAMES 'utf8'");
    $pdo->query('SET character_set_connection=utf8');
    $pdo->query('SET character_set_client=utf8');
    $pdo->query('SET character_set_results=utf8');
}catch (PDOException $e){
    $msgErro = $e ->getMessage();
}

    }
    //Fim da Conexao com a base de dados
        //fazendo o login do usuário
    public function login($email_utilizador, $senha_utilizador){
        $this->conectar();
        global $pdo;
        //verificar se o email e senha estao cadastrados
        $sql = $pdo->prepare("SELECT id_utilizador,email_utilizador,nome_utilizador,perfil_utilizador FROM tb_utilizadores WHERE email_utilizador = :e AND senha_utilizador = :s");
        $sql->bindValue(":e",$email_utilizador);
        $sql->bindValue(":s",md5($senha_utilizador));
        $sql->execute();
        if($sql->rowCount() > 0){
            $dados = $sql->fetch();
            session_start();
            //pegando os dados do usuário ao iniciar a sessão
            $_SESSION['id_usuario'] = $dados['id_utilizador'];
            $_SESSION['email_usuario'] = $dados['email_utilizador'];
            $_SESSION['nome_usuario'] = $dados['nome_utilizador'];
            $_SESSION['perfil_usuario'] = $dados['perfil_utilizador'];

            //Validando a tela de acordo com o perfil de usuário
            if($_SESSION['perfil_usuario'] == "user"){
                header("Location: ../../views/utilizadores/users.php");
            }elseif($_SESSION['perfil_usuario'] == "admin"){
                header("Location: ../../views/home/home.php");
            }else{
                header("Location: ../login.php");
            }
            //Fim da validação
            return true; //login feito com sucesso
        }else{
return false; //nao foi possivel fazer o login
        }

    }
    //fim do login
    // fazendo cadastro do usuário
    public function adicionar_usuario($nome_utilizador,$email_utilizador,$id_cargo,$perfil_utilizador,$senha_utilizador){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("SELECT id_utilizador,email_utilizador  FROM tb_utilizadores WHERE email_utilizador = :e");
        $sql->bindValue(":e",$email_utilizador);
        $sql->execute();
        if ($sql -> rowcount() >0 ){
            return false; // Usuário já cadastrado
        }else{
            //caso não, registar
            $sql = $pdo->prepare("INSERT INTO `tb_utilizadores` (`nome_utilizador`, `email_utilizador`, `id_cargo`, `perfil_utilizador`, `senha_utilizador`) VALUES (:n, :e, :car, :p, :s);");
            $sql->bindValue(":n",$nome_utilizador);
            $sql->bindValue(":e",$email_utilizador);
            $sql->bindValue(":car",$id_cargo,PDO::PARAM_INT);
            $sql->bindValue(":p",$perfil_utilizador);
            $sql->bindValue(":s",md5($senha_utilizador));
            $sql->execute();
            return true;
        }

    }
//selecionar cargos
    public function cargo(){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM tb_cargo");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    //selecionar nome
    public function email_usuario(){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("SELECT email_utilizador FROM tb_utilizadores");
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    //selecionar departamento
    public function departamento(){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM tb_departamento");
        $sql->execute();
        $result = $sql->fetchall();
        return $result;
    }
    //adicionando a requisicao
    public function request($descicao_pedido,$id_utilizador,$id_departamento,$id_estado ,$id_prioridade){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO `tb_pedido` (`descricao_pedido`, `id_utilizador`, `id_departamento`, `id_estado`,`id_prioridade`) VALUES (:descr , :u, :dp,:et, :pr);");
        $sql->bindValue(":descr",$descicao_pedido);
        $sql->bindValue(":u",$id_utilizador,PDO::PARAM_INT);
        $sql->bindValue(":dp", $id_departamento,PDO::PARAM_INT);
        $sql->bindValue(":et", $id_estado,PDO::PARAM_INT);
        $sql->bindValue(":pr", $id_prioridade,PDO::PARAM_INT);
        $sql->execute();
        return true;
    }
    // Requisicoes do usuario
    public function userquest($id_utilizador){
        $this->conectar();
        global $pdo;
//        $id_utilizador=$_SESSION['id_usuario'];
        $sql = $pdo->prepare("SELECT pd.descricao_pedido, u.nome_utilizador, d.nome_departamento, e.nome_estado, pr.nome_prioridade,pd.data_pedido,pd.update_data  FROM tb_pedido pd INNER JOIN tb_utilizadores u ON pd.id_utilizador=u.id_utilizador INNER JOIN tb_departamento d ON pd.id_departamento=d.id_departamento INNER JOIN tb_estado e ON pd.id_estado=e.id_estado INNER JOIN tb_prioridade pr ON pd.id_prioridade=pr.id_prioridade WHERE u.id_utilizador=:id ORDER BY pd.data_pedido DESC");
        $sql->bindValue(":id",$id_utilizador,PDO::PARAM_INT);
        $sql->execute();
        $result=$sql->fetchAll();
//        var_dump($result); exit();
        return $result;
    }
    //Mostrar o total dos pedidos pedentes do usuario
    public  function pedidos_pedentes_usuario($id_utilizador){
        $this->conectar();
        global $pdo;
        $sql = $pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Pedentes FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=1 AND p.id_utilizador=:u");
        $sql->bindValue(":u",$id_utilizador,PDO::PARAM_INT);
        $sql->execute();
        $dados=$sql->fetch();
        return $dados;
    }
    //Contar o total dos pedidos do usuario em revisao
    public function reviw_older_user($id_utilizador){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_EM_Revisao FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=2 AND p.id_utilizador=:u");
        $sql->bindValue(":u",$id_utilizador,PDO::PARAM_INT);
        $sql->execute();
        $dados=$sql->fetch();
        return $dados;
    }
    //Contar o total dos pedidos do usuario aprovados
    public function older_user_aprov($id_utilizador){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Aprovados FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=3 AND p.id_utilizador=:u");
        $sql->bindValue(":u",$id_utilizador,PDO::PARAM_INT);
        $sql->execute();
        $dados=$sql->fetch();
        return $dados;
    }
    //Contar o total dos pedidos do usuario feitos
    public function older_user_done($id_utilizador){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Feitos FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=4 AND p.id_utilizador=:u");
        $sql->bindValue(":u",$id_utilizador,PDO::PARAM_INT);
        $sql->execute();
        $dados=$sql->fetch();
        return $dados;
    }
    //Pegando todas requisicoes
    public function allrequest(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT pd.id_pedido, pd.descricao_pedido, u.nome_utilizador, d.nome_departamento, e.nome_estado, pr.nome_prioridade,pd.data_pedido,pd.update_data  FROM tb_pedido pd INNER JOIN tb_utilizadores u ON pd.id_utilizador=u.id_utilizador INNER JOIN tb_departamento d ON pd.id_departamento=d.id_departamento INNER JOIN tb_estado e ON pd.id_estado=e.id_estado INNER JOIN tb_prioridade pr ON pd.id_prioridade=pr.id_prioridade ORDER BY pd.data_pedido DESC");
        $sql->execute();
        $dados=$sql->FetchAll();
        return $dados;
    }
    //Pegando todas requisicoes pedentes (Total)
    public function allrequest_pedind(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Pedentes FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=1");
        $sql->execute();
        $dados=$sql->Fetch();
        return $dados;
    }
    //Pegando todas requisicoes pedentes (Total)
    public function allrequest_review(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_EM_Revisao FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=2");
        $sql->execute();
        $dados=$sql->Fetch();
        return $dados;
    }
    //Pegando todas requisicoes pedentes (Total)
    public function allrequest_aprov(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Aprovados FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=3");
        $sql->execute();
        $dados=$sql->Fetch();
        return $dados;
    }
    //Pegando todas requisicoes pedentes (Total)
    public function allrequest_done(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT COUNT(p.descricao_pedido) AS Pedidos_Feitos FROM tb_pedido p INNER JOIN tb_estado e ON p.id_estado=e.id_estado INNER JOIN tb_utilizadores u ON p.id_utilizador=u.id_utilizador WHERE p.id_estado=4");
        $sql->execute();
        $dados=$sql->Fetch();
        return $dados;
    }

    //actualizar estado da requisicao
    public  function request_update($id_estado,$id_prioridade ,$id_pedido){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("UPDATE tb_pedido SET id_estado = :et, id_prioridade = :pri, update_data = CURRENT_TIMESTAMP WHERE tb_pedido.id_pedido = :pd;");
        $sql->bindValue(":et",$id_estado,PDO::PARAM_INT);
        $sql->bindValue(":pri",$id_prioridade,PDO::PARAM_INT);
        $sql->bindValue(":pd",$id_pedido,PDO::PARAM_INT);
        $sql->execute();

//        echo "Chegamos aqui no main  ";
        return true;
    }
    //pegando o estado da requisicao
    public function status_request(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT * FROM tb_estado");
        $sql->execute();
        $dados=$sql->FetchAll();
        return $dados;
    }

    //pegando a prioridade
    public function prioridade(){
        $this->conectar();
        global $pdo;
        $sql=$pdo->prepare("SELECT * FROM tb_prioridade");
        $sql->execute();
        $resultado=$sql->FetchAll();
        return $resultado;
    }

//    public function studety(){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("SELECT al.*, na.nome_nivel FROM tb_alunos al INNER JOIN tb_nivel_acad na ON na.id_nivel_acad=al.id_nivel_acad ORDER BY al.nome_aluno ASC");
//        $sql->execute();
//        $result =$sql->fetchAll();
//        return $result;
//    }
//    public function challenge_status($id){
//        $this->conectar();
//        global $pdo;
//        $id=$_GET["id"];
//        $sql = $pdo->prepare("SELECT po.pontuacao,al.nome_aluno,al.apelido_aluno,nj.numero_nivel_jogo,ch.nome_challenge,po.data FROM `tb_pontuacao` po INNER JOIN `tb_alunos` al ON po.id_aluno=al.id_aluno INNER JOIN `tb_nivel_jogo` nj ON po.id_nivel_jogo=nj.id_nivel_jogo INNER JOIN `tb_challenges` ch ON po.id_challenge=ch.id_challenge WHERE ch.id_challenge=$id  ORDER BY nj.numero_nivel_jogo DESC,po.pontuacao DESC, po.data DESC");
////        $sql->bindValue(":id", $id,PDO::PARAM_INT);
//        $sql->execute();
//        $result = $sql->fetchAll();
//        return $result;
//    }
//    public function search($id_nivel_acad){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("SELECT nj.numero_nivel_jogo, ch.nome_challenge FROM `tb_nivel_acad_challenge` nac INNER JOIN `tb_challenges` ch ON nac.id_challenge=ch.id_challenge INNER JOIN `tb_nivel_jogo`nj ON nj.id_nivel_acad_challenge=nac.id_nivel_acad_challenge WHERE nac.id_nivel_acad_challenge=:id");
//        $sql->bindValue(":id",$id_nivel_acad);
//        $sql->execute();
//        $result = $sql->fetchAll();
//        return $result;
//    }
//
//    public function nivelacad(){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("SELECT * FROM `tb_nivel_acad`");
//        $sql->execute();
//        $result = $sql->fetchAll();
//        return $result;
//    }
//
//    public  function challenges(){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("SELECT * FROM tb_challenges");
//        $sql->execute();
//        $result = $sql->fetchAll();
//        return $result;
//    }
//
//    public function niveis($id_nivel_acad){
//       $this->conectar();
//       global $pdo;
////       $id_nivel_jogo=$_GET['id_nivel_jogo'];
//       $sql = $pdo->prepare("SELECT nj.numero_nivel_jogo,ch.id_challenge,nj.id_nivel_jogo ,ch.nome_challenge FROM `tb_nivel_jogo` nj INNER JOIN `tb_nivel_acad_challenge`nac ON nj.id_nivel_acad_challenge=nac.id_nivel_acad_challenge INNER JOIN `tb_challenges` ch ON nac.id_challenge=ch.id_challenge INNER JOIN `tb_nivel_acad` na ON nac.id_nivel_acad=na.id_nivel_acad WHERE na.id_nivel_acad=:id");
//       $sql->bindValue(":id",$id_nivel_acad);
//       $sql->execute();
//       $result = $sql->fetchAll();
//       return $result;
//
//    }
//    public  function addchallenge($id_nivel_acad, $id_challenge){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("INSERT INTO tb_nivel_acad_challenge (`id_nivel_acad_challenge`, `id_nivel_acad`, `id_challenge`) VALUES (NULL, :id, :chall);");
//        $sql->bindValue(":id",$id_nivel_acad,PDO::PARAM_INT);
//        $sql->bindValue(":chall",$id_challenge,PDO::PARAM_INT);
//        $add=$sql->execute();
//        $id=$pdo->lastInsertId();
//        $num=1;
//        if ($add==1){
//            $sql1 = $pdo->prepare("INSERT INTO tb_nivel_jogo (`id_nivel_jogo`, `id_nivel_acad_challenge`, `numero_nivel_jogo`) VALUES (NULL, :id, :num);");
//            $sql1->bindValue(":id",$id,PDO::PARAM_INT);
//            $sql1->bindValue(":num",$num);
//            $sql1->execute();
//        }
//        return true;
//    }
//
//    public function  actualizarchall($id_challenge,$estado){
//        $this->conectar();
//        global $pdo;
//        $sql =$pdo->prepare("UPDATE tb_challenges SET estado=:estd WHERE id_challenge=:chall");
//        $sql->bindValue(":chall",$id_challenge,PDO::PARAM_INT);
//        $sql->bindValue(":estd",$estado,PDO::PARAM_INT);
//        $sql->execute();
//        return true;
//    }
////    public function seacrhstudety($studety){
////        $this->conectar();
////        global $pdo;
////        $sql=$pdo->prepare("SELECT * FROM tb_alunos al WHERE al.nome_aluno  LIKE '%:nome%' OR al.apelido_aluno LIKE '%:nome%'");
////        $sql->bindValue(":nome",$studety,PDO::PARAM_STR);
////        $sql->execute();
////        $result=$sql->fetchAll();
////        return $result;
////    }
//    //SELECT * FROM tb_alunos al WHERE al.nome_aluno  LIKE '%ed%' OR al.apelido_aluno LIKE '%ed%'
//
//    public  function upchallenge($nome_challenge,$id_challenge){
//        $this->conectar();
//        global $pdo;
//        $sql = $pdo->prepare("UPDATE tb_challenges SET nome_challenge=:nome WHERE id_challenge=:chall");
//        $sql ->bindValue(":nome",$nome_challenge,PDO::PARAM_STR);
//        $sql ->bindValue(":chall",$id_challenge,PDO::PARAM_INT);
//        $sql->execute();
//        return true;
//    }
//
//    public function getAllPosts($id=null, $njogo=null, $id_challenge=null){
//
//        $this->conectar();
//        global $pdo;
//
//        $sql =$pdo->prepare("SELECT na.id_nivel_acad, na.nome_nivel, nj.numero_nivel_jogo,nj.id_nivel_jogo, pe.id_pergunta, pe.pergunta, re.resposta, re.verdadeira_resposta FROM tb_responta re INNER JOIN tb_pergunta pe ON pe.id_pergunta = re.id_pergunta INNER JOIN tb_nivel_jogo nj ON nj.id_nivel_jogo = pe.id_nivel_jogo INNER JOIN tb_nivel_acad_challenge nac ON nac.id_nivel_acad_challenge = nj.id_nivel_acad_challenge INNER JOIN tb_nivel_acad na ON na.id_nivel_acad = nac.id_nivel_acad WHERE nac.id_nivel_acad = :nivel AND nj.numero_nivel_jogo = :njogo AND nac.id_challenge = :chall");
//        $sql->bindValue(":nivel",$id);
//        $sql->bindValue(":njogo",$njogo);
//        $sql->bindValue(":chall",$id_challenge);
//        $sql->execute();
//        $result= $sql->fetchAll(PDO::FETCH_ASSOC);
//        $numresults= count($result);
//
// //        echo "<pre>";
// //        print_r($result);
// //        echo "</pre>";
// //        exit;
//
//
////    $executar_query = mysqli_query($obj->con, $query);
////    $numresults = mysqli_num_rows($executar_query);
////    $id_nivel_acad, $numero_nivel_jogo
////    fetch(PDO::FETCH_ASSOC)
//
//         $first = true;
//         $counter = 0; //Contador para saber quando for o último registro.
//         $niveis_jogo = array(); //Armazena todas as perguntas e respostas de um determinado nível.
//         $uma_pergunta=null;
//         foreach ($result as $item){
//             $correct = $item['verdadeira_resposta'] == 1 ? 1 : 0; //1 - Verdadeira; 0 - Falsa.
//
//             if ($first){ //Entra somente no primeiro ciclo.
//                 $id_pergunta = $item['id_pergunta']; //Armazena o id da primeira pergunta na variável
//                 $respostas = array(); //Aramazena todas as respostas de um determinada pergunta.
//                 $cont_resposta = 0; //Numera as respostas. Ex: 1, 2, 3..
//                 $cont_pergunta = 0; //Numera as perguntas. Ex: 1, 2, 3..
//                 $first = false;
//             }
//
//             if ($id_pergunta == $item['id_pergunta']){ //Compara id_pergunta com o valor id_pergunta do ciclo.
//                 $cont_resposta = $cont_resposta + 1;
//                 $respostas[] = array('id' => $cont_resposta, 'res' => $item['resposta'], 'correct' => $correct); //Insere a resposta no array
//                 $uma_pergunta = $item['pergunta'];
//             }else{
//                 $id_pergunta = $item['id_pergunta']; //Atribui novo valor ao id_pergunta
//                 $cont_pergunta = $cont_pergunta + 1;
//                 $pergunta = array('id' => $cont_pergunta, 'pergunta' => $uma_pergunta, 'resposta' => $respostas); //Cria o array da pergunta
//                 $niveis_jogo[$cont_pergunta] = $pergunta; //Insere a pergunta no array nível do jogo
//                 $respostas = array(); //Reset array de respostas, porque passa aqui para outra pergunta
//                 $cont_resposta = 1;
//                 $respostas[] = array('id' => $cont_resposta, 'res' => $item['resposta'], 'correct' => $correct); //Insere a resposta no array na primeira vez depois da troca do id_pergunta
//             }
//
//             if (++$counter == $numresults) { //Incrementa o contrador e compara com o número de linhas retornadas pela query.
//                 //Entra no último registro.
//                 $cont_pergunta = $cont_pergunta + 1;
//                 $pergunta = array('id' => $cont_pergunta, 'pergunta' => $uma_pergunta, 'resposta' => $respostas); //Cria o array da pergunta
//                 $niveis_jogo[$cont_pergunta] = $pergunta; //Insere a pergunta no array nível do jogo
//             }
//         }
////        echo "<pre>";
////        print_r($niveis_jogo);
////        echo "</pre>";
//
//        if(!isset($result[0]['id_nivel_jogo'])){
////            echo "Estamos Aqui9";
//            $sql=$pdo->prepare("SELECT id_nivel_jogo FROM tb_nivel_jogo nj INNER JOIN tb_nivel_acad_challenge nac ON nj.id_nivel_acad_challenge=nac.id_nivel_acad_challenge INNER JOIN tb_nivel_acad na ON nac.id_nivel_acad=na.id_nivel_acad INNER JOIN tb_challenges ch ON nac.id_challenge=ch.id_challenge WHERE nac.id_nivel_acad = :nivel AND nac.id_challenge=:chall");
//            $sql->bindValue(":nivel", $id);
//            $sql->bindValue(":chall", $id_challenge);
//            $sql->execute();
//            $resultado= $sql->fetch();
//            $result[0]=$resultado;
////            echo $result[0]['id_nivel_jogo'];
////            echo "Estamos Aqui98";
//        }
//
// return array('id_nivel_jogo'=>$result[0]['id_nivel_jogo'], "niveis_jogo"=>$niveis_jogo);
//
//         }

 }

?>
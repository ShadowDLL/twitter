<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
        
        $u = new usuarios();
        if (!$u->isLogged()) {
            header("Location: /login");
        }
    }

    public function index() {
        $dados = array(
            'nome' => ''
        );
        $u = new usuarios($_SESSION['twlg']);
        $p = new posts();
        
        if (!$u->statusAtivo()) {
           $md5 = md5($_SESSION['twlg']);
        $link = "http://www.twitter.orlnet.xyz/cadastroconfirma/confirmar.php?h=".$md5;
        $assunto = "Confirme seu cadastro";
        $email = $u->getEmail();
        $msg = "Clique no link abaixo para confirmar seu cadastro:\n\n".$link;
        $headers = "From: suporte@orlnet.xyz"."\r\n"."X-Mailer: PHP/".phpversion();
        mail($email, $assunto, $msg, $headers);
        
        echo "<h2>Confirme seu cadastro agora!</h2>";
        exit; 
        }
        
        if (isset($_POST['msg']) && !empty($_POST['msg'])) {
            $msg = addslashes($_POST['msg']);
            $_POST['msg'] = "";      
            $p->inserirPost($msg);
            
        }
        
        $dados['nome'] = $u->getNome();
        $dados['id_seguidor'] = $u->getSeguidor();
        $dados['id_seguido'] = $u->getSeguido();
        $dados['sugestao'] = $u->getUsuarios();      
        
        $lista = $u->getSeguidos();
        $lista[] = $_SESSION['twlg'];
        $dados['feed'] = $p->getFeed($lista);
        
        $this->loadTemplate('home', $dados);      
    }
    
    public function seguir($id){
        if (!empty($id)) {
            $id = addslashes($id);
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $r = new relacionamentos();
                $r->seguir($_SESSION['twlg'], $id);
            }
        }
        header("Location: /");
    }
    
    public function naoSeguir($id){
        if (!empty($id)) {
            $id = addslashes($id);
            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $r = new relacionamentos();
                $r->naoSeguir($_SESSION['twlg'], $id);
            }
        }
        header("Location: /");
    }

}
<?php
class loginController extends controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $dados = array();    
        
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            $u = new usuarios();
            if ($u->login($email, $senha)) {
                header("Location: /");
            }
        }
        $this->loadView('login', $dados);
    }
    
    public function cadastro(){
        $dados = array('aviso' => ''); 
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $dados['teste'] = 'entrou';
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $u = new usuarios();
                if ($u->checkEmail($email)) {
                    $dados['aviso'] = 'Email já cadastrado';
                }
                else{
                   $_SESSION['twlg'] = $u->cadastrar($nome, $email, $senha); 
                   header("Location: /");
                }    
            } 
            else{
                $dados['aviso'] = 'Preencha todos os campos';
            }
        }       
        $this->loadView('cadastro', $dados);
    }
    
    public function logout(){
        unset($_SESSION['twlg']);
        header("Location: /"); 
    }       
}



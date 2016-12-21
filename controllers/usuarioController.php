<?php

class usuarioController extends controller {
    public function index(){
       $dados = array('nome' => ''); 
       $this->loadTemplate('usuario', $dados); 
    }
    public function posts(){
        $dados = array('nome' => '');
        $u = new usuarios($_SESSION['twlg']);
        $dados['nome'] = $u->getNome();
        $id = addslashes($_GET['id_usuario']);
        $p = new posts();
        $dados['feed'] = $p->getFeedUsuario($id);      
        $this->loadTemplate('usuario', $dados); 
    }
    
}

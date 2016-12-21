<?php
class usuarios extends model{
    private $uid;
    
    public function __construct($id = '') {
        parent::__construct();
        $this->uid = $id;
    }
    
    public function isLogged(){
        if (isset($_SESSION['twlg']) && !empty($_SESSION['twlg'])) {
            return true;
        }
        else{
            return false;
        }
    }
    
    public function checkEmail($email){
        $sql = "SELECT email FROM usuarios WHERE email = '$email'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return true;
        }
        else{
            return false;
        }
    }
    public function cadastrar($nome, $email, $senha){
        $sql = "INSERT INTO usuarios SET nome = '$nome', email = '$email', senha = '$senha'";
        $this->db->query($sql); 
        return $this->db->lastInsertId();
    }
    
    public function getEmail(){
        $sql = "SELECT email FROM usuarios WHERE id = $this->uid";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
        }
        return $sql['email'];
    }
    
    public function statusAtivo(){
        $sql = "SELECT id FROM usuarios WHERE id = '$this->uid' AND status = '0'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return false;
        }
        else{
            return true;
        }
    }
    
    public function ativarUsuario(){
        $sql = "UPDATE usuarios SET status = '1' WHERE MD5(id) = '$this->uid'";
        $this->db->query($sql);
    }
    
    public function login($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['twlg'] = $sql['id'];
            return true;
        }
        else{
            return false;
        }
    }
    
    public function getNome(){
        if (!empty($this->uid)) {
            $sql = "SELECT nome FROM usuarios WHERE id = '$this->uid'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
            }
        }
        return $sql['nome'];
    }
    
    public function getSeguidor(){
        $sql = "SELECT id_seguido FROM relacionamentos WHERE id_seguidor = '$this->uid'";
        $sql = $this->db->query($sql);
        return $sql->rowCount();
    } 
    
    public function getSeguido(){
        $sql = "SELECT id_seguidor FROM relacionamentos WHERE id_seguido = '$this->uid'";
        $sql = $this->db->query($sql);
        return $sql->rowCount();
    }  
    
    public function getUsuarios(){
        $array = array();
        $sql = "SELECT *,(SELECT count(id) FROM relacionamentos AS r WHERE r.id_seguidor = '$this->uid' AND r.id_seguido = u.id) AS seguido FROM usuarios AS u WHERE id != '$this->uid' limit 5";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getSeguidos(){
        $array = array();
        $sql = "SELECT id_seguido FROM relacionamentos WHERE id_seguidor = '$this->uid'";
        $sql = $this->db->query($sql);
        if($sql->rowCount() > 0){
            $sql = $sql->fetchAll();
            foreach($sql as $seg){
                $array[] = $seg['id_seguido'];
            }
        }
        return $array;
        
    }
    
    
}


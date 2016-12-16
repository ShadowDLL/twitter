<?php
class usuarios extends model{
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
    
    
    
}


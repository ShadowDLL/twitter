<?php
class posts extends model{
    public function inserirPost($msg){
        $id_usuario = $_SESSION['twlg'];
        $sql = "INSERT INTO posts SET id_usuario = '$id_usuario', data_post = NOW(), mensagem = '$msg'";
        $this->db->query($sql);
    }
    
    public function getFeed($lista){
        $array = array();
        if (count($lista) > 0) {
            $sql = "SELECT *, (SELECT nome FROM usuarios WHERE usuarios.id = posts.id_usuario) AS nome FROM posts WHERE id_usuario IN (".implode(',', $lista).") ORDER BY data_post DESC LIMIT 10";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
        }
        return $array;
    }
    
    public function getFeedUsuario($id){
        $array = array();
        if (isset($id) && !empty($id)) {
            $sql = "SELECT *, (SELECT nome FROM usuarios WHERE usuarios.id = posts.id_usuario) AS nome FROM posts WHERE id_usuario = '$id' ORDER BY data_post DESC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
        }
        return $array;
    }
}


<?php
require_once __DIR__ . "/../config/conexao.php";

class Usuario{

    private $conexao;

    public function __construct()
    {
        $db = new Conexao();
        $this -> conexao = $db -> conectar();
        
    }

    public function buscarPorEmail($email){

        $sql = "SELECT*FROM usuario WHERE email = :email";
        $stmt = $this -> conexao -> prepare($sql);

        $stmt -> bindParam(":email",$email);
        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }


    public function salvarToken($idUsuario, $token){
        $sql = "UPDATE usuario
        set token = :token
        WHERE id_usuario = :id";

        $stmt = $this->conexao-> prepare($sql);
        $stmt -> bindParam(":token",$token);
        $stmt -> bindParam(":id",$idUsuario);

        return $stmt -> execute();
    }

    public function buscarPorToken($token){
        $sql = "SELECT*FROM usuario
        WHERE token = :token";

        $stmt = $this->conexao-> prepare($sql);
        $stmt -> bindParam(":token",$token);
        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
        
    }

    public function autenticar(string $email, string $senha): ?array
    {
        $usuario = $this->buscarPorEmail($email);
        return ($usuario && password_verify($senha, $usuario['senha'])) ? $usuario : null;
    }

    public function gerarToken(int $idUsuario): string
    {
        $token = bin2hex(random_bytes(32));
        $this->salvarToken($idUsuario, $token);
        return $token;
    }
}

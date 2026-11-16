<?php
    abstract class Conexao
    {
        public function __construct(protected $db = null)
        {
            // Ajuste usuário e senha conforme o seu MySQL (XAMPP: root, senha vazia)
            $parametros = getenv("AC_DSN") ?: "mysql:host=localhost;dbname=amaral_carvalho;charset=utf8mb4";
            $usuario = getenv("AC_USER") !== false ? getenv("AC_USER") : "root";
            $senha = getenv("AC_PASS") !== false ? getenv("AC_PASS") : "";
            try
            {
                $this->db = new PDO($parametros, $usuario, $senha, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ));
            }
            catch(PDOException $e)
            {
                die("Não foi possível conectar ao banco de dados. Tente mais tarde!");
            }
        }
    }
?>

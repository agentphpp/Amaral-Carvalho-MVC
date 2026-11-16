<?php
    // Controle de sessão: login, permissão, mensagens e proteção CSRF
    class Sessao
    {
        public static function iniciar()
        {
            if(session_status() === PHP_SESSION_NONE) session_start();
        }
        public static function logado()
        {
            return isset($_SESSION["id"]);
        }
        public static function admin()
        {
            return self::logado() && ($_SESSION["cargo"] ?? "") === "admnistrador";
        }
        public static function id()
        {
            return $_SESSION["id"] ?? 0;
        }
        // Exige usuário logado; se não estiver, manda para o login
        public static function exigirLogin()
        {
            if(!self::logado())
            {
                self::mensagem("aviso", "Faça login para continuar.");
                redirecionar("usuario", "login");
            }
        }
        // Exige administrador
        public static function exigirAdmin()
        {
            self::exigirLogin();
            if(!self::admin())
            {
                self::mensagem("erro", "Acesso restrito a administradores.");
                redirecionar("inicio", "inicio");
            }
        }
        // Mensagem exibida uma vez na próxima página (tipo: sucesso, erro, aviso)
        public static function mensagem($tipo, $texto)
        {
            $_SESSION["flash"] = array("tipo" => $tipo, "texto" => $texto);
        }
        public static function lerMensagem()
        {
            $m = $_SESSION["flash"] ?? null;
            unset($_SESSION["flash"]);
            return $m;
        }
        // CSRF: token em todo formulário POST
        public static function token()
        {
            if(empty($_SESSION["csrf"])) $_SESSION["csrf"] = bin2hex(random_bytes(16));
            return $_SESSION["csrf"];
        }
        public static function campoToken()
        {
            return '<input type="hidden" name="csrf" value="' . self::token() . '">';
        }
        public static function validarToken()
        {
            $ok = isset($_POST["csrf"]) && hash_equals(self::token(), $_POST["csrf"]);
            if(!$ok)
            {
                http_response_code(400);
                die("Requisição inválida. Volte e tente novamente.");
            }
        }
    }
?>

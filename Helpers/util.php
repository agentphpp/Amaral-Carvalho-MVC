<?php
    // Funções auxiliares usadas em controllers e views

    // Escapa texto para exibir no HTML (evita XSS)
    function e($valor)
    {
        return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
    }

    // Monta o endereço de uma rota do front controller (index.php)
    function url($controle, $metodo, $params = array())
    {
        return "index.php?" . http_build_query(
            array_merge(array("controle" => $controle, "metodo" => $metodo), $params)
        );
    }

    function redirecionar($controle, $metodo, $params = array())
    {
        header("Location: " . url($controle, $metodo, $params));
        die();
    }

    // Salva uma imagem enviada por formulário. Retorna o caminho salvo ou null.
    function salvarImagem($arquivo, $pasta)
    {
        if(!isset($arquivo) || $arquivo["error"] !== UPLOAD_ERR_OK) return null;
        if($arquivo["size"] > 3 * 1024 * 1024) return null; // até 3 MB
        $info = @getimagesize($arquivo["tmp_name"]);
        if($info === false) return null;
        $extensoes = array(IMAGETYPE_JPEG => "jpg", IMAGETYPE_PNG => "png", IMAGETYPE_WEBP => "webp", IMAGETYPE_GIF => "gif");
        if(!isset($extensoes[$info[2]])) return null;
        $nome = bin2hex(random_bytes(8)) . "." . $extensoes[$info[2]];
        if(!is_dir($pasta)) mkdir($pasta, 0775, true);
        if(!move_uploaded_file($arquivo["tmp_name"], "$pasta/$nome")) return null;
        return "$pasta/$nome";
    }

    // Estrelas de 1 a 5 para exibir uma nota
    function estrelas($nota)
    {
        $nota = (int)round($nota);
        return str_repeat("★", $nota) . str_repeat("☆", 5 - $nota);
    }

    // Converte segundos em texto legível: 45s, 12 min, 1h05
    function duracaoBR($segundos)
    {
        $s = (int)$segundos;
        if($s <= 0) return "—";
        if($s < 60) return $s . "s";
        if($s < 3600) return floor($s / 60) . " min";
        return floor($s / 3600) . "h" . str_pad((string)floor(($s % 3600) / 60), 2, "0", STR_PAD_LEFT);
    }

    function dataBR($data)
    {
        return $data ? date("d/m/Y", strtotime($data)) : "";
    }
?>

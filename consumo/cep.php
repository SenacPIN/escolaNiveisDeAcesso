    <?php

// Verifica se o CEP foi informado na URL
// Exemplo: cep.php?cep=01001000
if (!isset($_GET["cep"])) {

    echo "Informe um CEP.";

    exit;
}

// Remove caracteres que não sejam números
// Assim, tanto 01001000 quanto 01001-000 funcionam
$cep = preg_replace('/[^0-9]/', '', $_GET["cep"]);

// Verifica se o CEP possui exatamente 8 números
if (strlen($cep) != 8) {

    echo "CEP inválido.";

    exit;
}

// Monta a URL da API da ViaCEP
$url = "https://viacep.com.br/ws/" . $cep . "/json/";

// Inicia o cURL
$curl = curl_init();

// Define a URL que será acessada
curl_setopt($curl, CURLOPT_URL, $url);

// Faz o cURL retornar a resposta em uma variável
// Em vez de simplesmente mostrar a resposta na tela
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// IMPORTANTE:
// Essas duas opções foram colocadas por causa do ambiente
// de desenvolvimento utilizado no UniServer.
//
// O UniServer está apresentando um problema na validação
// do certificado SSL da API.
//
// Em um sistema real, NÃO devemos simplesmente desativar
// a validação do certificado. O correto é configurar
// corretamente os certificados CA do ambiente.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

// Executa a requisição para a API
$resposta = curl_exec($curl);

// Verifica se ocorreu algum erro durante a requisição
if ($resposta === false) {

    echo "Erro ao acessar a API: " . curl_error($curl);

    curl_close($curl);

    exit;
}

// Fecha o cURL
curl_close($curl);

// Converte o JSON recebido pela API em um array PHP
$dados = json_decode($resposta, true);

// Verifica se o CEP não foi encontrado
if (isset($dados["erro"]) && $dados["erro"] === true) {

    echo "CEP não encontrado.";

    exit;
}

// Apresenta os dados retornados pela API
echo "CEP: " . $dados["cep"] . "<br>";
echo "Logradouro: " . $dados["logradouro"] . "<br>";
echo "Bairro: " . $dados["bairro"] . "<br>";
echo "Cidade: " . $dados["localidade"] . "<br>";
echo "Estado: " . $dados["uf"];
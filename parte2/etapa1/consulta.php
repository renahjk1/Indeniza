<?php
// Recebe o CPF da requisição
$cpf = $_GET['cpf'] ?? '';

// Recebe os parâmetros UTM
$utm_source = $_GET['utm_source'] ?? '';
$utm_medium = $_GET['utm_medium'] ?? '';
$utm_campaign = $_GET['utm_campaign'] ?? '';
$utm_id = $_GET['utm_id'] ?? '';
$utm_term = $_GET['utm_term'] ?? '';
$utm_content = $_GET['utm_content'] ?? '';
$src = $_GET['src'] ?? '';

// URL da API
$api_url = "https://searchapi.dnnl.live/consulta?token_api=7490&cpf=" . $cpf;

// Faz a requisição para a API
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Verifica se a consulta foi bem sucedida
if ($data && isset($data['dados']) && !empty($data['dados'])) {
    // Constrói a URL de redirecionamento com os parâmetros UTM
    $redirect_url = "/etapa2?cpf=" . $cpf;
    
    // Adiciona os parâmetros UTM se existirem
    if ($utm_source) $redirect_url .= "&utm_source=" . urlencode($utm_source);
    if ($utm_medium) $redirect_url .= "&utm_medium=" . urlencode($utm_medium);
    if ($utm_campaign) $redirect_url .= "&utm_campaign=" . urlencode($utm_campaign);
    if ($utm_id) $redirect_url .= "&utm_id=" . urlencode($utm_id);
    if ($utm_term) $redirect_url .= "&utm_term=" . urlencode($utm_term);
    if ($utm_content) $redirect_url .= "&utm_content=" . urlencode($utm_content);
    if ($src) $redirect_url .= "&src=" . urlencode($src);
    
    // Redireciona para a etapa2
    header("Location: " . $redirect_url);
    exit();
} else {
    // Em caso de erro, redireciona de volta para a etapa1 com mensagem de erro
    header("Location: /etapa1?error=1");
    exit();
}
?>

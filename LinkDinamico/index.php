<?php
/**
 * Descrição:
 * Esse script recebe código do afiliado (affiliate_url_code), marca a afiliação dele e direciona para url final
 * desejada. A url final sendo uma url não bloqueada para o Facebook vai ajudar os afiliados para compartilharem
 * tranquilamente.
 * Como usar:
 * 1. Subir esse arquivo dentro de uma pasta do seu site, ex: /redirect
 * 2. Acessar pela url http://seusite.com.br/redirect/?affiliate_url_code=CODEDAURLDOAFILIADO
 * 3. Atenção: não é para colocar o código da afiliação, é para colocar a parte final de qualquer código de url do
 * afiliado.
 */
/** @var $url_final SOMENTE EDITE ESSA VARIÁVEL */
$url_final = 'http://suapaginadevendas.com.br'; // url da página de vendas, pode ser url da go do produtor ou direto a página de conversão
/** NÃO EDITAR ABAIXO DESSA LINHA */

$affiliate_url_code = $_GET['affiliate_url_code'] ?? '';

// adiciono os parâmetros querystring (src, utm_, ...) no final da url escolhida
$url_final = $url_final . (strpos($url_final, '?') > 0 ? '&' : '?') . http_build_query($_GET);

// url chegou com código do afiliado marco afiliação dele, caso contrário não marco para ninguém
if ($affiliate_url_code != '') {
    echo '<img src="https://go.perfectpay.com.br/' . $affiliate_url_code . '?' . http_build_query($_GET) . '." style="display:none">';
}
?>
<script language='JavaScript'>
    // aguarda 2s para direcionar para url escolhida, normalmente suficiente para marcar o afiliado
    setTimeout(function () {
        // url que será direcionado o cliente
        window.location.href = "<?php echo $url_final; ?>";
    }, 2000);
</script>

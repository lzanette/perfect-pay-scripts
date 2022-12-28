# Scripts para Marketing Digital

Aqui estão alguns scripts que usamos diariamente em nossas páginas.

## Como instalar

Adicione o código em sua página como elemento html, sempre no final antes do último ```</html>```

## 1. Back Redirect

Com esse script sempre que o potencial cliente clicar no back redirect do navegador, ele será apontado para a url
definida.

Todos os parâmetros da url serão adicionados automaticamente ao final da url.

```html

<script>
    var urlBackRedirect = 'SUA URL AQUI'; // lembre-se de usar a url sem espaços
    // não altere nada abaixo dessa linha
    urlBackRedirect = urlBackRedirect = urlBackRedirect.trim() +
            (urlBackRedirect.indexOf("?") > 0 ? '&' : '?') +
            document.location.search.replace('?', '').toString();
    history.pushState({}, "", location.href);
    history.pushState({}, "", location.href);
    window.onpopstate = function () {
        setTimeout(function () {
            location.href = urlBackRedirect;
        }, 1);
    };
</script>
```

#### Uso avançado 1: caso use mesma página em múltiplos domínios use:

```javascript 
var urlBackRedirect = '//' + window.location.hostname + '/PATH_RMKT'
```

---

## 2. Passar os parâmetros para todos os links da página

Esse script foi um dos primeiros que criei no marketing digital, ele ajuda muito a criarmos muitas campanhas apontando
para a mesma página de vendas, e mesmo assim mantermos todo trakeamento chegando no checkout.

Todos os parâmetros da url já serão adicionados ao final da url.

O checkout da perfectpay aceita os seguintes parâmetros:

```&src=```

```&utm_source=```

```&utm_campaign=```

```&utm_medium=```

```&utm_content=```

```&utm_therm=```

```&utm_perfect=```

```&click_id=```

```html

<script>
    window.onload = function () {
        var links = document.getElementsByTagName("a");
        for (var i = 0, n = links.length; i < n; i++) {
            var href = links[i].href.trim() +
                    (links[i].href.indexOf("?") > 0 ? '&' : '?') +
                    document.location.search.replace('?', '').toString();
            links[i].href = href;
        }
    }
</script>
```

Para pegar links específicos trocar ```var links = document.getElementsByTagName("a");``` na 3a por:

```javascript
var links = document.querySelector("a.checkout_link"); // se somente 1
var links = document.querySelectorAll("a.checkout_link"); // se mais de 1 link a ser alterado
```

Para receber os dados corretamente do Facebook recomendo usar esse formato no facebook

```
utm_source={{campaign.name}}&utm_medium={{adset.name}}&utm_campaign={{ad.name}}&utm_content={{placement}}
```

Ou pode usar em apenas 1 parâmetro de forma mais simplificada, pessoalmente eu prefiro dessa forma:

```
src={{campaign.name}}|{{adset.name}}|{{ad.name}}|{{placement}}
```

---

## 3. Colocar imagem do pixel do facebook em um iframe (para página de obrigado)

Com esse script você vai direcionar todo o tráfego para uma url de sua escolha.

Todos os parâmetros da url já serão adicionados ao final da url.

```javascript
<script>
    const params = new URLSearchParams(window.location.search)
    utm_content = params.get('utm_content') || false
    async function createImage(src) {
    let img = new Image(0,0);
    img.src = src;
    img.style.display = "none";
    document.body.appendChild(img);
}
    if (utm_content.length > 0) {
    createImage('https://www.facebook.com/tr?id=' + utm_content + '&ev=PageView');
    createImage('https://www.facebook.com/tr?id=' + utm_content + '&ev=Purchase&cd[currency]=BRL&cd[value]=97.00');
}
</script>
```

---

## 4. Exibir botões de vendas, ou partes da página, até o minuto que desejar

Normalmente esse recurso é usado para p[aginas com vídeos de vendas, somente exibindo as partes do site quanto o vídeo
chega no momento de falar o valor.

Coloque a classe ```.delay``` em todas as div que quiser esconder,
ex. ```<div class="delay">Essa div somente seria exibida após o tempo definido</div>```

```javascript
<script>
    let secondsToDelay = 60 * 15; // 60 segundos (vezes) 15 minutos
    $('.delay').hide();
    setTimeout(function () {
    $('.delay').show();
}, secondsToDelay * 1000);
</script>
```

---

## 5. Função Javascript para pegar parâmetros da url

Colocar esse código abaixo no início da página, antes de chamar ele.

```javascript
<script>
    function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
</script>
```

Como usar:

```javascript
getUrlParameter('ppayId')
```

---

## 6. Exit redirect Fake

Coloque logo após a tag body do seu site, altere somente: ```SUA URL AQUI```.

Exemplo:
https://codepen.io/leonardo-zanette/pen/yLPBeMw

```html

<backredirect>
    <a class="arrow" href="SUA URL AQUI">
        &#8249;
    </a>
</backredirect>
<style>
    body {
        margin-top: 50px;
    }
    backredirect {
        margin: 0;
        width: 100%;
        background-color: #e9e9e9;
        position: fixed;
        top: 0;
        left: 0;
    }
    backredirect .arrow {
        background-color: #dddddd;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        font-size: 48px;
        color: #444 !important;
        text-decoration: none;
        cursor: pointer;
    }
</style>
```

---

## 7. Notificações de pessoas comprando

Se desejar, altere os nomes.

Url está apontando para o topo da página, se desejar enviar para outra url, altere ```#``` para sua url
em ```var URL_FINAL = '#';```

```html

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
    $(document).ready(function onDocumentReady() {
        var URL_FINAL = '#';
        var nome = ['Luciana Oliveira', 'Marcia Araújo', 'Carolina Dias', 'Martha', 'Aline Campos', 'Luciane R Freire', 'Simone Z', 'Laura Campos', 'Carla Dias', 'Mariana Ruas', 'Jessica Ribeiro', 'Karol Lia'];
        nome.sort(() => Math.random() - 0.5);
        var i = 0, qtd = nome.length;
        setInterval(function doThis() {
            if (i == 11) return; // somente 11 eventos serão disparados
            if (i == 1 || i == 8 || i == 10) {
                toastr.info('<a href="' + URL_FINAL + '">Clique e Reserve sua vaga também!</a> ' + (qtd + (i * 3)) + ' novas alunas compraram nos últimos 30min.', {
                    timeOut: 5000,
                    positionClass: "toast-bottom-right",
                });
            }
            toastr.success('<a href="' + URL_FINAL + '">Clique e Reserve sua vaga também!</a> ' + nome[i++] + ' acabou de reservar a vaga dela.', {
                timeOut: 5000,
                positionClass: "toast-bottom-right",
            })
        }, 10 * 1000);   // a cada 10 segundos
    });
</script>
```

---

## 8. Redirecionar com PHP para colocar os parâmetros na url e marcar pixel antes de redirecionar

Se desejar, altere os nomes.

Normalmente usamos esse código quando queremos marcar um pixel antes de direcionar para página final, assim conseguimos
usar o remarketing mesmo sem ter acesso à página do produtor.

```php
<?php
$urlDestino = "SUA URL AQUI";
// não alteren nada abaixo
$urlDestino .= (strpos($urlDestino, '?') > 0 ? "&" : '?') . http_build_query($_GET);
?>
<script>
     setTimeout(function () {
        location.href = <?php echo $urlDestino; ?>
     }, 2000); // normalmente 2s de delay é o suficiente para marcar um pixel na página
</script>
<!-- ADICIONE O SEU SCRIPT PARA MARCAR AQUI ABAIXO -->

<!-- ADICIONE O SEU SCRIPT PARA MARCAR AQUI ACIMA -->
```

---

## 9. Contador regressivo para página

Se desejar, altere os nomes.

Normalmente usamos esse código quando queremos marcar um pixel antes de direcionar para página final, assim conseguimos
usar o remarketing mesmo sem ter acesso à página do produtor.

Exemplo de funcionamento: https://codepen.io/leonardo-zanette/pen/abEvqwJ

codepen[abEvqwJ][350]

Coloque esse código em todos os locais que deseja ver o contador regressivo funcionando. Pode colocar em quantos lugares
quiser que apareça o contador.

```html

<div class="countdown">
    <div class="label">O desconto encerra em:</div>
    <div class='time'>00:00</div>
</div>
```

Ao final da página coloque esse script:

```html

<script>
    var MINUTOS = 15;
    // Não altere nada abaixo dessa linha
    function startTimer(duration, display) {
        var timer = duration,
                minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            display.forEach(function (el) {
                el.textContent = minutes + ":" + seconds;
            })
            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }
    window.onload = function () {
        var minutesToSeconds = MINUTOS * 60,
                display = document.querySelectorAll('.time');
        startTimer(minutesToSeconds, display);
    };
</script>
<style>
    .countdown {
        font: normal 12px/20px Arial, Helvetica, sans-serif;
        word-wrap: break-word;
        box-shadow: 0 1px 1px 0 rgba(1, 1, 1, 0.4);
        width: 250px;
        height: 90px;
        text-align: center;
        background: #f1f1f1;
        border-radius: 5px;
        margin: 30px auto;
        font-weight: lighter;
    }
    .countdown .label {
        font-size: 12px;
        color: #65584c;
        text-align: center;
        text-transform: uppercase;
        display: inline-block;
        letter-spacing: 2px;
        padding: 7px 0;
    }
    .countdown .time {
        color: #fff;
        position: relative;
        z-index: 1;
        text-shadow: 1px 1px 0px #ccc;
        font-size: 48px;
        text-align: center;
        padding: 20px;
        border-radius: 0 0 5px 5px;
        display: block;
        background: #e5554e;
        box-shadow: 0 1px 2px 0 rgba(1, 1, 1, 0.4);
    }
</style>
```

---- 

## 10. Camuflador de link para Facebook Ads

Coloque o código direto dentro da sua página como elemento html no local que você deseja que o botão apareça.

Exemplo: https://codepen.io/leonardo-zanette/pen/eYydgep

```html

<script>
    function perfectLink() {
        var urlAfiliado = ''; // só alterar aqui PPU.....
        var perfectlink = 'https://go.perfectpay.com.br/' + urlAfiliado + location.search;
        return window.open(perfectlink, '_blank');
    }
</script>
<div style='width:100%; text-align:center; margin:20px'>
    <a href="#" id="redirect" onclick="perfectLink()">Continuar »</a>
</div>
<style>
    #redirect {
        position: relative;
        font-family: arial;
        padding: 10px 40px;
        margin: 20px auto;
        border-radius: 5px;
        font-size: 20px;
        color: #FFF;
        text-decoration: none;
        background-color: #2ecc71;
        border: none;
        border-bottom: 5px solid #27ae60;
        text-shadow: 0px -2px #27ae60;
        -webkit-transition: all 0.1s;
        transition: all 0.1s;
    }
    #redirect:hover, #redirect:active {
        -webkit-transform: translate(0px, 5px);
        -ms-transform: translate(0px, 5px);
        transform: translate(0px, 5px);
        border-bottom: 1px solid #2ecc71;
    }
</style>
```

---

## 11. Script para redirecionar o tráfego, marcando o pixel do Facebook antes de redirecionar

Coloque na primeira linha do seu site, altere somente: ```SUA URL AQUI```.

Se desejar alterar o tempo para redirecionar, mude o valor 3 * 1000 para o valor desejado, sendo 3 a quantidade de
segundos, não altere o 1000 pois o temporizador é em milesegundos.

```html

<script language="JavaScript">
    var URL = 'SUA URL AQUI'; // lembre-se de usar a url sem espaços antes ou depois
    // não altere nada abaixo dessa linha
    URL = URL.trim() +
            (URL.indexOf("?") > 0 ? '&' : '?') +
            document.location.search.replace('?', '').toString();
    setTimeout(function () {
        window.location = URL;
    }, 3 * 1000);
</script>
```

Você também pode usar esse recurso em html, lembre-se de colocar a url sem espaços, nesse caso não é possível passar os
parâmetros pela url, já que é um html puro.

```html

<meta http-equiv="refresh" content=3; URL='SUA URL AQUI'/>
```

---

## 12. Deeplink Youtube - Anúncios direto para vídeo do Yootube com deeplink, sem risco de bloqueio, enviando para o APP ou para o browser

Quando você coloca esse script em sua página, a pessoa que clicar nos seus anúncios que tiverem esse script na página
vão ser direcionadas corretamente para o App do Youtube, quando acessando via mobile, e quando acessando pelo
computador, vão acessar no próprio browser. Isso garante uma boa experiência para seu usuário.

```html

<script type="text/javascript">
    window.onload = function () {
        var desktopFallback = "https://www.youtube.com/watch?v=9_Xhj26L81g",
                mobileFallback = "https://www.youtube.com/watch?v=9_Xhj26L81g",
                app = "vnd.youtube://9_Xhj26L81g";
        if (/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            window.location = app;
            window.setTimeout(function () {
                window.location = mobileFallback;
            }, 25);
        } else {
            window.location = desktopFallback;
        }
        function killPopup() {
            window.removeEventListener('pagehide', killPopup);
        }
        window.addEventListener('pagehide', killPopup);
    };
</script>
```

---

## 13. Deeplink Instagram - Anúncios direto para vídeo do Yootube com deeplink, sem risco de bloqueio, enviando para o APP ou para o browser

A pessoa que clicar nos seus anúncios que tiverem esse script na página vão ser direcionadas corretamente para o App do
Instagram, quando acessando via mobile, e quando acessando pelo computador, vão acessar no próprio browser.

Isso garante uma boa experiência para seu usuário.

Troque apenas ```USERNAME```

```html

<script type="text/javascript">
    window.onload = function () {
        var USERNAME = "leonardozanette";
        if (/Android/i.test(navigator.userAgent)) {
            window.location = 'intent://www.instagram.com/' + USERNAME + '/#Intent;package=com.instagram.android;scheme=https;end';
        } else if (/iPhone|iPod/i.test(navigator.userAgent)) {
            window.location = 'instagram://user?username=' + USERNAME;
        } else {
            window.location = 'https://instagram.com/' + USERNAME;
        }
        function killPopup() {
            window.removeEventListener('pagehide', killPopup);
        }
        window.addEventListener('pagehide', killPopup);
    };
</script>
```

--- 

## 14. Divisor de whatsapps para várias atendentes

```html

<script>
    function getWhatsAppNumber() {
        var mensagemWhats = 'Eu quero testar!';
        var phones = [
            119911111111,
            119911111112,
            119911111113,
            119911111114,
        ];

        var url = 'https://api.whatsapp.com/send?phone='
                + phones[Math.floor(Math.random() * phones.length)]
                + '&text='
                + encodeURIComponent(mensagemWhats);

        window.open(url, '_blank');
    }
</script>
<a href="#" onclick='getWhatsAppNumber()'>Falar com um atendente</a>
```

--- 

## 15. Impedir clique com botão direito e inspecionar elemento

```html

<script>
    document.addEventListener("keydown", function (e) {
        if (e.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 73)) { // Prevent F12
            e.preventDefault()
        }
    }, true);
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault()
    }, true);
</script>
```

--- 

## 16. Auto Popular checkout da Perfect Pay

Parâmetros personalizados no Checkout
Como usar os parâmetros?

Coloque o parâmetro ao final da sua url, lembre-se:
Uma url só pode possuir um símbolo de interrogação "?"
Se precisar usar mais de um parâmetro use o símbolo "&"

Exemplo:
Sua URL:
http://go.perfectpay.com.br/pay/PPU38CKC5OG

Adicionando 1 parâmetro:
http://go.perfectpay.com.br/pay/PPU38CKC5OG?split=12

Dois ou mais parâmetros:
http://go.perfectpay.com.br/pay/PPU38CKC5OG?split=12&hidepix=1

--------------------------------------

## 17. Parâmetros aceitos na Perfect Pay

| Parâmetros aceitos | Como funciona                                                                                                                                                                                                        |
|--------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| split=12           | Alterar a quantidade de parcelas do cartão                                                                                                                                                                           |
| hideb = 1          | Esconder boleto ou hidebillet = 1                                                                                                                                                                                    |
| hidepix=1          | Esconder pix                                                                                                                                                                                                         |
| hidecard=1         | Esconder cartão                                                                                                                                                                                                      |
| hidebump=1         | Esconder order bumps                                                                                                                                                                                                 |
| name=              | Preencher o nome                                                                                                                                                                                                     |
| email=             | Preencher o email                                                                                                                                                                                                    |
| phone=             | Preencher o telefone                                                                                                                                                                                                 |
| cep=               | Preencher o CEP do cliente                                                                                                                                                                                           |
| billetd=3          | Quantidade de dias para vencer boleto                                                                                                                                                                                |
| scarcity=15        | Quantidade de minutos a mostrar no contador de escassez, esse contador aparece no topo da página. <br/> Ele somente exibe se não existir a configuração de escassez nas configurações de checkout dentro do produto. |

### 17.1. Parâmetros para trackeamento de vendas aceitos na Perfect Pay

Internamente na Perfect Pay em detalhamento de vendas você consegue identificar relatórios específicos por cada um dos
parâmetros abaixo:

- src=
- sck=
- utm_source=
- utm_campaign=
- utm_medium=
- utm_therm=
- utm_content=
- utm_perfect= (Evite usar esse, usamos para alguns recursos de recuperação.)
- click_id=

----

## 18. Outras funcionalidates na Perfect Pay

Todos links abaixo só precisa alterar TRANSACAO pelo seu código de venda.

- **Auto preencher com dados do cliente**, com base no checkout preenchido. (ideal para recuperar vendas enviando por
  email/whats/sms, o checkout já preenchido)
  https://checkout.perfectpay.com.br/checkout/TRANSACAO


- **Url direta para o boleto do cliente**
  https://checkout.perfectpay.com.br/boleto/TRANSACAO


- **Abrir tela para pagamento do Pix**
  https://checkout.perfectpay.com.br/pix/TRANSACAO


- **Abrir o boleto em pdf** (usado normalmente em automações de WhatsApp)
  https://checkout.perfectpay.com.br/boleto/TRANSACAO?pdf=1


- **Página de obrigado venda aprovada.** (Sem a TRANSACAO é a url que pode ser considerada para ativar pixel de compra.)
  Abrindo essa url com qualquer venda aprovada, de qualquer cliente, você poderá verificar quais pixels foram ativados
  na página.
  https://checkout.perfectpay.com.br/payments/thanks?payment=TRANSACAO


- **Página de acesso à compra do cliente** (Envie essa url para seu cliente e ele terá acesso ao produto, é uma boa
  ideia
  colocar na sua automação de email para compras aprovadas)
  https://app.perfectpay.com.br/customer


- **Link para liberação do Perfect Academy de forma simplificada.** (Com essa url seu cliente consegue logar facilmente
  no
  academy, mesmo que ele não tenha qual email realizou a compra)
  https://academy.perfectpay.com.br/br/pedido/TRANSACAO

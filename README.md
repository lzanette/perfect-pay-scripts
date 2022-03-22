# Scripts para Marketing Digital

Aqui estão alguns scripts que usamos diariamente em nossas páginas.

## Como instalar

Adicione o código em sua página como elemento html, sempre no final antes do último ```</html>```

## 1. Back Redirect

Com esse script você vai direcionar todo o tráfego para uma url de sua escolha.

Todos os parâmetros da url já serão adicionados ao final da url.

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

Com esse script você vai direcionar todo o tráfego para uma url de sua escolha.

Todos os parâmetros da url já serão adicionados ao final da url.

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

Para pegar links específicos use:

```javascript
document.querySelector("a.checkout_link"); // se somente 1
document.querySelectorAll("a.checkout_link"); // se mais de 1
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

## 4. Esconder botões até certo momento

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

## 5. Função para pegar parâmetros da url

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
getUrlParameter('ppayId'));
```


---

## 6. Exit redirect Fake

Coloque logo após a tag body do seu site, altere somente: ```SUA URL AQUI```.

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

## 8. Script PHP para colocar os parâmetros na url e marcar pixel antes de redirecionar

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

Coloque esse código em todos os locais que deseja ver o contador regressivo funcionando. Pode colocar em quantos lugares quiser que apareça o contador.

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
    .countdown{
        font: normal 12px/20px Arial, Helvetica, sans-serif;
        word-wrap:break-word;
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
    .countdown .time{
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

```html
<script>
    function perfectLink() {
        var path = location.pathname+location.search;
        var urlAfiliado = ''; // PPU.....
        var perfectlink  = 'https://go.perfectpay.com.br/' + urlAfiliado + path;
        return location.href = perfectlink;
    }
</script>
<a href="#" id="redirect" onclick="perfectLink()">Continuar »</a>
```

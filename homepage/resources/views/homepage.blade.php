<?php ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Primeira Aplicação Laravel</title>
</head>
<body>
    
<!-- Comando para criar a div com o nome de root, dentro tem o main e dentro do main tem o h1
    O nome disso é snipit
    #root>main>h1 -->

<div id="root">
    <main>
        <h1>Hello
            @if (empty ($data))
                World
                @else
                     {{ $data -> name }}
                @endif
        </h1>
    </main>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido confirmado com sucesso!</title>
</head>
<body>
<h1>Ordem de confirmação</h1>
<p>Obrigado, {{ $order->user }}!</p>
<p>Detalhes do pedido:</p>
<ul>
    <li>Produto: {{ $order->product }}</li>
    <li>Quantidade: {{ $order->quantity }}</li>
</ul>
</body>
</html>

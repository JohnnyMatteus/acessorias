#!/bin/sh

# Verifica se as variáveis de ambiente estão definidas
if [ -z "$DB_HOST" ]; then
  echo "Erro: A variável de ambiente DB_HOST não está definida."
  exit 1
fi

if [ -z "$DB_PORT" ]; then
  echo "Erro: A variável de ambiente DB_PORT não está definida."
  exit 1
fi

# Espera o banco de dados estar disponível
echo "Aguardando o banco de dados..."

while ! nc -z "$DB_HOST" "$DB_PORT"; do
  sleep 1
done

echo "Banco de dados disponível. Executando migrações..."

# Executa as migrações
php artisan migrate --force

# Inicia o worker da fila em background (somente no contêiner de fila)
if [ "$QUEUE_WORKER" = "true" ]; then
  echo "Iniciando o worker da fila..."
  nohup php artisan queue:work > /dev/null 2>&1 &
fi

# Executa o comando fornecido (default é php-fpm)
exec "$@"

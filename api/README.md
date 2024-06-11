# Projeto - Acessorias

Este projeto é uma aplicação Laravel configurada para funcionar dentro de containers Docker, seguindo as melhores práticas de desenvolvimento de software. Abaixo estão as instruções para iniciar o projeto.

## Arquitetura

O projeto segue a arquitetura DDD (Domain-Driven Design), contendo princípios de SOLID e utilizando diversos Design Patterns. A implementação de automação de envio de e-mail para registro de ordens em Laravel com DDD, foram utilizados dois Design Patterns principais:

### Observer Pattern

O padrão Observer é implementado através do listener `SendOrderConfirmationEmail`. Esse listener "observa" o evento `OrderRegistered` e, quando este é disparado, executa a ação de enviar o e-mail de confirmação.

### Command Pattern

O padrão Command é utilizado para encapsular o envio do e-mail em um comando chamado `SendOrderConfirmationEmailCommand`. Esse comando recebe as informações necessárias para enviar o e-mail (ID da ordem, ID do cliente e produtos) e as utiliza para disparar a ação de envio.

### Benefícios da Utilização dos Design Patterns

- **Maior organização e modularidade**: Os Design Patterns permitem dividir a lógica da aplicação em módulos menores e mais coesos, o que facilita a compreensão, a reutilização e a manutenção do código.
- **Maior flexibilidade e testabilidade**: O código se torna mais flexível e testável, pois os componentes podem ser facilmente substituídos ou testados de forma independente.
- **Maior facilidade de manutenção**: A utilização de Design Patterns torna o código mais fácil de entender e modificar, reduzindo o tempo e o custo de manutenção.

#### Exemplos

- **Observer Pattern**: O listener `SendOrderConfirmationEmail` implementa o padrão Observer pois ele se inscreve no evento `OrderRegistered` e, quando este é disparado, a ação de enviar o e-mail é executada.
- **Command Pattern**: O comando `SendOrderConfirmationEmailCommand` implementa o padrão Command pois ele encapsula a lógica de envio do e-mail em um único objeto, separando-a do listener e permitindo que seja reutilizada em outras partes da aplicação.

## Estrutura de Pastas

A estrutura do projeto está organizada da seguinte maneira:

- **api/.docker**: Arquivos de configuração do Docker.
- **api/app**: Diretório principal do aplicativo Laravel, contendo a lógica de negócios, controladores, modelos e mais.
    - **Application**: Contém a lógica de aplicação, como serviços e casos de uso.
    - **Console**: Comandos artisan personalizados.
    - **Domain**: Entidades de domínio e lógica de negócios.
    - **Events**: Eventos para a aplicação.
    - **Exceptions**: Tratamento de exceções customizadas.
    - **Helpers**: Funções auxiliares.
    - **Http**: Controladores e middleware.
        - **Controllers**: Controladores que gerenciam as requisições HTTP.
        - **Middleware**: Middleware para a aplicação.
    - **Infrastructure**: Repositórios e serviços de infraestrutura.
    - **Listeners**: Listeners para eventos.
    - **Mail**: Configurações de envio de e-mails.
    - **Model**: Modelos Eloquent.
    - **Notifications**: Notificações da aplicação.
    - **Providers**: Provedores de serviços.
    - **Validators**: Validações customizadas.
- **bootstrap**: Arquivos de inicialização do framework.
- **config**: Arquivos de configuração do Laravel.
- **database**: Migrations, seeders e factories.
- **docker**: Configurações adicionais para Docker.
- **public**: Arquivos públicos, como index.php e recursos estáticos.
- **resources**: Arquivos de visualização e tradução.
- **routes**: Definições de rotas.
- **storage**: Logs, cache e outros arquivos gerados pela aplicação.
- **tests**: Testes automatizados.
- **vendor**: Dependências gerenciadas pelo Composer.

## Iniciando o Projeto

### Pré-requisitos

- Docker e Docker Compose instalados

### Passos para Iniciar o Projeto

1. **Clone o Repositório**

   ```sh
   git clone <url-do-repositorio>
   cd acessorias

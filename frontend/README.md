# Projeto Frontend - Acessorias

Este projeto é uma aplicação frontend desenvolvida com Vue.js, Vuetify e TanStack para chamadas REST. A aplicação atende aos seguintes requisitos:

- Listagem de produtos e usuários.
- Criação, listagem e visualização de pedidos.
- Funcionalidades de login, recuperação de senha e logout.
- Respeito às heurísticas de Nielsen para usabilidade.

## Estrutura do Projeto

A estrutura do projeto está organizada da seguinte forma:

- **src/**: Diretório principal do código fonte da aplicação.
    - **components/**: Componentes Vue reutilizáveis.
    - **views/**: Componentes de visualização (páginas).
    - **router/**: Configurações de rotas.
    - **store/**: Gerenciamento de estado com Vuex.
    - **services/**: Serviços para chamadas REST e lógica de negócios.
    - **plugins/**: Plugins Vue, como Vuetify.
    - **assets/**: Arquivos estáticos, como imagens e estilos.
- **public/**: Arquivos públicos, como index.html.
- **tests/**: Testes automatizados.

## Iniciando o Projeto

### Pré-requisitos

- Node.js e npm instalados

### Passos para Iniciar o Projeto

1. **Acessar a pasta**

   ```sh
   cd frontend
   npm install

2. **Iniciar o Servidor de Desenvolvimento**

```sh
   npm run serve
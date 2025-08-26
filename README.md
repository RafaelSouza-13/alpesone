<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Que a força esteja com você!

#  Desafio Alpesone - Backend

Criar uma API básica que forneça dados de um recurso e configurar um ambiente na AWS para
hospedar e implantar essa aplicação. O foco é demonstrar habilidades em desenvolvimento
backend, infraestrutura como serviço (AWS EC2) e conhecimentos de DevOps.

## Observações
Dentro do diretório extras encontrasse a collection para testes da API realizadas no postman. Foi criado um CRUD para novos registros, porém as rotas estão protegidas pelo sanctum, é preciso autenticar um usuário para acessar os dados. Nos passos de configuração na etapa de seed, um usuário é criado com email: usuario@example.com e senha: senha123, tais credenciais após autenticadas conseguem realizar o CRUD da aplicação.

## ⚙️ Tecnologias Utilizadas

- PHP 8.3
- Laravel 12
- Composer
- Git
- SQL
- SQLITE3

## 💡 Funcionalidades

### Etapa 1: Aplicação Laravel
- [x] Criar uma aplicação Laravel e configurar o ambiente local com MySQL ou SQLite.
- Criar um comando Artisan que:
    - [x] Baixa e lê o JSON da URL
    - [x] Valida e insere os dados no banco de dados, atualizando os itens existentes.
    - [x] Faça uma verificação a cada hora se o JSON original foi alterado e aplique as respectivas atualizações na base de dados.
- [x] Criar uma API REST para que seja possível fazer CRUD à base de dados salva.
- Escrever testes testes automatizados.
    - [x] Unitários: Validações dos dados e lógica do comando de importação.
    - [x] Integração: Testar os endpoints da API, incluindo autenticação e paginação.
- Documentação: Incluir instruções para:
    - [x] Configurar o ambiente.
    - [x] Executar o comando de importação.
    - [x] Rodar a aplicação e os testes.
    - [x] Extras: collection para testes da API.



### Etapa 2: Configuração de Infraestrutura na AWS
- [x] Criar e configurar uma instância EC2
- [ ] Configurar o servidor para permitir acesso público ao endpoint da API.
- Extras
    - [x] Configurar um domínio ou subdomínio (exemplo: api.suaempresa.com)
        utilizando o Route 53 ou outro DNS.
    - [ ] Instalar e configurar HTTPS.

### Etapa 3: Deploy Automatizado
- Criar um script para realizar o deploy da aplicação. O script deve::
    - [ ] Copiar os arquivos do código para a instância EC2.
    - [ ] Reiniciar o servidor (caso necessário) para aplicar as mudanças.
- Extras:
    - [ ] Configurar um pipeline CI/CD simples utilizando o Bitbucket Pipelines ou GitHub Actions 
        para automatizar o deploy em pushes para o branch main.


## 🏗️ Estrutura do Projeto

Abaixo está a organização das principais pastas e arquivos deste projeto Laravel:

### 📂 Diretórios Principais

- **app/**  
  Contém a lógica de negócio da aplicação:
  - `console/`: commandos personalizados.
  - `exeptions/`: Exceções personalizados.
  - `Http/`: Classes de controladores e middlewares, formrequests e resources.
  - `Models/`: Classes de modelos.
  - `Repositories/`: Classes para ações no banco de dados.
  - `Services/`: Classes para lógica de negócios mais complexas.



- **bootstrap/**  
  Inicialização do framework e configuração do autoload.

- **config/**  
  Arquivos de configuração de serviços e do sistema.

- **database/**  
  Estrutura de banco de dados:
  - `factories/`: Criação de dados para testes.
  - `migrations/`: Definições de estrutura das tabelas.
  - `seeders/`: Popular o banco com dados iniciais.

- **extras/**  
  - Encontrasse as collection para testes da API.

- **public/**  
  Pasta pública acessível pela web. Contém o `index.php` e os assets públicos.

- **routes/**  
  Definições de rotas:
  - `api.php`: Rotas para o ambiente de API, com respostas em JSON.

- **storage/**  
  Arquivos gerados ou manipulados pela aplicação (logs, cache, uploads).

- **tests/**  
  Testes automatizados.

- **vendor/**  
  Dependências instaladas via Composer (não edite arquivos aqui).

---


# 🛠️ Pré-requisitos

Antes de começar, certifique-se de ter instalado e configurado o seguinte:

## 1️⃣ PHP e Extensões Necessárias

Laravel precisa de PHP 8.3 ou superior, além de algumas extensões essenciais:

| Extensão PHP       | Função                                     |
|-------------------|-------------------------------------------|
| `pdo`             | Suporte a PDO                              |
| `pdo_mysql`       | Conexão com MySQL / MariaDB                |
| `mysqli`          | Conexão com MySQL                          |
| `sqlite3`         | Conexão com SQLite                          |
| `mbstring`        | Suporte a strings multibyte                 |
| `xml`             | Suporte a XML                               |

---

### 2️⃣ Instalação das Extensões por Sistema Operacional

#### Linux (Ubuntu / Debian)
```bash
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-mysql php-sqlite3 php-pdo
```

#### Windows
- Abra o arquivo php.ini do seu PHP.
- Descomente (remova o ';') as linhas:
extension=pdo_mysql
extension=mysqli
extension=sqlite3


## 🚀 Executando o projeto
Para executar este projeto Laravel, certifique-se de ter instalado o PHP 8.3 ou superior, Composer.

Siga as etapas abaixo para executar este projeto Laravel em sua máquina local:

### Etapa 1

1. **Clone o repositório**  
   ```bash
   git clone git@github.com:RafaelSouza-13/alpesone.git

2. **Acesse o diretório do projeto**
   ```bash
   cd alpesone

3. **Configure as variáveis de ambiente**
    Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente conforme o seu ambiente local (como configurações de banco de dados).

4. **Insira a API que le e baixa o JSON no .env**
    Dentro do .env crie a variavel API_URL e atribua o valor da URL que é utilizada para ler e baixar o JSON.

5. **Instale as dependências do Laravel**
   ```bash
   composer install

6. **Gere a chave da aplicação**
   ```bash
    php artisan key:generate

7. **Inicie o servidor**
   ```bash
    php artisan serve

8. **Execute as migrações do banco de dados**
    ```bash
    php artisan migrate

9. **Execute os seeders para alimentar o banco de dados**
    ```bash
    php artisan db:seed

10. **Comando para reiniciar o banco e executar o seed após**
    ```bash
    php artisan migrate:refresh --seed

11. **Comando para executar importação**
    ```bash
    php artisan app:atualizar-json

12. **Comando para executar os testes**
    ```bash
    php artisan test

### Etapa 2: Configurar a aplicação na instância EC2.
1. **Crie uma instancia e de um nome**
  - ex: meu-servidor
2. **Escolha a imagem**
  - Utilizei a ubuntu linux

3. **Configurar par de chaves ssh**

4. **Configurar Rede**
  - Habilitar ssh, prototoclo http e https.

5. **Armazenamento**
  - Instancia com 8gb.

6. **Criar**

7. **Zonas hospedadas**
  - insira um nome de domínio ex: rotadesafio.com

8. **Criar registro**
  - insira o nome, tipo = A e o ip público.
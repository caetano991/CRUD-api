Este projeto é uma API simples desenvolvida em PHP utilizando PDO, com o objetivo de praticar operações básicas de back-end e consumo de API.
-----------------------------

## Tecnologias utilizadas

PHP
PDO (PHP Data Objects)
MySQL
Thunder Client (para testes)
-----------------------------

## Funcionalidades

Criar carros (POST)
Listar carros (GET)
Atualizar carros (PUT/PATCH)
Deletar carros (DELETE)
-----------------------------

## Configuração do Banco de Dados

1. Criar o banco:
CREATE DATABASE consumo_api;

2. Criar a tabela:
CREATE TABLE carros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100),
    categoria VARCHAR(100),
    modelo VARCHAR(100),
    ano DATE,
    valor DECIMAL(10,2)

);
-----------------------------

## Configuração do projeto

Clone o repositório:
git clone <url-do-repositorio>

Acesse a pasta:
cd nome-do-projeto

Configure a conexão com o banco no arquivo PHP:

DB_HOST=localhost
DB_NAME=consumo_api
DB_USER=root
DB_PASS="sua_senha"
-----------------------------
## Inicie o servidor local:
php -S localhost:8000

-----------------------------
## Testando a API

A API foi testada utilizando o Thunder Client no VS Code.

Exemplos de endpoints:

GET /carros → lista todos os carros
POST /carros → cria um novo carro
PUT /carros/{id} → atualiza um carro
DELETE /carros/{id} → remove um carro

-----------------------------
## Observações

Projeto desenvolvido para fins de estudo
Não possui autenticação ou validações avançadas
Pode ser melhorado com boas práticas e segurança

-----------------------------
## Objetivo

Praticar:
Criação de APIs com PHP
Uso de PDO para acesso a banco de dados
Estruturação de rotas
Testes de requisições HTTP

# Loja Virtual — E-commerce em PHP

Sistema de e-commerce desenvolvido em PHP com banco de dados relacional, cobrindo o fluxo completo de uma loja: cadastro de produtos, gestão de usuários, carrinho de compras e registro de vendas.

## Funcionalidades

- **Cadastro de produtos**: criação, edição e exclusão, com preço, custo, margem de lucro e ICMS
- **Cadastro de usuários**: criação, edição e exclusão, com dados de contato e permissão de administrador
- **Carrinho de compras**: associação entre usuário e produtos selecionados
- **Registro de vendas**: venda vinculada ao usuário, com itens de venda (produto, quantidade, valor unitário e total)

## Modelo de dados

- `produtos` — catálogo com preço, custo, margem e imagem
- `users` — usuários da loja (com flag de administrador)
- `carrinho` — itens no carrinho de cada usuário
- `venda` / `itensvenda` — histórico de vendas e seus itens

## Tecnologias

- PHP
- Banco de dados relacional (script SQL de criação incluso em `bd/script`)

## Contexto

Projeto do segundo ano do ensino técnico de informática — Colégio Técnico Industrial "Prof. Isaac Portal Roldán" (UNESP).

## 📊 Linguagens

![Linguagens](https://raw.githubusercontent.com/GKsegura/GKsegura/main/cards/EcoTube.svg)

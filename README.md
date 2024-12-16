<h1 align="center">Teste de Desenvolvedor para Systock - Crud de Usuários</h1>

> CRUD de usuários com com autenticação e perfis de acesso;<br>
> API foi construída usando PHP 8 e Laravel 11;<br>
> UI foi construída usando Typescript, Vue 3 e Vuetify 3;<br>
> A base de dados utilizada é o PostgreSQL<br>

## Prerequisitos
- Docker
- Git

## Tecnologias 
<div style="display: inline_block">
    <img align="center" alt="" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
    <img align="center" alt="" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" />
    <img align="center" alt="" src="https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white" />
    <img align="center" alt="" src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
    <img align="center" alt="" src="https://img.shields.io/badge/CSS-239120?&style=for-the-badge&logo=css3&logoColor=white" />
</div>
<br>
<div>
    <img align="center" alt="" src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
    <img align="center" alt="" src="https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D" />
    <img align="center" alt="" src="https://img.shields.io/badge/Vuetify.js-afddff?style=for-the-badge&logo=vuetify&logoColor=2196F3" />
</div>
<br>
<div>
    <img align="center" alt="" src="https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white" />
</div>

## Clonando o projeto
```sh
$ git clone https://github.com/DaviNoronha/crud-systock-api
```

## Buildando o projeto
- Certifique-se de que o Docker está rodando em sua máquina
- No diretório do projeto execute o comando em seu terminal
```sh
$ docker compose up --build 
```
- Aguarde até que todos os containers sejam iniciados
- Abra outra aba em seu terminal no diretório do projeto
- Execute os seguintes comandos:
```sh
$ docker exec laravel-api composer install
$ docker exec laravel-api php artisan key:generate
$ docker exec laravel-api php artisan migrate --seed
```
- Agora você pode abrir a aplicação web na url (http://localhost:3000/)

## Logando
- Use as seguinte credenciais: Email: admin@admin.com, Senha: 12345678

## Regras de Negócio
- O sistema permite um crud completo de usuários
- Apenas usuários com o perfil de Administrador podem cadastrar, editar e excluir outros usuários
- Usuários com o perfil de Usuário podem apenas visualizar outros usuários

## Autor
👤 **Davi Noronha Gato**

* Github: [@DaviNoronha](https://github.com/DaviNoronha)
* LinkedIn: [@davi-noronha-34ba04267](https://www.linkedin.com/in/davi-noronha-34ba04267/)

## Extra
- Se tiver com dificuldades para buildar o projeto usando Docker, você pode usar o Laragon caso esteja usando Windows
- Aplicação web foi inicialmente desenvolvida em outro repositório: [@crud-systock-web](https://github.com/DaviNoronha/crud-systock-web)
- Depois a aplicação web foi movida para este repositório para implementação do Docker
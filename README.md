<h1 align="center">Teste de Desenvolvedor para Systock - Crud de Usuários</h1>

> Uma aplicação com back-end e frontend.<br>
> API construída usando PHP com Laravel.<br>
> A aplicação de front-end que consome a API foi feita usando Typescript com Vuetify 3. <br>

## Prerequisitos
- Docker
- Git

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
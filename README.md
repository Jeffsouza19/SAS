# Hello! Wellcome

## This is a test carried out for a job vacancy at Search and Stay

<br>

### ***Note***
    It is an API built in Laravel for registering books with authentication using Sanctum.
    All routes bring the 'error' position, filled in case of any error, or empty


## **Requirements to start the application**

    This project uses laravel 9, with PHP8.0.2.


    Use the following commands in the terminal, already in the project folder

    composer install
    php artisan migration

    php artisan serve --host=0.0.0.0

    note:
    This project has seeders to populate the database, to use run the command:
    php artisan db:seed

    With that the application will be running on localHost

    example of a request after starting the application:
    localhost:8000/api/login

<br>

#
### ***Rotas***

*To access the routes use yourdomain.com/api/~*

<br>

### AuthController routes
- No prefix needed
# 

-  **/unauthenticated**

        ANY type route, for users who have not yet logged in.

        Any route that is accessed without being authenticated will redirect to this route

-   **/login**

        POST type route, receives 2 parameters to perform the login and receive the authentication token

        -Parameters:
            Email      -> required, 
            Password   -> required

        -Return:
            Token, User data

-   **/register**

        POST type route, receives 4 parameters to register, login and receive the authentication token.

        -Parameters:
            Name                -> required, 
            Email               -> required, 
            Password            -> required, 
            Confirm Password    -> required

        -Return:
            Token, User data

-   **/logout**

        GET type route, it is necessary to be logged in, it does not receive any parameters

        -Return:
            Logout successfully

<br>

### BookController routes
- all routes need to be logged in
#

-   **/book**

        GET type route, it does not receive any parameters

        -Return:
            All registered books

-   **/book/store**

        POST type route, receive 3 parameters to register a book

        -Parameters:
            Name    -> required,
            ISBN    -> integer,
            Value   -> decimal(min:1, max:9)

        -Return:
            Registered book data

-   **/book/edit**

        POST type route, receive 1 parameter to edit a book

        -Parameter:
            Id  -> required

        -Return:
            Specific book data

-   **/book/update**

        PUT type route, receive 4 parameters to update a book

        -Parameters:
            Id      -> required,
            Name    -> required,
            ISBN    -> integer,
            Value   -> decimal(min:1, max:9)

        -Return:
            Updated book data

-   **/book/delete**

        DELETE type route, receive 1 parameter to delete a book

        -Parameter:
            Id      -> required
        
        -Return:
            Delete successfully


<br>

### UserController routes
- all routes need to be logged in
#
    
-   **/user**

        GET type route, it does not receive any parameters

        -Return
            All users data

-   **/user/edit**

        GET type route, receive 1 parameter to show a user

        -Parameter:
            id      -> required

        -Return:
            Specific user data

-   **/user/update**

        PUT type route, receive 6 parameters to update a user

        -Parameters:
            id          -> required
            name        -> required
            email       -> optional
            password    -> optional
                if you want change password you'll need 2 more parameters
                old_password        -> current password
                confirm_passoword   -> same as the password field 
        ** Only the user can change his password and email

        -Return:
            Updated specific user

-   **/user/delete**

        DELETE type route, receive 1 parameter to delete a user

        -Parameters:
            id      -> required
        


<br>
<br>
<br>
<br>

# **Portuguese (pt-BR)**

# Olá!  Seja Bem vindo

## Este é um teste realizado para uma vaga de emprego na Busca e Fica

<br>

### ***Observação***
     É uma API construída em Laravel para registro de livros com autenticação usando Sanctum.
     Todas as rotas trazem a posição 'error', preenchida em caso de algum erro, ou vazia


## **Requisitos para iniciar o aplicativo**

     Este projeto usa laravel 9, com PHP8.0.2.


     Use os seguintes comandos no terminal, já na pasta do projeto

     composer install
     php artisan migration

     php artisan serve --host=0.0.0.0

     Nota:
     Este projeto possui seeders para preencher o banco de dados, para usar execute o comando:
     php artisan db:seed

     Com isso a aplicação estará rodando no localHost

     exemplo de requisição após iniciar a aplicação:
     localhost:8000/api/login

<br>

#
### ***Rotas***

*Para acessar as rotas use seudominio.com/api/~*

<br>

### Rotas AuthController
- Nenhum prefixo necessário
#

- **/unauthenticated**

         Rota do tipo ANY, para usuários que ainda não efetuaram login.

         Qualquer rota que for acessada sem estar autenticada irá redirecionar para esta rota

-   **/login**

         Rota tipo POST, recebe 2 parâmetros para realizar o login e receber o token de autenticação

         -Parâmetros:
             Email      -> obrigatório,
             Senha      -> obrigatório

         -Retornar:
             Token, dados do usuário

-   **/register**

         Rota tipo POST, recebe 4 parâmetros para cadastrar, fazer login e receber o token de autenticação.

         -Parâmetros:
             Nome               -> obrigatório,
             Email              -> obrigatório,
             Password           -> obrigatório,
             confirm password   -> obrigatório

         -Retornar:
             Token, dados do usuário

-   **/logout**

         Rota tipo GET, é necessário estar logado, não recebe nenhum parâmetro

         -Retornar:
             Sair com sucesso

<br>

### Rotas do BookController
- todas as rotas precisam estar logadas
#

-   **/book**

         Rota do tipo GET, não recebe nenhum parâmetro

         -Retornar:
             Todos os livros registrados

- **/book/store**

         Rota tipo POST, recebe 3 parâmetros para registrar um livro

         -Parâmetros:
             Nome       -> obrigatório,
             ISBN       -> inteiro,
             Valor      -> decimal(min:1, max:9)

         -Retornar:
             Dados do livro registrado

- **/book/edit**

         Rota tipo POST, recebe 1 parâmetro para editar um livro

         -Parâmetro:
             Id         -> obrigatório

         -Retornar:
             Dados específicos do livro

- **/book/update**

         Rota do tipo PUT, receba 4 parâmetros para atualizar um livro

         -Parâmetros:
             Id         -> obrigatório,
             Nome       -> obrigatório,
             ISBN       -> inteiro,
             Valor      -> decimal(min:1, max:9)

         -Retornar:
             Dados do livro atualizados

- **/book/delete**

         Rota do tipo DELETE, receba 1 parâmetro para deletar um livro

         -Parâmetro:
             Id     -> obrigatório
        
         -Retornar:
             Excluir com sucesso


<br>

### Rotas do UserController
- todas as rotas precisam estar logadas
#
    
-   **/user**

         Rota do tipo GET, não recebe nenhum parâmetro

         -Retornar
             Todos os dados dos usuários

- **/user/edit**

         Rota do tipo GET, recebe 1 parâmetro para mostrar a um usuário

         -Parâmetro:
             id     -> obrigatório

         -Retornar:
             Dados específicos do usuário

- **/user/update**

         Rota do tipo PUT, recebe 6 parâmetros para atualizar um usuário

         -Parâmetros:
             id         -> obrigatório
             name       -> obrigatório
             email      -> opcional
             password   -> opcional
                 se você quiser alterar a senha, precisará de mais 2 parâmetros
                 old_password       -> senha atual
                 confirm_passoword  -> igual ao campo de senha
         ** Apenas o usuário pode alterar sua senha e e-mail

         -Retornar:
             Usuário específico atualizado

- **/user/delete**

         Tipo de rota DELETE, receba 1 parâmetro para deletar um usuário

         -Parâmetros:
             id -> obrigatório

# Helpdesk

## Requisitos
- Composer v2.0.13
- Node v14.16.1
- PHP v7.4.19

## Instalação
1. Clonar esse repositório: ```git clone https://github.com/connsecurity/aplicacao-helpdesk```
2. Instalar as dependências do *back-end*: ```composer install```
3. Instalar as dependências e compilar os arquivos do *front-end*: ```npm install && npm run prod```
4. Fazer uma cópia do arquivo .env.example: ```cp .env.example .env```
5. Gerar um código aleatório: ```php artisan key:generate```
6. Criar um *link* simbólico: ```php artisan storage:link```
7. Configurar o arquivo .env:
    - Preencher as informações do banco de dados;
    - Preencher as informações do pusher;
    - Preencher as informações do envio de e-mails.
8. Rodar as migrações e as *seeders*: ```php artisan migrate --seed```
9. Deixar rodando o servidor de filas para escutar eventos assíncronos: ```php artisan queue:work```

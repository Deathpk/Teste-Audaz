# Requerimentos
* Composer na versão mais atual: https://getcomposer.org/download/
* PHP 8.1 >
* Habilitar no php.ini o driver sqli_pdo.

# Instalação
1. Rode o comando ``composer install`` para instalar as dependencias do projeto.
2. No terminal digite `cp .env.example .env` para criar o .env , ou copie e cole env.example e a renomeie.
3. Rode o comando ``php artisan key:generate`` , para gerar uma chave para aplicação no .env .
4. Rode o comando ``php artisan migrate`` , para migrar para as tabelas que serão utilizadas pela aplicação , para seu banco.

# Utilização
1. Na pasta do projeto rode o comando `php artisan serve` para inicializar um servidor local para testes.
2. Rode o comando `php artisan db:seed` , para seedar a tabela operator com um operador para testes. O code do operador criado é OP01.
3. Para testar todos os endpoints criados , utilize o Postman. Fiz uma coleção para o teste , que você pode importar na opção *import* do postman , e selecionando link , vc pode colocar esse link da coleção: https://www.postman.com/collections/e6af23c01e3d95493fde.


### Enjoy :D

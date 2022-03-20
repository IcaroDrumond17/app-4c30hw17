<h1  align="center">Teste Appmax - Ícaro Drumond</h1>
<h3>Projeto: app-4c30hw17</h5>

Esse projeto tem a finalidade de simular o cadastro de produtos e atualizações de estoque registrando cada movimentação. 

Para desenvolvimento desse projeto foi utilizando o Framework **Laravel ** na versão **8.83.4** e o padrão de desenvolvimento **MVC** e **POO** e as demais tecnologias a seguir.

## Tecnologias Utilizadas

<img  src="https://img.shields.io/static/v1?label=Laravel&message=8.83.4&color=FF2D20&style=for-the-badge&logo=laravel"/>

<img  src="https://img.shields.io/static/v1?label=PHP&message=8.0.16&color=777BB4&style=for-the-badge&logo=php"/>

<img  src="https://img.shields.io/static/v1?label=MySQL&message=8.0.28&color=4479A1&style=for-the-badge&logo=MySQL"/>

<img  src="https://img.shields.io/static/v1?label=phpMyAdmin&message=5.1.13&color=F69220&style=for-the-badge&logo=phpMyAdmin"/>

<img  src="https://img.shields.io/static/v1?label=Apache&message=5.1.13&color=FECC00&style=for-the-badge&logo=Apache"/>

<img  src="https://img.shields.io/static/v1?label=Composer&message=1.10.6&color=885630&style=for-the-badge&logo=Composer"/>

<img  src="https://img.shields.io/static/v1?label=Docker&message=20.10.13&color=2496ED&style=for-the-badge&logo=Docker"/>

<img  src="https://img.shields.io/static/v1?label=Bootstrap&message=5.1.3&color=7952B3&style=for-the-badge&logo=Bootstrap"/>

<img  src="https://img.shields.io/static/v1?label=HTML5&message=5.0&color=E34F26&style=for-the-badge&logo=HTML5"/>

<img  src="https://img.shields.io/static/v1?label=CSS3&message=3.0&color=1572B6&style=for-the-badge&logo=CSS3"/>

<img  src="https://img.shields.io/static/v1?label=XAMPP&message= >=3.2.4&color=FB7A24&style=for-the-badge&logo=XAMPP"/>

# Executando a Aplicação

 1. Clonar o repositório disponível em: [https://github.com/IcaroDrumond17/app-4c30hw17](https://github.com/IcaroDrumond17/app-4c30hw17)
 
 2. Acesse a pasta do repositório clonado através do terminal e execute o comando a seguir para instalar as dependências do laravel:
 
 - Linux
	>  `sudo composer install`
- Windows:
	> `composer install`

3. Após a instalação das dependências, é preciso configurar o arquivo padrão **.env** na raiz da aplicação:

	 - 	 Copie o arquivo  **.env.example**  criando um novo arquivo **.env**:
			
			- **Linux**:
				> `cp .env.exemple .env`
			
			- **Windows**: 	
				> `copy .env.exemple .env`
			
4. Para executar a  **aplicação**, pode-se usar o **Docker** ou um software de simulação de ambiente de desenvolvimento local, como o **XAMPP**. 

5. A configuração para acesso a base de dados dentro do arquivo **.env** criado, irá depender de qual meio foi escolhido para rodar a aplicação.

	- **Docker**:
		- `DB_CONNECTION=mysql`
		- `DB_HOST=mysql`
		- `DB_PORT=3306`
		- `DB_DATABASE=appmax`
		- `DB_USERNAME=appmax`
		- `DB_PASSWORD="root"`
		
	- **XAMPP**
		- `DB_CONNECTION=mysql`
		- `DB_HOST=localhost` ou `DB_HOST=127.0.0.1`
		- `DB_PORT=3306`
		- `DB_DATABASE=appmax`
		- `DB_USERNAME=root`
		- `DB_PASSWORD=` ou `DB_PASSWORD="root"`
		
		
6. É preciso também gerar uma chave (**Key**) para a variável "**APP_KEY=**" no arquivo **.env**, usando:

	-  **Docker**
		- Utilize o seguinte comando **DENTRO** da pasta **laradock**, mas para que funcione, é preciso **EXECUTAR** o **workspace**, o que será abordado no tópico "**Utilizando Docker**" a seguir:
			> `php artisan key: generate`
		
	- **XAMPP**
		- Basta rodar o seguinte comando:
			> `php artisan key: generate`
			
7. Observação: pode ser necessário dar permissão para a **pasta de logs** da aplicação **laravel**. Abra o terminal, acesse a pasta do repositório do projeto e execute o seguinte comando:
	
	- **Linux**
		> `sudo chmod -R 777 storage/logs/`
	
	- **Windows**
		> `chmod -R 777 storage/logs/`

## Utilizando Docker 

Foi utilizado o **Laradock** para executar a aplicação utilizando **Docker**, para isso é preciso baixar o repositório do laradock dentro do repositório da sua aplicação. 

1. Entre dentro da pasta do repositório da sua aplicação.

2. Clone o repositório do laradock  acessando [**Laradock**](https://github.com/laradock/laradock), dentro da sua aplicação.

3. Após o download, é preciso configurar o seguintes arquivos:
	
	 - Entre na pasta do repositório do **laradock** clonada e copie o arquivo  **.env.example**  criando um novo arquivo **.env**.
		 
		 - **Linux**:
			> `cp .env.exemple .env`
		
		- **Windows**: 	
			> `copy .env.exemple .env`
			
	- Agora, acesse o arquivo criado **.env** , procure pelas seguintes variáveis e altere conforme os passos a seguir:
		
		- Nome do projeto
			- `COMPOSE_PROJECT_NAME=test_appmax`
		
		- Porta para acesso local (porta da sua escolha)
			- `NGINX_HOST_HTTP_PORT=8090`
		
		- Configuração do banco de dados. É importante definir o **USER** e **PASSWORD** como no exemplo.
			
			- `MYSQL_DATABASE=appmax`
			- `MYSQL_USER=appmax`
			- `MYSQL_PASSWORD=root`
			- `MYSQL_PORT=8306`
			- `MYSQL_ROOT_PASSWORD=root`
			
			- *Obs: A porta **MYSQL_PORT** precisa ser diferente de **3306** para que o não cause conflito com o Docker. No arquivo **.env** da aplicação em si, continua a porta **3306**.*
			
		- Configurando a porta para acesso ao **phpMyAdmin**
			> `PMA_PORT:8081`
		
		- Agora vamos definir uma porta para o **Workspace** para evitar conflitos com o Docker.
			> `WORKSPACE_SSH_PORT=8989`
			
4. Configurado o arquivo **.env** criado, salve o mesmo e execute o comando **Docker** a seguir para subir os containers necessários para rodar a aplicação dentro da pasta laradock.

- **Linux**
	> `sudo docker-compose up -d nginx mysql phpmyadmin`

- **Windows** 
	> `docker-compose up -d nginx mysql phpmyadmin`
	
5. Execute o comando a seguir, se tudo ocorreu bem, os containers irão ser exibidos no terminal.
	
	> `docker-compose ps`
	
	- Lembrando que todos os comandos para configurar o **Docker** devem ser executados **dentro da pasta** do repositório **laradock** clonado dentro da sua aplicação.

6. Para executar os comandos do **artisan**, será necessário entrar no **Workspace** da aplicação, para isso, execute o seguinte comando:
	
	- **Linux**
		> `sudo docker-compose exec --user=root workspace bash`
	
	- **Windows**
		> `winpty docker-compose exec --user=root workspace bash`
	
	- O ***root*** em **---*user*** é o usuário padrão definido no **.env** do laradock.
	
	- Após entrar no **Workspace** já é possível utilizar os comandos do **artisan**.
	
7. Agora basta executar as Migrations

	### Migrations Docker

	- Antes de rodar o projeto é preciso criar a tabelas em nossa base de dados padrão definida no arquivo **.env** dentro da pasta **laradock**: **MYSQL_DATABASE=appmax**.
		
		- Execute o seguinte comando logado no **Workspace**:
			>`php artisan migrate`
		
		- Após a execução, basta executar o próximo comando para verificar o status das migrations executadas.
			> `php artisan migrate:status`
		
		- Pronto, tabelas criadas com sucesso.
		
8. Acesse a URL **localhost:8090** no navegador. A porta 8090, foi configurada na variável no arquivo **.env** na pasta do **laradock** em **NGINX_HOST_HTTP_PORT=8090**. 

9. Se tudo ocorreu bem, visualizará a page home da aplicação.

10. Utilizando Docker não é preciso executar o comando `php artisan serve` 
	para rodar sua aplicação.

## Utilizando XAMPP

1. Baixe o software no site [apachefriends](https://www.apachefriends.org/pt_br/download.html)

	- **Linux**
		1. De permissão para o arquivo instalador:
			> `chmod +x [nome-do-arquivo-baixado]`
			
		2. Execute a instalação pelo terminal usando:
			> `sudo ./[nome-do-arquivo-baixado]`
			
		3. Acesse a pasta onde foi instalado o software e procure pelo arquivo que consta no nome **"manager"**. Talvez, possa ser necessário novamente dar permissão aos diretórios criados pelo software. Para executar o **XAMPP** basta acessar a pasta do software e executar o seguinte comando:
			> `sudo ./manager-linux-x64.run`

		4. Ao abrir a interface do XAMPP, basta "**startar**" o servidor **apache** e o **MySQL**. Se ficarem com o status verde, acesse a URL **"localhost"**.
		
		5. Aparecendo a page home do software, tudo está funcionando normalmente.
		
	- **Windows**
		
		1. Execute o instalador baixado pelo site. Após a conclusão da instalação do XAMPP, abra o atalho criado em sua área de trabalho, abrindo a interface,  basta "**startar**" o servidor **apache** e o **MySQL**. Se ficarem com o status verde, acesse a URL **"localhost"**.
		
		2. Aparecendo page home do software, tudo está funcionando normalmente. 

2. Tanto no **Linux** como no **Windows**, pode ser necessário alterar a porta padrão, que no caso, é a PORTA 80 para que não ocorra conflitos.
 
3. Agora basta rodar as Migrations

	### Migrations XAMPP
	
	- Antes de rodar a aplicação, é preciso criar a nossa base de dados, você poder realizar isso através do sistema de gerenciamento de base de dados, o **phpMyAdmin**, criando uma base de dados por nome **appmax** conforme definido na variável dentro do arquivo **.env**: **DB_DATABASE=appmax**
		
		- Agora basta criar as tabelas dentro de nossa base de dados executando o seguinte comando na raiz de sua aplicação:
			>`php artisan migrate`
		
		- Após a execução, basta executar o comando a seguir para verificar o status das migrations executadas.
			> `php artisan migrate:status`
		
		- Pronto, tabelas criadas com sucesso. 
		
5. Agora execute a aplicação utilizando o seguinte comando dentro da pasta raiz da aplicação:
	> `php artisan serve`
	
	- No terminal será gerado uma **URL**, copie a mesma e abra-a em um navegador.  

6. Aparecendo page home da aplicação, tudo está funcionando normalmente. 

#### Importante!

- Na raiz da sua aplicação consta uma pasta chamada **db** com uma cópia em **.SQL** se caso prefira importar diretamente as tabelas na sua base de dados no **phpMyAdmin**.

### Comandos Artisan que podem ser útil

	
		php artisan cache:clear

		php artisan route:clear

		php artisan config:clear
		
		php artisan config:cache

		php artisan view:clear

		php artisan migrate:refresh

# Rotas

1. Criei uma interface básica para mostrar os dados em uma tabela buscando uma visualização rápida, sei que não foi pedido no teste, mas criei como um bônus, mas é bem básica, utilizando HTML5, CSS3 e Bootstrap de forma básica.

	Para acessar, é o link principal da aplicação.
	- http://localhost:8090/
	ou
	- http://localhost:/
	
2. Para demais ações, é preciso uma ferramenta cliente de **API REST**, como o **Insomnia** ou o **Postman**.
	
	- Todos Produtos
		- `Route: /api/products/`
		- `Type: GET`
		- `Params: search, field, order`
		- `Ex: /api/products?search=2tb&field=nome&desc`
		- Retorna de acordo com os parâmetros passados  um **json** com todos os produtos cadastrados. A ordem dos parâmetros na URL não importam. Funciona sem o envio dos parâmetros também.
		
	- Buscar Produto Específico
		- `Route: /api/products/product/{id}`
		- `Type: GET`
		- `Params: product id`
		- `Ex: /api/products/product/2`
		- Retorna os dados do produto de acordo com seu ID
		
	- Novo Produto
		- `Route: /api/products/new`
		- `Type: POST`
		- `Params: nome, SKU, quantidade`
		- `Ex: /api/products/new`
		- Insere um novo produto.
		
				application/json:
				
				{
					"nome":"SSD 2TB",
					"SKU":"SSD-S-S2-P-2000",
					"quantidade":15
				}
				
				- nome: min:3|max60 caracteres
				- SKU: min:3|max:30 caracteres
				- quantidade: integer
		
	- Editar Produto
	
		- `Route: /api/products/update/{id}`
		- `Type: PUT`
		- `Params: id, nome, SKU, quantidade`
		- `Ex: /api/products/update/2`
		- Atualiza dados de um produto pelo seu id.
		
				application/json
				
				{
					"nome":"SSD 2TB Samsung",
					"SKU":"SSD-S-S2-P-2000",
					"quantidade":15
				}
				
				- nome: min:3|max60 caracteres
				- SKU: min:3|max:30 caracteres
				- quantidade: integer
		
	- Remover Produto
		- `Route: /api/products/delete/{id}`
		- `Type: DELETE`
		- `Params: product id`
		- `Ex: /api/products/delete/2`
		- Exclui um produto pelo seu id.
		
	- Todas as Movimentações de Estoque
		- `Route: /api/movements/`
		- `Type: GET`
		- `Params: search, field, order`
		- `Ex: /api/movements?search=SSD-S-S2-P-2000&field=movements&desc`
		- Retorna de acordo com os parâmetros passados um **json** com todos as movimentações ocorridas no sistema. A ordem dos parâmetros na URL não importam. Funciona sem o envio dos parâmetros também.
	
	- Buscar Movimentação específica de Estoque
		- `Route: /api/movements/movement/{id}`
		- `Type: GET`
		- `Params: movements id`
		- `Ex: /api/movements/movement/2`
		- Retorna os dados da movimentação pelo envio do seu ID
		
	- Adicionar Estoque ao Produto
		- `Route: /api/product/add/{sku}/{quantidade}`
		- `Type: GET`
		- `Params: SKU, quantidade`
		- `Ex: /api/product/add/SSD-S-S2-P-2000/20`
		- Adiciona ao estoque do produto especificado pelo seu SKU, a quantidade enviada como parâmetro.
		
	- Retirar Estoque do Produto
		- `Route: /api/product/sub/{sku}/{quantidade}`
		- `Type: GET`
		- `Params: SKU, quantidade`
		- `Ex: /api/product/sub/SSD-S-S2-P-2000/5`
		- Remove do estoque do produto especificado pelo seu SKU, a quantidade enviada como parâmetro.
	
	- Visualizar na tabela os dados de produtos e movimentações:
		- `localhost:8090/` ou `localhost/`
		- `localhost:8090/home` ou `localhost/home`
		- Retorna em uma interface básica com uma tabela os dados dos produtos cadastrados bem como as movimentações realizadas nesses produtos.

### Importante

- Para utilização das rotas da API, pode ser preciso configurar na ferramenta de **REST API**, no header das requisições, o parâmetro:
	
	- **Accept** : **application/json** 

- Essa configuração pode ser necessária para evitar o bloqueio das requisições pela Aplicação.

## Links / Documentações / Repositórios

- Repositório Github: <https://github.com/IcaroDrumond17/app-4c30hw17>
- Documentação Laravel: <https://laravel.com/docs/8.x>
- Repositório GitHub Laradock: <https://github.com/laradock/laradock>
- Documentação Laradock: <http://laradock.io>
- Docker para Windows: <https://www.docker.com/get-started/>
- Download XAMMP: <https://www.apachefriends.org/pt_br/download.html>
- Documentação Bootstrap: <https://getbootstrap.com>


## Dúvidas?

- Caso precise de ajuda para tirar dúvidas, entre em contato comigo pelo E-mail: icarodrumond.net17@gmail.com.

## Desenvolvedor

- **Ícaro Drumond** - Web Development and Bachelor of Computer Science
- GitHub: <https://github.com/IcaroDrumond17/>
- Linkedin: <https://www.linkedin.com/in/icaro-drumond-1b00b7179/>

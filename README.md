# Process Mapper API

API Laravel totalmente dockerizada usando **Docker Compose** para facilitar o setup do ambiente.

---

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)

---

## Passo 1: Clonar o projeto

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd process-mapper-api
````

---

## Passo 2: Configurar variáveis de ambiente

Crie o arquivo `.env` com base no `.env.example`:

```bash
cp .env.example .env
```

Altere as variáveis do banco de dados se necessário:

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=process_mapper
DB_USERNAME=root
DB_PASSWORD=secret
```

> `DB_HOST=db` funciona porque o serviço MySQL no Docker Compose será chamado `db`.

---

## Passo 3: Docker Compose

### Arquivo `docker-compose.yml`

```yaml
version: "3.9"

services:
  app:
    build: .
    container_name: process-mapper-api
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_DATABASE=process_mapper
      - DB_USERNAME=root
      - DB_PASSWORD=secret
    command: >
      sh -c "composer install &&
             php artisan migrate &&
             php artisan serve --host=0.0.0.0 --port=8000"

  db:
    image: mysql:8.0
    container_name: process-mapper-db
    ports:
      - "3306:3306"
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: process_mapper
    volumes:
      - dbdata:/var/lib/mysql

volumes:
  dbdata:
```

---

## Passo 4: Rodar a aplicação

```bash
docker-compose up -d
```

Isso vai:

1. Buildar a imagem do Laravel
2. Subir o MySQL
3. Rodar `composer install`
4. Rodar `php artisan migrate`
5. Iniciar o servidor Laravel na porta 8000

Acesse a aplicação: [http://localhost:8000](http://localhost:8000)

---

## Passo 5: Comandos úteis

* Parar tudo:

```bash
docker-compose down
```

* Acessar o terminal do container Laravel:

```bash
docker-compose exec app bash
```

* Rodar migrations manualmente (caso necessário):

```bash
php artisan migrate
```

* Parar/reiniciar o container Laravel:

```bash
docker-compose restart app
```

* Ver logs em tempo real:

```bash
docker-compose logs -f
```

---

## Observações

* Todo o ambiente de desenvolvimento é replicável em qualquer computador que tenha Docker + Compose.
* O banco de dados fica persistente no volume `dbdata`.
* Se quiser mudar a porta da aplicação, altere `8000:8000` no `docker-compose.yml`.

---

## Conclusão

Com Docker Compose, basta clonar, ajustar `.env`, e rodar `docker-compose up -d`. A aplicação e o banco de dados estarão funcionando sem precisar instalar PHP, Composer ou MySQL localmente.

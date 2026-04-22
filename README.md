# Process Mapper 

Solução completa para mapeamento de processos com **API em Laravel** e **frontend em React/Next.js**.

---
O projeto foi desenvolvido com as seguintes tecnologias:

* ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
* ![Next.js](https://img.shields.io/badge/Next.js-000?style=for-the-badge&logo=next.js&logoColor=white)
* ![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
* ![React Flow](https://img.shields.io/badge/React%20Flow-FF0073?style=for-the-badge&logo=react&logoColor=white)
* ![Node.js](https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white)
* ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

## Backend (Laravel + Docker)

### Pré-requisitos

- Docker  
- Git  

---

### Configuração

Clone o repositório:

```bash
git clone https://github.com/seu-usuario/process-mapper-api.git
cd process-mapper-api

Crie o arquivo .env:

cp .env.example .env

Ajuste as portas no .env:

APP_PORT=8080
FORWARD_DB_PORT=33060
Subir containers
composer install
./vendor/bin/sail up -d

No Linux, se houver conflito com MySQL:

sudo systemctl stop mysql
Instalar dependências e gerar chave
./vendor/bin/sail composer install
./vendor/bin/sail php artisan key:generate
Importar banco de dados
./vendor/bin/sail mysql < database/backup_completo.sql

# Process Mapper 

Solução completa para mapeamento de processos com **API em Laravel** e **frontend em React/Next.js**.

---

## Tecnologias

- Laravel  
- Next.js  
- Docker  
- React Flow  
- Node.js  

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

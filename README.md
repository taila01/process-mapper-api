Process Mapper API 🚀
Este projeto é uma API em Laravel para mapeamento de processos, configurada para rodar em ambiente Docker utilizando o Laravel Sail.

🛠 Pré-requisitos
Antes de começar, você precisará ter instalado em sua máquina:

Docker Desktop ou Docker Engine.

Git.

📥 Instalação e Configuração
Clonar o repositório:

Bash

git clone https://github.com/seu-usuario/process-mapper-api.git
cd process-mapper-api
Configurar o Ambiente (.env): Copie o arquivo de exemplo e ajuste as portas para evitar conflitos com serviços nativos do seu sistema (como MySQL ou Apache):

Bash

cp .env.example .env
Certifique-se de que as seguintes linhas existam no seu .env:

Snippet de código

APP_PORT=8080
FORWARD_DB_PORT=33060 # Porta para acessar via HeidiSQL/DBeaver
DB_PASSWORD=password
Subir os Containers (Docker):

Bash

./vendor/bin/sail up -d
Nota: Se você tiver um MySQL rodando nativamente no Ubuntu, pare-o antes com sudo systemctl stop mysql para liberar a porta 3306.

Instalar Dependências e Gerar Key:

Bash

./vendor/bin/sail composer install
./vendor/bin/sail php artisan key:generate
🗄 Importando o Banco de Dados
Para que o projeto funcione com os dados já existentes, siga este passo a passo:

Localize o arquivo de backup (ex: database/backup_completo.sql).

Com os containers rodando, execute o comando de importação:

Bash

./vendor/bin/sail mysql < database/backup_completo.sql
Isso criará todas as tabelas e inserirá os dados que foram exportados via HeidiSQL.

🚀 Uso
API: http://localhost:8080

Conexão Banco (HeidiSQL/DBeaver):

Host: 127.0.0.1

Porta: 33060 (ou a definida em FORWARD_DB_PORT)

Usuário: sail

Senha: password

Banco: process_mapper

🛑 Comandos Úteis do Sail
Parar o projeto: ./vendor/bin/sail down

Rodar Migrations: ./vendor/bin/sail php artisan migrate

Ver status dos containers: ./vendor/bin/sail ps

Dicas Finais:
Aqui está o arquivo **README.md** completo, consolidando tanto o Frontend quanto o Backend em um único documento, com formatação profissional, blocos de código destacados e uma estrutura fácil de navegar.

---

```markdown
# 🚀 Process Mapper Ecosystem

Este repositório contém a solução completa para o Mapeamento de Processos, integrada por uma **API robusta em Laravel** e um **Frontend dinâmico em React/Next.js**.

---

## 🛠 Tecnologias Utilizadas

O ecossistema utiliza as tecnologias mais modernas do mercado:

* ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
* ![Next.js](https://img.shields.io/badge/Next.js-000?style=for-the-badge&logo=next.js&logoColor=white)
* ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
* ![React Flow](https://img.shields.io/badge/React%20Flow-FF0073?style=for-the-badge&logo=react&logoColor=white)
* ![Node.js](https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white)

---

## 🏗️ Parte 1: Backend (API Laravel + Docker)

A API gerencia os dados e a lógica de mapeamento, configurada para rodar isolada via **Laravel Sail**.

### 📋 Pré-requisitos
* **Docker Desktop** ou **Docker Engine**.
* **Git**.

### 📥 Configuração Passo a Passo
1. **Clone o repositório:**
   ```bash
   git clone [https://github.com/seu-usuario/process-mapper-api.git](https://github.com/seu-usuario/process-mapper-api.git)
   cd process-mapper-api

```

2. **Configurar Variáveis de Ambiente:**
Crie o arquivo `.env` e ajuste as portas para evitar conflitos:
```bash
cp .env.example .env

```


> **Importante:** Verifique estas linhas no seu `.env`:
> `APP_PORT=8080`
> `FORWARD_DB_PORT=33060`


3. **Subir os Containers:**
```bash
```Primeiro composer install
./vendor/bin/sail up -d

```


*Nota: Se o MySQL nativo estiver rodando no Linux, use `sudo systemctl stop mysql` primeiro.*
4. **Instalar Dependências e Gerar Key:**
```bash
./vendor/bin/sail composer install
./vendor/bin/sail php artisan key:generate

```


5. **Importar Banco de Dados (Backup):**
```bash
./vendor/bin/sail mysql < database/backup_completo.sql

```



---

## 💻 Parte 2: Frontend (React / Next.js)

Interface visual intuitiva construída com React Flow para desenhar os processos.

### 📋 Pré-requisitos

* **Node.js:** Versão 18 ou superior.

### 📥 Configuração Passo a Passo

1. **Acesse a pasta do frontend:**
```bash
cd ../nome-da-pasta-frontend

```


2. **Instalar Dependências:**
```bash
npm install

```


3. **Verificar Instalação:**
```bash
node -v
npm -v

```


4. **Iniciar Servidor de Desenvolvimento:**
```bash
npm run dev

```



---

## 🚀 Acesso e Conexões

| Serviço | URL / Endereço | Credenciais |
| --- | --- | --- |
| **Frontend** | [http://localhost:3000](https://www.google.com/search?q=http://localhost:3000) | - |
| **API Backend** | [http://localhost:8080](https://www.google.com/search?q=http://localhost:8080) | - |
| **Banco de Dados** | `127.0.0.1:33060` | Usuário: `sail` / Senha: `password` |

---

## 🛑 Comandos Úteis (Resumo)

### **Backend (Laravel Sail)**

* **Parar Projeto:** `./vendor/bin/sail down`
* **Rodar Migrations:** `./vendor/bin/sail php artisan migrate`
* **Status dos Containers:** `./vendor/bin/sail ps`

### **Frontend (NPM)**

* **Build para Produção:** `npm run build`
* **Limpeza Total:** `rm -rf node_modules package-lock.json && npm install`

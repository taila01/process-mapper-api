-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.8 - MySQL Community Server - GPL
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para process_mapper
CREATE DATABASE IF NOT EXISTS `process_mapper` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `process_mapper`;

-- Copiando estrutura para tabela process_mapper.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.cache: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.cache_locks: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.job_batches: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.migrations: ~3 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Copiando estrutura para tabela process_mapper.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.processes
CREATE TABLE IF NOT EXISTS `processes` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_processes_sector_id` (`sector_id`),
  KEY `idx_processes_parent_id` (`parent_id`),
  CONSTRAINT `fk_processes_parent` FOREIGN KEY (`parent_id`) REFERENCES `processes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_processes_sector` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.processes: ~4 rows (aproximadamente)
INSERT INTO `processes` (`id`, `sector_id`, `parent_id`, `name`, `description`, `type`, `status`, `created_at`, `updated_at`) VALUES
	('0a1b2c3d-4e5f-6a7b-8c9d-0e1f2a3b4c5d', 'a1b2c3d4-e5f6-7a8b-9c0d-1e2f3a4b5c6d', 'd4e5f6a7-b8c9-0d1e-2f3a-4b5c6d7e8f9a', 'Triagem de Currículos', 'Análise inicial de candidatos.', 'Tático', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('1b2c3d4e-5f6a-7b8c-9d0e-1f2a3b4c5d6e', 'b2c3d4e5-f6a7-8b9c-0d1e-2f3a4b5c6d7e', 'e5f6a7b8-c9d0-1e2f-3a4b-5c6d7e8f9a0b', 'Code Review', 'Revisão de código por pares.', 'Tático', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('d4e5f6a7-b8c9-0d1e-2f3a-4b5c6d7e8f9a', 'a1b2c3d4-e5f6-7a8b-9c0d-1e2f3a4b5c6d', NULL, 'Recrutamento e Seleção', 'Contratação de novos colaboradores.', 'Estratégico', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('e5f6a7b8-c9d0-1e2f-3a4b-5c6d7e8f9a0b', 'b2c3d4e5-f6a7-8b9c-0d1e-2f3a4b5c6d7e', NULL, 'Desenvolvimento de Software', 'Criação de novas funcionalidades.', 'Operacional', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11');

-- Copiando estrutura para tabela process_mapper.process_details
CREATE TABLE IF NOT EXISTS `process_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tools` text COLLATE utf8mb4_unicode_ci,
  `responsibles` text COLLATE utf8mb4_unicode_ci,
  `documentation_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_process_details_process_id` (`process_id`),
  CONSTRAINT `fk_process_details_process` FOREIGN KEY (`process_id`) REFERENCES `processes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.process_details: ~3 rows (aproximadamente)
INSERT INTO `process_details` (`id`, `process_id`, `tools`, `responsibles`, `documentation_url`, `created_at`, `updated_at`) VALUES
	('2c3d4e5f-6a7b-8c9d-0e1f-2a3b4c5d6e7f', 'd4e5f6a7-b8c9-0d1e-2f3a-4b5c6d7e8f9a', 'LinkedIn, Gupy', 'Gestor de RH', 'https://wiki.empresa.com/rh/recrutamento', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('3d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a', 'e5f6a7b8-c9d0-1e2f-3a4b-5c6d7e8f9a0b', 'Jira, GitHub', 'Tech Lead', 'https://wiki.empresa.com/ti/dev-process', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('4e5f6a7b-8c9d-0e1f-2a3b-4c5d6e7f8a9b', '0a1b2c3d-4e5f-6a7b-8c9d-0e1f2a3b4c5d', 'Planilhas', 'Analista Júnior', 'https://wiki.empresa.com/rh/triagem', '2026-02-06 12:13:11', '2026-02-06 12:13:11');

-- Copiando estrutura para tabela process_mapper.sectors
CREATE TABLE IF NOT EXISTS `sectors` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.sectors: ~3 rows (aproximadamente)
INSERT INTO `sectors` (`id`, `name`, `description`, `type`, `status`, `created_at`, `updated_at`) VALUES
	('a1b2c3d4-e5f6-7a8b-9c0d-1e2f3a4b5c6d', 'Recursos Humanos', 'Gestão de pessoas e talentos.', 'Administrativo', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('b2c3d4e5-f6a7-8b9c-0d1e-2f3a4b5c6d7e', 'Tecnologia da Informação', 'Suporte e desenvolvimento.', 'Operacional', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11'),
	('c3d4e5f6-a7b8-9c0d-1e2f-3a4b5c6d7e8f', 'Financeiro', 'Gestão de contas e faturamento.', 'Administrativo', 'Ativo', '2026-02-06 12:13:11', '2026-02-06 12:13:11');

-- Copiando estrutura para tabela process_mapper.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.sessions: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela process_mapper.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela process_mapper.users: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 08/10/2020 às 00:29
-- Versão do servidor: 5.7.31
-- Versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prova`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agentes`
--

CREATE TABLE `agentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `cpf` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `agentes`
--

INSERT INTO `agentes` (`id`, `cpf`, `nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '774.395.130-88', 'Vitor Bento Rezende', '2020-10-03 22:30:04', '2020-10-07 20:32:41', NULL),
(2, '117.117.596-51', 'Daniel Carlos Soares', '2020-10-07 04:19:06', '2020-10-07 17:10:14', NULL),
(3, '920.737.646-65', ' Otávio José Yuri Bernardes', '2020-10-07 04:20:22', '2020-10-07 15:10:02', NULL),
(12, '897.276.103-66', 'José Alves da Silva', '2020-10-07 15:22:29', '2020-10-07 15:47:25', NULL),
(13, '885.136.982-88', ' Marlene Adriana Martins', '2020-10-07 17:12:10', NULL, NULL),
(23, '678.448.320-02', ' Camila Manuela Vieira', '2020-10-07 18:03:05', NULL, NULL),
(24, '934.140.839-30', ' Nicole Heloisa Ester da Mota', '2020-10-07 20:39:29', NULL, NULL),
(25, '614.552.042-69', ' Sueli Bruna Maya Rodrigues', '2020-10-07 20:48:28', NULL, NULL),
(26, '170.581.776-94', ' Natália Isadora Pietra Sales', '2020-10-07 20:49:18', NULL, NULL),
(28, '984.030.919-66', ' Lorena Bruna Isabel Barbosa', '2020-10-07 21:06:09', NULL, NULL),
(29, '901.500.175-88', ' Raul Noah Bento Pinto', '2020-10-07 21:06:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filesize` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetype` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `paciente_id` int(10) UNSIGNED NOT NULL,
  `medico_id` int(10) UNSIGNED NOT NULL,
  `disponibilidade` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `espec` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `espec`, `descricao`) VALUES
(1, 'Alergia e Imunologia', 'diagnóstico e tratamento das doenças alérgicas e do sistema imunológico.'),
(2, 'Anestesiologia', 'área da Medicina que envolve o tratamento da dor, a hipnose e o manejo intensivo do paciente sob intervenção cirúrgica ou procedimentos'),
(3, 'Angiologia', 'é a área da medicina que estuda o tratamento das doenças do aparelho circulatório.'),
(4, 'Oncologia', 'é a especialidade que trata dos tumores malignos ou câncer.'),
(5, 'Cardiologia', 'aborda as doenças relacionadas com o coração e sistema vascular.'),
(6, 'Cirurgia Cardiovascular', 'tratamento cirúrgico de doenças do coração.'),
(7, 'Cirurgia da Mão', 'cuida das doenças das mãos e dos punhos, incluindo os ossos, articulações, tendões, músculos, nervos, vasos e pele'),
(8, 'Cirurgia de cabeça e pescoço', 'tratamento cirúrgico de doenças da cabeça e do pescoço.'),
(9, 'Cirurgia do Aparelho Digestivo', 'tratamento clínico e cirúrgico dos órgãos do aparelho digestório, como o esôfago, estômago, intestinos, fígado e vias biliares, e pâncreas.'),
(10, 'Cirurgia Geral', 'é a área que engloba todas as áreas cirúrgicas, sendo também subdividida.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidade_medico`
--

CREATE TABLE `especialidade_medico` (
  `id` int(11) UNSIGNED NOT NULL,
  `especialidade_id` int(10) UNSIGNED NOT NULL,
  `medico_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `especialidade_medico`
--

INSERT INTO `especialidade_medico` (`id`, `especialidade_id`, `medico_id`) VALUES
(8, 2, 9),
(9, 3, 9),
(10, 5, 9),
(11, 1, 10),
(12, 6, 10),
(13, 8, 10),
(14, 6, 11),
(15, 8, 11),
(16, 10, 11),
(17, 2, 12),
(18, 4, 12),
(19, 5, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `exames`
--

CREATE TABLE `exames` (
  `id` int(10) UNSIGNED NOT NULL,
  `paciente_id` int(10) UNSIGNED NOT NULL,
  `medico_id` int(10) UNSIGNED NOT NULL,
  `arquivo_id` int(10) UNSIGNED NOT NULL,
  `data_exame` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `laudos`
--

CREATE TABLE `laudos` (
  `id` int(10) UNSIGNED NOT NULL,
  `medico_id` int(10) UNSIGNED NOT NULL,
  `exame_id` int(10) UNSIGNED NOT NULL,
  `testes_realizados` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `agente_id` int(10) UNSIGNED NOT NULL,
  `crm` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `medicos`
--

INSERT INTO `medicos` (`id`, `agente_id`, `crm`, `deleted_at`) VALUES
(9, 23, '1044894552', NULL),
(10, 26, '1005644426', NULL),
(11, 28, '1053839925', NULL),
(12, 29, '1048972925', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `agente_id` int(10) UNSIGNED NOT NULL,
  `idade` int(3) DEFAULT NULL,
  `end_rua` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_num` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_bairro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_cidade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_uf` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_complemento` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_cep` char(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `agente_id`, `idade`, `end_rua`, `end_num`, `end_bairro`, `end_cidade`, `end_uf`, `end_complemento`, `end_cep`, `telefone`, `celular`, `deleted_at`) VALUES
(1, 2, 30, 'AV. COM. JACINTO SOARES DE SOUZA LIMA', '468', 'CENTRO', 'UBÁ', 'MG', 'APT 101', '36500091', '(32) 3353-3233', '(32) 9-9994-9523', NULL),
(2, 3, 30, ' Rua João Galdino de Freitas', ' 366', '  Graça', ' Caratinga', 'MG', '', '35305040', '(32) 3232-3232', '(32) 9-9828-1340', NULL),
(3, 12, 30, 'Rua Padre Gailhac', '132', 'Centro', 'Ubá', 'MG', 'teste', '36500101', '(32) 3532-3123', '(32) 9-9898-8989', NULL),
(4, 13, 35, ' Rua dos Chorões', ' 223', ' Loteamento Araguaína Sul', ' Araguaína', 'TO', '', '77827440', '(63) 2899-5864', '(63) 9-8101-7106', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `agente_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `agente_id`, `username`, `password`, `role`) VALUES
(1, 1, 'vitor', '$2y$10$iZUbatD5czZ7xhYcsrQmLOksR7dc9it1siNaHFp1L1HQjAbeT4NdG', 'admin'),
(2, 2, 'daniel', '$2y$10$m5Xufdb.uSfAhcAyAMLz3O16SpuzH5Lmr7wfkTxENqCQ0xGyvv4Yy', 'paciente'),
(3, 3, 'otavio', '$2y$10$V3wujX/JhSiZhMOaDz9Zuux09y7JFEVZx/Prbc16wWnnO4lVaH0aC', 'paciente'),
(4, 12, 'jose', '$2y$10$nuXQngUe5Cc1.p/Iweww4.qblW7O6Adl54bnQJAusQxt2XoZ4LcqO', 'paciente'),
(5, 13, 'marlene', '$2y$10$28bOORW0EpaxFZ8.udniIO0QyqKkO5uQZ3nu8KDoHXwh8ZCcRHlpK', 'paciente'),
(7, 23, 'camila', '$2y$10$8dyrnvIETCp5XnR.GCIdFeohGOXFqKmDs.ccT6n9/a1ZCId/KNTrC', 'medico'),
(8, 24, 'nicole', '$2y$10$9FetAxUfbYLThdqT8SfYi.fml4sPeP68z4fZCwOmy31S6E832YkBu', 'admin'),
(9, 25, 'sueli', '$2y$10$sZRAjRnrK72g.mTQnCGP..ccfn5h681Yjp.ab16z.rhHypErZQX4C', 'admin'),
(10, 26, 'natalia', '$2y$10$oqhgK722kX/LrIw08fY78eRUDY7MWQ1cr31N92TBp.vKq6yYsgJiq', 'medico'),
(11, 28, 'lorena', '$2y$10$jV4ZW9IFA6Ze7s972IkDm.RFJXBNWvJVzMrJaZIg33ROCJp80h1Iy', 'medico'),
(12, 29, 'raul', '$2y$10$Caq8l1befqgVFu4pxncN1u0mxPJnue/ftcPjIQ5.YzbJdboPl0kby', 'medico');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`);

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atendimentos_paciente_id_idx` (`paciente_id`),
  ADD KEY `atendimentos_medico_id_idx` (`medico_id`);

--
-- Índices de tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `especialidade_medico`
--
ALTER TABLE `especialidade_medico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_especialidades_especialidade_id_idx` (`especialidade_id`),
  ADD KEY `fk_medicos_medio_id_idx` (`medico_id`);

--
-- Índices de tabela `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exames_medico_id_idx` (`medico_id`),
  ADD KEY `exames_paciente_id_idx` (`paciente_id`),
  ADD KEY `exames_arquivo_id_idx` (`arquivo_id`);

--
-- Índices de tabela `laudos`
--
ALTER TABLE `laudos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laudos_medico_id_idx` (`medico_id`),
  ADD KEY `laudos_exame_id_idx` (`exame_id`);

--
-- Índices de tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_UNIQUE` (`crm`),
  ADD KEY `fk_agentes_id_medicos_idx` (`agente_id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_agente_agente_id_idx` (`agente_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_agentes_users_agente_id_idx` (`agente_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `especialidade_medico`
--
ALTER TABLE `especialidade_medico`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `exames`
--
ALTER TABLE `exames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `laudos`
--
ALTER TABLE `laudos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `atendimentos_medico_id` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `atendimentos_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `especialidade_medico`
--
ALTER TABLE `especialidade_medico`
  ADD CONSTRAINT `fk_especialidades_especialidade_id` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medicos_medio_id` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `exames`
--
ALTER TABLE `exames`
  ADD CONSTRAINT `exames_arquivo_id` FOREIGN KEY (`arquivo_id`) REFERENCES `arquivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `exames_medico_id` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `exames_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `laudos`
--
ALTER TABLE `laudos`
  ADD CONSTRAINT `laudos_exame_id` FOREIGN KEY (`exame_id`) REFERENCES `exames` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `laudos_medico_id` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `fk_agentes_id_medicos` FOREIGN KEY (`agente_id`) REFERENCES `agentes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_agente_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `agentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_agentes_users_agente_id` FOREIGN KEY (`agente_id`) REFERENCES `agentes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09/09/2026 às 15:50
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `data_nasc`, `cpf`, `endereco`, `telefone`) VALUES
(2, 'Maria Clara', '2011-08-15', '222.222.222-22', 'Rua B, 200', '(11)97777-2222'),
(3, 'André Silva', '1993-12-21', '123.456.789-09', 'teste', '123456789'),
(4, 'Tainá Couto ', '2009-06-17', '123.456.098.09', 'rua não sei ', '(12)345678654');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` int NOT NULL,
  `nome_disciplina` varchar(100) NOT NULL,
  `carga_horaria` int NOT NULL,
  `id_professor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `nome_disciplina`, `carga_horaria`, `id_professor`) VALUES
(1, 'Matemática', 80, 1),
(2, 'Português', 80, 2),
(4, 'Historia', 80, 2),
(5, 'Historia', 80, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int NOT NULL,
  `data_matricula` date NOT NULL,
  `status` enum('Ativa','Trancada','Concluida','Cancelada') NOT NULL,
  `id_aluno` int NOT NULL,
  `id_turma` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `matricula`
--

INSERT INTO `matricula` (`id_matricula`, `data_matricula`, `status`, `id_aluno`, `id_turma`) VALUES
(2, '2026-01-15', 'Ativa', 2, 2),
(4, '2026-06-15', 'Ativa', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `id_professor` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `especialidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `cpf`, `telefone`, `especialidade`) VALUES
(1, 'Carlos Silva', '123.456.789-00', '(11)99999-1111', 'Matemática'),
(2, 'Ana Souza Leite', '987.654.321-00', '(11)99999-2222', 'Português'),
(5, 'José Carlos Silva', '12345678910', NULL, '11977776666'),
(6, 'Vinicios Barbosa', '345.098.098-87', 'excel', '(12)345678902');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id_turma` int NOT NULL,
  `nome_turma` varchar(50) NOT NULL,
  `serie` varchar(20) NOT NULL,
  `ano_letivo` year NOT NULL,
  `id_professor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `nome_turma`, `serie`, `ano_letivo`, `id_professor`) VALUES
(1, 'Turma A', '1º Ano', '2026', 1),
(2, 'Turma B', '2º Ano', '2026', 2),
(4, 'Turma C', '3º Ano', '2026', 1),
(5, 'Turma D', '1º Ano', '2026', 2),
(6, 'Turma E', '2º Ano', '2026', 1),
(7, 'Turma F', '3º Ano', '2026', 2),
(8, 'Turma F', '3º Ano', '2026', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel_acesso` enum('aluno','professor','secretaria','direcao') NOT NULL DEFAULT 'aluno',
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `nivel_acesso`, `token`) VALUES
(1, 'administrador', 'admin@escola.com', '$2y$10$h8/xWIlkDO7PLo2tFbzr9.SPSekqpxfgc9/9gePf6GsCoGCty9wZu', 'aluno', NULL),
(2, 'Aluno Demonstração', 'aluno@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'aluno', 'dc7f97ded43673640143265df7ca43c71192fe171faa29fce82373bfe4884ea7'),
(3, 'Professor Demonstração', 'professor@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'professor', 'b8df3b26d8707e165cef29d13c5f8baa7395153a6786cee92a8233bbf86c1a93'),
(4, 'Secretaria Demonstração', 'secretaria@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'secretaria', 'd364096212326ae0f3757dbb9e5ed354912a3e0f05280e01eca79b9e7c882bd1'),
(5, 'Direção Demonstração', 'direcao@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'direcao', '9c712d4dea94e4b37f6f0035248cdb99948c787ebde4280085030642545c9325');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices de tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_professor`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_matricula` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id_professor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

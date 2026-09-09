-- Execute no banco `escola` depois de criar a tabela `usuario` mostrada na aula.
ALTER TABLE usuario
    ADD COLUMN nivel_acesso ENUM('aluno', 'professor', 'secretaria', 'direcao') NOT NULL DEFAULT 'aluno' AFTER senha;

-- Usuários didáticos; todos usam a senha 123456. Troque-a fora do ambiente de aula.
INSERT INTO usuario (nome, email, senha, nivel_acesso) VALUES
('Aluno Demonstração', 'aluno@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'aluno'),
('Professor Demonstração', 'professor@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'professor'),
('Secretaria Demonstração', 'secretaria@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'secretaria'),
('Direção Demonstração', 'direcao@escola.com', '$2y$10$dfKcn5H/aXYbHFRlAMOOGu/GStcxqaylgPH4eGgh4CMJavQPbj94O', 'direcao');

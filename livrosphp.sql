-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2025 às 01:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `livrosphp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastrodelivros`
--

CREATE TABLE `cadastrodelivros` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('pendente','lido') DEFAULT 'pendente',
  `genero` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `ano_publicacao` int(11) DEFAULT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cadastrodelivros`
--

INSERT INTO `cadastrodelivros` (`id`, `id_usuario`, `titulo`, `autor`, `descricao`, `status`, `genero`, `preco`, `ano_publicacao`, `capa`, `rating`) VALUES
(1, 1, 'Testemunha de Acusação', 'Agatha Christie', 'Fiquei impressionada! É um livro curtinho, mas superou todas as minhas expectativas. É sensacional como Agatha Christie nos prende a cada capítulo. Você se sente parte da investigação, tentando descobrir o assassino junto com os personagens, e o plot twist no final é surpreendente (algo que Agatha sempre faz com maestria). Recomendo demais para todos! Li em uma única noite e fiquei pasma. Este livro me tirou de uma longa ressaca literária', 'lido', NULL, NULL, NULL, 'capa_1.jpg', 5),
(2, 1, 'Jogos Vorazes', 'Suzanne Collins', '**spoiler alert** THIS BOOK! How can this be the best book ever and also have an amazing movie? But it\'s so sad—the context and the story of Kat, her family, and Peeta too. Like how he is treated by his family and the whole purpose of the Hunger Games. Peeta and Kat are so smart, but it\'s truly heartbreaking when Peeta discovers that Kat was (sort of) acting about having feelings for him. It\'s not a love story (at least not the main objective), but the way it describes the Hunger Games—the privileges of the rich compared to others, how each district has a purpose, and how a few manage to help each other survive—is just incredible. A mix of sadness and brilliance.', 'lido', NULL, NULL, NULL, 'capa_6.jpg', 5),
(4, 1, 'Jogo Vorazes: A esperança', 'Suzanne Collins', '**spoiler alert** The best ending—everything they ever deserved from the beginning. I refuse to say anything about Gale because I never trusted him, and that’s it. It’s heartbreaking to see everything Katniss goes through, and when she finally sees Peeta after so long, it’s such a powerful moment. The only thing I hated, but at the same time somewhat understood, was how she treated him afterward. Because if it were the other way around, Peeta would never have left her or given up on helping her! But it happened, and we can’t change that. In the end, everything turned out for the better, and it was a beautiful conclusion to their story.', 'lido', NULL, NULL, NULL, 'capa_2.jpg', 5),
(5, 1, 'O Assassinato de Roger Ackroyd', 'Agatha Christie', '**spoiler alert** I felt like an idiot when I discovered who was guilty, but it was an amazing read. Every detail, and how she made us believe who the murderer could be, kept me hooked. In the end, I was surprised because it might actually be someone you would never have believed. It was, by far, the best for me. ', 'lido', NULL, NULL, NULL, 'capa_4.jpg', 5),
(6, 1, 'O Diário de Anne Frank', 'Anne Frank', 'It\'s so tragic and miserable how humans could do such a thing to others. She could be alive and writing more books, just as she wanted and dreamed of. When the book ended, I felt empty and angry because she was full of hope and a little bit happy. Her words... I truly feel that she thought she was going to write more. I can\'t imagine what it was like for her, being locked in that small place the whole time. It makes me mad how there are people who defend these cruel times.', 'lido', NULL, NULL, NULL, 'capa_5.jpg', 5),
(7, 1, 'Um Corpo Na Biblioteca', 'Agatha Christie', 'What a book! Agatha Christie delivers another brilliant mystery with The Body in the Library. It starts with the shocking discovery of a young woman’s body in a respectable family’s library, and from there, Miss Marple takes charge. Her cleverness and ability to notice the smallest details make this story so satisfying. The twists keep you guessing, and the ending? Completely unexpected. It’s not just about the crime but also about human nature and hidden secrets. Even after years, I still remember how smart and surprising it was. A must-read for any mystery lover!', 'lido', NULL, NULL, NULL, 'capa_7.jpg', 5),
(8, 1, 'The A.B.C. Murders', 'Agatha Christie', 'The ABC Murders is one of Agatha Christie’s most intriguing and clever mysteries. Hercule Poirot is up against a chillingly methodical killer, leaving a trail of victims in alphabetical order and taunting the detective with an ABC railway guide at each scene. What makes this book stand out is how it keeps you on edge. The tension grows with every chapter, and just when you think you’ve figured it out, Christie pulls the rug out from under you. It’s not just about the murders—it’s about the psychology behind them and Poirot’s brilliance in piecing it all together. This story stayed with me because of its unique premise and shocking twists. If you’re looking for a Christie classic that will keep you guessing, this is the one!', 'lido', NULL, NULL, NULL, 'capa_8.jpg', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `foto`, `senha`) VALUES
(1, 'Giovana Marques Silva', 'marquessilvagiovana0@gmail.com', 'img/perfil_1.jpg', '$2y$10$zoqPybuWlqxVEMWRGFBuv.tf5SfyhLVSZg6cd7XbdJilAzZPVd.7y');

-- --------------------------------------------------------

--
-- Estrutura para tabela `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `wishlist`
--

INSERT INTO `wishlist` (`id`, `titulo`, `autor`, `id_usuario`) VALUES
(1, 'Testemunha de Acusação', 'Agatha Christie', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastrodelivros`
--
ALTER TABLE `cadastrodelivros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastrodelivros`
--
ALTER TABLE `cadastrodelivros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cadastrodelivros`
--
ALTER TABLE `cadastrodelivros`
  ADD CONSTRAINT `cadastrodelivros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

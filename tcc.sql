-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/09/2024 às 18:35
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 1090.00, 'on_hold', 1, 123456789, 'Lins', 'Lins SP', '2024-05-23 21:36:49'),
(2, 570.00, 'on_hold', 1, 254525232, 'Lins Lin Lins', 'Lins SP', '2024-05-23 21:40:54'),
(3, 570.00, 'on_hold', 1, 2147483647, 'vcbvcbvdbc', 'ghnfgnfg', '2024-05-23 21:48:04'),
(4, 2700.00, 'on_hold', 1, 123456789, 'Lins', 'Lins SP', '2024-05-28 18:36:17'),
(5, 2700.00, 'on_hold', 1, 123456789, 'Lins', 'Lins SP', '2024-05-28 18:39:02'),
(6, 4500.00, 'on_hold', 1, 2147483647, 'SSSSS', 'AAAAAA', '2024-05-28 18:39:34'),
(7, 900.00, 'on_hold', 1, 2147483647, 'Lins', 'ghnfgnfg', '2024-05-28 19:11:48'),
(8, 1800.00, 'on_hold', 1, 2147483647, 'Lins Lin Lins', 'aaaaaa', '2024-05-28 19:12:09'),
(9, 9999.99, 'on_hold', 7, 123456789, 'Lins', 'Lins SP', '2024-05-29 19:07:28'),
(10, 9999.00, 'on_hold', 7, 2147483647, 'cacaca', 'asasasa', '2024-05-29 19:09:27'),
(11, 190.00, 'on_hold', 7, 2147483647, 'fghfghd', 'gfhsf', '2024-05-29 19:09:58'),
(12, 9999.00, 'on_hold', 7, 2147483647, 'vcbvcbvdbc', 'AAAAAA', '2024-05-29 19:54:19'),
(13, 9999.99, 'on_hold', 8, 2147483647, 'Teste Cidade', 'Rua dos bobos numero 0', '2024-05-29 20:00:39'),
(14, 1800.00, 'Aguardando Pagamento', 9, 2147483647, 'Lins', 'ghnfgnfg', '2024-06-11 20:19:41'),
(15, 1800.00, 'Aguardando Pagamento', 10, 43625427, 'vjtdkytd', 'ftyfdufhkg', '2024-06-11 20:44:12'),
(16, 900.00, 'Aguardando Pagamento', 9, 2147483647, 'Lins', 'ghnfgnfg', '2024-06-11 21:46:06'),
(17, 3469.00, 'Aguardando Pagamento', 9, 31312313, 'Lins Lin Lins', 'reeddwede', '2024-06-11 22:13:17'),
(18, 900.00, 'Aguardando Pagamento', 9, 213123321, 'Lins', 'dsasdda', '2024-06-12 20:10:01'),
(19, 1600.00, 'Aguardando Pagamento', 9, 43625427, 'Lins', 'ghnfgnfg', '2024-06-18 19:14:23'),
(20, 900.00, 'Aguardando Pagamento', 9, 2147483647, 'Lins', 'Lins SP', '2024-06-18 19:15:13'),
(21, 2415.00, 'Aguardando Pagamento', 11, 2147483647, 'Lins', 'ghnfgnfg', '2024-06-20 21:37:21'),
(22, 900.00, 'Aguardando Pagamento', 9, 0, 'cvvcvb', 'cvbvbv', '2024-06-20 21:48:17'),
(23, 1752.00, 'Aguardando Pagamento', 9, 0, 'cvcvc', 'vcvcvcvc', '2024-06-20 21:49:33'),
(24, 349.00, 'Aguardando Pagamento', 12, 2147483647, 'dssada', 'dsads', '2024-07-31 19:43:43'),
(25, 2680.00, 'Aguardando Pagamento', 12, 43625427, 'Lins', 'ghnfgnfg', '2024-09-03 19:40:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 5, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 3, 1, '0000-00-00 00:00:00'),
(2, 6, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 5, 1, '0000-00-00 00:00:00'),
(3, 7, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 1, 1, '0000-00-00 00:00:00'),
(4, 8, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 2, 1, '0000-00-00 00:00:00'),
(5, 9, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 1, 7, '0000-00-00 00:00:00'),
(6, 9, '12', 'TEste testando 123', 'visa.png', 190.00, 3, 7, '0000-00-00 00:00:00'),
(7, 9, '9', 'Computador Gamer', 'bg.jpg', 9999.99, 1, 7, '0000-00-00 00:00:00'),
(8, 10, '9', 'Computador Gamer', 'bg.jpg', 9999.99, 1, 7, '0000-00-00 00:00:00'),
(9, 11, '12', 'TEste testando 123', 'visa.png', 190.00, 1, 7, '0000-00-00 00:00:00'),
(10, 12, '9', 'Computador Gamer', 'bg.jpg', 9999.99, 1, 7, '0000-00-00 00:00:00'),
(11, 13, '9', 'Computador Gamer', 'bg.jpg', 9999.99, 3, 8, '0000-00-00 00:00:00'),
(12, 13, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 2, 8, '0000-00-00 00:00:00'),
(13, 13, '8', 'White Shoes', 'featured1.jpeg', 155.00, 2, 8, '0000-00-00 00:00:00'),
(14, 14, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 2, 9, '0000-00-00 00:00:00'),
(15, 15, '10', 'Lorem alguma coisa ai doido', 'logo.jpg', 900.00, 2, 10, '0000-00-00 00:00:00'),
(16, 16, '16', 'NES (Nintendo)', 'NES.png', 900.00, 1, 9, '0000-00-00 00:00:00'),
(17, 17, '15', 'Super Nintendo ', 'SNES.jpg', 800.00, 3, 9, '0000-00-00 00:00:00'),
(18, 17, '16', 'NES (Nintendo)', 'NES.png', 900.00, 1, 9, '0000-00-00 00:00:00'),
(19, 17, '17', 'Mouse Gamer Redragon Cobra, Chroma RGB, 10000DPI, 7 Botões, Preto', 'REDRAGON.png', 169.00, 1, 9, '0000-00-00 00:00:00'),
(20, 18, '16', 'NES (Nintendo)', 'NES.png', 900.00, 1, 9, '0000-00-00 00:00:00'),
(21, 19, '15', 'Super Nintendo ', 'SNES.jpg', 800.00, 2, 9, '0000-00-00 00:00:00'),
(22, 20, '16', 'NES (Nintendo)', 'NES.png', 900.00, 1, 9, '0000-00-00 00:00:00'),
(23, 21, '23', 'Mouse Gamer Sem Fio Logitech G703 LIGHTSPEED com RGB LIGHTSYNC, 6 Botões Programáveis, Sensor HERO 2', 'logi.png', 415.99, 1, 11, '0000-00-00 00:00:00'),
(24, 21, '15', 'Super Nintendo ', 'SNES.jpg', 800.00, 1, 11, '0000-00-00 00:00:00'),
(25, 21, '21', 'Fliperama Bartop Arcade com mais de 3.500 jogos', 'flip.png', 1200.00, 1, 11, '0000-00-00 00:00:00'),
(26, 22, '16', 'NES (Nintendo)', 'NES.png', 900.00, 1, 9, '0000-00-00 00:00:00'),
(27, 23, '21', 'Fliperama Bartop Arcade com mais de 3.500 jogos', 'flip.png', 1200.00, 1, 9, '0000-00-00 00:00:00'),
(28, 23, '22', 'Console Atari Flashback, 110 jogos, Tectoy - CX 1 UN', 'atari.png', 552.00, 1, 9, '0000-00-00 00:00:00'),
(29, 24, '17', 'Mouse Gamer Redragon Cobra, Chroma RGB, 10000DPI, 7 Botões, Preto', 'REDRAGON.png', 169.00, 1, 12, '0000-00-00 00:00:00'),
(30, 24, '20', '\r\n\r\nProcessador gamer Intel Core i5-4590 BX80646I54590 de 4 núcleos e 3.7GHz de frequência com gráfi', 'intel.png', 180.00, 1, 12, '0000-00-00 00:00:00'),
(31, 25, '40', 'Water Cooler Rise Mode Aura Frost Pro, ARGB, 360mm, AMD/Intel, Branco - RM-WCF-07-ARGB', 'water.jpeg', 344.90, 1, 12, '0000-00-00 00:00:00'),
(32, 25, '23', 'Mouse Gamer Sem Fio Logitech G703 LIGHTSPEED com RGB LIGHTSYNC, 6 Botões Programáveis, Sensor HERO 2', 'logi.png', 415.99, 1, 12, '0000-00-00 00:00:00'),
(33, 25, '39', 'Placa de Vídeo RTX 4060 VENTUS 2x Black OC MSI NVIDIA GeForce, 8GB GDDR6, DLSS, Ray Tracing', 'placa1.jpeg', 1919.99, 1, 12, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(15, 'Super Nintendo ', 'videogames', 'Super Nintendo FAT com 32 jogos ', 'SNES.jpg', 'SNES2.jpg', 'SNES3.jpg', 'SNES4.jpg', 800.00, NULL, 'Branco'),
(16, 'NES (Nintendo)', 'videogames', 'NES Nintendinho com 10 mil jogos anos 80', 'NES.png', 'NES2.png', 'NES3.png', 'NES4.png', 900.00, NULL, 'BRANCO'),
(17, 'Mouse Gamer Redragon Cobra, Chroma RGB, 10000DPI, 7 Botões, Preto', 'perifericos', '- Sensor PIXART PMW3325 (10000 DPI/20G/100ips)\r\n- Iluminação RGB Ajustável\r\n- Sistema de Iluminação Chroma RGB\r\n- Polling Rate de 1000hz\r\n- 7 Botões Programáveis', 'REDRAGON.png', 'REDRAGON2.png', 'REDRAGON3.png', 'REDRAGON4.png', 169.00, NULL, 'PRETO'),
(20, '\r\n\r\nProcessador gamer Intel Core i5-4590 BX80646I54590 de 4 núcleos e 3.7GHz de frequência com gráfi', 'pecas', 'Modelo: i5-4590\r\nExecute programas de edição de vídeo, criação de conteúdo, streaming e videogame sem afetar o desempenho do dispositivo.\r\nMemória cache de 6 MB, rápida e volátil.\r\nProcessador gráfico Intel HD Graphics 4600.\r\nSuporta memória RAM DDR3.\r\nSu', 'intel.png', 'intel2.png', 'intel3.png', 'intel4.png', 180.00, NULL, NULL),
(23, 'Mouse Gamer Sem Fio Logitech G703 LIGHTSPEED com RGB LIGHTSYNC, 6 Botões Programáveis, Sensor HERO 2', 'perifericos', 'Sensor Hero 25K com rastreamento máximo de 25.600 DPI\r\nTecnologia sem fio LIGHTSPEED\r\nCompatível com POWERPLAY\r\nDesign confortável com laterais emborrachadas e peso opcional de 10g\r\nTecnologia avançada de botões com tensionamento de botão de mola de metal', 'logi.png', 'logi.png', 'logi2.png', 'logi3.png', 415.99, NULL, NULL),
(31, 'Console Atari C/2 Controles', 'videogames', 'O Atari 2600+ foi projetado para se parecer com o Atari 2600 de 4 interruptores, lançado em 1980. Esta versão moderna também joga jogos do Atari 7800, tem um modo de tela ampla, conecta-se facilmente a uma TV moderna e inclui um 10- cartucho de jogo em 1 ', 'atari1.png', 'atari2.png', 'atari3.png', 'atari1.png', 555.90, 0, '0'),
(35, 'Console Sega Mega Drive Mini - Genesis', 'videogames', 'O icônico console SEGA Genesis, que definiu uma geração de jogos, retorna em uma unidade lisa e miniaturizada. O console SEGA Genesis Mini é carregado com 42 jogos lendários e é plug and play pronto para a direita fora da caixa! \r\n\r\nPrincipais Característ', 'megadrive.jpg', 'megadrive2.jpg', 'megadrive3.jpg', 'megadrive.jpg', 972.30, 0, '0'),
(37, 'Teclado Gamer Redragon Lakshmi, Switch Brown, Layout 60%, ABNT2 , Preto - K606-OG&GY&BK (PT-BROWN)', 'perifericos', 'Características:\r\n\r\n- Marca: Redragon\r\n\r\n- Modelo: K606-OG&GY&BK\r\n\r\n- Cor: Preto, Cinza e Laranja\r\n\r\n \r\n\r\nEspecificações:\r\n\r\n \r\n\r\n- Switches: Redragon MK II\r\n\r\n- Acionamento: Mecânico\r\n\r\n- DIY: Sim\r\n\r\n- COR: Amarelo, Branco e Cinza\r\n\r\n- Formato: 60% \r\n\r\n-', 'teclado1.jpeg', 'teclado2.jpeg', 'teclado3.jpeg', 'teclado1.jpeg', 159.99, 0, '0'),
(38, 'Teclado Mecânico Gamer HyperX Alloy Origins Core, RGB, Switch HyperX Red, ABNT2 - 4P5P3A2#AC4', 'perifericos', 'Características:\r\n- Marca: HyperX\r\n- Modelo: HX-KB7RDX-BR\r\n\r\n\r\nEspecificações:\r\n\r\n- Acionamento: HyperX Switch\r\n\r\n- Tipo: Mecânico\r\n\r\n- Layout: ABNT2\r\n\r\n- Backlight: RGB (16,777,216 colors)\r\n\r\n- Efeitos de luz: iluminação RGB por tecla e 5 níveis de brilh', 'teclado1-2.jpeg', 'teclado2-2.jpeg', 'teclado3-2.jpeg', 'teclado1-2.jpeg', 544.99, 0, '0'),
(39, 'Placa de Vídeo RTX 4060 VENTUS 2x Black OC MSI NVIDIA GeForce, 8GB GDDR6, DLSS, Ray Tracing', 'pecas', 'Placa de Vídeo MSI NVIDIA GeForce RTX 4060 VENTUS 2X Black 8G OC\r\n \r\n\r\nLeve o Essencial\r\nO VENTUS traz uma experiência fundamentalmente sólida para usuários que procuram uma placa gráfica de alto desempenho. Um design atualizado de aparência nítida com o ', 'placa1.jpeg', 'placa2.jpeg', 'placa3.jpeg', 'placa1.jpeg', 1919.99, 0, '0'),
(40, 'Water Cooler Rise Mode Aura Frost Pro, ARGB, 360mm, AMD/Intel, Branco - RM-WCF-07-ARGB', 'pecas', 'Características:\r\n\r\n- Marca: Rise Mode\r\n\r\n- Modelo: RM-WCF-07-ARGB\r\n\r\n\r\nEspecificações:\r\n\r\n- TDP: 250W\r\n- Tamanho do fan: 120x120x25mm (3x)\r\n- ARGB - 5v motherboard (Compatível apenas com placas mãe com entrada ARGB 5v)\r\n- Velocidade do fan: 1200-2000RPM\r', 'water.jpeg', 'water2.jpeg', 'water3.jpeg', 'water.jpeg', 344.90, 0, '0'),
(41, 'SSD 500 GB XPG Spectrix S20G, M.2 2280, PCIe Gen3x4, Leitura: 2500 MB/s e Gravação: 1800 MB/s, 3D NA', 'pecas', 'SSD 500 GB XPG Spectrix S20G, M.2 2280\r\n \r\n\r\nO XPG SPECTRIX S20G é um SSD totalmente dedicado para jogos e seu estilo reflete isso. Possui um design RGB distinto e proeminente em forma de x que ofusca a concorrência. Os efeitos de luz RGB podem ser person', 'ssd1.jpeg', 'ssd2.jpeg', 'ssd3.jpeg', 'ssd1.jpeg', 329.99, 0, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(9, 'Kauan', 'ysloopinho2006@outlook.com', '$2y$10$ChqUVNaL/u.0.7oihW4yPupDRgyLmGSMlds0TuUSHItXjCAAcDfR.'),
(11, 'lll', 'teste@gmail.com', '$2y$10$76w/bVhU1b7f1YIFIzBz1.oJy2HyaNrWu.88TiB5DiOAhyknAnLiO'),
(12, 'Kauan', 'meuemail@gmail.com', '$2y$10$LlllSzciSYvAk9Rgqktxn.O2pb0mpqREDF2jPHLDs5HZLfbnQlHvK'),
(13, 'Kauan', 'tt@gmail.com', '$2y$10$h6I6p/oj37ME4s1OJH3EE.LeTTHwcbLB/HxnLY44gTJNUxVCID67.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

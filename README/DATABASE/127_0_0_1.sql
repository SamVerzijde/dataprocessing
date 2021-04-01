-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 apr 2021 om 11:22
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minecraft`
--
CREATE DATABASE IF NOT EXISTS `minecraft` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `minecraft`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `biome`
--

CREATE TABLE `biome` (
  `id` int(11) NOT NULL,
  `biome` varchar(25) NOT NULL,
  `rarity` varchar(25) NOT NULL,
  `temperature` decimal(15,2) NOT NULL,
  `type` varchar(25) NOT NULL,
  `blocks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `biome`
--

INSERT INTO `biome` (`id`, `biome`, `rarity`, `temperature`, `type`, `blocks`) VALUES
(1, 'badlands', 'rare', '2.00', 'dry_warm', 'red_sand, sand, cactus'),
(2, 'beach', 'common', '0.80', 'medium_lush', 'sand, clay, gravel'),
(3, 'birch_forest', 'common', '0.60', 'temperate_lush', 'grass_block, dirt, bee_nest'),
(4, 'dark_forest', 'common', '0.70', 'medium_mild', 'acacia_log, dirt, grass_block'),
(5, 'desert', 'common', '3.00', 'dry_warm', 'sand, cactus, gold'),
(6, 'forest', 'common', '0.70', 'temperate_lush', 'oak_log, oak_leaves, grass_block, dirt'),
(7, 'ice_spikes', 'rare', '0.00', 'snowy_icy', 'ice, snow'),
(8, 'jungle', 'rare', '0.95', 'medium_lush', 'grass_block, dirt, jungle_log, bee_nest, cocoa'),
(9, 'mountains', 'common', '0.20', 'cold', 'stone, emerald, gravel, gold'),
(10, 'nether', 'common', '2.00', 'nether', 'netherrack, nether_quartz_ore'),
(11, 'plains', 'common', '0.80', 'temperate_lush', 'grass_block ,dirt'),
(12, 'savanna', 'common', '1.20', 'dry_warm', 'sand, cactus, gravel, gold'),
(13, 'snowy_tundra', 'uncommon', '0.00', 'snowy_icy', 'ice, snow, stone, gravel'),
(14, 'swamp', 'common', '0.80', 'medium_mild', 'grass_block, dirt, sand, gravel'),
(15, 'taiga', 'common', '0.25', 'cold', 'grass_block, dirt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `block` varchar(25) NOT NULL,
  `biome` varchar(25) NOT NULL,
  `renewable` int(11) NOT NULL,
  `tool` varchar(25) NOT NULL,
  `flammable` int(11) NOT NULL,
  `breaking_time` decimal(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `block`
--

INSERT INTO `block` (`id`, `block`, `biome`, `renewable`, `tool`, `flammable`, `breaking_time`) VALUES
(1, 'acacia_log', 'dark_forest', 1, 'iron', 1, '3.00'),
(2, 'bee_nest', 'jungle', 1, 'iron', 1, '0.45'),
(3, 'cactus', 'desert, savanna, badlands', 1, 'wooden', 0, '0.60'),
(4, 'clay', 'beach', 1, 'stone', 0, '0.90'),
(5, 'cocoa', 'jungle', 1, 'wooden', 0, '0.30'),
(6, 'dirt', 'taiga, plains, forest', 0, 'wooden', 0, '0.75'),
(7, 'emerald', 'mountains', 0, 'diamond', 0, '15.00'),
(8, 'gold', 'desert', 0, 'diamond', 0, '15.00'),
(9, 'grass_block', 'taiga, plains, forest, bi', 1, 'wooden', 0, '0.90'),
(10, 'gravel', 'snowy_tundra, mountains, ', 1, 'stone', 0, '0.90'),
(11, 'ice', 'snowy_tundra, ice_spikes', 1, 'stone', 0, '0.75'),
(12, 'jungle_log', 'jungle', 1, 'iron', 1, '3.00'),
(13, 'netherrack', 'nether', 0, 'iron', 0, '2.00'),
(14, 'nether_quartz_ore', 'nether', 0, 'iron', 0, '15.00'),
(15, 'oak_leaves', 'forest', 1, 'wooden', 1, '0.30'),
(16, 'oak_log', 'forest', 1, 'iron', 1, '3.00'),
(17, 'red_sand', 'badlands', 1, 'wooden', 0, '0.75'),
(18, 'sand', 'beach, desert, savanna, b', 1, 'wooden', 0, '0.75'),
(19, 'snow', 'snowy_tunda, ice_spikes', 1, 'wooden', 0, '0.50'),
(20, 'stone', 'snowy_tundra, mountains', 1, 'diamond', 0, '7.50');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ore`
--

CREATE TABLE `ore` (
  `id` int(11) NOT NULL,
  `ore` varchar(25) NOT NULL,
  `tool` varchar(25) NOT NULL,
  `abundance` varchar(25) NOT NULL,
  `biome` varchar(25) NOT NULL,
  `most_found_in_layers` varchar(25) NOT NULL,
  `none_at_or_above` int(11) NOT NULL,
  `rare_on_layers` varchar(25) NOT NULL,
  `commonly_up_to_layers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `ore`
--

INSERT INTO `ore` (`id`, `ore`, `tool`, `abundance`, `biome`, `most_found_in_layers`, `none_at_or_above`, `rare_on_layers`, `commonly_up_to_layers`) VALUES
(1, 'ancient_debris', 'diamond', 'very_rare', 'nether', '13_17', 120, '22_119', 23),
(2, 'coal', 'wooden', 'very_common', 'taiga', '5_32', 132, '129_131', 128),
(3, 'diamond', 'iron', 'rare', 'swamp', '5_12', 16, '13_15', 12),
(4, 'emerald', 'iron', 'very_rare', 'mountains', '5_29', 33, '30_32', 29),
(5, 'gold', 'iron', 'uncommon', 'savanna', '5_29', 34, '31_33', 29),
(6, 'iron', 'stone', 'common', 'plains', '5_54', 64, '62_63', 62),
(7, 'lapis_lazuli', 'stone', 'rare', 'forest', '13_17', 0, '31_33', 23),
(8, 'nether_gold', 'wooden', 'common', 'nether', '15', 117, '96_116', 95),
(9, 'nether_quartz', 'wooden', 'very_common', 'nether', '10_114', 128, '123_125', 120),
(10, 'redstone', 'iron', 'uncommon', 'dark_forest', '5_12', 16, '13_15', 12);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `biome`
--
ALTER TABLE `biome`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ore`
--
ALTER TABLE `ore`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `biome`
--
ALTER TABLE `biome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `ore`
--
ALTER TABLE `ore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

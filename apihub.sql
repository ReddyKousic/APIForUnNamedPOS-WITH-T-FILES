-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 04:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apihub`
--

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id` int(50) NOT NULL,
  `sid` varchar(90) NOT NULL,
  `profile` int(11) NOT NULL,
  `interests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `sid`, `profile`, `interests`) VALUES
(79, 'Vbqe0tUn4GaZY6WbEwQxk2YW82Hh7Y', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `tokenid` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `token` varchar(600) NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `aid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`tokenid`, `id`, `username`, `token`, `valid`, `aid`) VALUES
(47, 99, 'kousic', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImtvdXNpYyIsImlwIjoiMTI3LjAuMC4xIiwiZXhwIjoxNjkzMzkxNjY4LCJ1c2VyX2FnZW50IjoiTW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzExNi4wLjAuMCBTYWZhcmkvNTM3LjM2Iiwic2lkIjoiV2E2WURLSXFsSlhvTXU4WnlGQVFYMHVDS3lFeUE5S2x2NjAifQ.EUgqzcyfP7noAC5ZmvM9uJ9NaEPv-xo3jwNJlpxyj4s', 1, '1rjBP92uzr9Q0aGFOblODonid3vbO8a618zaS1f4lm0K30hwFk'),
(48, 100, 'kousic2211', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImtvdXNpYzIyMTEiLCJpcCI6IjEyNy4wLjAuMSIsImV4cCI6MTY5MzM5NDgzMywidXNlcl9hZ2VudCI6Ik1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xMTYuMC4wLjAgU2FmYXJpLzUzNy4zNiIsInNpZCI6InRzRm5Na2dxa1d5WUN1WjRQRXRHTThPdExIcnlCRUxUdmhvTiJ9.XWWaohXH_fBn_TPdqZQJXUti6SKW7TvlSg_AWgxiLWA', 1, 'F2H6xGkdflFc3hAZm833q6y8khShcMoHD6TpxWF0BRsNmh5RWV'),
(49, 101, 'test1', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InRlc3QxIiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTM0NTQ4MTgsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTE2LjAuMC4wIFNhZmFyaS81MzcuMzYiLCJzaWQiOiJSd0FXbktHWDZPekVjNmxJTVJzOWVUMXlWcDFaUGRyWiJ9.NPDuRYKGnTpXZjPISgDgkaD2JTAerxX3oyC-ME-51_4', 1, 'fchfRO4lgT0xFtYyAw6me82JgtcOVTSJRFIoMPxWrocBhHPcFc'),
(50, 102, 'test2', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InRlc3QyIiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTM0NTU3NDAsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTE2LjAuMC4wIFNhZmFyaS81MzcuMzYiLCJzaWQiOiJrNHBvWDJ6YkdHanJFdVUyZUlIN3lhUWJicjcybVdGbjA0VWhHbjdwIn0.dFehTLXS9PiBPSinO5yFvT_TZVJX1VGByGcaoIidY2Y', 1, 'g5tjoNV5Xt7qNrAGm2E99ZhzaoUDlPFXTcoP3qLaC6c9iQlXaf'),
(51, 102, 'test2', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InRlc3QyIiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTM0NTYwNjIsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoTGludXg7IEFuZHJvaWQgNi4wOyBOZXh1cyA1IEJ1aWxkL01SQTU4TikgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzExNi4wLjAuMCBNb2JpbGUgU2FmYXJpLzUzNy4zNiIsInNpZCI6Ims0cG9YMnpiR0dqckV1VTJlSUg3eWFRYmJyNzJtV0ZuMDRVaEduN3AifQ.tQ7iaFwHjqa9QujvPAL7Xq30MI9pVpsnkBoGeeeILrg', 1, 'g5tjoNV5Xt7qNrAGm2E99ZhzaoUDlPFXTcoP3qLaC6c9iQlXaf'),
(52, 103, 'test3', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InRlc3QzIiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTM0NTYxMjIsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoTGludXg7IEFuZHJvaWQgNi4wOyBOZXh1cyA1IEJ1aWxkL01SQTU4TikgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzExNi4wLjAuMCBNb2JpbGUgU2FmYXJpLzUzNy4zNiIsInNpZCI6IkNuVUVwMWNjTVB3TlJOZk1rd2gySlpzcGdkclpnaGFFYTBKMUthTzkifQ.nhaCPpfpwMyPc7DmXWaxZNfddIDtDjg4WUfsW3EpX2Q', 1, 'um5wTploksPZUbUxGiXeKLeZt6fHNS1aXcRzhMDYF1lbw0bKcy'),
(53, 104, 'kousic1', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImtvdXNpYzEiLCJpcCI6IjEyNy4wLjAuMSIsImV4cCI6MTY5MzkyOTg5MSwidXNlcl9hZ2VudCI6Ik1vemlsbGEvNS4wIChXaW5kb3dzIE5UIDEwLjA7IFdpbjY0OyB4NjQpIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS8xMTYuMC4wLjAgU2FmYXJpLzUzNy4zNiIsInNpZCI6Imp2Yjg5SzFrVnZxOHdCdUpzbWN6eUJWWTRWZkw1YzAifQ.JV-gwq7dwUlxg7seiyOM9mJfpJi5-23Io9KLZVhsdJA', 1, 'vmXh8xzvHwjI5N59zS92VwpmbbZlN0ToRLTNMeZoDaCOCfl2AT'),
(54, 105, 'virat', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InZpcmF0IiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTQwMTgxOTEsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTE2LjAuMC4wIFNhZmFyaS81MzcuMzYiLCJzaWQiOiJqREVNZ0VTTjdSMXY5aGx6c2tQQWtGdWliQ2NJM3llQ3JaUjJXZCJ9.P-cs97dCvwOIOo5u9nCdCshi43qZD-oJ-vm8cihjJ80', 1, 'MT5uB8sCwOjHniteXdZ7RQpwQmcdP4yZQ2loGfOFqkGlFH8tDk'),
(55, 106, 'kousic21', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImtvdXNpYzIxIiwiaXAiOiIxMjcuMC4wLjEiLCJleHAiOjE2OTQ1MjY4NjAsInVzZXJfYWdlbnQiOiJNb3ppbGxhLzUuMCAoV2luZG93cyBOVCAxMC4wOyBXaW42NDsgeDY0KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTE2LjAuMC4wIFNhZmFyaS81MzcuMzYiLCJzaWQiOiJWYnFlMHRVbjRHYVpZNldiRXdReGsyWVc4MkhoN1kifQ.T1RvrfZz17DbF2DTXdbj_LbZ0i-a04VtttxfIFB7-q0', 1, 'cdk5Mim60RIjJckSZW85Uh1WXhvbeTnq4faHgAsRYKNGm8ZiFR');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `aid` varchar(100) NOT NULL,
  `sid` varchar(100) NOT NULL,
  `datetime` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `aid`, `sid`, `datetime`) VALUES
(106, 'kousic21', '$argon2id$v=19$m=65536,t=3,p=4$lleD1jRmaFWxC2wxrs/d2A$JzRzaGNo9hceXEgCia06W5+6+oPWR1yNGKxk2tWS4sY', 'cdk5Mim60RIjJckSZW85Uh1WXhvbeTnq4faHgAsRYKNGm8ZiFR', 'Vbqe0tUn4GaZY6WbEwQxk2YW82Hh7Y', 'Sep 11 2023 07:24PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sid` (`sid`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`datetime`),
  ADD KEY `username` (`username`),
  ADD KEY `aid` (`aid`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `tokenid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

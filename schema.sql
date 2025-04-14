-- Struttura della tabella `accounts`
CREATE TABLE `accounts` (
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `isValidator` tinyint(1) DEFAULT 0,
  `isWriter` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struttura della tabella `categories`
CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struttura della tabella `hotwords`
CREATE TABLE `hotwords` (
  `idHotword` int(11) NOT NULL,
  `hotword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struttura della tabella `posthotwords`
CREATE TABLE `posthotwords` (
  `hotword` int(11) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struttura della tabella `posts`
CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  `validator` int(11) DEFAULT NULL,
  `addedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `validatedAt` datetime DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struttura della tabella `users`
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `account` varchar(255) NOT NULL,
  `avatarPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Indici per le tabelle scaricate

-- Indici per la tabella `accounts`
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`);

-- Indici per la tabella `categories`
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

-- Indici per la tabella `hotwords`
ALTER TABLE `hotwords`
  ADD PRIMARY KEY (`idHotword`);

-- Indici per la tabella `posthotwords`
ALTER TABLE `posthotwords`
  ADD PRIMARY KEY (`hotword`,`post`),
  ADD KEY `post` (`post`);

-- Indici per la tabella `posts`
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `category` (`category`),
  ADD KEY `author` (`author`),
  ADD KEY `validator` (`validator`);

-- Indici per la tabella `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `account` (`account`);

-- AUTO_INCREMENT per le tabelle scaricate

-- AUTO_INCREMENT per la tabella `categories`
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- AUTO_INCREMENT per la tabella `hotwords`
ALTER TABLE `hotwords`
  MODIFY `idHotword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

-- AUTO_INCREMENT per la tabella `posts`
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

-- AUTO_INCREMENT per la tabella `users`
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

-- Limiti per le tabelle scaricate

-- Limiti per la tabella `posthotwords`
ALTER TABLE `posthotwords`
  ADD CONSTRAINT `posthotwords_ibfk_1` FOREIGN KEY (`hotword`) REFERENCES `hotwords` (`idHotword`),
  ADD CONSTRAINT `posthotwords_ibfk_2` FOREIGN KEY (`post`) REFERENCES `posts` (`postId`);

-- Limiti per la tabella `posts`
ALTER TABLE `posts`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `category` FOREIGN KEY (`category`) REFERENCES `categories` (`catId`),
  ADD CONSTRAINT `validator` FOREIGN KEY (`validator`) REFERENCES `users` (`uid`);

-- Limiti per la tabella `users`
ALTER TABLE `users`
  ADD CONSTRAINT `account` FOREIGN KEY (`account`) REFERENCES `accounts` (`email`);

INSERT INTO `categories` (`catId`, `catName`) VALUES
(1, 'Tech'),
(2, 'Science'),
(4, 'Math'),
(5, 'Other');
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 07:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookrentalapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `availability` enum('Available','Rented') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `genre`, `publication_date`, `isbn`, `available`, `created_at`, `updated_at`, `availability`) VALUES
(1, '1984', 'George Orwell', 'Dystopian', '1949-06-08', '9780451524935', 1, '2024-11-04 14:22:47', '2024-11-05 17:51:16', 'Available'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 'Classic', '1960-07-11', '9780060935467', 1, '2024-11-04 14:22:47', '2024-11-05 17:47:56', 'Available'),
(113, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', '1925-04-10', '9780743273565', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(114, 'Moby Dick', 'Herman Melville', 'Adventure', '1851-10-18', '9781503280786', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(115, 'Pride and Prejudice', 'Jane Austen', 'Romance', '1813-01-28', '9781503290563', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(116, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', '1951-07-16', '9780316769488', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(117, 'Brave New World', 'Aldous Huxley', 'Dystopian', '1932-08-01', '9780060850524', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(118, 'The Alchemist', 'Paulo Coelho', 'Fiction', '1988-05-01', '9780061122415', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(119, 'The Hobbit', 'J.R.R. Tolkien', 'Fantasy', '1937-09-21', '9780547928227', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(120, 'War and Peace', 'Leo Tolstoy', 'Historical Fiction', '1869-01-01', '9781420954218', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(121, 'The Picture of Dorian Gray', 'Oscar Wilde', 'Fiction', '1890-07-01', '9781505290432', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(122, 'Crime and Punishment', 'Fyodor Dostoevsky', 'Psychological Fiction', '1866-01-01', '9780486415864', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(123, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'Philosophical Fiction', '1880-11-01', '9780374528379', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(124, 'Wuthering Heights', 'Emily Brontë', 'Romance', '1847-12-01', '9780142437209', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(125, 'Jane Eyre', 'Charlotte Brontë', 'Romance', '1847-10-16', '9780142437259', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(126, 'Fahrenheit 451', 'Ray Bradbury', 'Dystopian', '1953-10-19', '9781451673319', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(127, 'The Grapes of Wrath', 'John Steinbeck', 'Historical Fiction', '1939-04-14', '9780143039433', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(128, 'The Old Man and the Sea', 'Ernest Hemingway', 'Literary Fiction', '1952-09-01', '9780684830490', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(129, 'The Fault in Our Stars', 'John Green', 'Young Adult', '2012-01-10', '9780142424179', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(130, 'The Hunger Games', 'Suzanne Collins', 'Dystopian', '2008-09-14', '9780439023528', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(131, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', '1997-09-01', '9780590353427', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(132, 'The Chronicles of Narnia', 'C.S. Lewis', 'Fantasy', '1950-10-16', '9780066238500', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(133, 'A Tale of Two Cities', 'Charles Dickens', 'Historical Fiction', '1859-04-30', '9780451530578', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(134, 'Catch-22', 'Joseph Heller', 'Satire', '1961-11-10', '9781451626650', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(135, 'The Road', 'Cormac McCarthy', 'Dystopian', '2006-09-26', '9780307387899', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(136, 'Slaughterhouse-Five', 'Kurt Vonnegut', 'Science Fiction', '1969-03-31', '9780385333217', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(137, 'The Handmaid\'s Tale', 'Margaret Atwood', 'Dystopian', '1985-04-17', '9780385490818', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(138, 'The Bell Jar', 'Sylvia Plath', 'Literary Fiction', '1963-01-14', '9780060833028', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(139, 'Little Women', 'Louisa May Alcott', 'Historical Fiction', '1868-09-30', '9781503280298', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(140, 'The Color Purple', 'Alice Walker', 'Literary Fiction', '1982-02-01', '9780156028356', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(141, 'The Kite Runner', 'Khaled Hosseini', 'Historical Fiction', '2003-05-29', '9781594631931', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(142, 'The Secret Life of Bees', 'Sue Monk Kidd', 'Historical Fiction', '2002-01-01', '9780142001745', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(143, 'Life of Pi', 'Yann Martel', 'Adventure', '2001-09-11', '9780151008117', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(144, 'The Perks of Being a Wallflower', 'Stephen Chbosky', 'Young Adult', '1999-09-01', '9780671027346', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(145, 'Station Eleven', 'Emily St. John Mandel', 'Science Fiction', '2014-09-09', '9780345538932', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(146, 'Where the Crawdads Sing', 'Delia Owens', 'Literary Fiction', '2018-08-14', '9780735219090', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(147, 'Normal People', 'Sally Rooney', 'Literary Fiction', '2018-08-28', '9781984822185', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(148, 'The Song of Achilles', 'Madeline Miller', 'Historical Fiction', '2011-09-20', '9780062066212', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(149, 'The Night Circus', 'Erin Morgenstern', 'Fantasy', '2011-09-13', '9780385534635', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(150, 'Eleanor Oliphant Is Completely Fine', 'Gail Honeyman', 'Literary Fiction', '2017-05-09', '9780735220683', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(151, 'The Woman in the Window', 'A.J. Finn', 'Thriller', '2018-01-02', '9780062678423', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(152, 'The Silent Patient', 'Alex Michaelides', 'Psychological Thriller', '2019-02-05', '9781250301697', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(153, 'Circe', 'Madeline Miller', 'Fantasy', '2018-04-10', '9780316488408', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(154, 'The Vanishing Half', 'Brit Bennett', 'Literary Fiction', '2020-06-02', '9780525536960', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(155, 'Anxious People', 'Fredrik Backman', 'Literary Fiction', '2020-09-08', '9781501160837', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(156, 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 'Self-Help', '1989-08-15', '9780743269513', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(157, 'Educated', 'Tara Westover', 'Memoir', '2018-02-20', '9780399590504', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(158, 'Becoming', 'Michelle Obama', 'Memoir', '2018-11-13', '9781524763138', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(159, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Non-Fiction', '2011-01-01', '9780062316097', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(160, 'Born a Crime', 'Trevor Noah', 'Memoir', '2016-11-15', '9780399588174', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(161, 'The Immortal Life of Henrietta Lacks', 'Rebecca Skloot', 'Non-Fiction', '2010-02-02', '9781400052189', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(162, 'The Wright Brothers', 'David McCullough', 'Biography', '2015-05-05', '9781476728759', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(163, 'The Glass Castle', 'Jeannette Walls', 'Memoir', '2005-01-01', '9780743247542', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(164, 'Just Mercy', 'Bryan Stevenson', 'Non-Fiction', '2014-08-05', '9780812984965', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(165, 'Into the Wild', 'Jon Krakauer', 'Non-Fiction', '1996-01-01', '9780385486804', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available'),
(166, 'The Fifth Season', 'N.K. Jemisin', 'Fantasy', '2015-08-04', '9780316334677', 1, '2024-11-05 18:12:38', '2024-11-05 18:12:38', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rental_date` date NOT NULL,
  `due_date` date NOT NULL,
  `returned` tinyint(1) DEFAULT 0,
  `overdue` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Rented','Returned','Overdue') NOT NULL DEFAULT 'Rented'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `book_id`, `rental_date`, `due_date`, `returned`, `overdue`, `created_at`, `updated_at`, `status`) VALUES
(1, 5, 1, '2024-11-04', '2024-11-19', 0, 0, '2024-11-04 16:44:37', '2024-11-04 16:44:37', ''),
(4, 5, 2, '2024-11-04', '2024-11-19', 0, 0, '2024-11-04 16:47:12', '2024-11-04 16:47:12', ''),
(5, 5, 1, '2024-11-05', '2024-11-20', 0, 0, '2024-11-05 17:16:47', '2024-11-05 17:44:57', 'Returned'),
(6, 5, 2, '2024-11-05', '2024-11-20', 0, 0, '2024-11-05 17:46:38', '2024-11-05 17:47:56', 'Returned'),
(7, 5, 1, '2024-11-05', '2024-11-20', 0, 0, '2024-11-05 17:50:06', '2024-11-05 17:50:22', 'Returned'),
(8, 5, 1, '2024-11-05', '2024-11-20', 0, 0, '2024-11-05 17:51:03', '2024-11-05 17:51:16', 'Returned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Admin','Customer') NOT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `security_question`, `security_answer`, `created_at`, `updated_at`) VALUES
(2, 'John Doe', 'johndoe@example.com', 'customer_password_hash', 'Customer', 'What is your pet’s name?', 'Buddy', '2024-11-04 14:22:47', '2024-11-05 17:52:37'),
(3, 'Kenneth Musonda', 'kennethmusonda@gmail.com', '$2y$10$PnQrL/3Q4q71ACWxJtL6eOFio/Y187M3XvCv9k/xZ4p2qJpugvTze', 'Admin', 'What is my favorite color?', 'blue', '2024-11-04 14:32:54', '2024-11-04 14:32:54'),
(5, 'Kenneth', 'Ken@gmail.com', '$2y$10$D2m6RiTXfsi0Pc31hp2yy.3HqM7RAUvoCpriwkzyP7VDEoPaNY1NO', 'Customer', 'Question', '1', '2024-11-04 16:38:13', '2024-11-04 16:38:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `idx_rental_user_book` (`user_id`,`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

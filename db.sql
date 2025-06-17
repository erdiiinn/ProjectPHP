CREATE TABLE users (
  id int(100) NOT NULL,
  name varchar(255) NOT NULL,
  surname varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table users
--

INSERT INTO users (id, name, surname, username, email, password) VALUES
(1, 'John', 'Doe', 'johndoe', 'johndoe@mail.com', '$2y$10$4kAii3oJMFLZnyy5Jdfj5OAsMPaRcj4Or8F/4XXdccuC329YkuLaG'),
(2, 'Jane', 'Doe', 'janedoe', 'janedoe@mail.com', '$2y$10$JzYz38MXRWUcrpOOgh61VefY0Mx/4gPUOiSndmYS5mD5VNZ4wOacm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
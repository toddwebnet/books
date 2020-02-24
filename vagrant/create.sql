
CREATE USER 'books'@'%' IDENTIFIED BY 'jSuZ7ugR7SKB9Afm';
CREATE DATABASE IF NOT EXISTS `books`;
GRANT ALL PRIVILEGES ON `books`.* TO 'books'@'%';GRANT ALL PRIVILEGES ON `books\_%`.* TO 'books'@'%';
flush privileges;

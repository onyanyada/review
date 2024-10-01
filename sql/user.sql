CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    lid VARCHAR(100) NOT NULL UNIQUE,
    lpw VARCHAR(255) NOT NULL,
    kanri_flg int(1) NOT NULL,
    life_flg int(1) NOT NULL
);

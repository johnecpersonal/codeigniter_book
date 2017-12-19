CREATE TABLE purchases (
    id INT(11) NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    description VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

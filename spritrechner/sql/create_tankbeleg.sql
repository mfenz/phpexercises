CREATE TABLE `tankbeleg` 
( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `userid` INT NOT NULL , 
    `km` DECIMAL(6,2) NOT NULL , 
    `liter` DECIMAL(6,2) NOT NULL , 
    `betrag` DECIMAL(6,2) NOT NULL , 
    `datum` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)
);
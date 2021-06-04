CREATE TABLE `user` 
( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `email` VARCHAR(255) NOT NULL , 
    `passwort` VARCHAR(255) NOT NULL ,
    `beschreibung` TEXT NOT NULL , 
    `foto_dateiname` VARCHAR(1000) NOT NULL , 
    PRIMARY KEY (`id`)
); 
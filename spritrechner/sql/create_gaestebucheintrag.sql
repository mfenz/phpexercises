CREATE TABLE `gaestebucheintrag` 
( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `datum` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `name` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `text` TEXT NOT NULL , 
    PRIMARY KEY (`id`)
); 
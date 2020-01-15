-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema uniticket
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `uniticket` ;

-- -----------------------------------------------------
-- Schema uniticket
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `uniticket` DEFAULT CHARACTER SET utf8 ;
USE `uniticket` ;

-- -----------------------------------------------------
-- Table `uniticket`.`Location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Location` (
  `idLocation` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `tel` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `cap` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idLocation`),
  UNIQUE INDEX `address_UNIQUE` (`address` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Room` (
  `idRoom` INT NOT NULL AUTO_INCREMENT,
  `capacity` INT NULL,
  `name` VARCHAR(45) NULL,
  `idLocation` INT NOT NULL,
  PRIMARY KEY (`idRoom`),
  UNIQUE INDEX `idRoom_UNIQUE` (`idRoom` ASC),
  INDEX `fk_Room_Location1_idx` (`idLocation` ASC),
  CONSTRAINT `fk_Room_Location1`
    FOREIGN KEY (`idLocation`)
    REFERENCES `uniticket`.`Location` (`idLocation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `admin` TINYINT NULL DEFAULT 0,
  `manager` TINYINT NULL DEFAULT 0,
  `regDate` DATETIME NOT NULL,
  `sessionId` VARBINARY(256) NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Event` (
  `idEvent` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(256) NULL,
  `price` DECIMAL(5,2) NULL,
  `date` DATETIME NOT NULL,
  `artist` VARCHAR(256) NULL,
  `idRoom` INT NOT NULL,
  `idManager` INT NOT NULL,
  PRIMARY KEY (`idEvent`),
  INDEX `fk_Event_Room1_idx` (`idRoom` ASC),
  INDEX `fk_Event_User1_idx` (`idManager` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `uniticket`.`Ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Ticket` (
  `idEvent` INT NOT NULL,
  `used` TINYINT NULL DEFAULT 0,
  `idTicket` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  PRIMARY KEY (`idTicket`),
  INDEX `fk_Ticket_Event1_idx` (`idEvent` ASC),
  INDEX `fk_Ticket_User1_idx` (`idUser` ASC),
  CONSTRAINT `fk_Ticket_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ticket_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Image` (
  `idImage` INT NOT NULL AUTO_INCREMENT,
  `image` MEDIUMBLOB NULL,
  `idEvent` INT NOT NULL,
  PRIMARY KEY (`idImage`),
  INDEX `fk_Image_Event1_idx` (`idEvent` ASC),
  CONSTRAINT `fk_Image_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Notice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Notice` (
  `idNotice` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(1024) NULL,
  `name` VARCHAR(45) NULL,
  `date` DATETIME NOT NULL,
  `idEvent` INT NOT NULL,
  PRIMARY KEY (`idNotice`),
  UNIQUE INDEX `idNotice_UNIQUE` (`idNotice` ASC),
  INDEX `fk_Notice_Event1_idx` (`idEvent` ASC),
  CONSTRAINT `fk_Notice_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Cart` (
  `idCart` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  PRIMARY KEY (`idCart`, `idUser`),
  INDEX `fk_Cart_User1_idx` (`idUser` ASC),
  CONSTRAINT `fk_Cart_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`ElementsInCart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`ElementsInCart` (
  `idCart` INT NOT NULL,
  `idEvent` INT NOT NULL,
  `nTicket` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCart`, `idEvent`),
  INDEX `fk_ElementsInCart_Event1_idx` (`idEvent` ASC),
  CONSTRAINT `fk_ElementsInCart_Cart1`
    FOREIGN KEY (`idCart`)
    REFERENCES `uniticket`.`Cart` (`idCart`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ElementsInCart_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`UserHasLocation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`UserHasLocation` (
  `idUser` INT NOT NULL,
  `idLocation` INT NOT NULL,
  PRIMARY KEY (`idUser`, `idLocation`),
  INDEX `fk_User_has_Location_Location1_idx` (`idLocation` ASC),
  INDEX `fk_User_has_Location_User1_idx` (`idUser` ASC),
  CONSTRAINT `fk_User_has_Location_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Location_Location1`
    FOREIGN KEY (`idLocation`)
    REFERENCES `uniticket`.`Location` (`idLocation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



/**************************************
            STORED PROCEDURE
**************************************/
DROP PROCEDURE IF EXISTS createNotice;
DELIMITER $$
CREATE PROCEDURE createNotice(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN name VARCHAR(45),
    IN description VARCHAR (1024))
BEGIN
	DECLARE countManager INT;
    SELECT COUNT(*) INTO countManager
		FROM Event INNER JOIN User ON User.idUser = Event.idManager
		WHERE User.sessionId = sessionId;
	IF ( countManager > 0)
    THEN
    select idEvent, @idEvent;
		INSERT INTO Notice(Notice.name, Notice.description, Notice.date, Notice.idEvent)
        VALUES(name, description, NOW(), idEvent);
    END IF;
END $$
DELIMITER ;
    

/* ASSOLUTAMENTE DA CONTROLLARE (ERO STANCO MORTO(NAED)) */
DROP PROCEDURE IF EXISTS buyTicket;
DELIMITER $$
CREATE PROCEDURE buyTicket(
	IN sessionId VARBINARY(256),
    IN idEvent INT)
BEGIN
	DECLARE idCart INT;
    DECLARE capacity INT;
    DECLARE ocupied INT;
    DECLARE i INT;
    DECLARE nTicket INT;
    SELECT Cart.idCart, ElementsInCart.nTicket INTO idCart, nTicket
    FROM (SELECT * FROM User INNER JOIN Cart 
			ON User.idUser = Cart.idUser 
			WHERE User.sessionId = sessionId) AS T
        INNER JOIN ElementsInCart ON T.idCart = ElementsInCart.idCart;
    /* TODO: vedere se le cose sono presenti nel carrello prima di comprarle */
    SELECT Room.capacity INTO capacity
    FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom;
    
    SELECT COUNT(*) INTO ocupied FROM Ticket WHERE Ticket.idEvent = idEvent;
    
    IF (capacity > ocupied + nTicket AND nTicket > 0)
    THEN
		DELETE FROM ElementsInCart WHERE Cart.idCart = idCart AND Cart.idEvent = idEvent;
        
        SET i = nTicket;
        cycle: LOOP
			INSERT INTO Ticket(Ticket.idEvent, Ticket.idUser, Ticket.used)
					VALUE(idEvent, idUser, 0);
			IF ( i >= 0)
            THEN
				SET i = i - 1;
                ITERATE cycle;
            END IF;
			LEAVE cycle;
        END LOOP cycle;
		SET @response = 1;
	ELSE
		SET @response = 0;
	END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS changeNumberTicket;
DELIMITER $$;
CREATE PROCEDURE changeNumberTicketToCart(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN newNumber INT)
BEGIN
	DECLARE idCart INT;
	SELECT Cart.idCart INTO idCart
    FROM User INNER JOIN USER 
		ON User.idUser = Cart.idUser 
	WHERE User.sessionId = sessionId;
    
    UPDATE ElementsInCart
    SET nTicket = newNumber;
    WHERE ElementsInCart.idCart = idCart AND ElementsInCart.idEvent = idEvent;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS addTicketToCart;
DELIMITER $$
CREATE PROCEDURE addTicketToCart(
	IN sessionId VARBINARY(256),
	IN idEvent INT,
    IN nTicket INT,
    OUT response TINYINT)
BEGIN
	DECLARE idCart INT;
    DECLARE capacity INT;
    DECLARE ocupied INT;
    SELECT Cart.idCart INTO idCart
    FROM User INNER JOIN Cart
		ON User.idUser = Cart.idUser 
	WHERE User.sessionId = sessionId;
    
    SELECT Room.capacity INTO capacity
    FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom;
    
    SELECT COUNT(*) INTO ocupied FROM Ticket WHERE Ticket.idEvent = idEvent;
    
    IF (capacity > ocupied + nTicket AND nTicket > 0)
    THEN
        INSERT INTO ElementsInCart(Cart.idCart, Cart.idEvent)
			VALUE (idCart, idEvent, nTicket);
		SET @response = 1;
	ELSE
		SET @response = 0;
	END IF;
    
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(
	IN name VARCHAR(45),
	IN pwd VARCHAR(45),
	IN mail VARCHAR(45),
	IN man TINYINT,
    OUT idUser INT)
BEGIN
	INSERT INTO User(User.username, User.password, User.email, User.regDate, User.manager)
	VALUES (name, pwd, mail, NOW(), man);
    SELECT LAST_INSERT_ID() INTO idUser;
    INSERT INTO Cart(Cart.idUser) VALUES (idUser);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS logIn;
DELIMITER $$
CREATE PROCEDURE logIn(
	IN name VARCHAR(45),
	IN passwd VARCHAR(45),
    OUT hashe VARBINARY(256))
BEGIN
	DECLARE id INT;
    DECLARE countUser INT;
	SET @id = 0;
	SELECT User.idUser, COUNT(*) INTO id, countUser
		FROM User
		WHERE User.username = name AND User.password = passwd;
	IF (countUser = 1)
	THEN
		SET hashe = SHA2(CONCAT(name, passwd, id, NOW()), 256);
		UPDATE User SET User.sessionId = hashe WHERE User.idUser = id;
	ELSE /* ONLY IF NOT PRESENT */
		SET @hashe = 0;
	END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS logOut;
DELIMITER $$
CREATE PROCEDURE logOut(
	IN sesId VARBINARY(256))
BEGIN
	UPDATE User SET User.sessionId = 0 WHERE User.sessionId = sesId;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS uniticket.getNotification;
DELIMITER $$
CREATE PROCEDURE getNotification(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
    SELECT User.idUset INTO idUser FROM User WHERE User.sessionId = sessionId;
    SELECT Image.image, Event.name, Event.description, Event.date, Event.artist, Notice.name, Notice.description
		FROM User INNER JOIN Ticket ON Ticket.idUser = idUser
		INNER JOIN Event ON Ticket.idEvent = Event.idEvent
		INNER JOIN Notice ON Notice.idEvent = Event.idEvent
		/** La riga sotto serve per aggiungere l'immagine ma molto probabilmente è sbagliata */
		INNER JOIN (SELECT Image.idEvent, Image.image FROM Image INNER JOIN Event ON Image.idEvent = Event.idEvent LIMIT 1) AS T ON T.idEvent = Event.idEvent;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS addImageToEvent;
DELIMITER $$
CREATE PROCEDURE addImageToEvent(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN image MEDIUMBLOB)
BEGIN
	DECLARE countManager INT;
    SELECT COUNT(*) INTO countManager
		FROM Event INNER JOIN User ON User.idUser = Event.idManager
		WHERE User.sessionId = sessionId;
	IF ( countManager > 0)
    THEN
		INSERT INTO Image(Image.idEvent, Image.image) VALUES (idEvent, image);
    END IF;
		
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS newEvent;
DELIMITER $$
CREATE PROCEDURE newEvent(
	IN sessionId VARBINARY(256),
	IN name VARCHAR(45),
	IN description VARCHAR(256),
	IN artist VARCHAR(256),
	IN price DECIMAL(5,2),
	IN date DATETIME,
	IN idRoom INT,
    OUT idEvent INT)
BEGIN
	DECLARE idManager INT;
    DECLARE countManager INT;
    
	SELECT User.idUser, COUNT(*) INTO idManager, countManager
	FROM User INNER JOIN UserHasLocation ON User.idUser = UserHasLocation.idUser
		INNER JOIN Location ON Location.idLocation = UserHasLocation.idLocation
		INNER JOIN Room ON Room.idLocation = Location.idLocation
		WHERE User.sessionId = sessionId;
	IF( countManager >= 1)
	THEN
		INSERT INTO Event(Event.name, Event.description, Event.price, Event.date, Event.artist, Event.idRoom, Event.idManager)
		VALUES (name, description, price, date, artist, idRoom, idManager);
        SELECT LAST_INSERT_ID() INTO idEvent ;
	ELSE
		SET @idEvent = 0;
	END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS uniticket.newLocation;
DELIMITER $$
CREATE PROCEDURE newLocation(
	IN sessionId VARBINARY(256),
	IN name VARCHAR(45),
	IN address VARCHAR(45),
	IN tel VARCHAR(45),
	IN email VARCHAR(45),
	IN cap VARCHAR(10),
    OUT idLoc INT)
BEGIN
	DECLARE idUser INT;
	DECLARE nUser INT;
	SELECT User.idUser, COUNT(*) INTO idUser, nUser FROM User WHERE User.sessionId = sessionId;
	IF( nUser = 1)
	THEN
		INSERT INTO Location(Location.name, Location.address, Location.tel, Location.email, Location.cap)
			VALUES(name, address, tel, email, cap);
		SELECT LAST_INSERT_ID() INTO idLoc;
		INSERT INTO UserHasLocation(idUser, idLocation)
			VALUES(idUser, idLoc);
	ELSE
		SET @idLoc = 0;
	END IF;
	
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS uniticket.newRoom;
DELIMITER $$
CREATE PROCEDURE newRoom(
	IN sessionId VARBINARY(256),
	IN name VARCHAR(45),
	IN capacity INT,
	IN idLocation INT,
    OUT idRoom INT)
BEGIN
	DECLARE count INT;
	SELECT COUNT(*) INTO count FROM User INNER JOIN UserHasLocation
		ON User.idUser = UserHasLocation.idUser
		WHERE User.sessionId = sessionId
		 AND UserHasLocation.idLocation = idLocation;
	IF (count = 1)
	THEN
		INSERT INTO Room(Room.capacity, Room.name, Room.idLocation)
		VALUES(capacity, name, idLocation);
		SELECT LAST_INSERT_ID() INTO idRoom;
	ELSE
		SET @idRoom = 0;
	END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS uniticket.initialize;
DELIMITER $$
CREATE PROCEDURE initialize()
BEGIN
	DECLARE sessionId VARBINARY(256);
	DECLARE idLoc INT;
	DECLARE idRoom INT;
    DECLARE idEvent INT;
    DECLARE idUser INT;
	CALL createUser('luca', 'aaa', 'a1@a.com', 0, @idUser);
	CALL createUser('franco', 'aaa', 'a2@a.com', 0, @idUser);
	CALL createUser('lucia', 'aaa', 'a3@a.com', 0, @idUser);
	CALL createUser('lubaldo', 'aaa', 'a4@a.com', 0, @idUser);
	CALL createUser('guido', 'aaa', 'a5@a.com', 0, @idUser);
	CALL createUser('matteo', 'aaa', 'a6@a.com', 0, @idUser);
	CALL createUser('francesco', 'aaa', 'a7@a.com', 0, @idUser);
	CALL createUser('cristian', 'aaa', 'a8@a.com', 0, @idUser);
	CALL createUser('manuel', 'aaa', 'a9@a.com', 0, @idUser);
	CALL createUser('sedia', 'aaa', 'a10@a.com', 0, @idUser);
	CALL createUser('lampada', 'aaa', 'a11@a.com', 0, @idUser);
	CALL createUser('manager', 'manager', 'manager@manager.com', 1, @idUser);
	
	CALL logIn('manager', 'manager', sessionId);
	CALL newLocation(sessionId, 'casa di Cristian', 'via viola 165', '666', 'ciaociao.com', '47521', @idLoc);
	CALL newRoom(sessionId, 'sala studio', 3, @idLoc, @idRoom);
	CALL newEvent(sessionId, 'tutti da Cristian', 'si studia', 'Naed', 0.0, 14-01-2020, @idRoom, @idEvent);
    CALL newRoom(sessionId, 'sala pranzo', 10, @idLoc, @idRoom);
    CALL newEvent(sessionId, 'mangiamo da Cristian i biscotti', 'tanti biscotti', 'Con la mitica partecipazione di NAED', 0.0, 17-01-2020, @idRoom, @idEvent);
    CALL createNotice(sessionId, @idEvent, 'Annullamento incontro', 'tutto annullato per mancanza di biscotti');
END $$
DELIMITER ;


INSERT INTO User (username, password, email, regDate, admin) VALUES ('admin', 'admin', 'admin@a.com', CURDATE(), 1);
CALL initialize();

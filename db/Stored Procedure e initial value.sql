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
  INDEX `fk_Event_User1_idx` (`idManager` ASC),
  CONSTRAINT `fk_Event_Room1`
    FOREIGN KEY (`idRoom`)
    REFERENCES `uniticket`.`Room` (`idRoom`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_User1`
    FOREIGN KEY (`idManager`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Ticket` (
  `idEvent` INT NOT NULL,
  `used` TINYINT NULL DEFAULT 0,
  `idTicket` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `date` VARCHAR(45) NOT NULL,
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
  `idEvent` INT NOT NULL,
  `number` INT NOT NULL,
  `img` MEDIUMBLOB NULL,
  PRIMARY KEY (`idEvent`, `number`),
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
  `text` VARCHAR(1024) NOT NULL,
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


-- -----------------------------------------------------
-- Table `uniticket`.`ActiveSession`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`ActiveSession` (
  `idSession` VARBINARY(256) NOT NULL,
  `idUser` INT NOT NULL,
  `logInDate` DATETIME NOT NULL,
  PRIMARY KEY (`idSession`),
  INDEX `fk_ActiveSession_User1_idx` (`idUser` ASC),
  CONSTRAINT `fk_ActiveSession_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`Cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`Cart` (
  `idUser` INT NOT NULL,
  `idEvent` INT NOT NULL,
  `nTicket` INT NOT NULL DEFAULT 1,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`idUser`, `idEvent`),
  INDEX `fk_Cart_Event1_idx` (`idEvent` ASC),
  CONSTRAINT `fk_Cart_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`NoticeRead`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`NoticeRead` (
  `idUser` INT NOT NULL,
  `idNotice` INT NOT NULL,
  PRIMARY KEY (`idUser`, `idNotice`),
  INDEX `fk_NoticeRead_Notice1_idx` (`idNotice` ASC),
  CONSTRAINT `fk_NoticeRead_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NoticeRead_Notice1`
    FOREIGN KEY (`idNotice`)
    REFERENCES `uniticket`.`Notice` (`idNotice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`BlockedUser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`BlockedUser` (
  `idUser` INT NOT NULL,
  `date` DATETIME NULL,
  `description` VARCHAR(256) NULL,
  PRIMARY KEY (`idUser`),
  CONSTRAINT `fk_table1_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`BlockedEvent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`BlockedEvent` (
  `idEvent` INT NOT NULL,
  PRIMARY KEY (`idEvent`),
  CONSTRAINT `fk_BlockedEvent_Event1`
    FOREIGN KEY (`idEvent`)
    REFERENCES `uniticket`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `uniticket`.`UserToConfirm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `uniticket`.`UserToConfirm` (
  `idUser` INT NOT NULL,
  `code` VARBINARY(256) NOT NULL,
  PRIMARY KEY (`idUser`),
  INDEX `fk_UserToConfirm_User1_idx` (`idUser` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  CONSTRAINT `fk_UserToConfirm_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `uniticket`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



/* The stored function is like stored procedure but retrive only one result */
/*****************************************
			STORED FUNCTION
*****************************************/
DROP FUNCTION IF EXISTS f_getIdFromSession
DELIMITER $$
CREATE FUNCTION f_getIdFromSession(
	sessionId VARBINARY(256))
RETURNS INT
BEGIN
	DECLARE date DATETIME;
    DECLARE idUser INT;
    SET idUser = -1;
	SELECT ActiveSession.logInDate, ActiveSession.idUser INTO date, idUser FROM ActiveSession
		WHERE ActiveSession.idSession = sessionId
        AND idUser NOT IN (SELECT BlockedUser.idUser FROM BlockedUser)
        AND idUser NOT IN (SELECT UserToConfirm.idUser FROM UserToConfirm);
    IF (DATEDIFF(date, NOW()) >= 1)
    THEN
		DELETE FROM ActiveSession WHERE ActiveSession.idSession = sessionId;
        RETURN 0;
    ELSEIF (idUser <= 0)
	THEN
		RETURN 0;
    END IF;
    RETURN idUser;
END $$
DELIMITER ;

DROP FUNCTION IF EXISTS f_buyTicket;
DELIMITER $$
CREATE FUNCTION f_buyTicket(
	sessionId VARBINARY(256),
    idEvent INT)
RETURNS TINYINT
BEGIN
	DECLARE idCart INT;
    DECLARE capacity INT;
    DECLARE ocupied INT;
    DECLARE i INT;
    DECLARE nTicket INT;
    DECLARE idUser INT;
    DECLARE blockedEvent INT;
    SELECT COUNT(*) INTO blockedEvent FROM BlockedEvent WHERE BlockedEvent.idEvent = idEvent;
    SET idUser = f_getIdFromSession(sessionId);
    
    IF ( idUser > 0 AND blockedEvent = 0)
    THEN
		SELECT COUNT(*) INTO ocupied FROM Ticket INNER JOIN Event ON Ticket.idEvent = Event.idEvent;
		SELECT Room.capacity INTO capacity FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom WHERE Event.idEvent = idEvent;
		SELECT Cart.nTicket INTO nTicket
			FROM Cart WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
		IF (nTicket IS NOT NULL AND capacity > ocupied + nTicket AND nTicket > 0)
		THEN
			DELETE FROM Cart WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
			SET i = nTicket;
			cycle: LOOP
				INSERT INTO Ticket(Ticket.idEvent, Ticket.idUser, Ticket.used, Ticket.date)
						VALUE(idEvent, idUser, 0, NOW());
				SET i = i - 1;
				IF ( i > 0)
				THEN
					ITERATE cycle;
				END IF;
				LEAVE cycle;
			END LOOP cycle;
			RETURN 1;
		ELSE
			RETURN 0;
		END IF;
    ELSE
		RETURN -1;
    END IF;
END $$
DELIMITER ;

DROP FUNCTION IF EXISTS f_addTicketToCart;
DELIMITER $$
CREATE FUNCTION f_addTicketToCart(
	sessionId VARBINARY(256),
	idEvent INT,
    nTicket INT)
RETURNS TINYINT
BEGIN
	DECLARE idCart INT;
    DECLARE capacity INT;
    DECLARE ocupied INT;
    DECLARE idUser INT;
    DECLARE alreadyAdded INT;
    DECLARE eventDate DATETIME;
    DECLARE blockedEvent INT;
    SELECT COUNT(*) INTO blockedEvent FROM BlockedEvent WHERE BlockedEvent.idEvent = idEvent;
    SET idUser = f_getIdFromSession(sessionId);
    
    IF (idUser <= 0 OR blockedEvent > 0)
    THEN
		RETURN -1;
    END IF;
    
    SELECT Event.date INTO eventDate FROM Event WHERE Event.idEvent = idEvent;
	IF (DATEDIFF(eventDate, NOW()) < 0)
    THEN
		RETURN -1;
	END IF;
    
    SELECT Room.capacity INTO capacity
		FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom
		WHERE Event.idEvent = idEvent;

    SELECT COUNT(*) INTO ocupied FROM Ticket WHERE Ticket.idEvent = idEvent;
    SET alreadyAdded = 0;
	SELECT Cart.nTicket INTO alreadyAdded FROM Cart
		WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
    IF (capacity > ocupied + nTicket + alreadyAdded)
    THEN
		IF (alreadyAdded = 0 AND nTicket > 0)
        THEN
			INSERT INTO Cart(Cart.idUser, Cart.idEvent, Cart.nTicket, Cart.date)
				VALUE (idUser, idEvent, nTicket, NOW());
			RETURN nTicket;
        ELSEIF (nTicket >= 0 OR alreadyAdded > (nTicket*-1))
        THEN
			IF(nTicket != 0)
            THEN
				UPDATE Cart SET Cart.nTicket = Cart.nTicket + nTicket
					WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
			END IF;
			RETURN (alreadyAdded + nTicket);
		ELSEIF(alreadyAdded <= (nTicket * -1))
        THEN
			DELETE FROM Cart WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
            RETURN 0;
        END IF;
	ELSE
		RETURN -1;
	END IF;
    
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS f_createUser;
DELIMITER $$
CREATE FUNCTION f_createUser(
	name VARCHAR(45),
	pwd VARCHAR(45),
	mail VARCHAR(45),
	man INT)
RETURNS VARBINARY(256)
BEGIN
	DECLARE idUser INT;
    DECLARE hashe VARBINARY(256);
	INSERT INTO User(User.username, User.password, User.email, User.regDate, User.manager)
		VALUES (name, pwd, mail, NOW(), man);
    SELECT LAST_INSERT_ID() INTO idUser;
    SET hashe = SHA2(CONCAT(name, pwd, idUser, NOW(), mail, RAND()), 256);
    INSERT INTO UserToConfirm(idUser, code) VALUES(idUser, hashe);
    RETURN hashe;
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS f_logIn;
DELIMITER $$
CREATE FUNCTION f_logIn(
	name VARCHAR(45),
	passwd VARCHAR(45))
RETURNS VARBINARY(256)
BEGIN
	DECLARE id INT;
    DECLARE count INT;
    DECLARE hashe VARBINARY(256);
    DECLARE blockedUser INT;
    DECLARE notRegistered INT;
    
	SET id = 0;
	SELECT uniticket.User.idUser INTO id
		FROM User
		WHERE User.username = name AND User.password = passwd;
	SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = id;
    SELECT COUNT(*) INTO notRegistered FROM UserToConfirm WHERE UserToConfirm.idUser = id;
    IF (notRegistered != 0)
    THEN
		RETURN -1;
    END IF;
    
	IF (id > 0 AND blockedUser = 0)
	THEN
		SET hashe = SHA2(CONCAT(name, passwd, id, NOW(), RAND()), 256);
        SELECT COUNT(*) INTO count FROM ActiveSession WHERE ActiveSession.idUser = id;
        IF ( count IS NULL OR count = 0)
        THEN
			INSERT INTO ActiveSession(ActiveSession.idSession, ActiveSession.idUser, ActiveSession.logInDate)
			VALUES (hashe, id, NOW());
		ELSE
			UPDATE ActiveSession SET ActiveSession.idSession = hashe, ActiveSession.logInDate = NOW() WHERE ActiveSession.idUser = id;
        END IF;
	ELSE /* ONLY IF NOT PRESENT OR BLOCKED OR NOT CONFIRMED EMAIL */
		RETURN 0;
	END IF;
    RETURN hashe;
END $$
DELIMITER ;

DROP FUNCTION IF EXISTS f_newEvent;
DELIMITER $$
CREATE FUNCTION f_newEvent(
	sessionId VARBINARY(256),
	name VARCHAR(45),
	description VARCHAR(256),
	artist VARCHAR(256),
	price DECIMAL(5,2),
	date DATETIME,
	idRoom INT)
RETURNS INT
BEGIN
	DECLARE idManager INT;
    DECLARE countManager INT;
    DECLARE idEvent INT;
    DECLARE blockedUser INT;
    SET idManager = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idManager;
    IF (idManager <= 0 OR blockedUser > 0)
    THEN
		RETURN 0;
    END IF;
    
	SELECT COUNT(*) INTO countManager
	FROM User INNER JOIN UserHasLocation ON User.idUser = UserHasLocation.idUser
		INNER JOIN Location ON Location.idLocation = UserHasLocation.idLocation
		INNER JOIN Room ON Room.idLocation = Location.idLocation
		WHERE User.idUser = idManager;
	IF( countManager >= 1)
	THEN
		INSERT INTO Event(Event.name, Event.description, Event.price, Event.date, Event.artist, Event.idRoom, Event.idManager)
			VALUES (name, description, price, date, artist, idRoom, idManager);	
        RETURN LAST_INSERT_ID();
	ELSE
		RETURN 0;
	END IF;
    RETURN idEvent;
END $$
DELIMITER ;

DROP FUNCTION IF EXISTS f_newLocation;
DELIMITER $$
CREATE FUNCTION f_newLocation(
	sessionId VARBINARY(256),
	name VARCHAR(45),
	address VARCHAR(45),
	tel VARCHAR(45),
	email VARCHAR(45),
	cap VARCHAR(10))
RETURNS INT
BEGIN
	DECLARE idUser INT;
    DECLARE idLoc INT;
    DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser <= 0 OR blockedUser > 0)
    THEN
		RETURN 0;
    END IF;
    
	INSERT INTO Location(Location.name, Location.address, Location.tel, Location.email, Location.cap)
		VALUES(name, address, tel, email, cap);
	SELECT LAST_INSERT_ID() INTO idLoc;
	INSERT INTO UserHasLocation(idUser, idLocation)
		VALUES(idUser, idLoc);
    RETURN idLoc;
END $$
DELIMITER ;

DROP FUNCTION IF EXISTS f_newRoom;
DELIMITER $$
CREATE FUNCTION f_newRoom(
	sessionId VARBINARY(256),
	name VARCHAR(45),
	capacity INT,
	nameLocation VARCHAR(45))
RETURNS INT
BEGIN
	DECLARE count INT;
    DECLARE idUser INT;
    DECLARE idRoom INT;
    DECLARE idLocation INT;
    DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser <= 0 OR blockedUser > 0)
    THEN
		RETURN 0;
    END IF;
    
    SELECT Location.idLocation INTO idLocation FROM Location WHERE Location.name = nameLocation;
    
	SELECT COUNT(*) INTO count FROM UserHasLocation
		WHERE UserHasLocation.idUser = idUser
		 AND UserHasLocation.idLocation = idLocation;
	IF (count = 1)
	THEN
		INSERT INTO Room(Room.capacity, Room.name, Room.idLocation)
		VALUES(capacity, name, idLocation);
		SELECT LAST_INSERT_ID() INTO idRoom;
	ELSE
		RETURN 0;
	END IF;
    RETURN idRoom;
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS f_userIsAdministrator;
DELIMITER $$
CREATE FUNCTION f_userIsAdministrator(
	sessionId VARBINARY(256))
RETURNS INT
BEGIN
	DECLARE idUser INT;
    DECLARE isAdmin INT;
    DECLARE isManager INT;
    DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser <= 0 OR blockedUser > 0)
    THEN
		RETURN 0;
    END IF;
    
    SELECT User.admin, User.manager INTO isAdmin, isManager FROM User WHERE User.idUser = idUser;
    RETURN isManager + isAdmin * 10;
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS f_createNotice;
DELIMITER $$
CREATE FUNCTION f_createNotice(
	sessionId VARBINARY(256),
    idEvent INT,
    text VARCHAR (1024),
    date DATETIME)
RETURNS INT
BEGIN
	DECLARE countManager INT;
    DECLARE idUser INT;
    DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser <= 0 OR blockedUser > 0)
    THEN
		RETURN 0;
    END IF;
    
    SELECT COUNT(*) INTO countManager
		FROM Event INNER JOIN User ON User.idUser = Event.idManager
		WHERE User.idUser = idUser AND Event.idEvent = idEvent LIMIT 1;
	IF ( countManager > 0)
    THEN
		INSERT INTO Notice(Notice.text, Notice.date, Notice.idEvent)
			VALUES(text, date, idEvent);
    END IF;
    RETURN 1;
END $$
DELIMITER ;


/**************************************
            STORED PROCEDURE
**************************************/

DROP PROCEDURE IF EXISTS createNotice;
DELIMITER $$
CREATE PROCEDURE createNotice(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN text VARCHAR (1024),
    IN date DATETIME)
BEGIN
	DECLARE ret INT;
	SET ret = f_createNotice(sessionid, idEvent, text, date);
END $$
DELIMITER ;


    

DROP PROCEDURE IF EXISTS buyTicket;
DELIMITER $$
CREATE PROCEDURE buyTicket(
	IN sessionId VARBINARY(256),
    IN idEvent INT)
BEGIN
	SELECT f_buyTicket(sessionId, idEvent);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getLocationsAndRoom;
DELIMITER $$
CREATE PROCEDURE getLocationsAndRoom(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
    DECLARE count INT;
    DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser > 0 AND blockedUser = 0)
    THEN
		IF (f_userIsAdministrator(sessionId) > 0)
		THEN
			(SELECT Location.name AS Location, Room.name AS Room, Room.idRoom
			FROM UserHasLocation INNER JOIN Location ON UserHasLocation.idLocation = Location.idLocation
			INNER JOIN Room ON Location.idLocation = Room.idLocation
			WHERE UserHasLocation.idUser = idUser)
			UNION 
			(Select Location.name AS Location, null, null
			FROM UserHasLocation INNER JOIN Location ON UserHasLocation.idLocation = Location.idLocation
			WHERE UserHasLocation.idUser = idUser AND Location.idLocation NOT IN (SELECT Room.idLocation FROM Room));
		ELSE
			SELECT f_userIsAdministrator(sessionId);
		END IF;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getRoomData;
DELIMITER $$
CREATE PROCEDURE getRoomData(
	IN idEvent INT)
BEGIN
	SELECT Location.name AS locationName, Room.name AS roomName
    FROM Event	INNER JOIN Room ON Room.idRoom = Event.idRoom
				INNER JOIN Location ON Location.idLocation = Room.idLocation
    WHERE Event.idEvent = idEvent;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS confirmMail;
DELIMITER $$
CREATE PROCEDURE confirmMail(
	IN code VARBINARY(256))
BEGIN
	DECLARE exist INT;
    SELECT COUNT(*) INTO exist FROM UserToConfirm WHERE UserToConfirm.code = code;
    IF (exist = 0)
    THEN
		SELECT 0;
	ELSE
		DELETE FROM UserToConfirm WHERE UserToConfirm.code = code;
        SELECT 1;
	END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS userLogged;
DELIMITER $$
CREATE PROCEDURE userLogged(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE id INT;
    SET id = f_getIdFromSession(sessionId);
    IF (id <= 0)
    THEN
		SELECT 0;
	ELSE
		SELECT id;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS changeNumberTicketToCart;
DELIMITER $$
CREATE PROCEDURE changeNumberTicketToCart(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN newNumber INT)
BEGIN
    DECLARE idUser INT;
    DECLARE capacity INT;
    DECLARE ocupied INT;
    DECLARE blockedUser INT;
    DECLARE blockedEvent INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    SELECT COUNT(*) INTO blockedEvent FROM BlockedEvent WHERE BlockedEvent.idEvent = idEvent;
    IF (idUser > 0 AND blockedUser = 0 AND BlockedEvent = 0)
    THEN
		SELECT Room.capacity INTO capacity
			FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom
			WHERE Event.idEvent = idEvent;
		SELECT COUNT(*) INTO ocupied FROM Ticket WHERE Ticket.idEvent = idEvent;
		
		IF (capacity > ocupied + newNumber AND newNumber > 0)
		THEN
			UPDATE Cart
			SET Cart.nTicket = newNumber
			WHERE Cart.idUser = idUser AND Cart.idEvent = idEvent;
		END IF;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS addTicketToCart;
DELIMITER $$
CREATE PROCEDURE addTicketToCart(
	IN sessionId VARBINARY(256),
	IN idEvent INT,
    IN nTicket INT)
BEGIN
	SELECT f_addTicketToCart(sessionId, idEvent, nTicket) AS TotalTicket;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS viewEventsInCart;
DELIMITER $$
CREATE PROCEDURE viewEventsInCart(
	IN sessionId VARBINARY(256))
BEGIN
    DECLARE idUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    
    SELECT Event.name, Event.description, Event.date, Event.artist, Event.price, Cart.nTicket, Image.img
		FROM Cart INNER JOIN Event ON Cart.idEvent = Event.idEvent 
        INNER JOIN Image ON Event.idEvent = Image.idEvent AND Image.number = 1
		WHERE Cart.idUser = idUser AND Event.idEvent NOT IN (SELECT BlockedEvent.idEvent FROM BlockedEvent);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(
	IN name VARCHAR(45),
	IN pwd VARCHAR(45),
	IN mail VARCHAR(45),
	IN man INT)
BEGIN
	SELECT f_createUser(name, pwd, mail, man);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS logIn;
DELIMITER $$
CREATE PROCEDURE logIn(
	IN name VARCHAR(45),
	IN passwd VARCHAR(45))
BEGIN
	SELECT f_logIn(name, passwd);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS logOut;
DELIMITER $$
CREATE PROCEDURE logOut(
	IN sessionId VARBINARY(256))
BEGIN
	DELETE FROM ActiveSession WHERE ActiveSession.idSession = sessionId;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getNotification;
DELIMITER $$
CREATE PROCEDURE getNotification(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT Event.idEvent, Event.name, Event.description, Event.date, Event.artist, Notice.text AS Text, Notice.date AS NoticeDate, Image.img
		FROM EVENT
        INNER JOIN (SELECT Ticket.idEvent FROM Ticket WHERE Ticket.idUser = idUser GROUP BY Ticket.idEvent) AS Ticket ON Event.idEvent = Ticket.idEvent
        INNER JOIN Image ON Event.idEvent = Image.idEvent AND Image.number = 1
		INNER JOIN Notice ON Notice.idEvent = Event.idEvent
        WHERE Event.date > NOW()
			AND Notice.date > NOW()
        ORDER BY Event.date;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS addImageToEvent;
DELIMITER $$
CREATE PROCEDURE addImageToEvent(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN imageNumber INT,
    IN image MEDIUMBLOB)
BEGIN
	DECLARE countManager INT;
    DECLARE lastNumber INT;
    DECLARE idUser INT;
	DECLARE blockedUser INT;
    DECLARE blockedEvent INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    SELECT COUNT(*) INTO blockedEvent FROM BlockedEvent WHERE BlockedEvent.idEvent = idEvent;
    IF (idUser > 0 AND blockedUser = 0 AND blockedEvent = 0)
    THEN
		SELECT COUNT(*) INTO countManager
			FROM Event WHERE Event.idManager = idUser;
		IF ( countManager > 0)
		THEN
			SELECT MAX(Image.number) INTO lastNumber FROM Image INNER JOIN Event ON Event.idEvent = Image.idEvent WHERE Image.idEvent = idEvent;
			IF ( (lastNumber IS NOT NULL AND lastNumber + 1 >= imageNumber) OR (lastNumber IS NULL AND imageNumber = 1))
			THEN
				INSERT INTO Image(Image.idEvent, Image.number, Image.img) VALUES (idEvent, imageNumber, image) ON DUPLICATE KEY UPDATE Image.img = image;	
			END IF;
		END IF;
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
	IN idRoom INT)
BEGIN
	SELECT f_newEvent(sessionId, name, description, artist, price, date, idRoom);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS newLocation;
DELIMITER $$
CREATE PROCEDURE newLocation(
	IN sessionId VARBINARY(256),
	IN name VARCHAR(45),
	IN address VARCHAR(45),
	IN tel VARCHAR(45),
	IN email VARCHAR(45),
	IN cap VARCHAR(10))
BEGIN
	SELECT f_newLocation(sessionId, name, address, tel, email, cap);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getEventImage;
DELIMITER $$
CREATE PROCEDURE getEventImage(
	IN idEvent INT)
BEGIN
	SELECT Image.number, Image.img FROM Image
		WHERE Image.idEvent = idEvent;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getEventInfo;
DELIMITER $$
CREATE PROCEDURE getEventInfo(
	IN idEvent INT)
BEGIN
	SELECT Event.name AS eventName, Event.description, Event.price, Event.date, Event.artist,
			Location.name AS locationName, Room.name AS roomName, Room.capacity
		FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom
		INNER JOIN Location ON Location.idLocation = Room.idLocation
        WHERE Event.idEvent = idEvent;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS searchEvent;
DELIMITER $$
CREATE PROCEDURE searchEvent(
	IN name VARCHAR(45))
BEGIN
	SELECT idEvent FROM Event WHERE Event.name LIKE name AND Event.idEvent NOT IN (Select idEvent FROM BlockedEvent);
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getEventHome;
DELIMITER $$
CREATE PROCEDURE getEventHome(
	IN sessionId VARBINARY(256),
    IN offset INT,
    IN num INT)
BEGIN
	DECLARE idUser INT;
    DECLARE cap VARCHAR(10);
    DECLARE ticketCount INT;
	DECLARE blockedUser INT;
    SET idUser = f_getIdFromSession(sessionId);
    SELECT COUNT(*) INTO blockedUser FROM BlockedUser WHERE BlockedUser.idUser = idUser;
    IF (idUser > 0 AND blockedUser = 0)
    THEN
		SELECT COUNT(*) INTO ticketCount
		FROM Ticket
		WHERE Ticket.idUser = idUser;
		IF( ticketCount = 0)
        THEN
			SELECT Event.idEvent FROM Event
            WHERE Event.date > NOW() AND Event.idEvent NOT IN (Select idEvent FROM BlockedEvent)
            ORDER BY Event.date
            LIMIT offset, num;
        ELSE
			SELECT Event.idEvent
			FROM Event INNER JOIN Room ON Event.idRoom = Room.idRoom
			INNER JOIN Location ON Location.idLocation = Room.idLocation
			INNER JOIN (SELECT Location.cap
			FROM Ticket INNER JOIN Event ON Ticket.idEvent = Event.idEvent
            INNER JOIN Room ON Event.idRoom = Room.idRoom
            INNER JOIN Location ON Location.idLocation = Room.idLocation
            WHERE Ticket.idUser = idUser AND DATEDIFF(Event.date, NOW()) > 1
            AND Event.idEvent NOT IN (Select idEvent FROM BlockedEvent)
            GROUP BY Location.cap) AS T ON T.cap = Location.cap 
            LIMIT offset, num;
        END IF;
    ELSE
		SELECT Event.idEvent FROM Event
            WHERE Event.date > NOW() AND Event.idEvent NOT IN (Select idEvent FROM BlockedEvent)
            ORDER BY Event.date
            LIMIT offset, num;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS newRoom;
DELIMITER $$
CREATE PROCEDURE newRoom(
	IN sessionId VARBINARY(256),
	IN name VARCHAR(45),
	IN capacity INT,
	IN nameLocation VARCHAR(45))
BEGIN
	SELECT f_newRoom(sessionId, name, capacity, nameLocation);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getUserData;
DELIMITER $$
CREATE PROCEDURE getUserData(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		SELECT User.username, User.email, User.manager, User.admin, User.regDate FROM User WHERE User.idUser = idUser;
	END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getUserOrders;
DELIMITER $$
CREATE PROCEDURE getUserOrders(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		SELECT Event.idEvent, COUNT(*) AS NumberTicket, Event.price AS Price
		FROM Ticket INNER JOIN Event ON Ticket.idEvent = Event.idEvent
		WHERE Ticket.idUser = idUser
		GROUP BY Event.idEvent, Event.price;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getManagedEvent;
DELIMITER $$
CREATE PROCEDURE getManagedEvent(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
    DECLARE isManager TINYINT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		SELECT Event.idEvent, COUNT(*) AS AcquiredTicket, Room.capacity AS TotalSpace
		FROM Event INNER JOIN Ticket ON Ticket.idEvent = Event.idEvent
		INNER JOIN Room ON Event.idRoom = Room.idRoom
		WHERE Event.idManager = idUser
		GROUP BY Event.idEvent, Room.capacity;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getEventsInCart;
DELIMITER $$
CREATE PROCEDURE getEventsInCart(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
	SET idUser = f_getIdFromSession(sessionId);
	SELECT Cart.idEvent, Cart.nTicket
	FROM Cart WHERE idUser = Cart.idUser;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS noticeRead;
DELIMITER $$
CREATE PROCEDURE noticeRead(
	IN sessionId VARBINARY(256),
    IN idEvent INT)
BEGIN
	DECLARE idUser INT;
    DECLARE count INT;
    DECLARE idNotice INT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		cycle: LOOP
			SET idNotice = -1;
			SELECT Notice.idNotice INTO idNotice FROM Notice WHERE Notice.idEvent = idEvent
				AND Notice.idNotice NOT IN (SELECT NoticeRead.idNotice FROM NoticeRead WHERE NoticeRead.idUser = idUser)
				LIMIT 1;
			
			IF ( idNotice > 0)
			THEN
				INSERT INTO NoticeRead(idUser, idNotice) VALUES(idUser, idNotice);
				ITERATE cycle;
			END IF;
			LEAVE cycle;
		END LOOP cycle;
	END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS checkUsername;
DELIMITER $$
CREATE PROCEDURE checkUsername(
	IN username VARCHAR(45))
BEGIN
	SELECT COUNT(*) AS Value FROM User WHERE User.username = username;
END $$
DELIMITER ;

/* Get the number of notice not read for each event*/
DROP PROCEDURE IF EXISTS getNoticeToRead;
DELIMITER $$
CREATE PROCEDURE getNoticeToRead(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		SELECT Event.idEvent, COUNT(*) AS NumberNoticeNotRead
		FROM Ticket INNER JOIN Event ON Ticket.idUser = idUser AND Ticket.idEvent = Event.idEvent
		INNER JOIN Notice ON Event.idEvent = Notice.idEvent
		WHERE Notice.idNotice NOT IN (SELECT NoticeRead.idNotice FROM NoticeRead WHERE NoticeRead.idUser = idUser)
		GROUP BY Event.idEvent;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS blockEvent;
DELIMITER $$
CREATE PROCEDURE blockEvent(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN message VARCHAR(1024))
BEGIN
	DECLARE permission INT;
    DECLARE idUser INT;
    DECLARE exist INT;
    SET permission = f_userIsAdministrator(sessionId);
    IF (permission >= 10 )
    THEN
		SELECT COUNT(*) INTO exist FROM Event WHERE Event.idEvent = idEvent;
		IF(exist > 0)
		THEN
			INSERT INTO BlockedEvent(idEvent)
			VALUES (idEvent)
			ON DUPLICATE KEY UPDATE
			   BlockedEvent.idEvent = idEvent;
			INSERT INTO Notice(Notice.Text, Notice.date, Notice.idEvent)
			VALUE(message, NOW(), idEvent);
            SELECT 1;
        ELSE 
			SELECT 0;
		END IF;
	ELSE 
		SELECT -1;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS blockUser;
DELIMITER $$
CREATE PROCEDURE blockUser(
	IN sessionId VARBINARY(256),
    IN username VARCHAR(45),
    IN description VARCHAR(256))
BEGIN
	DECLARE permission INT;
    DECLARE idUser INT;
    SET permission = f_userIsAdministrator(sessionId);
    IF (permission >= 10 )
    THEN
		SELECT User.idUser INTO idUser FROM User WHERE User.username = username;
        IF (idUser !=0)
        THEN
			INSERT INTO BlockedUser (idUser, date, description)
			VALUES (idUser, NOW(), description)
			ON DUPLICATE KEY UPDATE
			   BlockedUser.date = NOW(),
			   BlockedUser.description = description;
			DELETE FROM ActiveSession WHERE ActiveSession.idUser = idUser;
            SELECT 1;
		ELSE 
			SELECT 0;
        END IF;
	ELSE
		SELECT -1;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS unlockEvent;
DELIMITER $$
CREATE PROCEDURE unlockEvent(
	IN sessionId VARBINARY(256),
    IN idEvent INT,
    IN message VARCHAR(256))
BEGIN
	DECLARE permission INT;
    DECLARE idUser INT;
    DECLARE exist INT;
    SET permission = f_userIsAdministrator(sessionId);
    IF (permission >= 10 )
    THEN
		SELECT COUNT(*) INTO exist FROM Event WHERE Event.idEvent = idEvent;
        IF(exist > 0)
        THEN
			DELETE FROM BlockedEvent WHERE BlockedEvent.idEvent = idEvent;
			INSERT INTO Notice(Notice.Text, Notice.date, Notice.idEvent)
			VALUE(message, NOW(), idEvent);
			SELECT 1;
		ELSE
			SELECT 0;
        END IF;
	ELSE
		SELECT -1;
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS unlockUser;
DELIMITER $$
CREATE PROCEDURE unlockUser(
	IN sessionId VARBINARY(256),
    IN username VARCHAR(45))
BEGIN
	DECLARE permission INT;
    DECLARE idUser INT;
    SET permission = f_userIsAdministrator(sessionId);
    IF (permission >= 10 )
    THEN
		SELECT User.idUser INTO idUser FROM User WHERE User.username = username;
        IF (idUser > 0)
        THEN
			DELETE FROM BlockedUser WHERE BlockedUser.idUser = idUser;
			SELECT 1;
        ELSE
			SELECT 0;
        END IF;
	ELSE
		SELECT -1;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS getAgenda;
DELIMITER $$
CREATE PROCEDURE getAgenda(
	IN sessionId VARBINARY(256))
BEGIN
	DECLARE idUser INT;
	SET idUser = f_getIdFromSession(sessionId);
    IF (idUser > 0)
    THEN
		SELECT Event.idEvent, COUNT(*) AS NumberTicket, Event.price AS Price FROM Ticket
        INNER JOIN Event ON Ticket.idEvent = Event.idEvent AND Ticket.idUser = idUser
        WHERE Event.idEvent NOT IN (SELECT * FROM BlockedEvent)
		GROUP BY Event.idEvent ORDER BY Event.date;
    END IF;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS userIsAdministrator;
DELIMITER $$
CREATE PROCEDURE userIsAdministrator(
	IN sessionId VARBINARY(256))
BEGIN
	SELECT f_userIsAdministrator(sessionId);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS uniticket.initialize;
DELIMITER $$
CREATE PROCEDURE initialize()
BEGIN
	DECLARE sessionId VARBINARY(256);
	DECLARE idLoc INT;
	DECLARE idRoom INT;
    DECLARE idRoom1 INT;
    DECLARE idEvent INT;
    DECLARE idEvent1 INT;
    DECLARE idEvent2 INT;
    DECLARE idEvent3 INT;
    DECLARE idUser1 VARBINARY(256);
    DECLARE idUser VARBINARY(256);
    DECLARE response TINYINT;
    
    select "i'm here";
    
	SET idUser1 = f_createUser('luca', 'aaa', 'a1@a.com', 0);
	SET idUser = f_createUser('franco', 'aaa', 'a2@a.com', 0);
	SET idUser = f_createUser('lucia', 'aaa', 'a3@a.com', 0);
	SET idUser = f_createUser('lubaldo', 'aaa', 'a4@a.com', 0);
	SET idUser = f_createUser('guido', 'aaa', 'a5@a.com', 0);
	SET idUser = f_createUser('matteo', 'aaa', 'a6@a.com', 0);
	SET idUser = f_createUser('francesco', 'aaa', 'a7@a.com', 0);
	SET idUser = f_createUser('cristian', 'aaa', 'a8@a.com', 0);
	SET idUser = f_createUser('manuel', 'aaa', 'a9@a.com', 0);
	SET idUser = f_createUser('sedia', 'aaa', 'a10@a.com', 0);
	SET idUser = f_createUser('lampada', 'aaa', 'a11@a.com', 0);
	SET idUser = f_createUser('manager', 'manager', 'manager@manager.com', 1);
    
    select idUser;
    select idUser1;
	CALL confirmMail(idUser);
    CALL confirmMail(idUser1);
    
    select "i'm here 2";
	SET sessionId = f_logIn('manager', 'manager');

	select "i'm here3", sessionId;
    SET idLoc = f_newLocation(sessionId, 'casa di Faed', 'via sala 1305', '666', 'cia@ociao.com', '47521');

    select "i'm here3.1", idLoc, @idLoc;
    SET idRoom1 = f_newRoom(sessionId, 'stanza di Michele', 100, 'casa di Faed');
    
	SELECT "i'm here3.2";
	SET idLoc = f_newLocation(sessionId, 'Università', 'via università 50', '666', 'ciao@ciao.com', '47522');
    SET idRoom1 = f_newRoom(sessionId, '3.3', 100, 'Università');
    SET idEvent2 = f_newEvent(sessionId, 'studiamo reti', 'solo reti per sempre', 'Io e la inutilità', 300.0, '2020-03-25  10:30:00', idRoom1);
    
	SELECT "i'm here3.3";
    CALL addImageToEvent(sessionId, idEvent2, 1, 'https://source.unsplash.com/random/?0');
    SET idLoc = f_newLocation(sessionId, 'casa di Cristian', 'via viola 165', '666', 'ciao@ciao.com', '47521');
	SET idRoom = f_newRoom(sessionId, 'sala studio', 30, 'casa di Cristian');
    
	SELECT "i'm here4";
	SET idEvent1 = f_newEvent(sessionId, 'tutti da Cristian', 'si studia', 'Naed', 10.0, '2020-04-24  15:05:00', idRoom);
    SET idEvent3 = f_newEvent(sessionId, 'nuovo evento', 'stavolta lo vedo', 'Naed', 10.0, '2020-06-24  15:05:00', idRoom);
    SET idRoom = f_newRoom(sessionId, 'sala pranzo', 10, 'casa di Cristian');
    SET idEvent = f_newEvent(sessionId, 'andiamo nella stanza di naed', 'ha alexa', 'Con Naed' , 300.0, '2020-05-24  16:05:00', idRoom1);
	CALL addImageToEvent(sessionId, idEvent, 1, 'https://source.unsplash.com/random/?1');
    SET idEvent = f_newEvent(sessionId, 'mangiamo da Cristian i biscotti', 'tanti biscotti', 'Con la mitica partecipazione di NAED', 150.0, '2020-03-24  17:00:00', idRoom);
    
	SELECT "i'm here5";
    CALL createNotice(sessionId, idEvent, 'tutto annullato per mancanza di biscotti', '2020-03-01  15:05:00');
    CALL createNotice(sessionId, idEvent, 'Ha comprato i biscotti', '2020-03-03  16:05:00');
    CALL createNotice(sessionId, idEvent1, 'è stato così bravo che ha fatto tutto a casa', '2020-03-03  17:05:00');
    CALL createNotice(sessionId, idEvent3, 'notifica nuovo evento', '2020-03-03  17:05:00');
    SELECT "i'm here5.1";
    SET response = f_addTicketToCart(sessionId, idEvent, 1);
    select 'expected response = 1', response;
    CALL addImageToEvent(sessionId, idEvent, 1, 'https://source.unsplash.com/random/?2');
    CALL addImageToEvent(sessionId, idEvent, 2, 'https://source.unsplash.com/random/?3');
    CALL addImageToEvent(sessionId, idEvent1, 1, 'https://source.unsplash.com/random/?4');
    CALL addImageToEvent(sessionId, idEvent3, 1, 'https://source.unsplash.com/random?5');
    
	
	SELECT "i'm here6";
    CALL getLocationsAndRoom(sessionId);
    CALL getRoomData(1);
    
    CALL createNotice(sessionId, '1', 'ciao nuova notifica', '2020-04-01 11:05:00');
	CALL createNotice(sessionId, '3', 'é leffetto che ci fara prendere la lode', '2020-04-02 12:05:00');
	CALL createNotice(sessionId, '1', 'é leffetto che ci fara prendere la lode', '2020-04-03 13:05:00');
    CALL addImageToEvent(sessionId, '4', '3', 'https://source.unsplash.com/random/?5');
    CALL addImageToEvent(sessionId, '4', '4', 'https://source.unsplash.com/random/?6');
    CALL addImageToEvent(sessionId, '4', '5', 'https://source.unsplash.com/random/?7');
    CALL addImageToEvent(sessionId, '4', '6', 'https://source.unsplash.com/random/?8');
    
    CALL logOut(sessionId);
    SET sessionId = f_logIn('admin', 'admin');
    CALL blockEvent(sessionId, idEvent, 'Evento bloccato causa bruttezza');
    
    CALL logOut(sessionId);
    SET sessionId = f_logIn('luca', 'aaa');
    SELECT "i'm here6.1";
    SET response = f_addTicketToCart(sessionId, idEvent, 1);
    SET response = f_addTicketToCart(sessionId, 1, 5);
    SET response = f_addTicketToCart(sessionId, idEvent3, 3);
    SELECT "response", response;
    SELECT "i'm here6.1.1";
    SET response = f_addTicketToCart(sessionId, idEvent1, 1);
    SET response = f_addTicketToCart(sessionId, idEvent2, 1);
    SELECT "i'm here6.2";
    CALL viewEventsInCart(sessionId);
    SELECT "i'm here6.3";
    SET response = f_buyTicket(sessionId, idEvent);
    SET response = f_buyTicket(sessionId, idEvent1);
    SET response = f_buyTicket(sessionId, idEvent3);
    SELECT response;
    /*SET response = f_buyTicket(sessionId, idEvent2);*/
    
	SELECT "i'm here7";
    CALL getNotification(sessionId);
    CALL getNoticeToRead(sessionId);
    CALL noticeRead(sessionId, 2);
    CALL getNotification(sessionId);
    SELECT "I'm here7.2";
    CALL getEventHome(sessionId, 0, 10);
    SELECT "i'm here8";
    CALL getEventInfo(idEvent2);
    CALL getUserData(sessionId);
	CALL getUserOrders(sessionId);
    
    SELECT "i'm here 9";
    CALL getNoticeToRead(sessionId);
    /*CALL noticeRead(sessionId, 3);*/
    CALL getNoticeToRead(sessionId);
    SELECT "I'm here 10";
    
    CALL getManagedEvent(sessionId);
    SELECT "I'm here 11";
    CALL logOut(sessionId);
END $$
DELIMITER ;

INSERT INTO User (username, password, email, regDate, admin) VALUES ('admin', 'admin', 'admin@a.com', CURDATE(), 1);

CALL initialize();

/* Non so chi ha messo queste insert into ma causavano problemi, correggile con le SP */
/*INSERT INTO `uniticket`.`ticket` (`idEvent`, `used`, `idTicket`, `idUser`) VALUES ('1', '1', '9', '2');
INSERT INTO `uniticket`.`ticket` (`idEvent`, `used`, `idTicket`, `idUser`) VALUES ('2', '2', '10', '2');
INSERT INTO `uniticket`.`ticket` (`idEvent`, `used`, `idTicket`, `idUser`) VALUES ('4', '3', '11', '2');*/

INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('23', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2019-03-25 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('6', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-03-26 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('7', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-03-27 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('8', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-03-28 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('9', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-03-29 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('10', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-01 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('11', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-02 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('12', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-03 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('13', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-05 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('14', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-08 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('15', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-09 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('16', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-10 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('17', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-11 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('18', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-12 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('19', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-13 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('20', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-24 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('21', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-25 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');
INSERT INTO `uniticket`.`event` (`idEvent`, `name`, `description`, `price`, `date`, `artist`, `idRoom`, `idManager`) VALUES ('22', 'mangiamo da Cristian i biscotti', 'tanti biscotti', '150.00', '2020-07-26 17:00:00', 'Con la mitica partecipazione di NAED', '4', '13');

INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('4', '7', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('23', '8', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('6', '9', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('7', '10', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('8', '11', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('9', '12', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('10', '13', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('11', '14', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('12', '15', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('13', '16', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('14', '17', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('15', '18', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('16', '19', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('17', '20', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('18', '21', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('19', '22', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('20', '23', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('21', '24', "https://source.unsplash.com/random/");
INSERT INTO `uniticket`.`image` (`idEvent`, `number`, `img`) VALUES ('22', '25', "https://source.unsplash.com/random/");

UPDATE Event SET date='2019-07-26 17:00:00' WHERE Event.idEvent = 5;



























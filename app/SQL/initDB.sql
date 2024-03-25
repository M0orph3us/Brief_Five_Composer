#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users (
    uuid binary(16) DEFAULT(UUID_TO_BIN(UUID(), 1)) NOT NULL UNIQUE, firstname Varchar(50) NOT NULL, lastname Varchar(50) NOT NULL, mail Varchar(255) NOT NULL UNIQUE, password Varchar(255) NOT NULL, role Varchar(20) DEFAULT('user') NOT NULL, created_at Date DEFAULT(CURRENT_DATE) NOT NULL, CONSTRAINT PK_users PRIMARY KEY (uuid)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: reservations
#------------------------------------------------------------

CREATE TABLE reservations(
        uuid binary(16) DEFAULT(UUID_TO_BIN(UUID(), 1)) NOT NULL UNIQUE ,
        number_of_persons Integer NOT NULL ,
        baby_chair        Bool NOT NULL ,
        reserved_on       Date NOT NULL ,
        uuid_users          binary(16) NOT NULL
	,CONSTRAINT PK_reservations PRIMARY KEY (uuid)


	,CONSTRAINT FK_reservations_users FOREIGN KEY (uuid_users) REFERENCES users(uuid)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: available_tables
#------------------------------------------------------------

CREATE TABLE availableTables (
    uuid binary(16) DEFAULT(UUID_TO_BIN(UUID(), 1)) NOT NULL UNIQUE, quantity_tables Integer NOT NULL, CONSTRAINT PK_available_tables PRIMARY KEY (uuid)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: opening
#------------------------------------------------------------

CREATE TABLE opening (
    uuid binary(16) DEFAULT(UUID_TO_BIN(UUID(), 1)) NOT NULL UNIQUE, opening_day Varchar(10) NOT NULL, closing_day Varchar(10) NOT NULL, morning_opening_hour Time NOT NULL, morning_closing_hour Time NOT NULL, evening_opening_hour Time NOT NULL, evening_closing_hour Time NOT NULL, CONSTRAINT PK_opening PRIMARY KEY (uuid)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: teams
#------------------------------------------------------------

CREATE TABLE teams (
    uuid binary(16) DEFAULT(UUID_TO_BIN(UUID(), 1)) NOT NULL UNIQUE, firstname Varchar(50) NOT NULL, lastname Varchar(50) NOT NULL, CONSTRAINT PK_teams PRIMARY KEY (uuid)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: toAssign
#------------------------------------------------------------

CREATE TABLE toAssign(
        uuid_teams        binary(16) NOT NULL ,
        uuid_reservations binary(16) NOT NULL 
	,CONSTRAINT PK_toAssign PRIMARY KEY (uuid_teams,uuid_reservations)


	,CONSTRAINT FK_toAssign_teams FOREIGN KEY (uuid_teams) REFERENCES teams(uuid)
	,CONSTRAINT FK_toAssign_reservations0 FOREIGN KEY (uuid_reservations) REFERENCES reservations(uuid)
)ENGINE=InnoDB;
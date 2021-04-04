
CREATE DATABASE Match_System;
USE Match_System;

CREATE TABLE User
(
  user_name VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  Bdate DATE NOT NULL,
  gender CHAR(1) NOT NULL,
  city VARCHAR(50) NOT NULL,
  address VARCHAR(50),
  email VARCHAR(50) NOT NULL,
  approved INT NOT NULL,
  role VARCHAR(10) NOT NULL,
  PRIMARY KEY (user_name)
	
);

CREATE TABLE Stadium
(
  stadium_id INT NOT NULL auto_increment,
  name VARCHAR(50) NOT NULL,
  width INT NOT NULL,
  height INT NOT NULL,
  PRIMARY KEY (stadium_id)
);

CREATE TABLE Teams
(
  team_id INT NOT NULL auto_increment,
  team_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (team_id)
);

CREATE TABLE Matches
(
  match_id INT NOT NULL auto_increment,
  date_time datetime default CURRENT_TIMESTAMP(),
  main_referee VARCHAR(50) NOT NULL,
  lineman_first VARCHAR(50) NOT NULL,
  lineman_second VARCHAR(50) NOT NULL,
  home_team INT NOT NULL,
  away_team INT NOT NULL,
  stadium_id INT NOT NULL,
  PRIMARY KEY (match_id),
  FOREIGN KEY (home_team) REFERENCES Teams(team_id),
  FOREIGN KEY (away_team) REFERENCES Teams(team_id),
  FOREIGN KEY (stadium_id) REFERENCES Stadium(stadium_id)
);

CREATE TABLE Ticket
(
  ticket_id INT NOT NULL auto_increment,
  row INT NOT NULL,
  col INT NOT NULL,
  credit_card_id VARCHAR(50) NOT NULL,
  user_name VARCHAR(50) NOT NULL,
  match_id INT NOT NULL,
  PRIMARY KEY (ticket_id),
  FOREIGN KEY (user_name) REFERENCES User(user_name) on delete  cascade on update no action,
  FOREIGN KEY (match_id) REFERENCES Matches(match_id)
);


ALTER TABLE Ticket
ADD CONSTRAINT Ticket_Cons UNIQUE (row,col,match_id); 
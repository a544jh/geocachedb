CREATE TABLE users
(
id SERIAL PRIMARY KEY,
name varchar(50) UNIQUE NOT NULL,
password varchar(50),
registred date,
role integer,
bio varchar(5000)
);

CREATE TABLE geocaches
(
id SERIAL PRIMARY KEY,
type varchar(30),
name varchar(50),
description varchar(5000),
hint varchar(500),
added date DEFAULT current_date,
ownerid integer REFERENCES users,
difficulty integer,
terrain integer,
latitude decimal,
longitude decimal,
ispublic boolean DEFAULT false,
archived boolean DEFAULT false
);

CREATE TABLE trackables
(
id SERIAL PRIMARY KEY,
name varchar(50),
description varchar(5000),
added date,
ownerid integer REFERENCES users,
trackingcode varchar(10)
);

CREATE TABLE visittype
(
id SERIAL PRIMARY KEY,
type varchar(50)
);

CREATE TABLE logentry
(
id SERIAL PRIMARY KEY,
userid integer REFERENCES users,
comment varchar(5000),
timestamp timestamp,
edited timestamp,
geocacheid integer REFERENCES geocaches,
visittypeid integer REFERENCES visittype
);

CREATE TABLE trackableMoveLog
(
logentry integer REFERENCES logentry,
action integer,
trackable integer REFERENCES trackables,
fromuser integer REFERENCES users,
PRIMARY KEY (logentry, action, trackable)
);

CREATE TABLE trackableVisitedLog
(
logentry integer REFERENCES logentry,
trackable integer REFERENCES trackables,
type integer,
PRIMARY KEY (logentry, trackable, type)
);



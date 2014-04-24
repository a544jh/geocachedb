CREATE TABLE users
(
id SERIAL PRIMARY KEY,
name varchar(50) UNIQUE NOT NULL,
password varchar(50) NOT NULL,
registered date DEFAULT current_date,
role integer NOT NULL,
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
published boolean DEFAULT false,
archived boolean DEFAULT false
);

CREATE TABLE trackables
(
id SERIAL PRIMARY KEY,
name varchar(50),
description varchar(5000),
added date DEFAULT current_date,
ownerid integer REFERENCES users,
trackingcode varchar(6) UNIQUE
);

CREATE TABLE logentry
(
id SERIAL PRIMARY KEY,
userid integer REFERENCES users,
comment varchar(5000),
timestamp timestamp DEFAULT current_timestamp,
edited timestamp,
geocacheid integer REFERENCES geocaches,
visittype varchar(50)
);

CREATE TABLE trackablelog
(
logentry integer REFERENCES logentry,
action varchar(50),
trackable integer REFERENCES trackables,
fromuser integer REFERENCES users,
PRIMARY KEY (logentry, trackable)
);

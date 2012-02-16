drop table if exists points;
create table points
(
	id integer not null primary key autoincrement,  
	user_id integer not null unique,
        username varchar(55),
	swim_points integer,
	bike_points integer,
	run_points integer,
        total_points integer
);

drop table if exists workouts;
create table workouts
(
	id integer not null primary key autoincrement,  
	user_id integer not null,
	sport varchar (25) not null,
	distance real not null,
        date integer not null,
	description text not null
);
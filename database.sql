create Database TaskFlow;
use TaskFlow;


create table user(
    user_id int primary key auto_increment,
    username varchar(50),
    email varchar(100),
)

create table task(
    task_id int primary key auto_increment,
    title varchar(250),
    taskDescription text,
    statut varchar(50) default 'en cours',
    taskType varchar(50) default 'basic',
    assignedTo varchar(100),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id int foreign key references user(user_id)
)


create table bug(
    bug_id int primary key auto_increment,
    critere varchar(250),
    task_id int foreign key references task(task_id)
)

create table feature(
    feature_id int primary key auto_increment,
    requirement varchar(250),
    task_id int foreign key references task(task_id)
)
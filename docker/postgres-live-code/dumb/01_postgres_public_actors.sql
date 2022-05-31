create table actors
(
    id          serial
        primary key,
    first_name  varchar(255) not null,
    last_name   varchar(255) not null,
    gender      varchar(255) not null,
    age         integer not null
);

alter table actors
    owner to postgres;

insert into actors
    (first_name, last_name, gender, age)
values
    ('Leonardo', 'DiCaprio', 'male', 47), --ID: 1
    ('Tom', 'Cruise', 'male', 59), --ID: 2
    ('Robert', 'Downey Jr.', 'male', 57), --ID: 3
    ('Tom', 'Hanks', 'male', 65), --ID: 4
    ('Samuel L.', 'Jackson', 'male', 73), --ID: 5
    ('Johny', 'Depp', 'male', 58), --ID: 6
    ('Will', 'Smith', 'male', 53), --ID: 7
    ('Scarlett', 'Johansson', 'female', 37), --ID: 8
    ('Natalie', 'Portman', 'female', 40), --ID: 9
    ('Jennifer', 'Lawrence', 'female', 31), --ID: 10
    ('Jessica', 'Alba', 'female', 41), --ID: 11
    ('Emma', 'Stone', 'female', 33), --ID: 12
    ('Megan', 'Fox', 'female', 36), --ID: 13
    ('Margot', 'Robbie', 'female', 31); --ID: 14

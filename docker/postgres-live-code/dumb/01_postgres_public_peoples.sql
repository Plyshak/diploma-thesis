create table peoples
(
    id          serial
        primary key,
    first_name  varchar(255) not null,
    last_name   varchar(255) not null,
    gender      varchar(255) not null,
    age         integer not null
);

alter table peoples
    owner to postgres;

insert into peoples
    (first_name, last_name, gender, age)
values
    ('Leonardo', 'DiCaprio', 'male', 47),
    ('Tom', 'Cruise', 'male', 59),
    ('Robert', 'Downey Jr.', 'male', 57),
    ('Tom', 'Hanks', 'male', 65),
    ('Samuel L.', 'Jackson', 'male', 73),
    ('Johny', 'Depp', 'male', 58),
    ('Will', 'Smith', 'male', 53),
    ('Scarlett', 'Johansson', 'female', 37),
    ('Natalie', 'Portman', 'female', 40),
    ('Jennifer', 'Lawrence', 'female', 31),
    ('Jessica', 'Alba', 'female', 41),
    ('Emma', 'Stone', 'female', 33),
    ('Megan', 'Fox', 'female', 36),
    ('Margot', 'Robbie', 'female', 31);

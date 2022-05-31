create table films
(
    id          serial
        primary key,
    title  varchar(255) not null,
    year   integer not null
);

alter table films
    owner to postgres;

insert into films
    (title, year)
values
    ('Titanic', 1997), --ID: 1
    ('Na hraně zítřka', 2015), --ID: 2
    ('Avengers', 2012), --ID: 3
    ('Forrest Gump', 1994), --ID: 4
    ('Nespoutaný Django', 2012), --ID: 5
    ('Alenka v říši divů', 2010), --ID: 6
    ('Hancock', 2008), --ID: 7
    ('V jako Vendeta', 2005), --ID: 8
    ('Hunger Games', 2012), --ID: 9
    ('Fantastická čtyřka', 2005), --ID: 10
    ('Cruella', 2021), --ID: 11
    ('Transformers', 2007), --ID: 12
    ('Tarzan', 2016); --ID: 13

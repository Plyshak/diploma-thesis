create table actor_to_film
(
    id          serial
        primary key,
    film_id  integer not null
        references films,
    actor_id   integer not null
        references actors
);

alter table actor_to_film
    owner to postgres;

insert into actor_to_film
    (film_id, actor_id)
values
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (3, 8),
    (8, 9),
    (9, 10),
    (10, 11),
    (11, 12),
    (12, 13),
    (13, 14);

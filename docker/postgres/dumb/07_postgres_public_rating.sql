create table rating
(
    id          serial
        primary key,
    module      varchar(255) not null,
    module_id   integer not null,
    author_id   integer not null
        references users,
    rating      smallint not null,
    created_at  timestamp    not null,
    updated_at  timestamp    not null
);

alter table rating
    owner to postgres;

insert into rating
    (module, module_id, author_id, rating, created_at, updated_at)
values
    ('discussion', 1, 2, 1, now(), now()),
    ('discussion', 1, 4, 1, now(), now()),
    ('discussion', 1, 5, 1, now(), now()),
    ('discussion', 1, 6, 1, now(), now()),
    ('discussion', 2, 1, 1, now(), now()),
    ('discussion', 2, 3, 1, now(), now()),
    ('discussion', 2, 5, 1, now(), now()),
    ('discussion', 2, 6, 1, now(), now()),
    ('discussion', 3, 3, 1, now(), now()),
    ('discussion', 3, 5, 1, now(), now()),
    ('comment', 1, 2, -1, now(), now()),
    ('comment', 2, 3, 1, now(), now()),
    ('comment', 3, 2, 1, now(), now()),
    ('comment', 4, 3, 1, now(), now()),
    ('comment', 5, 4, 1, now(), now()),
    ('comment', 6, 5, 1, now(), now());
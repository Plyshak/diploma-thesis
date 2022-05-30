create table comment
(
    id          serial
        primary key,
    created_at  timestamp    not null,
    updated_at  timestamp    not null,
    discussion_id   integer
        references discussion,
    author_id   integer
        references users
);

alter table comment
    owner to postgres;

insert into comment
    (created_at, updated_at, discussion_id, author_id)
values
    (now(), now(), 1, 3), -- ID: 1
    (now(), now(), 1, 2), -- ID: 2
    (now(), now(), 1, 3), -- ID: 3
    (now(), now(), 2, 2), -- ID: 4
    (now(), now(), 2, 5), -- ID: 5
    (now(), now(), 3, 4); -- ID: 6
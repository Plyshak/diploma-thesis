create table label_stack
(
    id         serial
        primary key,
    module     varchar(255) not null,
    module_id  integer      not null,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

alter table label_stack
    owner to postgres;

insert into label_stack
    (module, module_id, created_at, updated_at)
values
    ('library', 1, now(), now()), -- ID: 1
    ('library', 2, now(), now()), -- ID: 2
    ('library', 3, now(), now()), -- ID: 3
    ('library', 4, now(), now()), -- ID: 4
    ('library', 5, now(), now()), -- ID: 5
    ('course', 1, now(), now()), -- ID: 6
    ('course', 2, now(), now()), -- ID: 7
    ('course', 3, now(), now()), -- ID: 8
    ('course', 4, now(), now()), -- ID: 9
    ('course', 5, now(), now()), -- ID: 10
    ('course', 6, now(), now()), -- ID: 11
    ('discussion', 1, now(), now()), -- ID: 12
    ('discussion', 2, now(), now()), -- ID: 13
    ('discussion', 3, now(), now()); -- ID: 14

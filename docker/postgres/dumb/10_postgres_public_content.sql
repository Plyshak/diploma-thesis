create table content
(
    id         serial
        primary key,
    module     varchar(255) not null,
    module_id  integer      not null,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

alter table content
    owner to postgres;

insert into content
    (module, module_id, created_at, updated_at)
values
    ('library', 1, now(), now()), -- ID: 1
    ('library', 2, now(), now()), -- ID: 2
    ('library', 3, now(), now()), -- ID: 3
    ('library', 4, now(), now()), -- ID: 4
    ('library', 5, now(), now()), -- ID: 5
    ('coursePage', 1, now(), now()), -- ID: 6
    ('coursePage', 2, now(), now()), -- ID: 7
    ('coursePage', 3, now(), now()), -- ID: 8
    ('coursePage', 4, now(), now()), -- ID: 9
    ('coursePage', 5, now(), now()), -- ID: 10
    ('coursePage', 6, now(), now()), -- ID: 11
    ('coursePage', 7, now(), now()), -- ID: 12
    ('coursePage', 8, now(), now()), -- ID: 13
    ('coursePage', 9, now(), now()), -- ID: 14
    ('coursePage', 10, now(), now()), -- ID: 15
    ('coursePage', 11, now(), now()), -- ID: 16
    ('coursePage', 12, now(), now()), -- ID: 17
    ('coursePage', 13, now(), now()), -- ID: 18
    ('coursePage', 14, now(), now()), -- ID: 19
    ('coursePage', 15, now(), now()), -- ID: 20
    ('coursePage', 16, now(), now()), -- ID: 21
    ('coursePage', 17, now(), now()), -- ID: 22
    ('coursePage', 18, now(), now()), -- ID: 23
    ('coursePage', 19, now(), now()), -- ID: 24
    ('coursePage', 20, now(), now()), -- ID: 25
    ('coursePage', 21, now(), now()), -- ID: 26
    ('coursePage', 22, now(), now()), -- ID: 27
    ('coursePage', 23, now(), now()), -- ID: 28
    ('discussion', 1, now(), now()), -- ID: 29
    ('discussion', 2, now(), now()), -- ID: 30
    ('discussion', 3, now(), now()), -- ID: 31
    ('comment', 1, now(), now()), -- ID: 32
    ('comment', 2, now(), now()), -- ID: 33
    ('comment', 3, now(), now()), -- ID: 34
    ('comment', 4, now(), now()), -- ID: 35
    ('comment', 5, now(), now()), -- ID: 36
    ('comment', 6, now(), now()); -- ID: 37

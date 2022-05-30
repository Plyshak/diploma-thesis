create table plugin
(
    id         serial
        primary key,
    content_id integer              not null
        references content
            on update cascade on delete cascade,
    plugin     varchar(255)         not null,
    plugin_id  integer              not null,
    created_at timestamp            not null,
    updated_at timestamp            not null,
    visibility boolean default true not null,
    position   integer default 0    not null,
    unique (id, content_id)
);

alter table plugin
    owner to postgres;

insert into plugin
    (content_id, plugin, plugin_id, created_at, updated_at, visibility, position)
values
    -- library
    (1, 'textBlock', 1, now(), now(), true, 0), -- ID: 1
    (1, 'codeBlock', 1, now(), now(), true, 1), -- ID: 2
    (1, 'textBlock', 2, now(), now(), true, 2), -- ID: 3
    (2, 'textBlock', 3, now(), now(), true, 0), -- ID: 4
    (3, 'textBlock', 4, now(), now(), true, 0), -- ID: 5
    (4, 'textBlock', 5, now(), now(), true, 0), -- ID: 6
    (5, 'textBlock', 6, now(), now(), true, 0), -- ID: 7
    -- course
    (6, 'liveCode', 1, now(), now(), true, 0), -- ID: 8
    (7, 'liveCode', 2, now(), now(), true, 0), -- ID: 9
    (8, 'testForm', 1, now(), now(), true, 0), -- ID: 10
    (9, 'liveCode', 3, now(), now(), true, 0), -- ID: 11
    (10, 'liveCode', 4, now(), now(), true, 0), -- ID: 12
    (11, 'testForm', 2, now(), now(), true, 0), -- ID: 13
    (12, 'testForm', 3, now(), now(), true, 0), -- ID: 14
    (13, 'textBlock', 7, now(), now(), true, 0), -- ID: 15
    (14, 'textBlock', 8, now(), now(), true, 0), -- ID: 16
    (15, 'textBlock', 9, now(), now(), true, 0), -- ID: 17
    (16, 'textBlock', 10, now(), now(), true, 0), -- ID: 18
    (17, 'textBlock', 11, now(), now(), true, 0), -- ID: 19
    (18, 'textBlock', 12, now(), now(), true, 0), -- ID: 20
    (19, 'textBlock', 13, now(), now(), true, 0), -- ID: 21
    (20, 'textBlock', 14, now(), now(), true, 0), -- ID: 22
    (21, 'textBlock', 15, now(), now(), true, 0), -- ID: 23
    (22, 'textBlock', 16, now(), now(), true, 0), -- ID: 24
    (23, 'textBlock', 17, now(), now(), true, 0), -- ID: 25
    (24, 'textBlock', 18, now(), now(), true, 0), -- ID: 26
    (25, 'textBlock', 19, now(), now(), true, 0), -- ID: 27
    (26, 'textBlock', 20, now(), now(), true, 0), -- ID: 28
    (27, 'textBlock', 21, now(), now(), true, 0), -- ID: 29
    (28, 'textBlock', 22, now(), now(), true, 0), -- ID: 30
    -- discussion
    (29, 'textBlock', 23, now(), now(), true, 0), -- ID: 31
    (29, 'codeBlock', 2, now(), now(), true, 1), -- ID: 32
    (30, 'textBlock', 24, now(), now(), true, 0), -- ID: 33
    (30, 'codeBlock', 3, now(), now(), true, 1), -- ID: 34
    (31, 'textBlock', 25, now(), now(), true, 0), -- ID: 35
    (31, 'codeBlock', 4, now(), now(), true, 1), -- ID: 36
    -- comment
    (32, 'textBlock', 26, now(), now(), true, 0), -- ID: 37
    (33, 'textBlock', 27, now(), now(), true, 0), -- ID: 38
    (34, 'textBlock', 28, now(), now(), true, 0), -- ID: 39
    (35, 'textBlock', 29, now(), now(), true, 0), -- ID: 40
    (36, 'textBlock', 30, now(), now(), true, 0), -- ID: 41
    (36, 'codeBlock', 5, now(), now(), true, 1), -- ID: 41
    (37, 'textBlock', 31, now(), now(), true, 0), -- ID: 42
    (37, 'pictureBlock', 1, now(), now(), true, 0); -- ID: 43

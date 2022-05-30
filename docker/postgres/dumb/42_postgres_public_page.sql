create table page
(
    id          serial
        primary key,
    created_at   timestamp not null,
    updated_at   timestamp not null,
    chapter_id   integer
        references chapter,
    position int default 1
);

alter table page
    owner to postgres;


insert into page
    (created_at, updated_at, chapter_id, position)
values
    -- course 1 chapter 1
    (now(), now(), 1, 1), -- ID: 1
    (now(), now(), 1, 2), -- ID: 2
    -- course 1 chapter 2
    (now(), now(), 2, 1), -- ID: 3
    -- course 1 chapter 3
    (now(), now(), 3, 1), -- ID: 4
    (now(), now(), 3, 2), -- ID: 5
    -- course 1 chapter 4
    (now(), now(), 4, 1), -- ID: 6
    (now(), now(), 4, 2), -- ID: 7
    -- course 2 chapter 1
    (now(), now(), 5, 1), -- ID: 8
    (now(), now(), 5, 2), -- ID: 9
    -- course 2 chapter 2
    (now(), now(), 6, 1), -- ID: 10
    -- course 3 chapter 1
    (now(), now(), 7, 1), -- ID: 11
    -- course 3 chapter 2
    (now(), now(), 8, 1), -- ID: 12
    -- course 3 chapter 3
    (now(), now(), 9, 1), -- ID: 13
    -- course 3 chapter 4
    (now(), now(), 10, 1), -- ID: 14
    -- course 4 chapter 1
    (now(), now(), 11, 1), -- ID: 15
    (now(), now(), 11, 2), -- ID: 16
    -- course 4 chapter 2
    (now(), now(), 12, 1), -- ID: 17
    -- course 5 chapter 1
    (now(), now(), 13, 1), -- ID: 18
    (now(), now(), 13, 2), -- ID: 19
    -- course 5 chapter 2
    (now(), now(), 14, 1), -- ID: 20
    -- course 6 chapter 1
    (now(), now(), 15, 1), -- ID: 21
    (now(), now(), 15, 2), -- ID: 22
    -- course 1 chapter 2
    (now(), now(), 16, 1); -- ID: 23

create table discussion
(
    id          serial
        primary key,
    created_at  timestamp    not null,
    updated_at  timestamp    not null,
    title       varchar(255),
    course_id   integer
        references course,
    author_id   integer
        references users,
    viewed      integer default 0,
    solved      boolean default false
);

alter table discussion
    owner to postgres;

insert into discussion
    (created_at, updated_at, title, course_id, author_id, viewed, solved)
values
    (now(), now(), 'PHPSpec nemůže najít soubor v docker kontejneru', 3, 2, 12, false), -- ID: 1
    (now(), now(), 'PHPStan unexpexted error while parsing file', 2, 3, 1899, true), -- ID: 2
    (now(), now(), 'PHP nejde nainstalovat na PC', 3, 3, 0, false); -- ID: 3
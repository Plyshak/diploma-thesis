create table topic
(
    id          serial
        primary key,
    created_at   timestamp not null,
    updated_at   timestamp not null,
    title        varchar(255)
);

alter table topic
    owner to postgres;

insert into topic
    (created_at, updated_at, title)
values
    (now(), now(), 'Digitální akademie'), -- ID: 1
    (now(), now(), 'Datová analýza'), -- ID: 2
    (now(), now(), 'Úvod do PHP'); -- ID: 3
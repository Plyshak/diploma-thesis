create table "label" (
    "id" serial not null,
    "title" character varying(255) not null,
    "created_at" timestamp NOT NULL,
    "updated_at" timestamp NOT NULL,
    primary key ("id"),
    unique ("id"),
    unique ("title")
);

create table "label_stack" (
    "id" serial not null,
    "module" character varying(255) NOT NULL,
    "module_id" integer NOT NULL,
    "created_at" timestamp NOT NULL,
    "updated_at" timestamp NOT NULL,
    primary key ("id"),
    unique ("id")
);

create table "label_bridge" (
    "id" serial not null,
    "label_stack_id" serial not null,
    "label_id" serial not null,
    primary key ("id"),
    unique ("id"),
    foreign key ("label_stack_id")
        references "label_stack" ("id")
        on delete NO ACTION
        on update NO ACTION,
    foreign key ("label_id")
        references "label" ("id")
        on delete NO ACTION
        on update NO ACTION
);

insert into "label"
values
       (1, 'PHP', now(), now()),
       (2, 'Javascript', now(), now()),
       (3, 'Java', now(), now()),
       (4, 'C++', now(), now()),
       (5, 'C#', now(), now()),
       (6, 'Ruby', now(), now()),
       (7, 'jQuery', now(), now()),
       (8, 'Design', now(), now()),
       (9, 'Kurz', now(), now()),
       (10, 'Přednáška', now(), now()),
       (11, 'iPhone', now(), now()),
       (12, 'Grafika', now(), now()),
       (13, 'UI', now(), now());

SELECT setval('label_id_seq', (SELECT MAX(id) FROM label));
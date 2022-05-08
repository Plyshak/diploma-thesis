create table "library" (
    "id" serial not null,
    "title" character varying(255) not null,
    "perex" text,
    "image" character varying(255) not null,
    "created_at" timestamp NOT NULL,
    "updated_at" timestamp NOT NULL,
    "author_id" int not null,
    primary key ("id"),
    unique ("id"),
    foreign key ("author_id")
        references "users" ("id")
        on delete NO ACTION
        on update NO ACTION
);
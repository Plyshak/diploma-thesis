CREATE TABLE "content" (
  "id" serial NOT NULL,
  "module" character varying(255) NOT NULL,
  "module_id" integer NOT NULL,
  "created_at" timestamp NOT NULL,
  "updated_at" timestamp NOT NULL,
  primary key ("id"),
  unique ("id")
);

create table "plugin" (
  "id" serial not null,
  "content_id" integer not null,
  "plugin" character varying(255) not null,
  "plugin_id" integer not null,
  "created_at" timestamp not null,
  "updated_at" timestamp not null,
  "visibility" boolean not null default true,
  "position" integer default 0 not null,
  primary key ("id"),
  unique ("id", "content_id"),
  foreign key ("content_id")
    references "content" ("id")
      on delete CASCADE
      on update cascade
);

create table "plugin_text_block" (
  "id" serial not null,
  "created_at" timestamp not null,
  "updated_at" timestamp not null,
  "title" character varying(255),
  "show_title" boolean default true,
  "perex" text,
  "body" text,
  "button_title" character varying(255),
  "button_show" boolean default true,
  "button_url" character varying(255),
  "button_blank" boolean default false,
  primary key ("id"),
  unique ("id")
);

create table "plugin_picture_block" (
  "id" serial not null,
  "created_at" timestamp not null,
  "updated_at" timestamp not null,
  "title" character varying(255),
  "show_title" boolean default true,
  "image" varchar(255),
  "picture_align" character varying(255) not null,
  "picture_description" text,
  "picture_show_description" boolean default false,
  "picture_width" character varying(255),
  primary key ("id"),
  unique ("id")
);

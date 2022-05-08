create table library
(
    id         serial
        primary key,
    title      varchar(255) not null,
    image      varchar(255) not null,
    created_at timestamp    not null,
    updated_at timestamp    not null,
    author_id  integer      not null
        references users (id),
    perex      text
);

alter table library
    owner to postgres;

INSERT INTO public.library
    (title, image, created_at, updated_at, author_id, perex)
VALUES
    ('Prvni upraveny clanek v knihovne', 'upload/library/1FxXThACdiFOt59Q9GSii4MDwSyrQsgxEx2ABfyht4QOjWuS2S4brD9hOX34wHjZE3fMITeUEMFtZk2fBr1w2qxaIbG5p8WD2dpxIRGV2rlJYJH1rJXZHJ5KG4PzZVAk.jpg', '2022-05-04 10:34:41.010369', '2022-05-05 14:43:13.976672', 2, 'neco k tomu napiseme aby se nereklo');

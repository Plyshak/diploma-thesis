create table plugin_code_block
(
    id                       serial
        primary key,
    created_at               timestamp    not null,
    updated_at               timestamp    not null,
    title                    varchar(255),
    show_title               boolean default true,
    code                     text,
    language                 varchar(255)
);

alter table plugin_code_block
    owner to postgres;

insert into plugin_code_block
    (created_at, updated_at, title, show_title, code, language)
values
    (now(), now(), 'Blok kódu', false, '<?php declare(strict_types = 1);
class Test {
    protected $text = "Hello World!";

    public function helloWorld() : void
    {
        echo $this->text;
    }
}', 'php'), -- ID: 1
    (now(), now(), 'Blok kódu', false, 'docker run -d \
--name devtest \
--mount source=myvol2,target=/app \
nginx:latest', 'docker'), -- ID: 2
    (now(), now(), 'Blok kódu', false, 'parameters:
    level: 6
    paths:
        src
        tests', 'yml'), -- ID: 3
    (now(), now(), 'Blok kódu', false, 'PS C:\apache24_php71\bin> scoop install php
Installing ''php'' (7.1.4).
php-7.1.4-Win32-VC14-x64.zip (23,4 MB) [=================================================================================================================================================] 100%
Checking hash of php-7.1.4-Win32-VC14-x64.zip... ok.
Extracting... done.
Linking ~\scoop\apps\php\current => ~\scoop\apps\php\7.1.4
Creating shim for ''php''.
Creating shim for ''php-cgi''.
Persisting cli
The syntax of the command is incorrect.
File not found - C:\Users\Silver Zachara\scoop\apps\php\current\cli
Persisting php.ini-production
The syntax of the command is incorrect.
Running post-install script...
gc : Cannot find path ''C:\Users\Silver Zachara\scoop\apps\php\current\cli\php.ini'' because it does not exist.
At line:14 char:2', 'powershell'), -- ID: 4
    (now(), now(), 'Blok kódu', false, 'parameters:
    level: 6
    paths:
        - src
        - tests', 'yml'), -- ID: 5
    (now(), now(), 'Vyzkoušejte si:', true, '<? echo "Hello PHP World!";', 'php'), -- ID: 6
    (now(), now(), 'Vyzkoušejte si:', true, 'console.log("Hello JS World!");', 'js'), -- ID: 7
    (now(), now(), 'Vyzkoušejte si:', true, 'print("Hello Python3 World!");', 'python'), -- ID: 8
    (now(), now(), 'Vyzkoušejte si:', true, 'select * from actors;

nebo

select * from films;

nebo

select * from actors
  where id in (
      select actor_id from actor_to_film
        where film_id = (select id from films where title = ''Avengers'')
  );
', 'sql'); -- ID: 9


# noinspection SqlNoDataSourceInspectionForFile

CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment NOT NULL,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nick            varchar(100),
email           varchar(255),
password        varchar(255),
image           varchar(255),
created_at      datetime,
updated_at      datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(
NULL,
'user',
'Miguel',
'Gozaine',
'GOZAEL',
'hordemzerado@gmail.com',
'pass',
NULL,
CURTIME(),
CURTIME(),
NULL
);

INSERT INTO users VALUES(
NULL,
'user',
'Juan',
'Lopez',
'Juani',
'juan@juan.com',
'juan',
NULL,
CURTIME(),
CURTIME(),
NULL
);

INSERT INTO users VALUES(
NULL,
'user',
'Pedro',
'Perez',
'ppez',
'pedro@pedro.com',
'pedro',
NULL,
CURTIME(),
CURTIME(),
NULL
);

CREATE TABLE IF NOT EXISTS images(
id              int(255) auto_increment NOT NULL,
user_id         int(255),
image_path      varchar(255),
description     text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=InnoDb;

INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'Test description 1', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 1, 'playa.jpg', 'Test description 2', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 3, 'sol.jpg', 'Test description 4', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 2, 'arena.jpg', 'Test description 3', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS comments(
id              int(255) auto_increment NOT NULL,
user_id         int(255),
image_id        int(255),
content         text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)Engine=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 4, 'Buena foto en familia', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1, 2, 'Buena foto de playa', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 4, 'QUE BUENO!!!!!', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
id              int(255) auto_increment NOT NULL,
user_id         int(255),
image_id        int(255),
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)Engine=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());

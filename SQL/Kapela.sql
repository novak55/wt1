/*drop table album;
drop table kapela;
drop table oblibena_kapela;
drop table pisen;
drop table stat;
drop table zanr;
drop table uzivatel;
*/

CREATE TABLE zanr (
    zanr_id serial PRIMARY KEY,
    popis VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE stat (
    stat_id serial PRIMARY KEY,
    zkratka varchar(2) UNIQUE NOT NULL ,
    nazev VARCHAR(100) NOT NULL
);


create table kapela  (
    kapela_id serial PRIMARY KEY,
    nazev_kapely VARCHAR(150) UNIQUE NOT NULL ,
    rok_zalozeni INTEGER NOT NULL ,
    rok_ukonceni INTEGER,
    zanr_id INTEGER REFERENCES zanr(zanr_id),
    mesto VARCHAR(50) NOT NULL,
    stat_id INTEGER REFERENCES stat(stat_id)
);
alter table kapela
    ADD CONSTRAINT rok_zalozeni_chk CHECK (rok_zalozeni BETWEEN 1900 AND to_char(now(),'YYYY')::integer),
    ADD CONSTRAINT rok_ukonceni_chk CHECK (rok_ukonceni BETWEEN 1900 AND to_char(now(),'YYYY')::integer OR null);

CREATE TABLE album (
                       album_id serial PRIMARY KEY,
                       kapela_id INTEGER REFERENCES kapela(kapela_id) ON DELETE CASCADE NOT NULL ,
                       nazev_alba VARCHAR(100) NOT NULL,
                       vydano INTEGER NOT NULL
);
alter table album
    ADD CONSTRAINT vydano_chk CHECK (vydano BETWEEN 1900 AND to_char(now(),'YYYY')::integer);

CREATE TABLE pisen (
                       pisen_id serial PRIMARY KEY,
                       album_id INTEGER REFERENCES album(album_id) ON DELETE CASCADE NOT NULL ,
                       nazev_pisne VARCHAR(100) NOT NULL ,
                       delka varchar(5) NOT NULL,
                       poradi INTEGER NOT NULL
);

CREATE TABLE role (
                      role_id VARCHAR(20) UNIQUE PRIMARY KEY NOT NULL ,
                      role_popis VARCHAR(100)
);
INSERT INTO role values
    ('admin', 'správce stránek a uživatelů'),
    ('navstevnik','Uživatel stránek, může si označovat oblíbené kapely.');

CREATE TABLE uzivatel (
                         user_id SERIAL PRIMARY KEY NOT NULL,
                         user_name VARCHAR(150) NOT NULL,
                         login VARCHAR(150) UNIQUE NOT NULL,
                         password VARCHAR(255) NOT NULL,
                         role_id VARCHAR(20) REFERENCES role(role_id) NOT NULL
);

--ALTER TABLE uzivatel rename column role to role_id;
--ALTER TABLE pisen ADD COLUMN poradi INTEGER NOT NULL;
--ALTER TABLE album rename column nazev to nazev_alba;
--ALTER TABLE uzivatel add constraint role_fkey FOREIGN KEY (role_id) REFERENCES role(role_id);
--alter table uzivatel drop constraint user_pkey;
--alter table uzivatel add constraint "user_pkey" PRIMARY KEY (user_id);

--DROP TABLE oblibena_kapela;

CREATE TABLE oblibena_kapela(
    user_id INTEGER REFERENCES uzivatel(user_id) ON DELETE CASCADE NOT NULL,
    kapela_id INTEGER REFERENCES kapela(kapela_id) ON DELETE CASCADE NOT NULL
);
ALTER TABLE oblibena_kapela ADD CONSTRAINT "oblibena_kapela_pkey" PRIMARY KEY (user_id, kapela_id);


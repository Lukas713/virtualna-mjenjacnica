drop database if exists virtualna_mjenjacnica;

create database virtualna_mjenjacnica;

use virtualna_mjenjacnica;

create table tip_korisnika
(
    tip_korisnika_id    int not null primary key auto_increment,
    naziv               varchar(50) not null
);

create table korisnik
(
    korisnik_id         int not null primary key auto_increment,
    tip_korisnika_id    int not null,
    korisnicko_ime      varchar(50) not null,
    lozinka             varchar(255) not null,
    ime                 varchar(50),
    prezime             varchar(50),
    email               varchar(50) not null,
    slika               varchar(255)
);

create table valuta
(
    valuta_id           int not null primary key auto_increment,
    moderator_id        int not null,
    naziv               varchar(50) not null,
    tecaj               double,
    slika               varchar(255),
    zvuk                varchar(255),
    aktivno_od          time,
    aktivno_do          time,
    datum_azuriranja    date
);

create table sredstva
(
    sredstva_id         int not null primary key auto_increment,
    korisnik_id           int not null,
    valuta_id           int not null,
    iznos               double
);

create table zahtjev
(
    zahtjev_id              int not null primary key auto_increment,
    korisnik_id             int not null,
    iznos                   decimal not null,
    prodajem_valuta_id      int not null,
    kupujem_valuta_id       int not null,
    datum_vrijeme_kreiranja datetime,
    prihvacen               boolean default false
);

alter table korisnik add foreign key (tip_korisnika_id) references tip_korisnika(tip_korisnika_id) on delete cascade;

alter table valuta add foreign key (moderator_id) references korisnik(korisnik_id) on delete cascade;

alter table sredstva add foreign key (korisnik_id) references korisnik(korisnik_id) on delete cascade;
alter table sredstva add foreign key (valuta_id) references valuta(valuta_id) on delete cascade;

alter table zahtjev add foreign key (korisnik_id) references korisnik(korisnik_id) on delete cascade;
alter table zahtjev add foreign key (prodajem_valuta_id) references valuta(valuta_id) on delete cascade;
alter table zahtjev add foreign key (kupujem_valuta_id) references valuta(valuta_id) on delete cascade;

insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'admin');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'moderator');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'korisnik');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'anonimni');

insert into korisnik (korisnik_id, tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)  values (null, 1, 'admin', '$2y$12$ceJIUxPAZbbnI/0OIFZwFuAvHNXnTNLyRl4NK52D3mEbzeKIg6DNu', '', '', 'admin@gmail.com', '');

insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 1, 'kuna', 1, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');
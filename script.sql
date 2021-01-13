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
    lozinka             varchar(50) not null,
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

alter table korisnik add foreign key (tip_korisnika_id) references tip_korisnika(tip_korisnika_id);

alter table valuta add foreign key (moderator_id) references korisnik(korisnik_id);

alter table sredstva add foreign key (korisnik_id) references korisnik(korisnik_id);
alter table sredstva add foreign key (valuta_id) references valuta(valuta_id);

alter table zahtjev add foreign key (korisnik_id) references korisnik(korisnik_id);
alter table zahtjev add foreign key (prodajem_valuta_id) references valuta(valuta_id);
alter table zahtjev add foreign key (kupujem_valuta_id) references valuta(valuta_id);

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

alter table korisnik add foreign key (tip_korisnika_id) references tip_korisnika(tip_korisnika_id);

alter table valuta add foreign key (moderator_id) references korisnik(korisnik_id);

alter table sredstva add foreign key (korisnik_id) references korisnik(korisnik_id);
alter table sredstva add foreign key (valuta_id) references valuta(valuta_id);

alter table zahtjev add foreign key (korisnik_id) references korisnik(korisnik_id);
alter table zahtjev add foreign key (prodajem_valuta_id) references valuta(valuta_id);
alter table zahtjev add foreign key (kupujem_valuta_id) references valuta(valuta_id);

insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'admin');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'moderator');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'korisnik');
insert into tip_korisnika (tip_korisnika_id, naziv) values (null, 'anonimni');

insert into korisnik (korisnik_id, tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)  values (null, 1, 'admin', '$2y$12$ceJIUxPAZbbnI/0OIFZwFuAvHNXnTNLyRl4NK52D3mEbzeKIg6DNu', '', '', 'admin@gmail.com', '');
insert into korisnik (korisnik_id, tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)  values (null, 2, 'root', '$2y$12$ceJIUxPAZbbnI/0OIFZwFuAvHNXnTNLyRl4NK52D3mEbzeKIg6DNu', '', '', 'admin123@gmail.com', '');
insert into korisnik (korisnik_id, tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)  values (null, 3, 'lukas', '$2y$12$ceJIUxPAZbbnI/0OIFZwFuAvHNXnTNLyRl4NK52D3mEbzeKIg6DNu', '', '', 'admin321@gmail.com', '');
insert into korisnik (korisnik_id, tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)  values (null, 4, 'lee', '$2y$12$ceJIUxPAZbbnI/0OIFZwFuAvHNXnTNLyRl4NK52D3mEbzeKIg6DNu', '', '', 'admin221@gmail.com', '');

insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 2, 'euro', 0.30, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');
insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 2, 'euro', 0.30, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');
insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 2, 'da', 0.21, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');
insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 2, 'fa', 0.32, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');
insert into valuta (valuta_id, moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) values (null, 2, 'ad', 0.10, '', '', '12:34:54.1237', '12:34:54.1237', '12-10-25');

insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 2, 1, 52.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 3, 2, 210.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 4, 3, 51.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 1, 4, 52.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 2, 5, 35.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 3, 4, 530.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 4, 3, 60.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 3, 2, 40.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 4, 1, 10.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 2, 2, 20.50);
insert into sredstva (sredstva_id, korisnik_id, valuta_id, iznos) values (null, 1, 3, 545.50);
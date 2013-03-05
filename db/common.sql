CREATE SEQUENCE "language_id" START WITH 10;
CREATE TABLE "language" (
    "id" INTEGER NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);
insert into "language" ("id", "name", "code", "native") values (1, 'English', 'en', 'English', true);
insert into "language" ("id", "name", "code", "native") values (2, 'Russian', 'ru', 'Русский', true);


CREATE SEQUENCE "unit_id" START WITH 10;
CREATE TABLE "unit" (
    "id" INTEGER NOT NULL default nextval('unit_id'),
    "name" CHARACTER VARYING(16) NULL,
    "sign" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "unit_i18n_id";
CREATE TABLE "unit_i18n" (
    "id" BIGINT NOT NULL default nextval('unit_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX unit_i18n_object_id_idx ON unit_i18n(object_id);
CREATE INDEX unit_i18n_language_id_idx ON unit_i18n(language_id);
CREATE UNIQUE INDEX unit_i18n_object_id_language_id_uidx ON "unit_i18n"("object_id", "language_id");

insert into "unit" ("id", "name", "sign") values (1, 'money', '&euro;');
insert into "unit" ("id", "name", "sign") values (2, 'area', 'm<sup>2</sup>');
insert into "unit" ("id", "name", "sign") values (3, 'quantity', '');
insert into "unit" ("id", "name", "sign") values (4, 'flag', '');	-- all internal options
insert into "unit_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "unit";


CREATE SEQUENCE "city_id" START WITH 10;
CREATE TABLE "city" (
    "id" INTEGER NOT NULL default nextval('unit_id'),
    "name" CHARACTER VARYING(16) NULL,
    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,
    "region_id" BIGINT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "city_i18n_id";
CREATE TABLE "city_i18n" (
    "id" BIGINT NOT NULL default nextval('city_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX city_i18n_object_id_idx ON city_i18n(object_id);
CREATE INDEX city_i18n_language_id_idx ON city_i18n(language_id);
CREATE UNIQUE INDEX city_i18n_object_id_language_id_uidx ON "city_i18n"("object_id", "language_id");

insert into "city" ("id", "name", "latitude", "longitude") values (1, 'Nicosia', 0, 0);
insert into "city" ("id", "name", "latitude", "longitude") values (2, 'Limassol', 0, 0);
insert into "city" ("id", "name", "latitude", "longitude") values (3, 'Larnaka', 0, 0);
insert into "city" ("id", "name", "latitude", "longitude") values (4, 'Paphos', 0, 0);
insert into "city_i18n" ("object_id", "language_id", "name") select "id", 1, "name" from "city";

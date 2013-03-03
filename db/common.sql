CREATE SEQUENCE "language_id";
CREATE TABLE "language" (
    "id" BIGINT NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);
insert into "language" (name) values ('English', 'en', 'English', true);
insert into "language" (name) values ('Russian', 'ru', 'Русский', true);


CREATE SEQUENCE "unit_id";
CREATE TABLE "unit" (
    "id" BIGINT NOT NULL default nextval('unit_id'),
    "name" CHARACTER VARYING(16) NULL,
    "sign" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "unit_i18n_id";
CREATE TABLE "unit_i18n" (
    "id" BIGINT NOT NULL default nextval('unit_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "unit"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" BIGINT NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NOT NULL,
    PRIMARY KEY("id")
);
CREATE INDEX unit_i18n_object_id_idx ON unit_i18n(object_id);
CREATE INDEX unit_i18n_language_id_idx ON unit_i18n(language_id);
CREATE UNIQUE INDEX unit_i18n_object_id_language_id_uidx ON "unit_i18n"("object_id", "language_id");


CREATE SEQUENCE "city_id";
CREATE TABLE "city" (
    "id" BIGINT NOT NULL default nextval('unit_id'),
    "name" CHARACTER VARYING(16) NULL,
    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,
    "region_id" BIGINT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "city_i18n_id";
CREATE TABLE "city_i18n" (
    "id" BIGINT NOT NULL default nextval('city_i18n_id'),
    "object_id" BIGINT NOT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" BIGINT NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX city_i18n_object_id_idx ON city_i18n(object_id);
CREATE INDEX city_i18n_language_id_idx ON city_i18n(language_id);
CREATE UNIQUE INDEX city_i18n_object_id_language_id_uidx ON "city_i18n"("object_id", "language_id");
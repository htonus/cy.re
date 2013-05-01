CREATE SEQUENCE "language_id";
CREATE TABLE "language" (
    "id" INTEGER NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "unit_id";
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


CREATE SEQUENCE "city_id";
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


CREATE SEQUENCE "district_id";
CREATE TABLE "district" (
    "id" INTEGER NOT NULL default nextval('district_id'),
    "name" CHARACTER VARYING(16) NULL,
    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,
    "city_id" BIGINT NULL REFERENCES "city"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "district_i18n_id";
CREATE TABLE "district_i18n" (
    "id" BIGINT NOT NULL default nextval('district_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "district"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX district_i18n_object_id_idx ON district_i18n(object_id);
CREATE INDEX district_i18n_language_id_idx ON district_i18n(language_id);
CREATE UNIQUE INDEX district_i18n_object_id_language_id_uidx ON "district_i18n"("object_id", "language_id");



CREATE SEQUENCE "token_id";
CREATE TABLE "token" (
    "id" INTEGER NOT NULL default nextval('token_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "value" CHARACTER VARYING(128) NULL,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "token_i18n_id";
CREATE TABLE "token_i18n" (
    "id" BIGINT NOT NULL default nextval('token_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "token"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "value" CHARACTER VARYING(128) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX token_i18n_object_id_idx ON token_i18n(object_id);
CREATE INDEX token_i18n_language_id_idx ON token_i18n(language_id);
CREATE UNIQUE INDEX token_i18n_object_id_language_id_uidx ON "token_i18n"("object_id", "language_id");



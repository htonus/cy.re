CREATE SEQUENCE "language_id";
CREATE TABLE "language" (
    "id" INTEGER NOT NULL default nextval('language_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "code" CHARACTER VARYING(2) NOT NULL,
    "native" CHARACTER VARYING(16) NOT NULL,
    "active" BOOLEAN NOT NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "country_id";
CREATE TABLE "country" (
    "id" INTEGER NOT NULL default nextval('country_id'),
    "country_code" varchar(2) NULL,
    "phone_code" integer NULL,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "country_i18n_id";
CREATE TABLE "country_i18n" (
    "id" BIGINT NOT NULL default nextval('country_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "country"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX country_i18n_object_id_idx ON country_i18n(object_id);
CREATE INDEX country_i18n_language_id_idx ON country_i18n(language_id);
CREATE UNIQUE INDEX country_i18n_object_id_language_id_uidx ON "country_i18n"("object_id", "language_id");


CREATE SEQUENCE "region_id";
CREATE TABLE "region" (
    "id" INTEGER NOT NULL default nextval('region_id'),
    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,
    "country_id" BIGINT NOT NULL REFERENCES "country"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY("id")
);
CREATE SEQUENCE "region_i18n_id";
CREATE TABLE "region_i18n" (
    "id" BIGINT NOT NULL default nextval('region_i18n_id'),
    "object_id" INTEGER NOT NULL REFERENCES "region"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "language_id" INTEGER NOT NULL REFERENCES "language"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "name" CHARACTER VARYING(32) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX region_i18n_object_id_idx ON region_i18n(object_id);
CREATE INDEX region_i18n_language_id_idx ON region_i18n(language_id);
CREATE UNIQUE INDEX region_i18n_object_id_language_id_uidx ON "region_i18n"("object_id", "language_id");



CREATE SEQUENCE "city_id";
CREATE TABLE "city" (
    "id" INTEGER NOT NULL default nextval('unit_id'),
    "country_id" INTEGER NOT NULL REFERENCES "country"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "latitude" numeric(10,6) NULL,
    "longitude" numeric(10,6) NULL,
    "region_id" BIGINT NULL REFERENCES "region"("id") ON UPDATE CASCADE ON DELETE SET NULL,
	"prefix" CHARACTER VARYING(2) NULL,
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
    "name" CHARACTER VARYING(32) NULL,
    PRIMARY KEY("id")
);
CREATE INDEX district_i18n_object_id_idx ON district_i18n(object_id);
CREATE INDEX district_i18n_language_id_idx ON district_i18n(language_id);
CREATE UNIQUE INDEX district_i18n_object_id_language_id_uidx ON "district_i18n"("object_id", "language_id");



CREATE SEQUENCE "token_id";
CREATE TABLE "token" (
    "id" INTEGER NOT NULL default nextval('token_id'),
    "name" CHARACTER VARYING(32) NOT NULL,
    "object" CHARACTER VARYING(16) NULL,
    "object_id" INTEGER NULL,
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


CREATE SEQUENCE "picture_id";

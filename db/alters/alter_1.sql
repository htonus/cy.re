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

alter table city drop column region_id;
alter table city add column "region_id" BIGINT NULL REFERENCES "region"("id") ON UPDATE CASCADE ON DELETE SET NULL;


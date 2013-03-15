CREATE TABLE "resource_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "resource_id";
CREATE TABLE "resource" (
    "id" INTEGER NOT NULL default nextval('resource_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
    "type_id" INTEGER NULL REFERENCES "resource_type"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);

CREATE TABLE "access_type" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "group_id";
CREATE TABLE "group" (
    "id" INTEGER NOT NULL default nextval('group_id'),
    "name" CHARACTER VARYING(16) NOT NULL,
	"text" CHARACTER VARYING(256) NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "group_access_id";
CREATE TABLE "group_access" (
    "id" INTEGER NOT NULL default nextval('group_access_id'),
    "group_id" INTEGER NOT NULL REFERENCES "group"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "access_id" INTEGER NOT NULL REFERENCES "access_type"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "resource_id" INTEGER NOT NULL REFERENCES "resource"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);


CREATE TABLE "person_status" (
    "id" INTEGER NOT NULL,
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "person_id";
CREATE TABLE "person" (
    "id" INTEGER NOT NULL default nextval('person_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "name" CHARACTER VARYING(32) NOT NULL,
    "surname" CHARACTER VARYING(32) NULL,
    "status_id" INTEGER NULL REFERENCES "person_status"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "email" CHARACTER VARYING(32) NOT NULL,
    "username" CHARACTER VARYING(16) NOT NULL,
    "password" CHARACTER VARYING(40) NOT NULL,
    PRIMARY KEY("id")
);

CREATE TABLE "person_group" (
    "person_id" INTEGER NULL REFERENCES "person"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "group_id" INTEGER NULL REFERENCES "group"("id") ON UPDATE CASCADE ON DELETE CASCADE
);
create index person_group_person_id_idx on "person_group"("person_id");
create index person_group_group_id_idx on "person_group"("group_id");


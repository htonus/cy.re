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


CREATE SEQUENCE "access_rule_id";
CREATE TABLE "access_rule" (
    "id" INTEGER NOT NULL default nextval('access_rule_id'),
    "access_id" INTEGER NULL REFERENCES "access_type"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    "resource_id" INTEGER NULL REFERENCES "resource"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "person_role_id";
CREATE TABLE "person_role" (
    "id" INTEGER NOT NULL default nextval('person_role_id'),
    "name" CHARACTER VARYING(16) NULL,
    PRIMARY KEY("id")
);


CREATE SEQUENCE "role_rule_id";
CREATE TABLE "role_rule" (
    "role_id" INTEGER NULL REFERENCES "person_role"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "rule_id" INTEGER NULL REFERENCES "access_rule"("id") ON UPDATE CASCADE ON DELETE RESTRICT,
);
create index role_rule_rule_id_idx on "role_rule"("rule_id");
create index role_rule_role_id_idx on "role_rule"("role_id");


CREATE SEQUENCE "persom_id";
CREATE TABLE "person" (
    "id" INTEGER NOT NULL default nextval('person_id'),
    "created" timestamp NOT NULL DEFAULT now(),
    "name" CHARACTER VARYING(32) NOT NULL,
    "email" CHARACTER VARYING(32) NOT NULL,
    "username" CHARACTER VARYING(16) NOT NULL,
    "password" CHARACTER VARYING(40) NOT NULL,
    PRIMARY KEY("id")
);

CREATE SEQUENCE "person_role_id";
CREATE TABLE "person_role" (
    "person_id" INTEGER NULL REFERENCES "person"("id") ON UPDATE CASCADE ON DELETE CASCADE,
    "role_id" INTEGER NULL REFERENCES "person_role"("id") ON UPDATE CASCADE ON DELETE CASCADE,
);
create index person_role_person_id_idx on "person_role"("person_id");
create index person_role_role_id_idx on "person_role"("role_id");


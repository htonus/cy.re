--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: unit_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: city; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city (
    id bigint DEFAULT nextval('unit_id'::regclass) NOT NULL,
    name character varying(16),
    latitude numeric(10,6),
    longitude numeric(10,6),
    region_id bigint
);


--
-- Name: city_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE city_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: city_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city_i18n (
    id bigint DEFAULT nextval('city_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16)
);


--
-- Name: city_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE city_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature (
    id bigint DEFAULT nextval('feature_id'::regclass) NOT NULL,
    type_id bigint NOT NULL,
    realty_id bigint NOT NULL,
    value bigint
);


--
-- Name: feature_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type (
    id bigint DEFAULT nextval('feature_type_id'::regclass) NOT NULL,
    name character varying(16),
    unit_id bigint,
    weight integer DEFAULT 1 NOT NULL,
    group_id bigint
);


--
-- Name: feature_type_group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type_group (
    id bigint NOT NULL,
    name character varying(16)
);


--
-- Name: feature_type_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_type_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature_type_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type_i18n (
    id bigint DEFAULT nextval('feature_type_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Name: group_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE group_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE "group" (
    id bigint DEFAULT nextval('group_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    text character varying(256)
);


--
-- Name: group_access_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE group_access_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: group_access; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE group_access (
    id bigint DEFAULT nextval('group_access_id'::regclass) NOT NULL,
    group_id bigint NOT NULL,
    resource_id bigint NOT NULL,
    access integer DEFAULT 0 NOT NULL
);


--
-- Name: language_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE language_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: language; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE language (
    id bigint DEFAULT nextval('language_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    code character varying(2) NOT NULL,
    native character varying(16) NOT NULL,
    active boolean DEFAULT false NOT NULL
);


--
-- Name: offer_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE offer_type (
    id bigint NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Name: person_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE person_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: person; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE person (
    id bigint DEFAULT nextval('person_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    name character varying(32) NOT NULL,
    surname character varying(32),
    status_id bigint NOT NULL,
    email character varying(32) NOT NULL,
    username character varying(16) NOT NULL,
    password character varying(40) NOT NULL
);


--
-- Name: person_group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE person_group (
    person_id integer,
    group_id integer
);


--
-- Name: person_status; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE person_status (
    id integer NOT NULL,
    name character varying(16)
);


--
-- Name: picture_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE picture_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    realty_id bigint NOT NULL,
    type_id bigint NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    width integer NOT NULL,
    height integer NOT NULL
);


--
-- Name: realty_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: realty; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty (
    id bigint DEFAULT nextval('realty_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    published timestamp without time zone,
    name character varying(128),
    text character varying(4096),
    latitude numeric(10,6),
    longitude numeric(10,6),
    type_id bigint NOT NULL,
    offer_id bigint NOT NULL,
    city_id bigint NOT NULL
);


--
-- Name: realty_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: realty_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_i18n (
    id bigint DEFAULT nextval('realty_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(128),
    text character varying(4096)
);


--
-- Name: realty_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_type (
    id bigint NOT NULL,
    name character varying(16)
);


--
-- Name: realty_type_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_type_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: realty_type_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_type_i18n (
    id bigint DEFAULT nextval('realty_type_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Name: realty_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: resource_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE resource_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: resource; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE resource (
    id bigint DEFAULT nextval('resource_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    type_id bigint NOT NULL
);


--
-- Name: resource_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE resource_type (
    id integer NOT NULL,
    name character varying(16)
);


--
-- Name: token_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE token_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: token; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE token (
    id bigint DEFAULT nextval('token_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    value character varying(128)
);


--
-- Name: token_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE token_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: token_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE token_i18n (
    id bigint DEFAULT nextval('token_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    value character varying(128)
);


--
-- Name: unit; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit (
    id bigint DEFAULT nextval('unit_id'::regclass) NOT NULL,
    name character varying(16),
    sign character varying(16)
);


--
-- Name: unit_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: unit_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit_i18n (
    id bigint DEFAULT nextval('unit_i18n_id'::regclass) NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16) NOT NULL,
    object_id bigint NOT NULL
);


--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city (id, name, latitude, longitude, region_id) FROM stdin;
1	Nicosia	35.145214	33.377237	\N
2	Limassol	0.000000	0.000000	\N
3	Larnaka	0.000000	0.000000	\N
4	Paphos	0.000000	0.000000	\N
\.


--
-- Data for Name: city_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	Nicosia
2	2	1	Limassol
3	3	1	Larnaka
4	4	1	Paphos
\.


--
-- Name: city_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_i18n_id', 4, true);


--
-- Name: city_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_id', 10, false);


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature (id, type_id, realty_id, value) FROM stdin;
1	1	1	100000
2	2	1	200
3	3	1	3
4	4	1	3
5	5	1	3
6	10	1	1
7	11	1	1
8	14	1	1
9	15	1	1
\.


--
-- Name: feature_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_id', 9, true);


--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type (id, name, unit_id, weight, group_id) FROM stdin;
1	price	1	10	3
2	area	2	10	3
3	bedrooms	3	10	3
4	toylets	3	10	3
5	parking lots	3	10	3
6	monthly price	3	10	3
10	Balcony	4	1	1
11	Storage room	4	1	1
12	Solar heater	4	1	1
13	Swimming pool	4	1	2
14	Garden	4	1	2
15	BBQ area	4	1	2
\.


--
-- Data for Name: feature_type_group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type_group (id, name) FROM stdin;
1	indoor options
2	outdoor options
3	general options
\.


--
-- Data for Name: feature_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	price
2	2	1	area
3	3	1	bedrooms
4	4	1	toylets
5	5	1	parking lots
6	6	1	monthly price
7	10	1	Balcony
8	10	7	
9	10	2	
10	10	3	
11	11	1	Storage room
12	11	7	
13	11	2	
14	11	3	
15	12	1	Solar heater
16	12	7	
17	12	2	
18	12	3	
19	13	1	Swimming pool
20	13	7	
21	13	2	
22	13	3	
23	14	1	Garden
24	14	7	
25	14	2	
26	14	3	
27	15	1	BBQ area
28	15	7	
29	15	2	
30	15	3	
\.


--
-- Name: feature_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_i18n_id', 30, true);


--
-- Name: feature_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_id', 15, true);


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY "group" (id, name, text) FROM stdin;
7	Project setup	Setup all dictionaries, except publishing
8	Publisher	Only to check objects and publish them
\.


--
-- Data for Name: group_access; Type: TABLE DATA; Schema: public; Owner: -
--

COPY group_access (id, group_id, resource_id, access) FROM stdin;
1	7	1	23
2	7	2	23
3	7	3	23
4	7	5	23
5	8	1	52
6	8	2	52
7	8	3	52
8	8	4	52
9	8	5	52
10	8	6	52
11	8	7	52
12	8	8	52
\.


--
-- Name: group_access_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_access_id', 12, true);


--
-- Name: group_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_id', 8, true);


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

COPY language (id, name, code, native, active) FROM stdin;
1	English	en	English	t
7	Chineese	cn	简体中文	f
2	Russian	ru	Русский	f
3	Greek	el	Elliniki	f
\.


--
-- Name: language_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('language_id', 7, true);


--
-- Data for Name: offer_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY offer_type (id, name) FROM stdin;
1	sale
2	rent
\.


--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person (id, created, name, surname, status_id, email, username, password) FROM stdin;
1	2013-03-17 12:49:42	Mike	\N	3	htonus@gmail.com	htonus	1q2w3e4r
\.


--
-- Data for Name: person_group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person_group (person_id, group_id) FROM stdin;
1	7
1	8
\.


--
-- Name: person_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('person_id', 1, true);


--
-- Data for Name: person_status; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person_status (id, name) FROM stdin;
1	No access
2	Readonly
3	Normal
4	Admin
5	Full access
\.


--
-- Data for Name: picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY picture (id, realty_id, type_id, name, main, width, height) FROM stdin;
\.


--
-- Name: picture_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('picture_id', 1, false);


--
-- Data for Name: realty; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty (id, created, published, name, text, latitude, longitude, type_id, offer_id, city_id) FROM stdin;
1	2013-03-12 19:18:31	\N	House	Very, very nice house	\N	\N	1	1	3
\.


--
-- Data for Name: realty_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_i18n (id, object_id, language_id, name, text) FROM stdin;
1	1	1	House	Very, very nice house
2	1	7		
3	1	2		
4	1	3		
\.


--
-- Name: realty_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_i18n_id', 4, true);


--
-- Name: realty_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_id', 1, true);


--
-- Data for Name: realty_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type (id, name) FROM stdin;
1	house
2	appartments
\.


--
-- Data for Name: realty_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	house
2	2	1	appartments
\.


--
-- Name: realty_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_i18n_id', 2, true);


--
-- Name: realty_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_id', 10, false);


--
-- Data for Name: resource; Type: TABLE DATA; Schema: public; Owner: -
--

COPY resource (id, name, type_id) FROM stdin;
1	Language	1
2	Unit	1
3	FeatureType	1
4	Feature	1
5	RealtyType	1
6	Resource	1
7	Group	1
8	Person	1
\.


--
-- Name: resource_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('resource_id', 8, true);


--
-- Data for Name: resource_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY resource_type (id, name) FROM stdin;
1	object
\.


--
-- Data for Name: token; Type: TABLE DATA; Schema: public; Owner: -
--

COPY token (id, name, value) FROM stdin;
1	SALE	sale
2	RENT	rent
3	INDOOR	indoor options
5	GENERAL	general features
4	OUTDOOR	outdoor features
\.


--
-- Data for Name: token_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY token_i18n (id, object_id, language_id, value) FROM stdin;
1	1	1	sale
2	2	1	rent
3	1	2	Продажа
4	2	2	Аренда
5	3	1	indoor options
6	4	1	outdoor features
7	5	1	general features
\.


--
-- Name: token_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_i18n_id', 7, true);


--
-- Name: token_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_id', 5, true);


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (id, name, sign) FROM stdin;
1	money	&euro;
3	quantity	
4	flag	
2	area	m<sup>2</sup>
\.


--
-- Data for Name: unit_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit_i18n (id, language_id, name, object_id) FROM stdin;
1	1	money	1
2	1	area	2
3	1	quantity	3
4	1	flag	4
5	2	площадь	2
6	3		2
\.


--
-- Name: unit_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_i18n_id', 6, true);


--
-- Name: unit_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_id', 10, false);


--
-- Name: city_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY city_i18n
    ADD CONSTRAINT city_i18n_pkey PRIMARY KEY (id);


--
-- Name: city_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY city
    ADD CONSTRAINT city_pkey PRIMARY KEY (id);


--
-- Name: feature_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_pkey PRIMARY KEY (id);


--
-- Name: feature_type_group_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature_type_group
    ADD CONSTRAINT feature_type_group_pkey PRIMARY KEY (id);


--
-- Name: feature_type_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature_type_i18n
    ADD CONSTRAINT feature_type_i18n_pkey PRIMARY KEY (id);


--
-- Name: feature_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_pkey PRIMARY KEY (id);


--
-- Name: group_access_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY group_access
    ADD CONSTRAINT group_access_pkey PRIMARY KEY (id);


--
-- Name: group_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY "group"
    ADD CONSTRAINT group_pkey PRIMARY KEY (id);


--
-- Name: language_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY language
    ADD CONSTRAINT language_pkey PRIMARY KEY (id);


--
-- Name: offer_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY offer_type
    ADD CONSTRAINT offer_type_pkey PRIMARY KEY (id);


--
-- Name: person_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id);


--
-- Name: person_status_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY person_status
    ADD CONSTRAINT person_status_pkey PRIMARY KEY (id);


--
-- Name: picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_pkey PRIMARY KEY (id);


--
-- Name: realty_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty_i18n
    ADD CONSTRAINT realty_i18n_pkey PRIMARY KEY (id);


--
-- Name: realty_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_pkey PRIMARY KEY (id);


--
-- Name: realty_type_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty_type_i18n
    ADD CONSTRAINT realty_type_i18n_pkey PRIMARY KEY (id);


--
-- Name: realty_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty_type
    ADD CONSTRAINT realty_type_pkey PRIMARY KEY (id);


--
-- Name: resource_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY resource
    ADD CONSTRAINT resource_pkey PRIMARY KEY (id);


--
-- Name: resource_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY resource_type
    ADD CONSTRAINT resource_type_pkey PRIMARY KEY (id);


--
-- Name: token_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY token_i18n
    ADD CONSTRAINT token_i18n_pkey PRIMARY KEY (id);


--
-- Name: token_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY token
    ADD CONSTRAINT token_pkey PRIMARY KEY (id);


--
-- Name: unit_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY unit_i18n
    ADD CONSTRAINT unit_i18n_pkey PRIMARY KEY (id);


--
-- Name: unit_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY unit
    ADD CONSTRAINT unit_pkey PRIMARY KEY (id);


--
-- Name: city_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX city_i18n_language_id_idx ON city_i18n USING btree (language_id);


--
-- Name: city_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX city_i18n_object_id_idx ON city_i18n USING btree (object_id);


--
-- Name: city_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX city_i18n_object_id_language_id_uidx ON city_i18n USING btree (object_id, language_id);


--
-- Name: feature_realty_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_realty_id_idx ON feature USING btree (realty_id);


--
-- Name: feature_type_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_i18n_language_id_idx ON feature_type_i18n USING btree (language_id);


--
-- Name: feature_type_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_i18n_object_id_idx ON feature_type_i18n USING btree (object_id);


--
-- Name: feature_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_id_idx ON feature USING btree (type_id);


--
-- Name: object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX object_id_idx ON unit_i18n USING btree (object_id);


--
-- Name: person_group_group_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX person_group_group_id_idx ON person_group USING btree (group_id);


--
-- Name: person_group_person_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX person_group_person_id_idx ON person_group USING btree (person_id);


--
-- Name: picture_realty_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX picture_realty_id_idx ON picture USING btree (realty_id);


--
-- Name: realty_city_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_city_id_idx ON realty USING btree (city_id);


--
-- Name: realty_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_i18n_language_id_idx ON realty_i18n USING btree (language_id);


--
-- Name: realty_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_i18n_object_id_idx ON realty_i18n USING btree (object_id);


--
-- Name: realty_type_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_i18n_language_id_idx ON realty_type_i18n USING btree (language_id);


--
-- Name: realty_type_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_i18n_object_id_idx ON realty_type_i18n USING btree (object_id);


--
-- Name: realty_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_id_idx ON realty USING btree (type_id);


--
-- Name: token_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX token_i18n_language_id_idx ON token_i18n USING btree (language_id);


--
-- Name: token_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX token_i18n_object_id_idx ON token_i18n USING btree (object_id);


--
-- Name: token_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX token_i18n_object_id_language_id_uidx ON token_i18n USING btree (object_id, language_id);


--
-- Name: unit_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX unit_i18n_object_id_language_id_uidx ON unit_i18n USING btree (object_id, language_id);


--
-- Name: city_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY city_i18n
    ADD CONSTRAINT city_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: city_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY city_i18n
    ADD CONSTRAINT city_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: city_region_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY city
    ADD CONSTRAINT city_region_id_fkey FOREIGN KEY (region_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: feature_realty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_realty_id_fkey FOREIGN KEY (realty_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: feature_type_group_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_group_id_fkey FOREIGN KEY (group_id) REFERENCES feature_type_group(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: feature_type_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type_i18n
    ADD CONSTRAINT feature_type_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: feature_type_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type_i18n
    ADD CONSTRAINT feature_type_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: feature_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_type_id_fkey FOREIGN KEY (type_id) REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: group_access_group_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY group_access
    ADD CONSTRAINT group_access_group_id_fkey FOREIGN KEY (group_id) REFERENCES "group"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: group_access_resource_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY group_access
    ADD CONSTRAINT group_access_resource_id_fkey FOREIGN KEY (resource_id) REFERENCES resource(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: person_group_group_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY person_group
    ADD CONSTRAINT person_group_group_id_fkey FOREIGN KEY (group_id) REFERENCES "group"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: person_group_person_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY person_group
    ADD CONSTRAINT person_group_person_id_fkey FOREIGN KEY (person_id) REFERENCES person(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: person_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_status_id_fkey FOREIGN KEY (status_id) REFERENCES person_status(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: picture_realty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_realty_id_fkey FOREIGN KEY (realty_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_city_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_city_id_fkey FOREIGN KEY (city_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: realty_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_i18n
    ADD CONSTRAINT realty_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_i18n
    ADD CONSTRAINT realty_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_offer_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_offer_id_fkey FOREIGN KEY (offer_id) REFERENCES offer_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: realty_type_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_type_i18n
    ADD CONSTRAINT realty_type_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_type_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_type_i18n
    ADD CONSTRAINT realty_type_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES realty_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_type_id_fkey FOREIGN KEY (type_id) REFERENCES realty_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: resource_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY resource
    ADD CONSTRAINT resource_type_id_fkey FOREIGN KEY (type_id) REFERENCES resource_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: token_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY token_i18n
    ADD CONSTRAINT token_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: token_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY token_i18n
    ADD CONSTRAINT token_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES token(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: unit_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY unit_i18n
    ADD CONSTRAINT unit_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: unit_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY unit_i18n
    ADD CONSTRAINT unit_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES unit(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--


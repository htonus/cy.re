--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
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
-- Name: article_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: article; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article (
    id bigint DEFAULT nextval('article_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    published timestamp without time zone,
    category_id bigint,
    promote boolean DEFAULT false,
    type_id bigint NOT NULL
);


--
-- Name: article_category; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_category (
    id bigint NOT NULL,
    created timestamp without time zone NOT NULL,
    published timestamp without time zone,
    parent_id bigint,
    slug character varying(16),
    "left" integer DEFAULT 0,
    "right" integer DEFAULT 0
);


--
-- Name: article_category_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_category_i18n (
    id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(64),
    text character varying(256),
    object_id bigint NOT NULL
);


--
-- Name: article_category_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_category_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: article_category_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_category_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: article_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: article_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_i18n (
    id bigint DEFAULT nextval('article_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(128),
    text character varying(4096),
    brief character varying(1024)
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
-- Name: article_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id bigint NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL,
    text character varying(256),
    "order" integer
);


--
-- Name: article_realty; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_realty (
    realty_id bigint,
    article_id bigint
);


--
-- Name: article_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_type (
    id bigint NOT NULL,
    name character varying(16)
);


--
-- Name: unit_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: city; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city (
    id bigint DEFAULT nextval('unit_id'::regclass) NOT NULL,
    latitude numeric(10,6),
    longitude numeric(10,6),
    region_id bigint,
    prefix character varying(2),
    country_id bigint DEFAULT 1 NOT NULL
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
    name character varying(32)
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
-- Name: country_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE country_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: country; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE country (
    id bigint DEFAULT nextval('country_id'::regclass) NOT NULL,
    country_code character varying(2),
    phone_code integer
);


--
-- Name: country_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE country_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: country_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE country_i18n (
    id bigint DEFAULT nextval('country_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16)
);


--
-- Name: custom_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE custom_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: custom; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE custom (
    id bigint DEFAULT nextval('custom_id'::regclass) NOT NULL,
    type_id bigint NOT NULL,
    section_id bigint NOT NULL,
    name character varying(256)
);


--
-- Name: custom_item_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE custom_item_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: custom_item; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE custom_item (
    id bigint DEFAULT nextval('custom_item_id'::regclass) NOT NULL,
    "order" integer,
    parent_id bigint NOT NULL,
    realty_id bigint,
    name character varying(256),
    article_id bigint
);


--
-- Name: custom_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE custom_type (
    id integer NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Name: district_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE district_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: district; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE district (
    id bigint DEFAULT nextval('district_id'::regclass) NOT NULL,
    latitude numeric(10,6),
    longitude numeric(10,6),
    city_id bigint NOT NULL
);


--
-- Name: district_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE district_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: district_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE district_i18n (
    id bigint DEFAULT nextval('district_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(32)
);


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
    unit_id bigint,
    group_id bigint,
    weight integer DEFAULT 1 NOT NULL,
    view character varying(16) DEFAULT ''::character varying
);


--
-- Name: feature_type_group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type_group (
    id integer NOT NULL,
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
    name character varying(31) NOT NULL
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
    active boolean NOT NULL
);


--
-- Name: news_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE news_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: news; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE news (
    id bigint DEFAULT nextval('news_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    published timestamp without time zone
);


--
-- Name: news_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE news_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: news_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE news_i18n (
    id bigint DEFAULT nextval('news_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(128),
    text character varying(4096)
);


--
-- Name: news_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE news_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id bigint NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL,
    text character varying(256),
    "order" integer
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
    email character varying(32),
    username character varying(16),
    password character varying(40),
    autologin character varying(40),
    phone character varying(12),
    language_id bigint
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
    latitude numeric(10,6),
    longitude numeric(10,6),
    type_id bigint NOT NULL,
    city_id bigint,
    preview_id bigint,
    district_id bigint,
    polygon character varying(255),
    zip character varying(8),
    address character varying(256),
    owner_id bigint
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
-- Name: realty_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id bigint NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL,
    text character varying(256),
    "order" integer
);


--
-- Name: realty_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_type (
    id bigint NOT NULL,
    prefix character varying(2),
    area_range character varying(256)
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
-- Name: region_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE region_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: region; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE region (
    id bigint DEFAULT nextval('region_id'::regclass) NOT NULL,
    latitude numeric(10,6),
    longitude numeric(10,6),
    country_id bigint NOT NULL
);


--
-- Name: region_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE region_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: region_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE region_i18n (
    id bigint DEFAULT nextval('region_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(32)
);


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
-- Name: section; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE section (
    id integer NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Name: static_page_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE static_page_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: static_page; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE static_page (
    id bigint DEFAULT nextval('static_page_id'::regclass) NOT NULL,
    type_id bigint NOT NULL,
    section_id bigint
);


--
-- Name: static_page_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE static_page_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: static_page_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE static_page_i18n (
    id bigint DEFAULT nextval('static_page_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(128),
    anons character varying(512),
    text character varying(4096)
);


--
-- Name: static_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE static_type (
    id integer NOT NULL,
    name character varying(16) NOT NULL
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
    name character varying(32) NOT NULL,
    object character varying(16),
    object_id integer
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
    value character varying(512)
);


--
-- Name: unit; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit (
    id bigint DEFAULT nextval('unit_id'::regclass) NOT NULL,
    sign character varying(16),
    type integer DEFAULT 1 NOT NULL
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
    object_id bigint NOT NULL,
    language_id bigint NOT NULL,
    name character varying(16) NOT NULL
);


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article (id, created, published, category_id, promote, type_id) FROM stdin;
1	2013-07-19 16:49:20	\N	\N	f	1
\.


--
-- Data for Name: article_category; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_category (id, created, published, parent_id, slug, "left", "right") FROM stdin;
1	2016-06-20 17:48:10	\N	\N	\N	2	3
\.


--
-- Data for Name: article_category_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_category_i18n (id, language_id, name, text, object_id) FROM stdin;
1	1	about		1
2	2			1
\.


--
-- Name: article_category_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_category_i18n_id', 2, true);


--
-- Name: article_category_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_category_id', 1, true);


--
-- Data for Name: article_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_i18n (id, object_id, language_id, name, text, brief) FROM stdin;
1	1	1	The acquisition of immovable property by EU citizens	<div>The acquisition of immovable property by EU citizens</div><div>A national of an EU member country is permitted to own as much ‘immovable property’ (a term that includes both land and property) as they wish.</div><div><br></div><div>Once the Title Deeds for the property they are buying become available, they are required to provide proof of their citizenship by taking their passport to the District Lands office when they pay the Property Transfer Fees.</div>	\N
3	1	2			\N
\.


--
-- Name: article_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_i18n_id', 5, true);


--
-- Name: article_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_id', 3, true);


--
-- Data for Name: article_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_picture (id, object_id, type_id, name, main, size, width, height, text, "order") FROM stdin;
\.


--
-- Data for Name: article_realty; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_realty (realty_id, article_id) FROM stdin;
\.


--
-- Data for Name: article_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_type (id, name) FROM stdin;
1	information
2	project
3	about
\.


--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city (id, latitude, longitude, region_id, prefix, country_id) FROM stdin;
1	35.145214	33.377237	\N	NI	1
2	0.000000	0.000000	\N	LI	1
3	0.000000	0.000000	\N	LA	1
4	0.000000	0.000000	\N	PA	1
10	35.038887	34.036160	\N	FA	1
12	35.033440	32.433357	\N	PO	1
13	\N	\N	2	\N	1
14	\N	\N	2	\N	1
15	\N	\N	2	\N	1
16	\N	\N	2	\N	1
17	\N	\N	2	\N	1
18	\N	\N	2	\N	1
19	\N	\N	2	\N	1
\.


--
-- Data for Name: city_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	Nicosia
2	2	1	Limassol
3	3	1	Larnaka
4	4	1	Paphos
5	10	1	Famagusta
7	10	2	Фамагуста
9	12	1	Polis
11	12	2	Полис
13	1	2	
15	2	2	
17	3	2	
19	4	2	
20	13	1	Kato Polemidia
22	13	2	
23	14	1	Mouttagiaka
25	14	2	
26	15	1	Moni
28	15	2	
29	16	1	Agios Tychon
31	16	2	
32	17	1	Kolossi
34	17	2	
35	18	1	Ypsonas
37	18	2	
38	19	1	Parekklisia
40	19	2	
\.


--
-- Name: city_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_i18n_id', 40, true);


--
-- Name: city_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_id', 19, true);


--
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: -
--

COPY country (id, country_code, phone_code) FROM stdin;
1	CY	357
\.


--
-- Data for Name: country_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY country_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	Cyprus
\.


--
-- Name: country_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('country_i18n_id', 1, true);


--
-- Name: country_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('country_id', 1, true);


--
-- Data for Name: custom; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom (id, type_id, section_id, name) FROM stdin;
3	1	1	\t\t\t"\r\n\t\t
\.


--
-- Name: custom_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_id', 3, true);


--
-- Data for Name: custom_item; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom_item (id, "order", parent_id, realty_id, name, article_id) FROM stdin;
7	1	3	26	\N	\N
\.


--
-- Name: custom_item_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_item_id', 7, true);


--
-- Data for Name: custom_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom_type (id, name) FROM stdin;
1	carousel
2	recent
3	projects
\.


--
-- Data for Name: district; Type: TABLE DATA; Schema: public; Owner: -
--

COPY district (id, latitude, longitude, city_id) FROM stdin;
1	\N	\N	2
2	\N	\N	2
3	\N	\N	2
4	\N	\N	2
5	\N	\N	2
7	\N	\N	2
8	\N	\N	2
\.


--
-- Data for Name: district_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY district_i18n (id, object_id, language_id, name) FROM stdin;
3	1	2	
6	2	2	
9	3	2	
12	4	2	
15	5	2	
21	7	2	
1	1	1	Limassol
4	2	1	Nicosia
7	3	1	Larnaka
10	4	1	Paphos
13	5	1	Famagusta
19	7	1	Polis
22	8	1	Ayia Napa
24	8	2	
\.


--
-- Name: district_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_i18n_id', 24, true);


--
-- Name: district_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_id', 8, true);


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature (id, type_id, realty_id, value) FROM stdin;
283	7	26	1
284	2	26	1
285	6	26	1
286	1	26	1
\.


--
-- Name: feature_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_id', 286, true);


--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type (id, unit_id, group_id, weight, view) FROM stdin;
1	1	1	10	
2	2	1	10	
3	3	1	10	
5	3	1	10	
22	4	3	1	
23	4	3	1	
24	4	3	1	
34	4	3	1	
35	4	3	1	
36	4	3	1	
38	4	3	1	
39	4	3	1	
7	1	2	10	
11	4	2	1	
13	4	2	1	
14	4	2	1	
15	4	2	1	
16	4	2	1	
17	4	2	1	
18	4	2	1	
19	4	2	1	
20	4	2	1	
25	4	2	1	
27	4	2	1	
21	4	2	1	
26	4	2	1	
28	4	2	1	
29	4	2	1	
30	4	2	1	
31	4	2	1	
33	4	2	1	
10	4	2	1	
37	4	2	1	
42	4	2	1	
43	4	2	1	
6	1	1	10	\N
4	3	1	10	\N
41	4	3	10	\N
\.


--
-- Data for Name: feature_type_group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type_group (id, name) FROM stdin;
1	general options
3	outdoor options
2	indoor options
4	distance
\.


--
-- Data for Name: feature_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	price
2	2	1	area
3	3	1	bedrooms
5	5	1	parking lots
6	6	1	monthly price
7	7	1	daily price
8	10	2	
9	10	10	
10	4	10	
11	4	2	
12	11	1	dish washer
14	11	2	
16	13	1	electric fan oven
18	13	2	
21	14	2	Электроплита
24	15	2	Вытяжка
27	16	2	Газовая плита
30	17	2	Газовая духовка
33	18	2	Галогенная плита
36	19	2	 СВЧ
39	20	2	Холодильник
42	21	2	Стиральная машина
13	11	10	Πλυντήριο πιάτων
17	13	10	 ΗΛΕΚΤΡΙΚΟΣ ΦΟΥΡΝΟΣ FAN
20	14	10	Ηλεκτρικές εστίες
23	15	10	Απορροφητήρα
26	16	10	Εστίες αερίου
29	17	10	Φούρνος γκαζιού
32	18	10	Εστία αλογόνου
35	19	10	ΜΙΚΡΟΚΥΜΑΤΩΝ
38	20	10	Ψυγείο
41	21	10	Πλυντήριο ρούχων
43	22	1	Covered parking
44	22	10	
45	22	2	
46	23	1	Swiming Pool
47	23	10	
48	23	2	
49	24	1	Garden
50	24	10	
51	24	2	
19	14	1	electric hob
22	15	1	extractor fan 
25	16	1	gas hob 
28	17	1	gas oven
31	18	1	halogen hob
34	19	1	microwave 
37	20	1	refrigerator 
52	25	1	fireplace
53	25	10	
54	25	2	
56	26	10	
57	26	2	
58	27	1	provision for A/C  
59	27	10	
60	27	2	
40	21	1	 Washing machine 
55	26	1	 Double glazing 
61	28	1	Underfloor heating
62	28	10	
63	28	2	
65	29	10	
66	29	2	
64	29	1	Air conditioner
67	30	1	Ceiling fans
68	30	10	
69	30	2	
70	31	1	Double garage
71	31	10	
72	31	2	
74	33	1	Shoot for clothes to laundry 
75	33	10	
76	33	2	
77	34	1	Garden shed
78	34	10	
79	34	2	
80	35	1	Tool room
81	35	10	
82	35	2	
83	36	1	Barbecue area
84	36	10	
85	36	2	
86	37	1	Central vacuum system
87	37	10	
88	37	2	
89	38	1	Double garage
90	38	10	
91	38	2	
93	39	10	
94	39	2	
92	39	1	Balcony
98	41	1	Sea view
99	41	10	
100	41	2	
101	42	1	Sea view
102	42	10	
103	42	2	
104	43	1	Jacuzzi
105	43	10	
106	43	2	
107	6	2	
108	6	10	
4	4	1	toilets
\.


--
-- Name: feature_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_i18n_id', 108, true);


--
-- Name: feature_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_id', 43, true);


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY "group" (id, name, text) FROM stdin;
2	Users	User and access management
4	Editor	Acces to create and update Realty, Article and News
1	Setup	Access to set up dictionaries
3	Moderator	Update and publish
\.


--
-- Data for Name: group_access; Type: TABLE DATA; Schema: public; Owner: -
--

COPY group_access (id, group_id, resource_id, access) FROM stdin;
\.


--
-- Name: group_access_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_access_id', 22, true);


--
-- Name: group_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_id', 4, true);


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

COPY language (id, name, code, native, active) FROM stdin;
1	English	en	English	t
2	Russian	ru	Русский	t
10	Chineese	cn	中文简体	f
\.


--
-- Name: language_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('language_id', 10, true);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: -
--

COPY news (id, created, published) FROM stdin;
\.


--
-- Data for Name: news_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY news_i18n (id, object_id, language_id, name, text) FROM stdin;
\.


--
-- Name: news_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_i18n_id', 1, false);


--
-- Name: news_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_id', 1, false);


--
-- Data for Name: news_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY news_picture (id, object_id, type_id, name, main, size, width, height, text, "order") FROM stdin;
\.


--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person (id, created, name, surname, status_id, email, username, password, autologin, phone, language_id) FROM stdin;
1	2016-06-20 10:55:17.14858	Mikhail	Cherviakov	5	htonus@cyprus-realty.com	htonus	28f9e86b0d5f5739612a7fda378ade96f0c30ac9	\N	\N	\N
4	2016-06-20 16:02:15	nobody	nobody	2	nobody@gmail.com	nobody	9ac20922b054316be23842a5bca7d69f29f69d77	\N	\N	\N
5	2016-06-20 18:06:08			3		\N	\N	\N		\N
\.


--
-- Data for Name: person_group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person_group (person_id, group_id) FROM stdin;
\.


--
-- Name: person_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('person_id', 5, true);


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
-- Name: picture_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('picture_id', 311, true);


--
-- Data for Name: realty; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty (id, created, published, latitude, longitude, type_id, city_id, preview_id, district_id, polygon, zip, address, owner_id) FROM stdin;
26	2016-06-20 18:06:08	2016-06-27 13:14:14	\N	\N	2	1	307	\N	{'type':'polygon','points':[[34.692463718135784,33.02771544436837],[34.69262250411806,33.028058767122275],[34.691916786309605,33.028573751253134],[34.69178446355064,33.02816605548287]]}	\N	\N	5
\.


--
-- Data for Name: realty_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_i18n (id, object_id, language_id, name, text) FROM stdin;
76	26	1		
77	26	2		
\.


--
-- Name: realty_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_i18n_id', 77, true);


--
-- Name: realty_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_id', 26, true);


--
-- Data for Name: realty_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_picture (id, object_id, type_id, name, main, size, width, height, text, "order") FROM stdin;
308	26	2	1.jpg	f	115303	940	625	\N	5
309	26	2	3.jpg	f	215547	940	1253	\N	4
310	26	2	5.jpg	f	151016	940	627	\N	3
311	26	2	4.jpg	f	154481	940	628	\N	2
307	26	2	2.jpg	f	172959	940	627	REALTYPICTURE307	1
\.


--
-- Data for Name: realty_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type (id, prefix, area_range) FROM stdin;
12	\N	\N
13	\N	\N
16	\N	\N
19	\N	\N
22	\N	\N
17	\N	\N
10	B	\N
11	L	\N
14	F	\N
18	S	\N
21	V	\N
26	B	\N
27	\N	\N
1	H	\N
2	A	\N
\.


--
-- Data for Name: realty_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	house
2	2	1	appartments
3	10	1	bungalow
4	10	10	
5	10	2	
6	11	1	land
7	11	10	
8	11	2	
9	12	1	maisonette
10	12	10	
11	12	2	
12	13	1	mobile home
13	13	10	
14	13	2	
15	14	1	office
16	14	10	
17	14	2	
21	16	1	penthouse
22	16	10	
23	16	2	
24	17	1	plot
26	17	2	
27	18	1	shop
28	18	10	
29	18	2	
30	19	1	showroom
31	19	10	
32	19	2	
36	21	1	villa
37	21	10	
38	21	2	
39	22	1	village house
40	22	10	
41	22	2	
42	1	10	
43	1	2	Дом
44	2	10	
45	2	2	
25	17	10	Οικόπεδα
54	26	2	
55	26	10	
53	26	1	business
57	27	10	
58	27	2	
56	27	1	studio
\.


--
-- Name: realty_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_i18n_id', 58, true);


--
-- Name: realty_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_id', 27, true);


--
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: -
--

COPY region (id, latitude, longitude, country_id) FROM stdin;
1	\N	\N	1
2	\N	\N	1
\.


--
-- Data for Name: region_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY region_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	Limassol
2	1	2	
3	2	1	Nicosia
4	2	2	
\.


--
-- Name: region_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('region_i18n_id', 4, true);


--
-- Name: region_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('region_id', 2, true);


--
-- Data for Name: resource; Type: TABLE DATA; Schema: public; Owner: -
--

COPY resource (id, name, type_id) FROM stdin;
1	Language	1
2	Unit	1
3	FeatureType	1
4	RealtyType	1
5	Resource	1
6	Group	1
7	Person	1
8	Realty	1
9	City	1
10	Article	1
11	District	1
\.


--
-- Name: resource_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('resource_id', 11, true);


--
-- Data for Name: resource_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY resource_type (id, name) FROM stdin;
1	object
\.


--
-- Data for Name: section; Type: TABLE DATA; Schema: public; Owner: -
--

COPY section (id, name) FROM stdin;
1	buy
2	rent
3	sell
4	lend
5	info
6	project
7	about
\.


--
-- Data for Name: static_page; Type: TABLE DATA; Schema: public; Owner: -
--

COPY static_page (id, type_id, section_id) FROM stdin;
5	1	\N
6	2	\N
7	7	\N
\.


--
-- Data for Name: static_page_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY static_page_i18n (id, object_id, language_id, name, anons, text) FROM stdin;
11	5	1	About	About	
12	5	2	О нас	О нас	О нас
13	6	1	Contact	Contact	
14	6	2			
15	7	1	Address	Address	
16	7	2			
\.


--
-- Name: static_page_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_i18n_id', 16, true);


--
-- Name: static_page_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_id', 7, true);


--
-- Data for Name: static_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY static_type (id, name) FROM stdin;
1	about
2	contact
3	twitter
4	legal
5	phone
6	email
7	address
8	company
\.


--
-- Data for Name: token; Type: TABLE DATA; Schema: public; Owner: -
--

COPY token (id, name, object, object_id) FROM stdin;
1	BUY	\N	\N
2	RENT	\N	\N
3	INDOOR	\N	\N
4	OUTDOOR	\N	\N
5	GENERAL	\N	\N
21	REALTYPICTURE307	RealtyPicture	307
22	ANY	\N	\N
6	LIST-TYPE-1	\N	\N
7	LIST-TYPE-2	\N	\N
8	LIST-TYPE-3	\N	\N
9	LIST-TYPE-4	\N	\N
10	LIST-TYPE-5	\N	\N
11	ESPERIA-COMPANY	\N	\N
12	TTL-CONTACT-INFO	\N	\N
13	TTL-LEGAL-INFO	\N	\N
14	TTL-ESPERIA-COMPANY	\N	\N
15	TTL-FOLLOW-US	\N	\N
16	TTL-TWITTER-FEED	\N	\N
17	ABOUT-US	\N	\N
18	TWEET-NOTE	\N	\N
19	TTL-RECENT	\N	\N
20	TTL-SUBMIT	\N	\N
\.


--
-- Data for Name: token_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY token_i18n (id, object_id, language_id, value) FROM stdin;
1	1	1	buy
2	2	1	rent
3	3	1	indoor options
4	4	1	outdoor features
5	5	1	general features
76	21	1	aaaa ssss ddd
77	21	2	
78	22	1	Any
79	22	2	Любой
31	6	1	Big preview list
32	6	10	
33	6	2	
34	7	1	2 columns
35	7	10	
36	7	2	
37	8	1	3 columns
38	8	10	
39	8	2	
40	9	1	4 columns
41	9	10	
42	9	2	
43	10	1	Simple list
44	10	10	
45	10	2	
46	11	1	Members of: The International Real Estate Federation, The Cyprus Real Estate Agents Association, Association of Cyprus Travel Agents, The Cyprus Chamber of Commerce and Industry, The Technical Chamber of Cyprus (ETEK), The Institution of Civil Engineers, The Cyprus Institute of Civil Engineers, The Cyprus Institute of Architects and Civil Engineers
47	11	10	
48	11	2	
49	12	1	Contact information
50	12	10	
51	12	2	
52	13	1	Legal info
53	13	10	
54	13	2	
55	14	1	Esperia Company
56	14	10	
57	14	2	
58	15	1	Follow Us
59	15	10	
60	15	2	
61	16	1	Twitter Feed
62	16	10	
63	16	2	
64	17	1	About Us
65	17	10	
66	17	2	
67	18	1	Find out what's happening, right now, with the people and organizations you care about.
68	18	10	
69	18	2	
70	19	1	Recent offers
71	19	10	
72	19	2	
73	20	1	Submit
74	20	10	
75	20	2	Отправить
\.


--
-- Name: token_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_i18n_id', 79, true);


--
-- Name: token_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_id', 22, true);


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (id, sign, type) FROM stdin;
1	&euro;	1
2	m<sup>2</sup>	1
3		1
4		1
\.


--
-- Data for Name: unit_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	money
2	2	1	area
3	3	1	quantity
4	4	1	flag
\.


--
-- Name: unit_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_i18n_id', 8, true);


--
-- Name: unit_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_id', 10, false);


--
-- Name: article_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY article_i18n
    ADD CONSTRAINT article_i18n_pkey PRIMARY KEY (id);


--
-- Name: article_picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY article_picture
    ADD CONSTRAINT article_picture_pkey PRIMARY KEY (id);


--
-- Name: article_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- Name: article_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY article_type
    ADD CONSTRAINT article_type_pkey PRIMARY KEY (id);


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
-- Name: country_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY country_i18n
    ADD CONSTRAINT country_i18n_pkey PRIMARY KEY (id);


--
-- Name: country_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);


--
-- Name: custom_item_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY custom_item
    ADD CONSTRAINT custom_item_pkey PRIMARY KEY (id);


--
-- Name: custom_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY custom
    ADD CONSTRAINT custom_pkey PRIMARY KEY (id);


--
-- Name: custom_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY custom_type
    ADD CONSTRAINT custom_type_pkey PRIMARY KEY (id);


--
-- Name: district_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY district_i18n
    ADD CONSTRAINT district_i18n_pkey PRIMARY KEY (id);


--
-- Name: district_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY district
    ADD CONSTRAINT district_pkey PRIMARY KEY (id);


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
-- Name: news_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY news_i18n
    ADD CONSTRAINT news_i18n_pkey PRIMARY KEY (id);


--
-- Name: news_picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY news_picture
    ADD CONSTRAINT news_picture_pkey PRIMARY KEY (id);


--
-- Name: news_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


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
-- Name: realty_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty_i18n
    ADD CONSTRAINT realty_i18n_pkey PRIMARY KEY (id);


--
-- Name: realty_picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY realty_picture
    ADD CONSTRAINT realty_picture_pkey PRIMARY KEY (id);


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
-- Name: region_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY region_i18n
    ADD CONSTRAINT region_i18n_pkey PRIMARY KEY (id);


--
-- Name: region_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY region
    ADD CONSTRAINT region_pkey PRIMARY KEY (id);


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
-- Name: section_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY section
    ADD CONSTRAINT section_pkey PRIMARY KEY (id);


--
-- Name: static_page_i18n_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY static_page_i18n
    ADD CONSTRAINT static_page_i18n_pkey PRIMARY KEY (id);


--
-- Name: static_page_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY static_page
    ADD CONSTRAINT static_page_pkey PRIMARY KEY (id);


--
-- Name: static_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY static_type
    ADD CONSTRAINT static_type_pkey PRIMARY KEY (id);


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
-- Name: article_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX article_i18n_language_id_idx ON article_i18n USING btree (language_id);


--
-- Name: article_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX article_i18n_object_id_idx ON article_i18n USING btree (object_id);


--
-- Name: article_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX article_i18n_object_id_language_id_uidx ON article_i18n USING btree (object_id, language_id);


--
-- Name: article_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX article_id_idx ON custom_item USING btree (article_id);


--
-- Name: article_picture_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX article_picture_object_id_idx ON article_picture USING btree (object_id);


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
-- Name: country_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX country_i18n_language_id_idx ON country_i18n USING btree (language_id);


--
-- Name: country_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX country_i18n_object_id_idx ON country_i18n USING btree (object_id);


--
-- Name: country_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX country_i18n_object_id_language_id_uidx ON country_i18n USING btree (object_id, language_id);


--
-- Name: custom_item_custom_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX custom_item_custom_id_idx ON custom_item USING btree (parent_id);


--
-- Name: custom_item_realty_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX custom_item_realty_id_idx ON custom_item USING btree (realty_id);


--
-- Name: custom_section_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX custom_section_id_idx ON custom USING btree (section_id);


--
-- Name: district_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX district_i18n_language_id_idx ON district_i18n USING btree (language_id);


--
-- Name: district_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX district_i18n_object_id_idx ON district_i18n USING btree (object_id);


--
-- Name: district_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX district_i18n_object_id_language_id_uidx ON district_i18n USING btree (object_id, language_id);


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
-- Name: feature_type_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX feature_type_i18n_object_id_language_id_uidx ON feature_type_i18n USING btree (object_id, language_id);


--
-- Name: feature_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_id_idx ON feature USING btree (type_id);


--
-- Name: language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX language_id_idx ON article_category_i18n USING btree (language_id);


--
-- Name: news_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX news_i18n_language_id_idx ON news_i18n USING btree (language_id);


--
-- Name: news_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX news_i18n_object_id_idx ON news_i18n USING btree (object_id);


--
-- Name: news_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX news_i18n_object_id_language_id_uidx ON news_i18n USING btree (object_id, language_id);


--
-- Name: news_picture_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX news_picture_object_id_idx ON news_picture USING btree (object_id);


--
-- Name: person_group_group_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX person_group_group_id_idx ON person_group USING btree (group_id);


--
-- Name: person_group_person_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX person_group_person_id_idx ON person_group USING btree (person_id);


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
-- Name: realty_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX realty_i18n_object_id_language_id_uidx ON realty_i18n USING btree (object_id, language_id);


--
-- Name: realty_picture_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_picture_object_id_idx ON realty_picture USING btree (object_id);


--
-- Name: realty_type_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_i18n_language_id_idx ON realty_type_i18n USING btree (language_id);


--
-- Name: realty_type_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_i18n_object_id_idx ON realty_type_i18n USING btree (object_id);


--
-- Name: realty_type_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX realty_type_i18n_object_id_language_id_uidx ON realty_type_i18n USING btree (object_id, language_id);


--
-- Name: realty_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX realty_type_id_idx ON realty USING btree (type_id);


--
-- Name: region_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX region_i18n_language_id_idx ON region_i18n USING btree (language_id);


--
-- Name: region_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX region_i18n_object_id_idx ON region_i18n USING btree (object_id);


--
-- Name: region_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX region_i18n_object_id_language_id_uidx ON region_i18n USING btree (object_id, language_id);


--
-- Name: static_page_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX static_page_i18n_language_id_idx ON static_page_i18n USING btree (language_id);


--
-- Name: static_page_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX static_page_i18n_object_id_idx ON static_page_i18n USING btree (object_id);


--
-- Name: static_page_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX static_page_i18n_object_id_language_id_uidx ON static_page_i18n USING btree (object_id, language_id);


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
-- Name: unit_i18n_language_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX unit_i18n_language_id_idx ON unit_i18n USING btree (language_id);


--
-- Name: unit_i18n_object_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX unit_i18n_object_id_idx ON unit_i18n USING btree (object_id);


--
-- Name: unit_i18n_object_id_language_id_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX unit_i18n_object_id_language_id_uidx ON unit_i18n USING btree (object_id, language_id);


--
-- Name: article_category_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY article_category_i18n
    ADD CONSTRAINT article_category_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: article_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY article_i18n
    ADD CONSTRAINT article_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: article_picture_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY article_picture
    ADD CONSTRAINT article_picture_object_id_fkey FOREIGN KEY (object_id) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: country_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY country_i18n
    ADD CONSTRAINT country_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: country_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY country_i18n
    ADD CONSTRAINT country_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES country(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: custom_item_article_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY custom_item
    ADD CONSTRAINT custom_item_article_id_fkey FOREIGN KEY (article_id) REFERENCES article(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: custom_item_parent_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY custom_item
    ADD CONSTRAINT custom_item_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES custom(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: custom_item_realty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY custom_item
    ADD CONSTRAINT custom_item_realty_id_fkey FOREIGN KEY (realty_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: custom_section_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY custom
    ADD CONSTRAINT custom_section_id_fkey FOREIGN KEY (section_id) REFERENCES section(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: custom_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY custom
    ADD CONSTRAINT custom_type_id_fkey FOREIGN KEY (type_id) REFERENCES custom_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: district_city_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY district
    ADD CONSTRAINT district_city_id_fkey FOREIGN KEY (city_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: district_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY district_i18n
    ADD CONSTRAINT district_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES district(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: feature_type_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES unit(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: news_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY news_i18n
    ADD CONSTRAINT news_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: news_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY news_i18n
    ADD CONSTRAINT news_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES news(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: news_picture_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY news_picture
    ADD CONSTRAINT news_picture_object_id_fkey FOREIGN KEY (object_id) REFERENCES news(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: person_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: person_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_status_id_fkey FOREIGN KEY (status_id) REFERENCES person_status(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: realty_city_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_city_id_fkey FOREIGN KEY (city_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: realty_district_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_district_id_fkey FOREIGN KEY (district_id) REFERENCES district(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: realty_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_i18n
    ADD CONSTRAINT realty_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_picture_realty_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty_picture
    ADD CONSTRAINT realty_picture_realty_id_fkey FOREIGN KEY (object_id) REFERENCES realty(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: realty_preview_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY realty
    ADD CONSTRAINT realty_preview_id_fkey FOREIGN KEY (preview_id) REFERENCES realty_picture(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: region_country_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY region
    ADD CONSTRAINT region_country_id_fkey FOREIGN KEY (country_id) REFERENCES country(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: region_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY region_i18n
    ADD CONSTRAINT region_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: region_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY region_i18n
    ADD CONSTRAINT region_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES region(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resource_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY resource
    ADD CONSTRAINT resource_type_id_fkey FOREIGN KEY (type_id) REFERENCES resource_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: static_page_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY static_page_i18n
    ADD CONSTRAINT static_page_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: static_page_i18n_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY static_page_i18n
    ADD CONSTRAINT static_page_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES static_page(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: static_page_section_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY static_page
    ADD CONSTRAINT static_page_section_id_fkey FOREIGN KEY (section_id) REFERENCES section(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: static_page_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY static_page
    ADD CONSTRAINT static_page_type_id_fkey FOREIGN KEY (type_id) REFERENCES static_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
    ADD CONSTRAINT unit_i18n_object_id_fkey FOREIGN KEY (object_id) REFERENCES unit(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


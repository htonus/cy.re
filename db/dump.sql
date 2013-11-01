--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- Name: article_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: article_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_id', 3, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: article; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article (
    id bigint DEFAULT nextval('article_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    published timestamp without time zone
);


--
-- Name: article_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE article_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: article_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('article_i18n_id', 5, true);


--
-- Name: article_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_i18n (
    id bigint DEFAULT nextval('article_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id integer NOT NULL,
    name character varying(128),
    text character varying(4096)
);


--
-- Name: picture_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE picture_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: picture_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('picture_id', 306, true);


--
-- Name: article_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE article_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id integer NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL
);


--
-- Name: unit_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: unit_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_id', 10, false);


--
-- Name: city; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city (
    id integer DEFAULT nextval('unit_id'::regclass) NOT NULL,
    latitude numeric(10,6),
    longitude numeric(10,6),
    region_id bigint,
    prefix character varying(2)
);


--
-- Name: city_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE city_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: city_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_i18n_id', 40, true);


--
-- Name: city_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city_i18n (
    id bigint DEFAULT nextval('city_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    name character varying(32)
);


--
-- Name: city_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE city_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: city_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_id', 19, true);


--
-- Name: custom_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE custom_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: custom_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_id', 2, true);


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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: custom_item_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('custom_item_id', 6, true);


--
-- Name: custom_item; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE custom_item (
    id bigint DEFAULT nextval('custom_item_id'::regclass) NOT NULL,
    "order" integer,
    parent_id bigint NOT NULL,
    realty_id bigint NOT NULL,
    name character varying(256)
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: district_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_id', 8, true);


--
-- Name: district; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE district (
    id integer DEFAULT nextval('district_id'::regclass) NOT NULL,
    latitude numeric(10,6),
    longitude numeric(10,6),
    city_id bigint
);


--
-- Name: district_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE district_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: district_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('district_i18n_id', 24, true);


--
-- Name: district_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE district_i18n (
    id bigint DEFAULT nextval('district_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    name character varying(32)
);


--
-- Name: feature_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: feature_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_id', 282, true);


--
-- Name: feature; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature (
    id bigint DEFAULT nextval('feature_id'::regclass) NOT NULL,
    type_id integer NOT NULL,
    realty_id integer NOT NULL,
    value bigint
);


--
-- Name: feature_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_type_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: feature_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_id', 43, true);


--
-- Name: feature_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type (
    id integer DEFAULT nextval('feature_type_id'::regclass) NOT NULL,
    unit_id integer,
    group_id integer,
    weight integer DEFAULT 1 NOT NULL
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: feature_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_i18n_id', 106, true);


--
-- Name: feature_type_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type_i18n (
    id integer DEFAULT nextval('feature_type_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: group_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE group_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: group_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_id', 4, true);


--
-- Name: group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE "group" (
    id integer DEFAULT nextval('group_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    text character varying(256)
);


--
-- Name: group_access_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE group_access_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: group_access_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('group_access_id', 22, true);


--
-- Name: group_access; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE group_access (
    id integer DEFAULT nextval('group_access_id'::regclass) NOT NULL,
    group_id integer NOT NULL,
    resource_id integer NOT NULL,
    access integer DEFAULT 0 NOT NULL
);


--
-- Name: language_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE language_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: language_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('language_id', 10, true);


--
-- Name: language; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE language (
    id integer DEFAULT nextval('language_id'::regclass) NOT NULL,
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: news_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_id', 1, false);


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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: news_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('news_i18n_id', 1, false);


--
-- Name: news_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE news_i18n (
    id bigint DEFAULT nextval('news_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id integer NOT NULL,
    name character varying(128),
    text character varying(4096)
);


--
-- Name: news_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE news_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id integer NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL
);



--
-- Name: person_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE person_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: person_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('person_id', 3, true);


--
-- Name: person; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE person (
    id integer DEFAULT nextval('person_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    name character varying(32) NOT NULL,
    surname character varying(32),
    status_id integer,
    email character varying(32) NOT NULL,
    username character varying(16) NOT NULL,
    password character varying(40) NOT NULL,
    autologin character varying(40),
    language_id bigint,
    phone character varying(12)
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: realty_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_id', 25, true);


--
-- Name: realty; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty (
    id bigint DEFAULT nextval('realty_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    published timestamp without time zone,
    latitude numeric(10,6),
    longitude numeric(10,6),
    type_id integer NOT NULL,
    offer_id integer NOT NULL,
    city_id integer,
    preview_id bigint,
    district_id integer
);


--
-- Name: realty_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: realty_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_i18n_id', 75, true);


--
-- Name: realty_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_i18n (
    id bigint DEFAULT nextval('realty_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id integer NOT NULL,
    name character varying(128),
    text character varying(4096)
);


--
-- Name: realty_picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    type_id integer NOT NULL,
    name character varying(128) NOT NULL,
    main boolean DEFAULT false,
    size bigint DEFAULT 0,
    width integer NOT NULL,
    height integer NOT NULL
);


--
-- Name: realty_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_type (
    id integer NOT NULL,
    prefix character varying(2)
);


--
-- Name: realty_type_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_type_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: realty_type_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_i18n_id', 58, true);


--
-- Name: realty_type_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE realty_type_i18n (
    id integer DEFAULT nextval('realty_type_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: realty_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE realty_type_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: realty_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('realty_type_id', 27, true);


--
-- Name: resource_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE resource_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: resource_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('resource_id', 11, true);


--
-- Name: resource; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE resource (
    id integer DEFAULT nextval('resource_id'::regclass) NOT NULL,
    name character varying(16) NOT NULL,
    type_id integer
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: static_page_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_id', 4, true);


--
-- Name: static_page; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE static_page (
    id bigint DEFAULT nextval('static_page_id'::regclass) NOT NULL,
    created timestamp without time zone DEFAULT now() NOT NULL,
    type_id bigint NOT NULL,
    section_id bigint
);


--
-- Name: static_page_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE static_page_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: static_page_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('static_page_i18n_id', 10, true);


--
-- Name: static_page_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE static_page_i18n (
    id bigint DEFAULT nextval('static_page_i18n_id'::regclass) NOT NULL,
    object_id bigint NOT NULL,
    language_id integer NOT NULL,
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
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: token_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_id', 20, true);


--
-- Name: token; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE token (
    id integer DEFAULT nextval('token_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: token_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE token_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: token_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('token_i18n_id', 75, true);


--
-- Name: token_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE token_i18n (
    id bigint DEFAULT nextval('token_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    value character varying(512)
);


--
-- Name: unit; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit (
    id integer DEFAULT nextval('unit_id'::regclass) NOT NULL,
    sign character varying(16)
);


--
-- Name: unit_i18n_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_i18n_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: unit_i18n_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_i18n_id', 8, true);


--
-- Name: unit_i18n; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit_i18n (
    id bigint DEFAULT nextval('unit_i18n_id'::regclass) NOT NULL,
    object_id integer NOT NULL,
    language_id integer NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article (id, created, published) FROM stdin;
1	2013-07-19 16:49:20	\N
\.


--
-- Data for Name: article_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_i18n (id, object_id, language_id, name, text) FROM stdin;
1	1	1	The acquisition of immovable property by EU citizens	<div>The acquisition of immovable property by EU citizens</div><div>A national of an EU member country is permitted to own as much ‘immovable property’ (a term that includes both land and property) as they wish.</div><div><br></div><div>Once the Title Deeds for the property they are buying become available, they are required to provide proof of their citizenship by taking their passport to the District Lands office when they pay the Property Transfer Fees.</div>
2	1	10		
3	1	2		
\.


--
-- Data for Name: article_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY article_picture (id, object_id, type_id, name, main, size, width, height) FROM stdin;
\.


--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city (id, latitude, longitude, region_id, prefix) FROM stdin;
1	35.145214	33.377237	\N	NI
2	0.000000	0.000000	\N	LI
3	0.000000	0.000000	\N	LA
4	0.000000	0.000000	\N	PA
10	35.038887	34.036160	\N	FA
12	35.033440	32.433357	\N	PO
13	\N	\N	2	\N
14	\N	\N	2	\N
15	\N	\N	2	\N
16	\N	\N	2	\N
17	\N	\N	2	\N
18	\N	\N	2	\N
19	\N	\N	2	\N
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
6	10	10	
7	10	2	Фамагуста
9	12	1	Polis
10	12	10	
11	12	2	Полис
12	1	10	
13	1	2	
14	2	10	
15	2	2	
16	3	10	
17	3	2	
18	4	10	
19	4	2	
20	13	1	Kato Polemidia
21	13	10	
22	13	2	
23	14	1	Mouttagiaka
24	14	10	
25	14	2	
26	15	1	Moni
27	15	10	
28	15	2	
29	16	1	Agios Tychon
30	16	10	
31	16	2	
32	17	1	Kolossi
33	17	10	
34	17	2	
35	18	1	Ypsonas
36	18	10	
37	18	2	
38	19	1	Parekklisia
39	19	10	
40	19	2	
\.


--
-- Data for Name: custom; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom (id, type_id, section_id, name) FROM stdin;
2	2	2	\t\t\t"\r\n\t\t
1	1	1	\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t"\r\n\t\t
\.


--
-- Data for Name: custom_item; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom_item (id, "order", parent_id, realty_id, name) FROM stdin;
3	1	2	5	\N
4	3	1	11	\N
5	4	1	12	\N
6	5	1	17	\N
\.


--
-- Data for Name: custom_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY custom_type (id, name) FROM stdin;
1	carousel
2	recent
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
2	1	10	
3	1	2	
5	2	10	
6	2	2	
8	3	10	
9	3	2	
11	4	10	
12	4	2	
14	5	10	
15	5	2	
20	7	10	
21	7	2	
1	1	1	Limassol
4	2	1	Nicosia
7	3	1	Larnaka
10	4	1	Paphos
13	5	1	Famagusta
19	7	1	Polis
22	8	1	Ayia Napa
23	8	10	
24	8	2	
\.


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature (id, type_id, realty_id, value) FROM stdin;
163	39	17	1
66	13	6	1
1	1	1	500000
2	2	1	200
3	3	1	3
4	5	1	2
5	4	1	3
6	19	1	1
7	20	1	1
8	21	1	1
9	10	1	1
10	24	1	1
44	4	5	1
45	19	5	1
46	20	5	1
47	21	5	1
51	1	6	49000
48	10	5	1
49	22	5	1
50	23	5	1
41	3	5	2
42	5	5	1
123	1	16	455000
124	3	16	2
125	5	16	1
126	6	16	1700
127	4	16	1
128	10	16	1
129	14	16	1
130	15	16	1
131	20	16	1
132	21	16	1
133	26	16	1
134	22	16	1
135	23	16	1
136	24	16	1
73	1	11	565000
74	3	11	4
75	5	11	2
76	4	11	5
77	11	11	1
78	13	11	1
79	10	11	1
173	1	19	360000
139	3	17	4
140	5	17	2
141	4	17	3
142	11	17	1
143	13	17	1
145	14	17	1
146	19	17	1
80	14	11	1
81	15	11	1
83	19	11	1
84	20	11	1
85	21	11	1
86	22	11	1
87	23	11	1
88	24	11	1
147	20	17	1
90	3	12	5
91	23	12	1
92	24	12	1
89	1	12	2450000
149	25	17	1
148	21	17	1
150	26	17	1
154	28	17	1
155	29	17	1
156	30	17	1
164	3	18	1
165	6	18	1000
166	13	18	1
167	14	18	1
168	15	18	1
169	19	18	1
170	20	18	1
171	26	18	1
172	29	18	1
158	33	17	1
151	22	17	1
152	23	17	1
153	24	17	1
159	34	17	1
160	35	17	1
161	36	17	1
174	3	19	3
162	38	17	1
175	16	19	1
176	17	19	1
177	19	19	1
178	20	19	1
179	25	19	1
180	29	19	1
181	22	19	1
182	23	19	1
183	24	19	1
184	34	19	1
185	36	19	1
67	14	6	1
68	15	6	1
69	20	6	1
70	21	6	1
71	22	6	1
72	24	6	1
64	5	6	1
65	4	6	1
188	5	20	1
189	4	20	3
190	11	20	1
191	13	20	1
187	3	20	3
192	14	20	1
194	19	20	1
195	20	20	1
196	25	20	1
197	21	20	1
198	26	20	1
199	28	20	1
200	29	20	1
201	22	20	1
202	23	20	1
203	24	20	1
204	34	20	1
205	35	20	1
207	39	20	1
43	6	5	670
138	1	17	2200000
186	1	20	2500000
193	15	20	1
209	42	20	1
210	43	20	1
206	36	20	1
211	1	21	1150
212	3	21	2
213	5	21	1
214	6	21	1150
215	4	21	2
216	11	21	1
217	13	21	1
218	14	21	1
219	19	21	1
220	20	21	1
221	21	21	1
222	29	21	1
223	10	21	1
224	42	21	1
225	1	5	670
226	14	5	1
227	15	5	1
228	1	22	550
229	3	22	2
230	6	22	550
231	4	22	2
232	13	22	1
233	14	22	1
234	29	22	1
235	35	22	1
236	38	22	1
237	39	22	1
238	1	23	295000
239	5	23	1
240	4	23	2
241	13	23	1
242	14	23	1
243	19	23	1
244	20	23	1
245	26	23	1
246	29	23	1
247	10	23	1
248	39	23	1
249	1	24	750
250	3	24	2
251	5	24	1
252	6	24	750
253	4	24	2
254	13	24	1
255	14	24	1
256	15	24	1
257	19	24	1
258	20	24	1
259	26	24	1
260	29	24	1
261	22	24	1
262	35	24	1
263	39	24	1
264	1	25	600000
265	3	25	3
266	5	25	2
267	4	25	3
268	13	25	1
269	14	25	1
270	15	25	1
271	19	25	1
272	20	25	1
273	21	25	1
274	26	25	1
275	29	25	1
276	22	25	1
277	23	25	1
278	24	25	1
279	34	25	1
280	35	25	1
281	36	25	1
282	39	25	1
\.


--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type (id, unit_id, group_id, weight) FROM stdin;
1	1	3	10
2	2	3	10
3	3	3	10
5	3	3	10
6	3	3	10
4	3	3	10
11	4	1	1
13	4	1	1
22	4	2	1
23	4	2	1
24	4	2	1
14	4	1	1
15	4	1	1
16	4	1	1
17	4	1	1
18	4	1	1
19	4	1	1
20	4	1	1
25	4	1	1
27	4	1	1
21	4	1	1
26	4	1	1
28	4	1	1
29	4	1	1
30	4	1	1
31	4	1	1
33	4	1	1
10	4	1	1
34	4	2	1
35	4	2	1
36	4	2	1
37	4	1	1
38	4	2	1
39	4	2	1
40	4	3	1
41	4	3	10
42	4	1	1
43	4	1	1
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
5	5	1	parking lots
6	6	1	monthly price
7	10	1	balcony
8	10	2	
9	10	10	
4	4	1	toiets
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
95	40	1	
96	40	10	
97	40	2	
98	41	1	Sea view
99	41	10	
100	41	2	
101	42	1	Sea view
102	42	10	
103	42	2	
104	43	1	Jacuzzi
105	43	10	
106	43	2	
\.


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
7	2	7	63
15	4	8	31
18	4	10	31
1	1	1	23
2	1	2	23
3	1	3	23
4	1	4	23
5	1	5	23
6	1	6	23
17	1	9	23
20	1	10	23
21	1	11	23
8	3	1	54
9	3	2	54
10	3	3	54
11	3	4	54
12	3	5	54
13	3	6	54
14	3	8	54
16	3	9	54
19	3	10	54
22	3	11	54
\.


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

COPY language (id, name, code, native, active) FROM stdin;
1	English	en	English	t
10	Chineese	cn	中文简体	f
2	Russian	ru	Русский	f
\.


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
-- Data for Name: news_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY news_picture (id, object_id, type_id, name, main, size, width, height) FROM stdin;
\.



--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person (id, created, name, surname, status_id, email, username, password, autologin, language_id, phone) FROM stdin;
3	2013-05-15 22:21:05	Demetris	\N	3	demetris@cyprus-realty.com	esperia	0ad23e97087b73c03e8245dd6366d172e7f0dbd8	55F74EBA51C9824200E08F6F4C31C88BB7F51F6A	\N	\N
2	2013-04-01 13:56:06	Natalia	Boiarinova	3	natalia@cyprus-realty.com	nekta	45c099e596be6bbda390b3c1726d384edb501e96	20298DD37B7330766898633A7ED06F3A60EBE042	\N	\N
1	2013-04-01 12:49:52	Mikhail	Cherviakov	5	htonus@cyprus-realty.com	htonus	28f9e86b0d5f5739612a7fda378ade96f0c30ac9	2AAB9D2C2C2421557F7E9DEA70275BF361683246	\N	\N
\.


--
-- Data for Name: person_group; Type: TABLE DATA; Schema: public; Owner: -
--

COPY person_group (person_id, group_id) FROM stdin;
2	1
2	3
2	4
3	1
3	4
3	3
\.


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
-- Data for Name: realty; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty (id, created, published, latitude, longitude, type_id, offer_id, city_id, preview_id, district_id) FROM stdin;
1	2013-05-18 20:10:03	2013-06-27 13:10:31	\N	\N	2	1	2	7	2
17	2013-07-18 15:17:05	2013-07-22 14:32:07	\N	\N	21	1	2	184	1
20	2013-07-22 12:49:56	2013-07-24 13:04:07	\N	\N	21	1	2	224	\N
21	2013-07-24 15:05:27	2013-07-24 15:08:29	\N	\N	2	2	2	228	\N
16	2013-07-18 14:34:07	2013-07-18 14:43:25	\N	\N	2	1	2	180	\N
5	2013-06-28 23:08:43	2013-07-24 15:31:21	\N	\N	2	2	2	12	\N
22	2013-07-24 15:35:51	2013-07-24 15:39:26	\N	\N	2	2	2	245	\N
23	2013-07-26 11:38:54	2013-07-26 12:45:38	\N	\N	2	1	2	267	\N
24	2013-07-29 11:16:47	2013-07-29 12:49:49	\N	\N	2	2	2	280	\N
18	2013-07-19 15:50:22	2013-07-19 15:51:22	\N	\N	2	2	2	186	1
25	2013-08-01 10:42:53	2013-08-01 10:55:23	\N	\N	1	1	2	304	\N
19	2013-07-19 16:00:16	2013-07-19 16:05:34	\N	\N	22	1	19	189	\N
11	2013-07-18 11:13:51	2013-07-19 16:06:04	\N	\N	21	1	2	98	1
12	2013-07-18 12:05:19	2013-07-19 16:06:22	\N	\N	21	1	2	116	1
6	2013-07-17 11:58:03	2013-08-07 11:37:52	\N	\N	2	1	2	198	1
\.


--
-- Data for Name: realty_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_i18n (id, object_id, language_id, name, text) FROM stdin;
2	1	10		
3	1	2		
1	1	1	Pretty flat	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium orci a sapien gravida convallis. Suspendisse rutrum facilisis sapien, vel mollis magna mollis sed. Ut at malesuada mi, a fringilla metus. Donec fringilla ante orci, eget suscipit felis posuere viverra. Proin libero ligula, vestibulum id tellus ac, viverra elementum mi. Proin tellus justo, sagittis in nisi a, semper elementum odio. Proin vel ipsum id eros pulvinar molestie.</p><p>Quisque non egestas ligula. Curabitur at velit sit amet magna imperdiet lobortis. Pellentesque leo justo, vestibulum at nisi non, sollicitudin pulvinar nunc. Pellentesque pulvinar vel risus ut mollis. Proin volutpat ultrices purus, vel porta arcu laoreet non. In hac habitasse platea dictumst. Praesent egestas, magna ut luctus tempor, eros tellus hendrerit magna, sit amet condimentum urna diam ut orci. Proin euismod porta bibendum. Phasellus quis eleifend eros. Nullam viverra porta lacus, ut consectetur mauris vestibulum at.</p>
14	5	10		
15	5	2		
16	6	1		
17	6	10		
18	6	2		
13	5	1		Two Bedroom apartment with open plan kitchen/sitting/dining area,&nbsp;bathroom, large&nbsp;balcony,&nbsp;swimming&nbsp;pool.&nbsp;Situated in the Germassoia area, close to&nbsp;the tourist road and with good access to&nbsp;restaurants, bars, shops and within walking distance to&nbsp;sandy beaches.&nbsp;&nbsp;
31	11	1		<div>Four bedroom &nbsp;villa located at Kolossi, 15 minutes to the west of Limassol. Very well built with modern kitchen, fireplace, overflow swimming pool with electric cover, electric shutters, laundry room, double garage and many other extras. Good access to the highway for Paphos, Larnaca or Nicosia and within easy reach of two championship golf courses. Also close to a nice sandy beach and only twenty minutes away from one of the main wine producing areas of Cyprus</div><div><br></div>
32	11	10		
33	11	2		
34	12	1		LUXURIOUS FIVE BEDROOM VILLA SITUATED IN THE BEST RESIDENTIAL AREA &nbsp;OF LIMASSOL WITH PANORAMIC VIEWS OF THE TOWN AND THE SEA . LOCATED ON A LARGE PLOT OF LAND IT OFFERS COMFORT AND ELEGANCE &nbsp;FOR THE DISCERNING BUYER . &nbsp;ITS BEAUTIFUL LANDSCAPED GARDENS, SWIMMING POOL, HIGH QUALITY &nbsp;FINISHES, FIREPLACE AND CENTRAL HEATING ARE JUST A FEW OF THE &nbsp;FEATURES THAT CONTRIBUTE TO MAKE THIS A VERY ATTRACTIVE &nbsp;RESIDENCE.&nbsp;
35	12	10		
36	12	2		
46	16	1		
47	16	10		
48	16	2		
49	17	1		
50	17	10		
51	17	2		
52	18	1		
53	18	10		
54	18	2		
55	19	1		
56	19	10		
57	19	2		
58	20	1		
59	20	10		
60	20	2		
61	21	1		
62	21	10		
63	21	2		
64	22	1		
65	22	10		
66	22	2		
67	23	1		
68	23	10		
69	23	2		
70	24	1		
71	24	10		
72	24	2		
73	25	1		
74	25	10		
75	25	2		
\.


--
-- Data for Name: realty_picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_picture (id, object_id, type_id, name, main, size, width, height) FROM stdin;
1	1	2	Idea-Paint-Awwwards.com_.jpg	f	65097	635	438
2	1	2	1671985-inline-5127b51fb3fc4b95c900004d-hayden-place-cuningham-group-cga-05-1000x667.jpg	f	101204	642	428
3	1	2	interior-wallpaper-1280x800-048.jpg	f	819516	1280	800
4	1	2	nice-indoor-pool-and-space-1280x960.jpg	f	379323	1280	960
6	1	2	nice-indoor-pool-and-space-1280x960.jpg	f	379323	1280	960
7	1	2	images.jpg	f	603161	1280	800
12	5	2	kranou10.jpg	f	94152	768	1024
13	5	2	kranou9.jpg	f	138002	768	1024
14	5	2	kranou8.jpg	f	199818	768	1024
15	5	2	kranou6.jpg	f	92491	1024	768
16	5	2	kranou7.jpg	f	173334	1024	768
17	5	2	kranou4.jpg	f	66013	1024	768
18	5	2	kranou3.jpg	f	69130	1024	768
19	5	2	kranou5.jpg	f	80986	768	1024
20	5	2	kranou2.jpg	f	74472	1024	768
21	5	2	kranou1.jpg	f	78527	1024	768
22	5	2	kranou.jpg	f	95869	1024	768
25	6	2	003.jpg	f	80828	768	1024
28	11	2	HPNX0105.JPG	f	415883	1280	960
29	11	2	HPNX0104.JPG	f	487714	1280	960
31	11	2	HPNX0102.JPG	f	498260	1280	960
32	11	2	HPNX0101.JPG	f	442872	1280	960
33	11	2	HPNX0098.JPG	f	479170	1280	960
34	11	2	HPNX0099.JPG	f	500419	1280	960
35	11	2	HPNX0100.JPG	f	505893	1280	960
36	11	2	HPNX0097.JPG	f	529672	1280	960
37	11	2	HPNX0094.JPG	f	558379	960	1280
38	11	2	HPNX0093.JPG	f	600452	1280	960
39	11	2	HPNX0091.JPG	f	623685	1280	960
40	11	2	HPNX0092.JPG	f	561760	1280	960
41	11	2	HPNX0088.JPG	f	513337	1280	960
42	11	2	HPNX0090.JPG	f	652331	1280	960
43	11	2	HPNX0084.JPG	f	431189	1280	960
44	11	2	HPNX0086.JPG	f	510801	1280	960
45	11	2	HPNX0085.JPG	f	506591	960	1280
46	11	2	HPNX0081.JPG	f	416677	1280	960
47	11	2	HPNX0082.JPG	f	413917	1280	960
48	11	2	HPNX0080.JPG	f	416127	1280	960
49	11	2	HPNX0079.JPG	f	458934	1280	960
50	11	2	HPNX0083.JPG	f	439962	1280	960
51	11	2	HPNX0077.JPG	f	437918	1280	960
52	11	2	HPNX0076.JPG	f	440776	1280	960
53	11	2	HPNX0072.JPG	f	502325	1280	960
54	11	2	HPNX0078.JPG	f	553843	1280	960
55	11	2	HPNX0075.JPG	f	473813	1280	960
56	11	2	HPNX0074.JPG	f	488284	1280	960
57	11	2	HPNX0071.JPG	f	565038	1280	960
58	11	2	HPNX0068.JPG	f	452545	1280	960
59	11	2	HPNX0069.JPG	f	449215	1280	960
60	11	2	HPNX0070.JPG	f	443190	1280	960
61	11	2	HPNX0073.JPG	f	466460	1280	960
62	11	2	HPNX0065.JPG	f	439115	1280	960
63	11	2	HPNX0067.JPG	f	409983	960	1280
64	11	2	HPNX0066.JPG	f	449532	1280	960
65	11	2	HPNX0064.JPG	f	441292	1280	960
66	11	2	HPNX0061.JPG	f	480125	1280	960
67	11	2	HPNX0060.JPG	f	450451	1280	960
68	11	2	HPNX0063.JPG	f	478097	1280	960
69	11	2	HPNX0058.JPG	f	451204	960	1280
70	11	2	HPNX0059.JPG	f	423308	1280	960
72	11	2	HPNX0054.JPG	f	351789	1280	960
73	11	2	HPNX0053.JPG	f	442361	1280	960
74	11	2	HPNX0051.JPG	f	492081	1280	960
75	11	2	HPNX0050.JPG	f	467925	1280	960
76	11	2	HPNX0049.JPG	f	495007	1280	960
77	11	2	HPNX0052.JPG	f	505066	1280	960
78	11	2	HPNX0046.JPG	f	543090	1280	960
80	11	2	HPNX0047.JPG	f	483153	1280	960
81	11	2	HPNX0048.JPG	f	467977	1280	960
83	11	2	HPNX0042.JPG	f	476291	1280	960
84	11	2	HPNX0039.JPG	f	515704	1280	960
88	11	2	HPNX0032.JPG	f	545839	1280	960
89	11	2	HPNX0027.JPG	f	596257	1280	960
90	11	2	HPNX0026.JPG	f	502482	1280	960
91	11	2	HPNX0029.JPG	f	551070	1280	960
93	11	2	HPNX0024.JPG	f	446666	1280	960
94	11	2	HPNX0025.JPG	f	509363	1280	960
95	11	2	HPNX0020.JPG	f	501670	1280	960
96	11	2	HPNX0022.JPG	f	470862	1280	960
97	11	2	HPNX0019.JPG	f	504966	1280	960
98	11	2	HPNX0018.JPG	f	525064	1280	960
99	11	2	HPNX0014.JPG	f	553884	1280	960
100	11	2	HPNX0015.JPG	f	547138	1280	960
101	11	2	HPNX0010.JPG	f	565379	1280	960
104	11	2	HPNX0009.JPG	f	570692	1280	960
107	11	2	HPNX0043.JPG	f	500830	1280	960
110	12	2	IMG_3168.JPG	f	824701	3456	2304
111	12	2	IMG_3147.JPG	f	845184	3456	2304
112	12	2	IMG_3176.JPG	f	974444	3456	2304
114	12	2	IMG_3178.JPG	f	1017716	3456	2304
115	12	2	IMG_3145.JPG	f	781912	3456	2304
116	12	2	IMG_3152.JPG	f	1148313	3456	2304
117	12	2	IMG_3142.JPG	f	1150769	2304	3456
118	12	2	IMG_3139.JPG	f	964142	3456	2304
120	12	2	IMG_3131.JPG	f	828440	3456	2304
121	12	2	IMG_3144.JPG	f	1110245	3456	2304
122	12	2	IMG_3130.JPG	f	836935	3456	2304
123	12	2	IMG_3132.JPG	f	1379837	3456	2304
124	12	2	IMG_3129.JPG	f	913447	3456	2304
125	12	2	IMG_3123.JPG	f	771039	3456	2304
126	12	2	IMG_3114.JPG	f	802049	3456	2304
127	12	2	IMG_3115.JPG	f	1158580	3456	2304
128	12	2	IMG_3111.JPG	f	810772	2304	3456
129	12	2	IMG_3112.JPG	f	812947	3456	2304
130	12	2	IMG_3109.JPG	f	1012172	3456	2304
131	12	2	IMG_3120.JPG	f	1475633	3456	2304
132	12	2	IMG_3105.JPG	f	839011	3456	2304
133	12	2	IMG_3104.JPG	f	841080	3456	2304
134	12	2	IMG_3106.JPG	f	1343634	2304	3456
135	12	2	IMG_3102.JPG	f	937985	3456	2304
136	12	2	IMG_3099.JPG	f	928442	3456	2304
164	16	2	02.jpg	f	334584	1282	855
166	16	2	01.3.jpg	f	488422	1140	1709
167	16	2	03.jpg	f	628817	1496	997
168	16	2	04.2.jpg	f	416341	1496	997
169	16	2	04.jpg	f	450230	1496	997
170	16	2	05.1.jpg	f	421915	1709	1140
171	16	2	04.1.jpg	f	475071	1496	997
172	16	2	05.jpg	f	361231	1140	1709
173	16	2	07.jpg	f	7277	226	151
174	16	2	07.1.jpg	f	195769	855	570
175	16	2	09.jpg	f	100244	428	641
176	16	2	06.3.jpg	f	509522	1709	1140
177	16	2	06.1.jpg	f	570888	1709	1140
178	16	2	06.2.jpg	f	586388	1709	1140
179	16	2	08.jpg	f	250605	570	855
180	16	2	06.jpg	f	622074	1709	1140
182	17	2	IMG_3035.JPG	f	1770074	3456	2304
183	17	2	IMG_3032.JPG	f	1637805	3456	2304
184	17	2	IMG_3031.JPG	f	1672385	3456	2304
185	18	2	Sitting-dining area.jpg	f	263346	1392	928
186	18	2	Kitchen area.jpg	f	239466	1392	928
187	18	2	Main bedroom.jpg	f	200006	1392	928
188	18	2	Sea View.jpg	f	464157	694	1368
189	19	2	House.jpg	f	70314	512	384
190	19	2	Garden 2.jpg	f	74968	512	384
191	19	2	SAM_0444.JPG	f	625757	2048	1536
192	19	2	SAM_0434.JPG	f	623355	2048	1536
193	19	2	SAM_0442.JPG	f	633618	2048	1536
194	19	2	SAM_0440.JPG	f	631197	2048	1536
195	19	2	SAM_0433.JPG	f	632617	2048	1536
196	6	2	004.jpg	f	65166	768	1024
198	6	2	Elka 4.jpg	f	133836	800	600
199	6	2	Elka Google 2.jpg	f	349362	1200	791
200	20	2	VA0023.jpg	f	367375	2184	1456
201	20	2	VA0022.jpg	f	515804	2184	1456
202	20	2	VA0024.jpg	f	388039	1456	2184
203	20	2	VA0025.jpg	f	600294	2184	1456
204	20	2	VA0026.jpg	f	858975	2184	1456
205	20	2	VA0021.jpg	f	431393	2184	1456
206	20	2	VA0019.jpg	f	391661	2184	1456
207	20	2	VA0020.jpg	f	478838	1456	2184
208	20	2	VA0027.jpg	f	1047721	2184	1456
209	20	2	VA0018.jpg	f	477427	2184	1456
210	20	2	VA0016.jpg	f	437108	2184	1456
211	20	2	VA0017.jpg	f	691655	2184	1456
212	20	2	VA0015.jpg	f	512968	2184	1456
213	20	2	VA0013.jpg	f	451594	1456	2184
214	20	2	VA0012.jpg	f	570403	2184	1456
215	20	2	VA0014.jpg	f	670253	1456	2184
216	20	2	VA0009.jpg	f	572245	1456	2184
217	20	2	VA0011.jpg	f	633591	2184	1456
218	20	2	VA0010.jpg	f	681655	1456	2184
219	20	2	VA0008.jpg	f	487604	2184	1456
220	20	2	VA0006.jpg	f	504989	2184	1456
221	20	2	VA0007.jpg	f	620673	2184	1456
223	20	2	VA0005.jpg	f	1037408	2184	1456
224	20	2	VA0002.jpg	f	995049	2184	1456
225	17	2	IMG_3037.JPG	f	2097124	3456	2304
226	21	2	IMGP0186.JPG	f	460351	1080	1920
227	21	2	IMGP0182.JPG	f	486324	1920	1080
228	21	2	IMGP0187.JPG	f	491897	1920	1080
229	21	2	IMGP0183.JPG	f	500515	1920	1080
230	21	2	IMGP0185.JPG	f	477292	1920	1080
231	21	2	IMGP0184.JPG	f	481115	1920	1080
232	21	2	IMGP0180.JPG	f	484961	1920	1080
233	21	2	IMGP0181.JPG	f	500856	1920	1080
234	21	2	IMGP0179.JPG	f	499598	1920	1080
235	21	2	IMGP0177.JPG	f	493509	1920	1080
236	21	2	IMGP0178.JPG	f	483672	1080	1920
237	21	2	IMGP0176.JPG	f	476747	1080	1920
238	21	2	IMGP0175.JPG	f	462211	1920	1080
239	21	2	IMGP0174.JPG	f	470674	1920	1080
240	21	2	IMGP0172.JPG	f	492199	1080	1920
241	21	2	IMGP0171.JPG	f	476439	1920	1080
242	21	2	IMGP0173.JPG	f	480885	1920	1080
243	22	2	IMGP0271.JPG	f	504909	1080	1920
244	22	2	8.JPG	f	479048	1080	1920
245	22	2	IMGP0286.JPG	f	447528	1920	1080
247	22	2	9.JPG	f	490912	1080	1920
248	22	2	IMGP0272.JPG	f	467715	1080	1920
249	22	2	7.JPG	f	471762	1920	1080
250	22	2	6.JPG	f	472582	1920	1080
251	22	2	5.JPG	f	462006	1920	1080
252	22	2	4.1.JPG	f	511261	1080	1920
253	22	2	4.JPG	f	460544	1920	1080
254	22	2	7.1.JPG	f	494444	1080	1920
255	22	2	3.JPG	f	442093	1920	1080
256	22	2	2.JPG	f	491993	1080	1920
257	22	2	1.JPG	f	497647	1920	1080
258	22	2	3.1.JPG	f	475365	1920	1080
259	23	2	1.jpg	f	1622438	4000	3000
260	23	2	2.jpg	f	1721494	4000	3000
261	23	2	19.jpg	f	1534185	4000	3000
262	23	2	14.jpg	f	1640452	4000	3000
263	23	2	15.jpg	f	2072336	4000	3000
264	23	2	16.jpg	f	1846220	4000	3000
265	23	2	13.jpg	f	1966700	4000	3000
266	23	2	12.jpg	f	1859077	4000	3000
267	23	2	9.jpg	f	2003040	4000	3000
268	23	2	11.jpg	f	2055909	4000	3000
269	23	2	7.jpg	f	1945265	4000	3000
270	23	2	4.jpg	f	1614767	4000	3000
271	23	2	3.jpg	f	1721778	4000	3000
272	24	2	14.jpg	f	1640452	4000	3000
273	24	2	19.jpg	f	1534185	4000	3000
274	24	2	18.jpg	f	1974175	4000	3000
275	24	2	15.jpg	f	2072336	4000	3000
276	24	2	16.jpg	f	1846220	4000	3000
277	24	2	12.jpg	f	1859077	4000	3000
278	24	2	13.jpg	f	1966700	4000	3000
279	24	2	11.jpg	f	2055909	4000	3000
280	24	2	9.jpg	f	2003040	4000	3000
281	24	2	7.jpg	f	1945265	4000	3000
282	24	2	4.jpg	f	1614767	4000	3000
283	24	2	3.jpg	f	1721778	4000	3000
284	24	2	2.jpg	f	1721494	4000	3000
285	24	2	1.jpg	f	1622438	4000	3000
286	25	2	20.jpg	f	66772	768	1024
287	25	2	23.jpg	f	111615	768	1024
288	25	2	21.jpg	f	70428	768	1024
289	25	2	22.jpg	f	111120	768	1024
290	25	2	19.jpg	f	48829	1024	768
291	25	2	13.jpg	f	79793	1024	768
292	25	2	10.jpg	f	72759	1024	768
293	25	2	14.jpg	f	98686	1024	768
294	25	2	11.jpg	f	59483	1024	768
295	25	2	15.jpg	f	116303	1024	768
296	25	2	9.jpg	f	109193	1024	768
297	25	2	6.jpg	f	187625	1024	768
298	25	2	17.jpg	f	54602	768	1024
299	25	2	5.jpg	f	127546	1024	768
300	25	2	2.jpg	f	85493	768	1024
301	25	2	8.jpg	f	161831	1024	768
302	25	2	3.jpg	f	86108	768	1024
303	25	2	4.jpg	f	84094	1024	768
304	25	2	1.jpg	f	88219	1024	768
305	25	2	7.jpg	f	126296	1024	768
306	25	2	18.jpg	f	78045	768	1024
\.


--
-- Data for Name: realty_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type (id, prefix) FROM stdin;
12	\N
13	\N
16	\N
19	\N
22	\N
17	\N
1	H
10	B
11	L
14	F
18	S
21	V
26	B
27	\N
2	A
\.


--
-- Data for Name: realty_type_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY realty_type_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	house
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
2	2	1	apartment
54	26	2	
55	26	10	
53	26	1	business
57	27	10	
58	27	2	
56	27	1	studio
\.


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
\.


--
-- Data for Name: static_page; Type: TABLE DATA; Schema: public; Owner: -
--

COPY static_page (id, created, type_id, section_id) FROM stdin;
4	2013-06-03 19:51:34.629845	8	\N
\.


--
-- Data for Name: static_page_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY static_page_i18n (id, object_id, language_id, name, anons, text) FROM stdin;
9	4	10			
10	4	2			
8	4	1	About Esperia		<p>Esperia Estates was incorporated in 1967 and has since played a leading role in the real estate profession in Cyprus.&nbsp;<br></p><p>The company has grown steadily and now offers a wide range of services which are available either separately or in combination so as to suit precisely the client's particular needs.&nbsp;<br></p><p>Esperia Estates has successfully developed sites in various parts of Cyprus. The company has its own management and design teams for the construction of apartments, offices, shops, villas, hotels and restaurants. The quality of the finished product and the successful completion within specified time limits are an essential part of the company's image.<br></p>
\.


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

COPY token (id, name) FROM stdin;
2	RENT
3	INDOOR
4	OUTDOOR
5	GENERAL
1	BUY
6	LIST-TYPE-1
7	LIST-TYPE-2
8	LIST-TYPE-3
9	LIST-TYPE-4
10	LIST-TYPE-5
11	ESPERIA-COMPANY
12	TTL-CONTACT-INFO
13	TTL-LEGAL-INFO
14	TTL-ESPERIA-COMPANY
15	TTL-FOLLOW-US
16	TTL-TWITTER-FEED
17	ABOUT-US
18	TWEET-NOTE
19	TTL-RECENT
20	TTL-SUBMIT
\.


--
-- Data for Name: token_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY token_i18n (id, object_id, language_id, value) FROM stdin;
17	2	1	rent
18	3	1	indoor options
19	4	1	outdoor features
20	5	1	general features
16	1	1	buy
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
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (id, sign) FROM stdin;
1	&euro;
3	
2	m<sup>2</sup>
4	\N
\.


--
-- Data for Name: unit_i18n; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit_i18n (id, object_id, language_id, name) FROM stdin;
1	1	1	money
2	2	1	area
3	3	1	quantity
5	2	2	площадь
6	2	10	
7	4	10	
8	4	2	Наличие
4	4	1	presence
\.


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
-- Name: article_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY article_i18n
    ADD CONSTRAINT article_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: district_i18n_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY district_i18n
    ADD CONSTRAINT district_i18n_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: feature_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_type_id_fkey FOREIGN KEY (type_id) REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- PostgreSQL database dump complete
--


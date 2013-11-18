CREATE OR REPLACE FUNCTION is_in_earth_circle(lat float, lng float, cLat float, cLng float, radius float) RETURNS boolean AS
$BODY$
BEGIN
    IF lat IS NULL OR lng IS NULL THEN
        RETURN FALSE;
    END IF;

    RETURN earth_distance(ll_to_earth(cLat, cLng), ll_to_earth(lat, lng)) < radius;
END
$BODY$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_earth_distance(lat float, lng float, cLat float, cLng float) RETURNS integer AS
$BODY$
BEGIN
    RETURN earth_distance(ll_to_earth(cLat, cLng), ll_to_earth(lat, lng))::integer;
END
$BODY$
LANGUAGE plpgsql;


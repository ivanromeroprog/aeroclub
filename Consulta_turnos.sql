SELECT

alumno.nombre AS alumno_nombre,
alumno.apellido AS alumno_apellido,
piloto.nombre AS piloto_nombre,
piloto.apellido AS piloto_apellido,
aeronave.marca,
aeronave.modelo,
turno.*

FROM turno

LEFT JOIN alumno ON turno.id_alumno = alumno.id
LEFT JOIN piloto ON turno.id_piloto = piloto.id
LEFT JOIN aeronave ON turno.id_aeronave = aeronave.id;

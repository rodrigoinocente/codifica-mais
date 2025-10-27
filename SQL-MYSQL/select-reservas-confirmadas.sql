SELECT reservas.id_reserva, reservas.status_id
FROM reservas
WHERE status_id = 2 AND data_checkin > '2025-06-01';

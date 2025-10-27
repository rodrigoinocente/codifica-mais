SELECT reservas.id_reserva,
hospedes.nome_completo,
hospedagens.titulo,
status_reservas.status_nome AS status
FROM reservas
JOIN hospedes ON hospedes.id_hospede = reservas.id_hospede
JOIN hospedagens ON hospedagens.id_hospedagem = reservas.id_hospedagem
JOIN status_reservas ON status_reservas.id_status = reservas.status_id;
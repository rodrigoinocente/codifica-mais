SELECT reservas.id_reserva,
(reservas.valor_noite * noites) AS total_recebido
FROM reservas
WHERE deletado_em IS NOT NULL;
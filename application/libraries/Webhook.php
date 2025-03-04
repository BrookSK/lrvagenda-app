<?php
function sendWebhook($appointment) {
    // Verifica se o status é "br-success" (status = 1)
    if ($appointment->status == 1) {
        
        // URL do webhook
        $webhook_url = "https://webhook.site/9bd1e010-aba4-476c-944d-3331be3f2ecc";

        // Dados a serem enviados
        $payload = json_encode([
            "appointment_id" => $appointment->id,
            "customer_id" => $appointment->customer_id,
            "service_id" => $appointment->service_id,
            "staff_id" => $appointment->staff_id,
            "date" => $appointment->date,
            "time" => $appointment->time,
            "status" => "approved"
        ]);

        // Inicializa o cURL
        $ch = curl_init($webhook_url);
        
        // Configurações do cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Executa a requisição
        $response = curl_exec($ch);

        // Verifica erros
        if (curl_errno($ch)) {
            error_log("Erro ao enviar webhook: " . curl_error($ch));
        }

        // Fecha conexão
        curl_close($ch);
    }
}

// Exemplo de uso no código existente
sendWebhook($appointment);
?>
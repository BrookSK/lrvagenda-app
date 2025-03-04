<?php
function sendWebhook($appointment) {
    // URL do webhook de destino
    $webhookUrl = "https://webhook.site/9bd1e010-aba4-476c-944d-3331be3f2ecc"; 

    // Verifica se o status do agendamento é "br-success" (status == 1)
    if ($appointment->status == 1) {
        // Dados a serem enviados no webhook
        $payload = json_encode([
            "appointment_id" => $appointment->id,
            "customer_id" => $appointment->customer_id,
            "service_id" => $appointment->service_id,
            "staff_id" => $appointment->staff_id,
            "date" => $appointment->date,
            "time" => $appointment->time,
            "status" => "approved" // Indicação de que foi aprovado
        ]);

        // Configuração do cURL para enviar a requisição POST
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($payload)
        ]);

        // Executa a requisição
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Log opcional para debug
        error_log("Webhook enviado para $webhookUrl - Status: $httpCode - Resposta: $response");
    }
}

// Exemplo de uso (insira dentro do loop ou onde os agendamentos são carregados)
sendWebhook($appointment);
?>
<?php
    // Verifica se o status foi alterado para br-success (status 1)
    if($appointment->status == 1) {
        
        // Configurações do Webhook
        $webhook_url = 'https://webhook.site/9bd1e010-aba4-476c-944d-3331be3f2ecc';
        $data = [
            'appointment_id' => $appointment->id,
            'status' => 'br-success',
            'timestamp' => date('Y-m-d H:i:s'),
            'additional_data' => [
                // Adicione outros campos relevantes aqui
            ]
        ];

        // Inicia o cURL
        $ch = curl_init($webhook_url);
        
        // Configura a requisição
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        // Executa a requisição
        $result = curl_exec($ch);
        
        // Verifica erros
        if(curl_errno($ch)) {
            // Registra o erro se necessário
            error_log('Webhook error: ' . curl_error($ch));
        }
        
        curl_close($ch);
    }
?>
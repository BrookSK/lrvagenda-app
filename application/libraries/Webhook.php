<?php
function sendWebhook($business, $appointment, $customer = null, $service = null) {
    if (empty($business) || empty($business->webhook_url)) {
        return;
    }

    if ((int)$appointment->status !== 1) {
        return;
    }

    $payload = [
        "event" => "appointment_approved",
        "business_id" => $appointment->business_id,
        "appointment_id" => $appointment->id,
        "customer" => [
            "id" => isset($appointment->customer_id) ? $appointment->customer_id : null,
            "name" => $customer ? $customer->name : null,
            "email" => $customer ? $customer->email : null,
            "phone" => $customer ? $customer->phone : null
        ],
        "service" => [
            "id" => isset($appointment->service_id) ? $appointment->service_id : null,
            "name" => $service ? $service->name : null
        ],
        "staff_id" => isset($appointment->staff_id) ? $appointment->staff_id : null,
        "date" => $appointment->date,
        "time" => $appointment->time,
        "status" => "approved"
    ];

    $payloadJson = json_encode($payload);

    $ch = curl_init($business->webhook_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Content-Length: " . strlen($payloadJson)
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    error_log("Webhook enviado para {$business->webhook_url} - Status: $httpCode - Resposta: $response");
}
?>
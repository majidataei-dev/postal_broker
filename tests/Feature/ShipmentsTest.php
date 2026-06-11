<?php

use App\Models\Shipment;

test('shipments index returns 200', function () {
    $response = $this->get('/shipments');
    $response->assertStatus(200);
});

test('shipments store works', function () {
    $response = $this->post('/shipments', [
        'sender_id' => 1,
        'receiver_id' => 2,
        'tracking_code' => 'TEST123',
        'service_type' => 'standard',
        'status' => 'pending',
        'packages' => [['weight' => 2, 'description' => 'Test package']],
        'description' => 'Test shipment',
    ]);

    $response->assertStatus(201);
});

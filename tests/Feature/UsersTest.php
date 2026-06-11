<?php

use App\Models\User;

test('users index returns 200', function () {
    $response = $this->get('/users');
    $response->assertStatus(200);
});

test('users store works', function () {
    $response = $this->post('/users', [
        'full_name' => 'Majid Ataei',
        'mobile' => '09198412978',
        'zip_code' => '5619877131',
        'address' => "address"
    ]);

    $response->assertStatus(201);
});

<?php

namespace Tests\Feature;

use App\Models\Ruang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ScanRoomBarcodeFlowTest extends TestCase
{
    use RefreshDatabase;

    private function makeRuangWithToken(): Ruang
    {
        return Ruang::create([
            'nama_ruang' => 'A101',
            'pj_ruang' => 'PJ01',
            'scan_token' => Str::random(32),
        ]);
    }

    private function makeUser(array $attributes = []): User
    {
        return User::create(array_merge([
            'nama_user' => 'User Test',
            'email' => uniqid('user', true) . '@mail.test',
            'password' => bcrypt('secret'),
            'manajer' => 0,
            'mitra' => 0,
        ], $attributes));
    }

    public function test_scan_invalid_token_returns_404(): void
    {
        $response = $this->get('/scan/token-invalid');

        $response->assertNotFound();
    }

    public function test_scan_valid_token_as_guest_redirects_to_login(): void
    {
        $ruang = $this->makeRuangWithToken();

        $response = $this->get('/scan/' . $ruang->scan_token);

        $response->assertRedirect(route('auth.login'));
    }

    public function test_scan_valid_token_as_mitra_redirects_to_mitra_pemeliharaan_room(): void
    {
        $ruang = $this->makeRuangWithToken();
        $mitra = $this->makeUser(['mitra' => 1]);

        $response = $this->actingAs($mitra)->get('/scan/' . $ruang->scan_token);

        $response->assertRedirect(route('mitra.pemeliharaan.index', $ruang->id));
    }

    public function test_scan_valid_token_as_non_mitra_redirects_to_cs_dashboard(): void
    {
        $ruang = $this->makeRuangWithToken();
        $user = $this->makeUser();

        $response = $this->actingAs($user)->get('/scan/' . $ruang->scan_token);

        $response->assertRedirect(route('cs.dashboard'));
    }
}

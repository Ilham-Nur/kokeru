<?php

namespace App\Console\Commands;

use App\Models\Ruang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateRoomQrCommand extends Command
{
    protected $signature = 'ruang:generate-qr {--force : Overwrite token and QR existing}';

    protected $description = 'Generate scan token dan QR ruangan';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $created = 0;
        $skipped = 0;

        Ruang::orderBy('id')->chunk(100, function ($ruangList) use ($force, &$created, &$skipped): void {
            foreach ($ruangList as $ruang) {
                $hasToken = !empty($ruang->scan_token);

                if ($hasToken && !$force) {
                    $skipped++;
                    continue;
                }

                if (!$hasToken || $force) {
                    $ruang->scan_token = Str::random(32);
                }

                $url = url('/scan/' . $ruang->scan_token);
                $path = 'qrcode/ruang-' . $ruang->id . '.svg';

                $svg = QrCode::format('svg')->size(260)->generate($url);
                Storage::disk('public')->put($path, $svg);

                $ruang->qr_path = $path;
                $ruang->qr_url = $url;
                $ruang->save();

                $created++;
            }
        });

        $this->info('QR selesai diproses.');
        $this->line('Token/QR dibuat: ' . $created);
        $this->line('Dilewati (token sudah ada): ' . $skipped);

        return self::SUCCESS;
    }
}

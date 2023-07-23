<?php

namespace App\Jobs;

use App\Models\ManagePesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExpiredSnapTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil semua data dari tabel dengan snap token yang sudah melewati batas waktu (misalnya 24 jam)
        $expiredSnapTokens = ManagePesanan::whereNotNull('snap_token')
            ->where('snap_token_created_at', '<', now()->subHours(24))
            ->get();

        // Hapus snap token untuk setiap data yang telah kadaluarsa
        foreach ($expiredSnapTokens as $data) {
            $data->update([
                'snap_token' => null,
                'snap_token_created_at' => null,
            ]);
        }

    }
}

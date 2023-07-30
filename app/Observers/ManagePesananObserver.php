<?php

namespace App\Observers;

use App\Models\ManagePesanan;

class ManagePesananObserver
{
    /**
     * Handle the ManagePesanan "created" event.
     *
     * @param  \App\Models\ManagePesanan  $managePesanan
     * @return void
     */
    public function created(ManagePesanan $managePesanan)
    {
        //
    }

    /**
     * Handle the ManagePesanan "updated" event.
     *
     * @param  \App\Models\ManagePesanan  $managePesanan
     * @return void
     */
    public function updated(ManagePesanan $managePesanan)
    {
        //
    }

    /**
     * Handle the ManagePesanan "deleted" event.
     *
     * @param  \App\Models\ManagePesanan  $managePesanan
     * @return void
     */
    public function deleted(ManagePesanan $managePesanan)
    {
        // Jika transaksi dp dihapus, hapus juga transaksi fp dengan email yang sama
        $managePesanan2 = ManagePesanan::where('email_pemesan', $managePesanan->email_pemesan)->where('jenis_pembayaran', 'fp');
        $managePesanan2->delete();
    }

    /**
     * Handle the ManagePesanan "restored" event.
     *
     * @param  \App\Models\ManagePesanan  $managePesanan
     * @return void
     */
    public function restored(ManagePesanan $managePesanan)
    {
        //
    }

    /**
     * Handle the ManagePesanan "force deleted" event.
     *
     * @param  \App\Models\ManagePesanan  $managePesanan
     * @return void
     */
    public function forceDeleted(ManagePesanan $managePesanan)
    {
        //
    }
}

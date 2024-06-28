<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan pekerjaan untuk membersihkan file-file cache yang sudah kadaluwarsa
        $schedule->call(function () {
            // Hapus file-file cache yang sudah kadaluwarsa di views
            $this->deleteExpiredCacheFiles(storage_path('framework/views'));

            // Hapus file-file cache yang sudah kadaluwarsa di testing
            $this->deleteExpiredCacheFiles(storage_path('framework/testing'));

            // Hapus file-file cache yang sudah kadaluwarsa di sessions
            $this->deleteExpiredCacheFiles(storage_path('framework/sessions'));
        })->everyTenMinutes();
    }

    /**
     * Delete expired cache files from the specified directory.
     *
     * @param string $directory
     * @return void
     */
    private function deleteExpiredCacheFiles($directory)
    {
        $expiredTime = now()->subMinutes(10); // Waktu 10 menit yang lalu
        $deletedCount = 0;

        // Mendapatkan daftar file
        $files = File::files($directory);

        // Iterasi melalui setiap file dan hapus jika sudah kadaluarsa
        foreach ($files as $file) {
            if (File::lastModified($file) < $expiredTime) {
                File::delete($file);
                $deletedCount++;
            }
        }

        Log::info('Deleted ' . $deletedCount . ' expired cache files from ' . $directory);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

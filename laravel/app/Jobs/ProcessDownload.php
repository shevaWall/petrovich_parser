<?php

namespace App\Jobs;

use App\Http\Controllers\ShopItemController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shopItem_id;
    private $image;
    private $fileName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($shopItem_id, $image, $fileName)
    {
        $this->shopItem_id = $shopItem_id;
        $this->image = $image;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *

     * @return void
     */
    public function handle(): void
    {
        $id = $this->shopItem_id;
        Log::info("Загрузка изображений для $id.");
        ShopItemController::downloadAndAttacheImage($this->shopItem_id, $this->image, $this->fileName);
    }
}

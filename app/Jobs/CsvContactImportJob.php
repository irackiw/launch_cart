<?php

namespace App\Jobs;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CsvContactImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filename;

    private int $user_id;

    public function __construct(string $filename, int $user_id)
    {
        $this->filename = $filename;
        $this->user_id = $user_id;
    }

    public function handle()
    {
        // @TODO VALIDATION AND REMOVING FILE AFTER SUCCESSFUL PROCESS
        $rows = explode(PHP_EOL, Storage::get($this->filename));
        foreach ($rows as $row) {
            $record = str_getcsv($row);

            $contact = Contact::create(
                [
                    'first_name' => $record[0],
                    'phone' => $record[1],
                    'email' => $record[2],
                    'manager_id' => $this->user_id,
                ]
            );
            $contact->save();
        }


    }
}

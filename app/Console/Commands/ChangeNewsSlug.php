<?php

namespace App\Console\Commands;

use App\Models\Redirect;
use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Contracts\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class ChangeNewsSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeNewsSlug {oldSlug} {newSlug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes article slug to something and creates redirection from old slug';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oldSlug = $this->argument('oldSlug');
        $newSlug = $this->argument('newSlug');
        if ($oldSlug === $newSlug) {
            $this->error("Slugs are equal");
            return 1;
        }
        $news  = News::query()->where('slug', $oldSlug)->first();
        if ($news === null) {
            $this->error("No news with such slug");
            return 1;
        }
        $redirect = Redirect::query()->where('old_slug', $oldSlug)->where('new_slug', $newSlug)->first();
        if ($redirect !== null) {
            $this->error("Such pair of old slug and new slug already exists");
            return 1;
        }

        DB::transaction(function() use ($news, $newSlug){
            $same_slugs_row = Redirect::query()->where('old_slug', $newSlug)->first();
            if ($same_slugs_row != null) {
                $same_slugs_row->delete();
            }
            $news->slug = $newSlug;
            $news->save();
        });

        return 0;
    }
}

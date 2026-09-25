<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\ContactUs\App\Models\ContactInfo;
use Modules\FileManager\App\Helpers\ImageHelper;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Setting\App\Models\AboutUs;
use Modules\Setting\App\Models\SiteDetail;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

/**
 * Production-safe database seeder.
 *
 * Unlike the default DatabaseSeeder (meant for local development - it seeds
 * ~10 fake users, fake categories, fake menus, fake site copy, etc. via
 * Faker), this seeder only creates the minimum a fresh production site
 * needs in order to boot:
 *
 *   - permissions + roles (Admin / Editor / Author / Subscriber) via the
 *     existing RoleDatabaseSeeder - untouched, so the current
 *     roles/permissions system is not affected
 *   - a single admin account, read strictly from ADMIN_EMAIL / ADMIN_PASSWORD
 *     in .env (see Modules\User\App\Helpers\UserHelper::createAdminUser).
 *     There is no fallback/default email or password - the seed fails
 *     loudly with a clear message if they are not set, instead of silently
 *     creating a guessable admin account
 *   - empty-but-valid Site Details / About Us / Contact Info rows using
 *     static placeholder text (no Faker), so this also works when composer
 *     install ran with --no-dev (Faker is a dev-only dependency)
 *
 * It deliberately does NOT create demo articles, demo categories, demo
 * menus, or extra demo/random users - editorial content and site copy for
 * a real news site should not be auto-generated nonsense.
 *
 * Idempotent: safe to run more than once (skips anything that already
 * exists rather than duplicating or overwriting it).
 *
 * Usage: php artisan db:seed --class="Database\Seeders\ProductionSeeder"
 */
class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleDatabaseSeeder::class);

        if (! User::getFirstAdmin()) {
            UserHelper::firstOrCreateAdminUser();
        }

        $this->seedSiteDetails();
        $this->seedAboutUs();
        $this->seedContactInfo();
    }

    private function seedSiteDetails(): void
    {
        if (SiteDetail::query()->exists()) {
            return;
        }

        TransactionHelper::beginTransaction('Failed to seed site details: ', static function () {
            SiteDetail::query()->create([
                'title' => config('app.name', 'News Site'),
                'description' => 'Site description - please update this from the admin panel.',
                'keywords' => null,
                'footer_text' => '© '.date('Y').' '.config('app.name', 'News Site'),
                'main_logo_id' => ImageHelper::createDefaultImage(configPath: 'common.default_logo.file_path')->id,
                'second_logo_id' => ImageHelper::createDefaultImage(configPath: 'common.default_logo.file_path')->id,
                'favicon_id' => ImageHelper::createDefaultImage(configPath: 'common.default_favicon.file_path')->id,
            ]);
        });
    }

    private function seedAboutUs(): void
    {
        if (AboutUs::query()->exists()) {
            return;
        }

        TransactionHelper::beginTransaction('Failed to seed about us: ', static function () {
            AboutUs::query()->create([
                'title' => __('about_us'),
                'content' => 'About us content - please update this from the admin panel.',
            ]);
        });
    }

    private function seedContactInfo(): void
    {
        if (ContactInfo::query()->exists()) {
            return;
        }

        TransactionHelper::beginTransaction('Failed to seed contact info: ', static function () {
            ContactInfo::query()->create([
                'title' => __('contact_us'),
                'content' => null,
                'address' => null,
                'email' => null,
                'phone' => null,
            ]);
        });
    }
}

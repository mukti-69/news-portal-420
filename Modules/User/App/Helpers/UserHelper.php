<?php

namespace Modules\User\App\Helpers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManager;
use Modules\Role\App\Models\Role;
use Modules\User\App\Exceptions\UserCreationFailedException;
use Modules\User\App\Models\User;

class UserHelper
{
    public static function firstOrCreateAdminUser(): void
    {
        DB::beginTransaction();

        try {
            $admin_user = self::createAdminUser();
            $admin_role = Role::query()->where('name', Role::ADMIN)->first();
            $admin_user->syncRoles($admin_role);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new UserCreationFailedException($e->getMessage());
        }
    }

    public static function createAdminUser(): Model
    {
        $email = config('user.admin_email');
        $password = config('user.admin_password');

        if (empty($email) || empty($password)) {
            throw new UserCreationFailedException(
                'Cannot create the admin account: ADMIN_EMAIL and ADMIN_PASSWORD must both be set in .env. '.
                'No default credentials are used.'
            );
        }

        if (strlen($password) < 8) {
            throw new UserCreationFailedException(
                'Cannot create the admin account: ADMIN_PASSWORD must be at least 8 characters.'
            );
        }

        $attributes = collect([
            'full_name' => config('user.admin_full_name', 'Admin'),
            'username' => config('user.admin_username', 'admin'),
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);
        $user = User::query()->firstOrCreate(
            $attributes->only('email')->toArray(),
            $attributes->toArray(),
        );
        $profile_picture = self::createDefaultProfilePicture($user->id);
        $user->image()->save($profile_picture);

        return $user;
    }

    public static function createDefaultProfilePicture(?int $user_id = null): Model
    {
        $defaultImagePath = config('user.default_profile_picture.file_path');
        $uploadedFile = new UploadedFile($defaultImagePath, basename($defaultImagePath));
        $defaultAltText = 'Default Profile Picture';
        $uploadedFilePath = FileManager::uploadFromFile($uploadedFile);

        return Image::query()->create([
            'file_path' => $uploadedFilePath,
            'alt_text' => $defaultAltText,
            'user_id' => $user_id,
        ]);
    }

    public static function createDefaultUsername(): string
    {
        $username = uniqid('user_', false);
        while (User::where('username', $username)->exists()) {
            $username = uniqid('user_', true);
        }

        return $username;
    }
}

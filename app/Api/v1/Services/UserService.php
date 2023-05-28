<?php

namespace App\Api\v1\Services;

use App\Api\v1\DTO\CreateUser;
use App\Facades\FileUploader;
use App\Models\Position;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class UserService
{
    private array $userData;

    public function markTokenAsUsed(string $token): static
    {
        Token::where('token', $token)->update(['used_at' => now()]);

        return $this;
    }

    /**
     * @throws InvalidManipulation
     */
    public function prepareUserData(CreateUser $data): static
    {
        $this->userData = [
            ...Arr::except($data->toArray(), ['token', 'photo']),
            'photo'    => $this->prepareUserPhoto($data->photo),
            'password' => Hash::make(Str::random(8)),
            'position' => Position::find($data->position_id)->name,
            'registration_timestamp' => now()->timestamp
        ];

        return $this;
    }

    public function save(): User
    {
        return User::create($this->userData);
    }

    /**
     * @throws InvalidManipulation
     */
    private function prepareUserPhoto(UploadedFile $photo)
    {
        $originalFile = FileUploader::putAs(
            $photo,
            'image/original',
            'users',
            pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
        );

        $compressedFile = FileUploader::compressPhoto($photo, $originalFile);

        Image::load(storage_path('app/public/' . $compressedFile))
            ->crop(Manipulations::CROP_CENTER, 70, 70)
            ->save();

        return 'storage/' . $compressedFile;
    }
}

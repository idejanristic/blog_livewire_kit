<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Dtos\Profiles\ProfileDto;

class ProfileRepository
{

    /**
     * @param \App\Dtos\Profiles\ProfileDto $dto
     * @param int $userId
     * @return Profile
     */
    public function create(ProfileDto $dto, int $userId): Profile
    {
        return Profile::create(
            attributes: [
                'first_name' => ucfirst(string: strtolower(string: $dto->first_name)),
                'last_name' => ucfirst(string: strtolower(string: $dto->last_name)),
                'title' => strtolower(string: $dto->title),
                'img_path' => $dto->img_path,
                'user_id' => $userId
            ]
        );
    }

    /**
     * @param \App\Dtos\Profiles\ProfileDto $dto
     * @param \App\Models\Profile $profile
     * @return bool
     */
    public function update(ProfileDto $dto, Profile $profile): bool
    {
        return $profile->update(
            attributes: [
                'first_name' => ucfirst(string: strtolower(string: $dto->first_name)),
                'last_name' => ucfirst(string: strtolower(string: $dto->last_name)),
                'title' => strtolower(string: $dto->title),
                'img_path' => $dto->img_path,
            ]
        );
    }

    /**
     * @param \App\Models\Profile $profile
     * @return bool|null
     */
    public function delete(Profile $profile): bool|null
    {
        return $profile->delete();
    }
}

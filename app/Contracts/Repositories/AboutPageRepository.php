<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AboutPageRepositoryInterface;
use App\Models\AboutPageContent;
use Illuminate\Support\Facades\Storage;

class AboutPageRepository implements AboutPageRepositoryInterface
{
    /**
     * Get the about page content.
     *
     * @return object|null
     */
    public function getContent()
    {
        return AboutPageContent::firstOrCreate([], [
            'hero_title' => 'Default Title',
            'hero_subtitle' => 'Default Subtitle',
        ]);
    }

    /**
     * Update the about page content.
     *
     * @param array $data
     * @return object
     */
    public function updateContent(array $data)
    {
        $content = $this->getContent();
        $updatableData = $data;

        // Handle File Uploads
        $fileFields = [
            'hero_blob_image',
            'story_1_image',
            'story_2_image',
            'story_3_image'
        ];

        foreach ($fileFields as $field) {
            if (isset($data[$field]) && $data[$field] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old file if exists
                if ($content->$field) {
                    Storage::disk('public')->delete($content->$field);
                }
                $path = $data[$field]->store('about/images', 'public');
                $updatableData[$field] = $path;
            } else {
                // If not uploaded, remove from update array to prevent overwriting with null/string if handled by controller
                unset($updatableData[$field]);
            }
        }

        $content->update($updatableData);

        return $content;
    }
}

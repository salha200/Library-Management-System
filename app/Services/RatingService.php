<?php

namespace App\Services;

use App\Models\Rating;

class RatingService
{
    public function createRating(array $data)
    {
        return Rating::create($data);
    }

    public function getRatings()
    {
        return Rating::all();
    }
    /**
     *updateRating
     * @param mixed $id
     * @param array $data
     * @return TModel|\Illuminate\Database\Eloquent\Collection
     */
    public function updateRating($id, array $data)
    {
        $rating = Rating::findOrFail($id);
        $rating->update([

            'book_id' => $data['book_id'] ?? $rating->book_id,
            'user_id' => $data['user_id'] ?? $rating->user_id,
            'rating' => $data['rating'] ?? $rating->rating,
            'review' => $data['review'] ?? $rating->review,
        ]);
        return $rating;
    }
    /**
     * delete the rating
     * @param mixed $id
     * 
     */

    public function deleteRating($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return $rating;
    }
}

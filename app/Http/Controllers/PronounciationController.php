<?php

namespace App\Http\Controllers;

use App\Models\Pronouncitation;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class PronounciationController extends Controller
{
    public function getPronounciationsByWord(Request $request, string $email = '')
    {
        $dto = $request->all();
        $perPage = isset($dto['perPage']) ? $dto['perPage'] : 10;
        $vocabulary = Vocabulary::query()->where('word', $dto['word'])->first();
        $pronounciations = Pronouncitation::query()->where('user_email', $email)->where('vocabulary_id', $vocabulary->id)->paginate($perPage);
        return response(($pronounciations), 200);
    }

    public function getMedian(Request $request, string $email = "test@test.ru")
    {
        $dto = $request->all();
        $vocabulary = Vocabulary::query()->where('word', $dto['word'])->first();

        if (!$vocabulary) {
            return response('Vocabulary not found', 404);
        }

        $pronounciations = Pronouncitation::query()->where('user_email', $email)->where('vocabulary_id', $vocabulary->id)->pluck('coincidence')->toArray();

        if (empty($pronounciations)) {
            return response('No pronounciations found', 404);
        }

        $median = $this->calcMedian($pronounciations);
        return response(['median' => $median], 200);
    }

    private function calcMedian(array $array): float
    {
        $iCount = count($array);
        if ($iCount === 0) {
            throw new \Exception('Median of an empty array is undefined');
        }
        $middle_index = floor($iCount / 2);
        sort($array, SORT_NUMERIC);
        $median = $array[$middle_index];

        if ($iCount % 2 == 0) {
            $median = ($median + $array[$middle_index - 1]) / 2;
        }
        
        return (float) $median;
    }

    public function store(Request $request, string $email)
    {
        $dto = $request->validate([
            'vocabulary_id' => 'required | integer',
            'recognized_word' => 'string',
            'audio_path' => 'string',
            'coincidence' => 'numeric'
        ]);

        $pronounciation = Pronouncitation::create([
            'vocabulary_id' => $dto['vocabulary_id'],
            'user_email' => $email,
            'recognized_word' => $dto['recognized_word'],
            'audio_path' => $dto['audio_path'],
            'coincidence' => $dto['coincidence'],
        ]);

        return $pronounciation ? response('Pronounciation stored successfully', 201) : response("Failed to store the data", 400);
    }

    public function getAll()
    {
        return response(Pronouncitation::all(), 200);
    }

    public function delete(Request $request, string $email = "test@test.ru")
    {
        Pronouncitation::where('user_email', $email)->delete();
    }
}
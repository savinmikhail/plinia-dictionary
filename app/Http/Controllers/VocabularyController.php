<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{

    public function hasWord(string $email = '')
    {
        $vocab = Vocabulary::query()->where('user_email', $email)->first();
        if (!$vocab) {
            return response("There is no words in user's vocabulary", 400);
        }
        return response("User has words in vocabulary", 200);
    }

    public function getVocabulary(string $email = '')
    {
        $words = Vocabulary::all();
        if (!$words) {
            return response('There is no words in the database', 400);
        }
        return response()->json($words);
        // return response(serialize($words), 200);
    }


    public function getNext(Request $request, string $email = '')
    {
        $dto = $request->all();
        $word = $dto['word'];
        $word = Vocabulary::query()->where('word', $word)->first();
        if ($word) {
            $next = Vocabulary::where('id', '>', $word->id)->orderBy('id')->first();
            if ($next) {
                return response(json_encode($next), 200);
            }
            return response('Unable to find next word', 400);
        }
        return response("Failed to get this word from the database", 400);
    }

    public function addVocabulary(Request $request, string $email = '')
    {
        $dto = $request->all();

        $newWord = new Vocabulary;
        $newWord->word = $dto['word'];
        if ($newWord->save()) {
            return response('Word was added successfully!', 201);
        }
        return response("Can't add word");
    }

    public function changeVocabulary(Request $request, string $email = '')
    {
        $dto = $request->all();
        $currentWord = $dto['wordCur'];
        $newWord = $dto['newWord'];
        $word = Vocabulary::query()->where('word', $currentWord)->first();
        if ($word) {
            $word->word = $newWord;
            if ($word->save()) {
                return response("Word was changed successfully!", 201);
            }
            return response("Can't change word.", 400);
        }
        return response("this word doesn't exist", 400);
    }

}
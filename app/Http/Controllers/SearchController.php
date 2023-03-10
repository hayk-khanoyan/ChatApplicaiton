<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserSearchRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SearchResultResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    public function search(UserSearchRequest $request): AnonymousResourceCollection|ErrorResource
    {
        $validated = $request->validated();

        $condition = '%'.$validated['search_query'].'%';

        $users = User::query()
            ->select('id', 'name')
            ->selectRaw("'direct' as type")
            ->where('name', 'like', $condition)
            ->orWhere('email', 'like', $condition);

        $groupsAndUsers = Group::query()
            ->select('id', 'name')
            ->selectRaw("'group' as type")
            ->where('name', 'like', $condition)
            ->union($users)
            ->simplePaginate(50);

        return SearchResultResource::collection($groupsAndUsers);
    }
}

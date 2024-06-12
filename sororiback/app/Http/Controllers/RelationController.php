<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Relation::all();
        if ($relations) {
            return response()->json([
                'success' =>true,
                'data' =>$relations,
            ],200);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error listing relations',
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_1' => 'required|exists:users,id',
            'user_2' => 'required|exists:users,id',
            'type' => 'required',
            'status' => 'required'
        ]);

        $relation = Relation::create($request->all());
        if ($relation){
            return response()->json([
                'success' =>true,
                'data' => $relation
            ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' =>'Error creating relation',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $relation = Relation::find($id);
        if ($relation) {
            return response()->json([
                'success' => true,
                'data' => $relation,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error showing relation',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $relation = Relation::find($id);
        if($relation){
            $request->validate([
                'user_1' => 'exists:users,id',
                'user_2' => 'exists:users,id',
                'type' => 'required'
            ]);
            $relation->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $relation,
            ], 200);
        } else{
            return response()->json([
                'success'  => false,
                'message' => 'Error finding relation'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relation = Relation::find($id);

        if ($relation) {
            $relation->delete();
            return response()->json([
                'success' => true,
                'data' => $relation,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Relation not found, how sadly',
            ], 404);
        }
    }

    public function get_user_relations(string $id, string  $type)
    {
        $user = User::find($id);
        if ($user) {
            if ($type == "all") {
                $relations = Relation::where('user_1', $id)
                     ->pluck('user_2')
                     ->toArray();
                $types = Relation::where('user_1', $id)
                     ->pluck('type')
                     ->toArray();
                $status = Relation::where('user_1', $id)
                     ->pluck('status')
                     ->toArray();
                $ids = Relation::where('user_1', $id)
                ->pluck('id')
                ->toArray();
                     $users_all = [];
                     $i = 0;
                     foreach ($relations as $user_id) {
                        $profile = Profile::where('id_user', $user_id)->first();

                        if ($profile) {
                            $profile->relation_type = $types[$i];
                            $profile->relation_id = $ids[$i];
                            $profile->status = $status[$i];
                            $users_all[] = $profile;
                        }
                        $i++;
                    
                     }
                usort($users_all, function($a, $b) {
                    return ($a->status === 'active' && $b->status !== 'active') ? -1 : 1;
                });
                return response()->json([
                    'success' => true,
                    'data' => $users_all,
                ], 200);

            } elseif ($type == "blocked") {
                
                $relations = Relation::where('user_1', $id)
                     ->where('type', '=', 'blocked')
                     ->pluck('user_2')
                     ->toArray();
                $users_all = [];
                
                foreach ($relations as $user_id) {
                    $profile = Profile::where('id_user', $user_id)->first();
                    if ($profile) {
                        $users_all[] = $profile;
                    }
                }
                return response()->json([
                    'success' => true,
                    'data' => $users_all,
                ], 200);
            } elseif ($type == "extended") {
                $rel_extended = [];
                $rel_first = Relation::where('user_1', $id)
                     ->where('type', '=', 'second')
                     ->pluck('user_2')
                     ->toArray();
                     foreach ($rel_first as $user_2) {
                        $rel_user_2 = Relation::where('user_1', $user_2)
                                              ->where('type', '=', 'second')
                                              ->pluck('user_2')
                                              ->toArray();
                        $rel_extended = array_merge($rel_extended, $rel_user_2);
                    }
                    $rel_extended = array_unique($rel_extended);
                    $relations = Relation::where('user_1', $id)->get();
                    foreach ($relations as $relation) {
                        $user_2_value = $relation->user_2;
                        if (($key = array_search($user_2_value, $rel_extended)) !== false) {
                            unset($rel_extended[$key]);
                        }
                    }
                    if (($key = array_search($id, $rel_extended)) !== false) {
                        unset($rel_extended[$key]);
                    }
                    $users_extended = [];

                    foreach ($rel_extended as $user_id) {
                        $profile = Profile::where('id_user', $user_id)->first();
                        if ($profile) {
                            $profile->relation_type = "extended";
                            $users_extended[] = $profile;
                        }
                    }
                    return response()->json([
                        'success' => true,
                        'data' => $users_extended
                    ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect Type',
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    }
    public function explore(Request $request, string $id)
    {
        $user = User::find($id);
        if ($user) {
            $relatedUserIds = Relation::where('user_1', $id)
                ->orWhere('user_2', $id)
                ->pluck('user_1', 'user_2')
                ->all();
    
            $query = User::where('id', '!=', $id)
                ->whereNotIn('id', array_keys($relatedUserIds))
                ->where('role', '!=', 'admin')
                ->with(['profile', 'profile.town']);
    
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->whereHas('profile', function($q) use ($searchTerm) {
                    $q->where('name', 'like', "%$searchTerm%");
                });
            }
    
            $users = $query->paginate(10);
    
            return response()->json([
                'success' => true,
                'users' => $users,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    }
    
    
    public function pending(string $id)
    {
        $relations = Relation::where('user_2', $id)
            ->where('status', 'pending')
            ->get();

        if ($relations->isNotEmpty()) {
            $notifications = [];
            foreach ($relations as $relation) {
                $profile = Profile::where('id_user', $relation->user_1)->first();
                if ($profile) {
                    $notifications[] = [
                        'relation' => $relation,
                        'profile' => $profile,
                    ];
                }
            }
            return response()->json([
                'success' => true,
                'data' => $notifications,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No pending notifications found',
            ], 404);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelations;

    private array $relations = ['user'];
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $query = $this->loadRelations(
            $event->attendees()->latest()
        );
        return AttendeeResource::collection(
            $query->paginate()
        );
    }

    protected function shouldIncludeRelation(string $relation) : bool
    {
        $include = \request()->query('include');

        if(!$include)
        {
            return false;
        }

        $relations = array_map('trim',explode(',',$include));

        return in_array($relation, $relations);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);
        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource(
            $this->loadRelations($attendee)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

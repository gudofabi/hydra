<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use Auth;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($taskId)
    {
        $comments = $this->commentService->getAllComment($taskId);
        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $taskId)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id; // Set user_id in the controller
        $comment = $this->commentService->createComment($data, $taskId);
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $comment = $this->commentService->updateComment($id, $request->all());
            return $comment;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->commentService->deleteComment($id);
        return response()->json(['message' => 'Successfully deleted the comment.']);
    }
}

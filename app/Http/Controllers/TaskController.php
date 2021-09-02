<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTask;
use App\Http\Requests\CreateTask;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
  // public function in()
  // {
  //  return "Hellow world";
  // }
  public function index(int $id)
  {
    // ★ ユーザーのフォルダを取得する
    $folders = Auth::user()->folders()->get();

    $current_folder = Folder::find($id);

    $tasks = $current_folder->tasks()->get();

    return view('tasks/index', [
      'folders' => $folders,
      'current_folder_id' => $current_folder->id,
      'tasks' => $tasks,
    ]);
  }
   // /**
   // *タスク一覧
   // *@param Folder $folder
   // *@return \Illuminate\View\View
   // */
   //  public function index(Folder $folder)
   //  {
   //
   //    //すべてのフォルダを取得する
   //    //ユーザーのフォルダを取得する
   //    $folders = Auth::user()->folders()->get();
   //
   //    //選ばれたフォルダに紐づくタスクを取得する
   //    $tasks = $folder->tasks()->get();
   //
   //    return view('tasks/index',[
   //      'folders' => $folders,
   //      'current_folder_id' => $folder->id,
   //      'tasks' => $tasks,
   //    ]);
   //  }


    public function showCreateForm(int $id)
    {
      return view('tasks/create',[
        'folder_id' => $id
      ]);
    }
    /**
    *タスク作成
    * @param Folder $folder
    *@param CreateTask $request
    *@return \Illuminate\Http\RedirectResponse
    */
    public function create(int $id, CreateTask $request)
    {
      $current_folder = Folder::find($id);

         $task = new Task();
         $task->title = $request->title;
         $task->due_date = $request->due_date;

         $current_folder->tasks()->save($task);

         return redirect()->route('tasks.index', [
             'id' => $current_folder->id,
         ]);
    }

    /**
    *タスク編集フォーム
    *@param Folder $folder
    *@param Task $task
    *@return \Illuminate\View\View
    */
    public function showEditForm(int $id, int $task_id)
    {
      $task = Task::find($task_id);


      return view('tasks/edit',[
        'task' => $task,
      ]);
    }
    /**
    *タスク編集
    *@param Folder $folder
    *@param Task $task
    *@param EditTask $request
    *@return \Illuminate\Http\RedirectResponse
    */
    public function edit(int $id, int $task_id, EditTask $request)
    {
      // 1
      $task = Task::find($task_id);

      // 2
      $task->title = $request->title;
      $task->status = $request->status;
      $task->due_date = $request->due_date;
      $task->save();

      // 3
      return redirect()->route('tasks.index', [
          'id' => $task->folder_id,
      ]);
    }

    private function checkRelation(Folder $folder, Task $task)
     {
      if ($folder->id !== $task->folder_id) {
        abort(404);
      }
    }
}

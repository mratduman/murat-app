<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Repository\TaskRepository;
use App\Models\Developer;
use App\Models\BusinessTask;
use App\Models\ItTask;

class IndexController extends Controller
{
    public function index() {
      $developers = Developer::query()->get();
      $it_tasks = ItTask::query()->get();
      $business_tasks = BusinessTask::query()->get();

      $calculation = (new TaskRepository)->calculation($developers, $it_tasks, $business_tasks);

      return view('index', compact('calculation'));
    }

    public function dataUpdate()
    {
      (new TaskRepository)->connectProvidersAndInsertData();

      return redirect()->route('index');
    }
}

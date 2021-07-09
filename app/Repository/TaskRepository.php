<?php

namespace App\Repository;

use GuzzleHttp\Client;
use App\Models\ItTask;
use App\Models\BusinessTask;
use softDeletes;

class TaskRepository
{

    public $working_time = 45;

    public function client() {
      return $client = new Client();
    }

    public function connectProvidersAndInsertData()
    {
        $it_tasks = $this->connectItTaskProvider();
        ItTask::query()->where('id','>',0)->delete();
        ItTask::query()->insert($it_tasks);

        $business_task = $this->connectBusinessTaskProvider();
        BusinessTask::query()->where('id','>',0)->delete();
        BusinessTask::query()->insert($business_task);
    }

    public function connectItTaskProvider()
    {
        $response_it_tasks = $this->client()->request('GET', config('tasks.it_tasks'));
        $it_tasks = json_decode($response_it_tasks->getBody());

        $datas = array();
        foreach ($it_tasks as $it_task) {

            $task = array(
              'name' => $it_task->id,
              'time' => $it_task->sure,
              'level' => $it_task->zorluk
            );

            array_push($datas, $task);
        }

        return $datas;
    }

    public function connectBusinessTaskProvider()
    {
        $response_business_tasks = $this->client()->request('GET', config('tasks.business_tasks'));
        $business_tasks = json_decode($response_business_tasks->getBody());

        $datas = array();
        foreach ($business_tasks as $business_task) {

          foreach ($business_task as $key => $value) {

              $task = array(
                'name' => $key,
                'estimated_duration' => $value->estimated_duration,
                'level' => $value->level
              );

              array_push($datas, $task);
          }
        }

        return $datas;
    }

    public function calculation($developers, $it_tasks, $business_tasks)
    {
        $it_task_total = 0;
        $business_task_total = 0;

    		foreach ($it_tasks as $it_task) {
    			$it_task_total += $it_task->time*$it_task->level;
    		}

        foreach ($business_tasks as $business_task) {
    			$business_task_total += $business_task->estimated_duration*$business_task->level;
    		}


        $devs = array();
    		foreach ($developers as $developer) {
    			$developer_total = $developer->units * $this->working_time;

          array_push($devs,
              array($developer->name =>
                array(
                  'it_task_hour' => $it_task_total / $developer_total,
                  'it_task_week' => $it_task_total / $developer_total / $this->working_time,
                  'business_task_hour' => $business_task_total / $developer_total,
                  'business_task_week' => $business_task_total / $developer_total / $this->working_time,
                )
              )
          );

    		}

    		return $devs;
    }

}

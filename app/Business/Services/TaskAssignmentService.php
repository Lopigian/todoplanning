<?php

namespace App\Business\Services;

use App\Models\Assignment;
use App\Models\Developer;
use App\Models\Task;

class TaskAssignmentService
{
    const DURATION = 45;

    public function assignTasks()
    {
        // Tüm taskleri zorluk derecesine göre al
        $tasks = Task::orderBy('difficulty', 'desc')->get();

        // Tüm developer'ların saatlik zorluk kapasitesine göre al
        $developers = Developer::orderBy('capacity')->get();

        // İlk haftadan başlayarak tüm taskleri ata
        $week = 1;
        while ($tasks->count() > 0) {
            foreach ($developers as $developer) {
                // Developer'ın kalan çalışma süresi
                $remainingHours = $developer->weekly_hours;

                // Atacak taskleri bul
                foreach ($tasks as $key => $task) {
                    // Task'ı tamamlamak için gereken süre
                    $requiredHours = $task->difficulty * $developer->capacity;

                    if ($remainingHours >= $requiredHours) {
                        // Task'ı ata
                        Assignment::create([
                            'task_id' => $task->id,
                            'developer_id' => $developer->id,
                            'week' => $week
                        ]);

                        // Kalan süreyi güncelle ve task'ı listeden kaldır
                        $remainingHours -= $requiredHours;
                        $tasks->pull($key);

                        // Tüm tasklar atandıysa döngüden çık
                        if ($tasks->isEmpty()) {
                            break 2;
                        }
                    }
                }
            }

            $week++;
        }
    }


    public function getPlan(array $developers = [])
    {
        $developerTasks = $this->assignTaskToDeveloper($developers);
        foreach ($developerTasks as $key => $developer) {
            $developerTasks[$key]['name']  = $developer['name'];
            $developerTasks[$key]['capacity'] = $developer['capacity'];
            $developerTasks[$key]['duration']  = $developer['duration'];
            $developerTasks[$key]['weekly'] = $this->weeklyGroup($developer['tasks']);
        }
        return $developerTasks;
    }

    public function assignTaskToDeveloper(array $developerList = [])
    {
        $tasks = Task::orderBy('duration', 'desc')->get();
        $taskGroup = [];

        foreach ($tasks as $task) {
            $taskGroup[$task->difficulty][] = ['id' => $task->id,'name' => $task->name, 'duration' => $task->duration];
        }

        $developers = [];
        foreach ($developerList as $developer) {
            $developers[$developer['capacity']] = ['name' => $developer['name'], 'capacity' => $developer['capacity'], 'duration' => 0];
        }

        foreach ($taskGroup as $capacity => $tasks) {
            foreach ($tasks as $task) {
                if (!isset($developers[$capacity]))
                    continue;
                $findingDeveloperLevel = $this->findDeveloperLevel($developers, $capacity);
                $developers[$findingDeveloperLevel]['tasks'][] = array_merge($task, ['capacity' => $capacity]);
                $developers[$findingDeveloperLevel]['duration']    += $task['duration'];
            }
        }

        return $developers;
    }

    public function findDeveloperLevel(array $developers, int $capacity)
    {
        $developer = $developers[$capacity];
        ksort($developers);

        $index = array_search($capacity, array_keys($developers));

        $upperLevelDeveloper = array_slice($developers, $index + 1, 1, true);

        if ( ! isset($upperLevelDeveloper[$capacity + 1]['duration'])) {
            return $capacity;
        } elseif ($developer['duration'] <= $upperLevelDeveloper[$capacity + 1]['duration']) {
            return $capacity;
        } else {
            $upperLevel = $this->findDeveloperLevel($developers, $capacity + 1);
            if ($upperLevel == $capacity)
                return $capacity;
            else
                return $upperLevel;
        }

    }

    private static function weeklyGroup(array $tasks = [])
    {
        $weeklyTasks = [
            [
                'tasks' => [],
                'duration'  => 0,
            ],
        ];

        foreach ($tasks as $task) {
            $taskTime = $task['duration'];
            foreach ($weeklyTasks as $key => $week) {
                if ($week['duration'] == self::DURATION && isset($weeklyTasks[$key + 1]))
                    continue;

                if ($week['duration'] == self::DURATION && ! isset($weeklyTasks[$key + 1])) {
                    $task['duration']  = $taskTime;
                    $weeklyTasks[] = [
                        'tasks' => [$task],
                        'duration'  => $task['duration'],
                    ];
                    break;
                }

                if ($week['duration'] < self::DURATION && ($week['duration'] + $taskTime) > self::DURATION) {
                    $duration = self::DURATION - $week['duration'];
                    $taskTime -= $duration;
                    $task['duration'] = $duration;
                    $weeklyTasks[$key]['tasks'][] = $task;
                    $weeklyTasks[$key]['duration'] += $duration;
                    $task['duration']  = $taskTime;
                    $weeklyTasks[] = [
                        'tasks' => [$task],
                        'duration'  => $task['duration'],
                    ];
                    break;
                }

                if ($week['duration'] < self::DURATION && ($week['duration'] + $taskTime) <= self::DURATION) {
                    $weeklyTasks[$key]['tasks'][] = $task;
                    $weeklyTasks[$key]['duration'] += $taskTime;
                    break;
                }
            }
        }
        return $weeklyTasks;
    }
}

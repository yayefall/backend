<?php

namespace App\Observers;

use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ModelHistoryObserver
{
    protected $modelTableMap = [
        'App\Models\Lavage' => 'lavages',
        'App\Models\Vehicule' => 'vehicules',
        'App\Models\Driver' => 'drivers',
        'App\Models\Entretien' => 'entretien',
        'App\Models\User' => 'users',
    ];

    protected function log($model, $action)
    {
        $class = get_class($model);
        $tableName = $this->modelTableMap[$class] ?? 'unknown';

        History::create([
            'table_name' => $tableName,
            'action' => $action,
            'record_id' => $model->id,
            'username' => Auth::check() ? Auth::user()->name : 'Système',
            'description' => ucfirst($action) . " sur " . $tableName . " ID: {$model->id}"
        ]);
    }

    public function created($model)
    {
        $this->log($model, 'create');
    }

    public function updated($model)
    {
        $this->log($model, 'update');
    }

    public function deleted($model)
    {
        $this->log($model, 'delete');
    }
}

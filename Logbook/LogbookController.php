<?php

namespace Statamic\Addons\Logbook;

use Statamic\API\User;
use Statamic\Extend\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogbookController extends Controller
{
    public function index()
    {
        $user = User::getCurrent();
        $super = $user && $user->isSuper();
        
        if (!$super) {
            return redirect('/cp');
        }

        $logviewer = new LaravelLogViewer;

        if ($file = request('log')) {
            $logviewer->setFile(base64_decode($file));
        }

        if ($file = request('dl')) {
            return response()->download($logviewer->pathToLogFile(base64_decode($file)));
        }

        if ($file = request('del')) {
            app('files')->delete($logviewer->pathToLogFile(base64_decode($file)));

            return redirect(request()->url());
        }

        if (request()->has('delall')) {
            foreach ($logviewer->getFiles(true) as $file) {
                app('files')->delete($logviewer->pathToLogFile($file));
            }

            return redirect(request()->url());
        }

        $data = [
            'logs' => $logviewer->all(),
            'files' => $logviewer->getFiles(true),
            'current_file' => $logviewer->getFileName(),
            'action_path' => strtolower('/'.CP_ROUTE.'/addons/'.$this->getAddonName()),
            'title' => 'Logbook',
        ];

        return $this->view('index', $data);
    }
}

<?php

namespace App\Listeners;

use App\Models\UserLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Agent;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $request = request();
        $agent = new Agent();
        
        $agent->setUserAgent($request->header('User-Agent'));

        $device = $agent->platform() . ' en ' . ($agent->isDesktop() ? 'Escritorio' : ($agent->isTablet() ? 'Tablet' : 'Movil'));

        $browser = $agent->browser();

        UserLogin::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'sistema' => $device,
            'navegador' => $browser,
        ]);
    }
}

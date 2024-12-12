<?php

namespace Pyramid;


use Pyramid\Connection;
use Pyramid\Container;
use Pyramid\DatabaseSessionHandler;

use Pyramid\SessionService;


class SessionServiceProvider {

	public function register(): void {


		if ( config( 'Session.driver' ) == 'file' ) {
			ini_set('session.save_path', config('Session.files'));
		} elseif ( config( 'Session.driver' ) == 'database' ) {
			// Session başlatılmadan önce gerekli session handler ayarlarını yapıyoruz
			$handler = new DatabaseSessionHandler( Connection::conn() );
			session_set_save_handler(
				[ $handler, 'open' ],
				[ $handler, 'close' ],
				[ $handler, 'read' ],
				[ $handler, 'write' ],
				[ $handler, 'destroy' ],
				[ $handler, 'gc' ]
			);
		}


//		session_name(config('Session.cookie'));
//		ini_set('session.cookie_samesite', config('Session.same_site'));

		ini_set('session.cookie_lifetime', config('Session.cookie_lifetime') * 60);
		ini_set('session.path', config('Session.path'));
		ini_set('session.domain', config('Session.domain'));
		ini_set('session.secure', config('Session.secure'));
		ini_set('session.httponly', config('Session.httponly'));
		ini_set('session.gc_maxlifetime', config('Session.lifetime') * 60);
		ini_set('session.auto_start', config('Session.session_auto_start'));
		ini_set('session.cookie_samesite', config('Session.same_site'));


		// SessionService'ı servis konteynırına bağlayın
//		Container::bind( 'session', function () {
//			return new SessionService();
//		} );

	}

	public function boot(): void {
//		 Session başlatılmadan önce kontrol etme
		if (session_status() == PHP_SESSION_NONE) {
			session_start(); // Eğer session başlatılmamışsa, başlatın
		}

	}




}

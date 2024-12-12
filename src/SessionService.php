<?php

namespace Pyramid;

use Pyramid\Crypt;
use Random\RandomException;

class SessionService {
	/**
	 * @return array|null
	 * Tüm sessionları listeliyoruz
	 */
	public function all() {
		$data = [];
		foreach ( $_SESSION as $key => $value ) {
			$data[ Crypt::decrypt($key) ] = Crypt::decrypt( $value );
		}

		return $data ?? null;
	}

	/**
	 * @param $key
	 *
	 * @return mixed|void
	 * Anahtar isteği ile session verisini alıyoruz
	 */
	public function get( $key ) {
		if ( isset( $_SESSION[ Crypt::encrypt($key) ] ) ) {
			return Crypt::decrypt( $_SESSION[ Crypt::encrypt($key) ] );
		}

	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return void
	 * Anahtar ve Değer bilgisi girerek session oluşturuyoruz
	 */
	public function set( $key, $value ): void {
//		session_regenerate_id( true );
		$_SESSION[ Crypt::encrypt($key) ] = Crypt::encrypt( $value );
	}

	/**
	 * @param $key
	 *
	 * @return bool
	 * Anahtara sahip session var mı? kontrol ediyoruz
	 */
	public function hash( $key ) {
		return isset( $_SESSION[ Crypt::encrypt($key) ] );
	}

	/**
	 * @param $key
	 *
	 * @return void
	 * Anahtar bilgisi ile session siliyoruz
	 */
	public function unset( $key ) {
		unset( $_SESSION[ Crypt::encrypt($key) ] );
	}

	/**
	 * @return void
	 * Tüm session oturumlarını sonlandırıyoruz
	 */
	public function destroy() {
		session_destroy();
	}

}
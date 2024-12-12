<?php

namespace Pyramid;


use Pyramid\Interfaces\SessionHandlerInterface;

class DatabaseSessionHandler implements SessionHandlerInterface {
	private $pdo;

	public function __construct( $pdo ) {
		$this->pdo = $pdo;
	}

	// Session başlatma
	public function open( $save_path, $session_name ): bool {
		return true; // Bağlantıyı başlat, burada yapılacak başka bir şey yok
	}

	public function close(): bool {
		// Oturumu kapatma işlemi
		// Burada session'ı kapatmak için gerekli işlemleri yapabilirsiniz
		return true;
	}

	// Session verisini okuma
	public function read( $session_id ): string {
		$stmt = $this->pdo->prepare( "SELECT data FROM sessions WHERE id = :id" );
		$stmt->execute( [ 'id' => $session_id ] );
		$session = $stmt->fetch( \PDO::FETCH_ASSOC );

		if ( $session ) {
			return unserialize( $session['data'] );  // Veriyi unserialize ederek döndür
		}

		return '';  // Session bulunmazsa boş bir değer döndür
	}

	// Session verisini yazma
	public function write( $session_id, $session_data ): bool {
		$session_data = serialize( $session_data );  // Session verisini serileştir
		$stmt         = $this->pdo->prepare( "REPLACE INTO sessions (id, data) VALUES (:id, :data)" );
		$stmt->execute( [ 'id' => $session_id, 'data' => $session_data ] );

		return true;
	}

	// Session'ı silme
	public function destroy( $session_id ): bool {
		$stmt = $this->pdo->prepare( "DELETE FROM sessions WHERE id = :id" );
		$stmt->execute( [ 'id' => $session_id ] );

		return true;
	}

	// Eski session'ları temizleme
	public function gc( $maxlifetime ): bool {
		$stmt = $this->pdo->prepare( "DELETE FROM sessions WHERE updated_at < NOW() - INTERVAL :maxlifetime SECOND" );
		$stmt->execute( [ 'maxlifetime' => $maxlifetime ] );

		return true;
	}


}

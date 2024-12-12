<?php
namespace Pyramid;

interface SessionHandlerInterface {
	public function open(string $save_path, string $session_name): bool;
	public function close(): bool;
	public function read(string $session_id): string;
	public function write(string $session_id, string $data): bool;
	public function destroy(string $session_id): bool;
	public function gc(int $maxlifetime): bool;
}
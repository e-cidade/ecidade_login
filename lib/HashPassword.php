<?php

namespace OCA\EcidadeLogin;

use OCA\UserBackendSqlRaw\IHashPassword;

class HashPassword implements IHashPassword {
	public function validate(string $password, string $hash): bool {
		if (sha1(md5($password)) === $hash) {
			return true;
		};
		return $password === $hash;
	}

	public function hashPassword(string $password): string {
		return sha1(md5($password));
	}
}

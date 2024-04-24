<?php

namespace OCA\EcidadeLogin;

class HashPassword implements IHashPassword {
	public function validate(string $password, string $hash): bool {
		if (md5(md5($password)) === $hash) {
			return true;
		};
		return $password === $hash;
	}

	public function hashPassword(string $password): string {
		return md5($password);
	}
}

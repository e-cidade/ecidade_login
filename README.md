# e-Cidade Login

Integração do login do e-Cidade com Nextcloud

Com este App você poderá autenticar-se no Nextcloud utilizando login e senha de usuários existentes no e-Cidade. Com isto você conseguirá integrar o e-Cidade com o [LibreSign](https://github.com/LibreSign/libresign/) também e utilizar a API do [LibreSign](https://github.com/LibreSign/libresign/) utilizando credenciais de acesso de usuários do e-Cidade.

## Requisitos

* Vá para a pasta de apps de teu Nextcloud e execute os comandos que seguem:
  ```bash
  git clone --progress --single-branch --depth 1 --recurse-submodules -j 4 https://github.com/e-cidade/ecidade_login
  cd ecidade_login
  composer i --no-dev
  occ app:enable ecidade_login
  cd -
  git clone --progress --single-branch --depth 1 --branch "fork" --recurse-submodules -j 4 https://github.com/vitormattos/user_backend_sql_raw
  cd user_backend_sql_raw
  composer i --no-dev
  occ app:enable user_backend_sql_raw
  ```

* Edite o arquivo `config.php` e configure o app [`user_backend_sql_raw`](https://github.com/vitormattos/user_backend_sql_raw). Exemplo:

  ```php
    'user_backend_sql_raw' => 
    array (
      'db_type' => 'mariadb',
      'db_host' => 'mysql',
      'db_name' => 'nextcloud',
      'db_user' => 'nextcloud',
      'db_password' => 'nextcloud',
      'queries' => 
      array (
        'get_password_hash_for_user' => 'SELECT password_hash FROM ecidade WHERE user = :username',
        'user_exists' => 'SELECT EXISTS(SELECT 1 FROM ecidade WHERE user = :username)',
        'get_users' => 'SELECT user FROM ecidade WHERE (user LIKE :search) OR (display_name LIKE :search)',
        'set_password_hash_for_user' => 'UPDATE ecidade SET password_hash = :new_password_hash WHERE user = :username',
        'get_display_name' => 'SELECT display_name FROM ecidade WHERE user = :username',
      ),
      'validation_password_class' => '\\OCA\\EcidadeLogin\\HashPassword',
      'hash_algorithm_for_new_passwords' => '\\OCA\\EcidadeLogin\\HashPassword',
    ),
  ```

## Como autenticar-se?

### Browser

Acesse o Nextcloud pelo browser com seu usuário e senha do e-Cidade.

### API

Utilize o `password_hash` que consta na tabela `ecidade` do usuário como token de acesso a API do Nextcloud.


## Suporte

Caso queira suporte corporativo para Nextcloud, entre em contato com a [LibreCode](https://librecode.coop)! Empresa de especialistas em Nextcloud no Brasil.

Canais de contato:
* Site: https://librecode.coop
* Telegram: https://t.me/LibreCodeCoop

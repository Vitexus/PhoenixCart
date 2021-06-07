<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ConfigKeyNewDbCharset extends AbstractMigration {

  /**
   * Change Method.
   *
   * Write your reversible migrations using this method.
   *
   * More information on writing migrations is available here:
   * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
   *
   * Remember to call "create()" or "update()" and NOT "save()" when working
   * with the Table class.
   */
  public function change() {
    $key = 'DB_ENCODING';
    $this->execute("DELETE FROM configuration WHERE configuration_key='" . $key . "'");

    $configChange = [
        'configuration_title' => 'Set Database Encoding',
        'configuration_key' => $key,
        'configuration_value' => 'utf8',
        'configuration_description' => 'DB encodings: utf8 utf8m4',
        'configuration_group_id' => '1',
        'sort_order' => '99999',
        'last_modified' => date('Y-m-d'),
        'set_function' => '',
        'date_added' => date('Y-m-d')
    ];

    $table = $this->table('configuration');
    $table->insert($configChange);
    $table->saveData();
  }

}

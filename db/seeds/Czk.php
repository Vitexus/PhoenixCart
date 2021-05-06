<?php


use Phinx\Seed\AbstractSeed;

class Czk extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        // INSERT INTO currencies (title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value) VALUES ('Czech Koruna', 'CZK', '', 'Kč', ',', '.', '2', '1'
        // update configuration set configuration_value = 'CZK' where configuration_key = 'DEFAULT_CURRENCY'
    }
}

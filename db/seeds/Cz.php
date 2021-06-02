<?php

use Phinx\Seed\AbstractSeed;

class Cz extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run() {
        $data = [
            [
                'name' => 'Čeština',
                'code' => 'cs',
                'image' => 'icon.gif',
                'directory' => 'czech',
                'sort_order' => '1'
            ]
        ];

        $languages = $this->table('languages');
        $languages->insert($data)->save();

        $this->execute('INSERT INTO categories_description (categories_id, language_id, categories_name) SELECT categories_id, 2, categories_name FROM categories_description WHERE language_id = 1 ');
        $this->execute('INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url) SELECT products_id, 2, products_name, products_description, products_url FROM products_description WHERE language_id = 1 ');
        $this->execute('INSERT INTO products_options (products_options_id, language_id, products_options_name) SELECT products_options_id, 2, products_options_name FROM products_options WHERE language_id = 1 ');
        $this->execute('INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) SELECT products_options_values_id, 2, products_options_values_name FROM products_options_values WHERE language_id = 1 ');
        $this->execute('INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url) SELECT manufacturers_id, 2, manufacturers_url FROM manufacturers_info WHERE languages_id = 1 ');
        $this->execute('INSERT INTO orders_status (orders_status_id, language_id, orders_status_name) SELECT orders_status_id, 2, orders_status_name FROM orders_status WHERE language_id = 1 ');
        $this->execute('INSERT INTO customer_data_groups (customer_data_groups_id, language_id, customer_data_groups_name, cdg_vertical_sort_order, cdg_horizontal_sort_order, customer_data_groups_width) SELECT customer_data_groups_id, 2, customer_data_groups_name, cdg_vertical_sort_order, cdg_horizontal_sort_order, customer_data_groups_width FROM customer_data_groups WHERE language_id = 1');
        $this->execute("UPDATE configuration SET configuration_value = 'cs' WHERE configuration_key = 'DEFAULT_LANGUAGE'");
        $this->execute('INSERT INTO advert_info (advert_id, languages_id) SELECT advert_id, 2 FROM advert_info WHERE languages_id = 1 ');
        $this->execute('INSERT INTO pages_description (pages_id, languages_id, pages_title, pages_text, navbar_title) SELECT pages_id, 2, 2, 2, 2 FROM pages_description WHERE languages_id = 1 ');
        
        $this->execute("INSERT INTO currencies (title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value) VALUES ('Czech Koruna', 'CZK', '', 'Kč', ',', '.', '2', '1') ");
        $this->execute("update configuration set configuration_value = 'CZK' where configuration_key = 'DEFAULT_CURRENCY' ");
    }

}

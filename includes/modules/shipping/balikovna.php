<?php

class Balikovna extends abstract_shipping_module {

    public function __construct() {
        parent::__construct();
        $this->balikovna();
    }

    var $code, $title, $description, $icon, $enabled, $api_key, $country, $quotes;

    const ZONE_COUNT = 1;
    const CONFIG_KEY_BASE = 'MODULE_SHIPPING_BAL_';

// class constructor
    function balikovna() {
        global $balPtr;
        $balPtr = $this;
        $order = Guarantor::ensure_global('order');
        /** injected code cleanup (for mailing, etc) * */
        if (preg_match('/^Balíkovna/', $order->info['shipping_method'])) {
            $order->info['shipping_method'] = MODULE_SHIPPING_BAL_TEXT_WAY;
        }
        if (array_key_exists('shipping', $_SESSION) && preg_match('/^Balíkovna/', $_SESSION['shipping']['title'])) {
            $_SESSION['shipping']['title'] = MODULE_SHIPPING_BAL_TEXT_WAY;
        }

        $this->code = 'balikovna';
        $this->title = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_TEXT_TITLE');
        $this->description = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_TEXT_DESCRIPTION');
        $this->sort_order = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_SORT_ORDER');
        $this->api_key = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_API_KEY');
        $this->country = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_COUNTRY') == 'Vše' ? '' : ( \Ease\Functions::cfg('MODULE_SHIPPING_BAL_COUNTRY') == 'Slovenská republika' ? 'sk' : 'cz' );
        $this->icon = 'images/apps/balikovna/balikovna.png';
        $this->tax_class = \Ease\Functions::cfg('MODULE_SHIPPING_BAL_TAX_CLASS');
//DELETED      $this->tax_basis = MODULE_SHIPPING_ZAS_TAX_BASIS == 'Doprava' ? 'Shipping' : (MODULE_SHIPPING_ZAS_TAX_BASIS == 'Fakturace' ? 'Billing' : 'Store');

        /*
          TODO?      // disable only when entire cart is free shipping
          if (zen_get_shipping_enabled($this->code)) {
          $this->enabled = ((MODULE_SHIPPING_ZAS_STATUS == 'Povolit' && $this->api_key) ? true : false);
          }
         */

        $this->enabled = !empty($this->api_key);

        if (($this->enabled == true) && ((int) \Ease\Functions::cfg('MODULE_SHIPPING_BAL_ZONE') > 0)) {
            $check_flag = false;
            $check = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '" . constant('MODULE_SHIPPING_BAL_ZONE') . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");

            while ($checkA = tep_db_fetch_array($check)) {
                if ($checkA['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($checkA['zone_id'] == $order->delivery['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            /* původní zencartí vepřovina, v osc nefunkční       
              while (!$check->EOF) {
              if ($check->fields['zone_id'] < 1) {
              $check_flag = true;
              break;
              } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
              $check_flag = true;
              break;
              }
              $check->MoveNext();
              }
             */

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }


        if ($_SESSION['shipping']['id'] == 'zasilkovna_zasilkovna') {
            $zasilkovna_id = \Ease\WebPage::getRequestValue('zasilkovna_id');
            if (empty($zasilkovna_id)) {
                $this->quotes['error'] = 'Nebyla vybrána výdejna zásilkovny!';
            } else {
                $zasilkovna_id; //Todo save in order
            }
        }


//TODO?	  if($order->info['shipping_module_code'] == 'zasilkovna_'.$this->code){
//		  $order->info['shipping_method'] = $this->title . ' ('.$this->description.')';
//	  }
    }

// class methods

    /**
     * Module Configuration
     * 
     * @return array Module initial configuration
     */
    function get_parameters() {

        return [
//MODULE_SHIPPING_BAL_STATUS', 'Povolit', '?', '6', '0', 'tep_cfg_select_option(array(\'Povolit\', \'Zakázat\'), ', now())");
            $this->config_key_base . 'STATUS' => [
                'title' => 'Povolit Balikovnu',
                'value' => 'True',
                'desc' => 'Chcete povolit používání Balikovny?',
                'set_func' => "tep_cfg_select_option(['True', 'False'], ",
            ],
            $this->config_key_base . 'COST' => [
                'title' => 'Balíkovna',
                'value' => '5.00',
                'desc' => 'Shiping price',
            ],
            $this->config_key_base . 'MODE' => [
                'title' => 'Table Method',
                'value' => 'weight',
                'desc' => 'The shipping cost is based on the order total or the total weight of the items ordered.',
                'set_func' => "tep_cfg_select_option(['weight', 'price', 'quantity'], ",
            ],
            $this->config_key_base . 'HANDLING' => [
                'title' => 'Handling Fee',
                'value' => '0',
                'desc' => 'Handling fee for this shipping method.',
            ],
            $this->config_key_base . 'TAX_CLASS' => [
                'title' => 'Tax Class',
                'value' => '0',
                'desc' => 'Use the following tax class on the shipping fee.',
                'use_func' => 'tep_get_tax_class_title',
                'set_func' => 'tep_cfg_pull_down_tax_classes(',
            ],
            $this->config_key_base . 'ZONE' => [
//('Zóna dopravy', 'MODULE_SHIPPING_BAL_ZONE', '0', 'Když je vybrána zóna, doprava se zobrazí pouze pro tuto zónu.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
                'title' => 'Shipping Zone',
                'value' => '0',
                'desc' => 'If a zone is selected, only enable this shipping method for that zone.',
                'use_func' => 'tep_get_zone_class_title',
                'set_func' => 'tep_cfg_pull_down_zone_classes(',
            ],
            $this->config_key_base . 'SORT_ORDER' => [
                'title' => 'Sort Order',
                'value' => '0',
                'desc' => 'Sort order of display.',
            ],
            $this->config_key_base . 'API_KEY' => [
                'title' => 'Klíč API',
                'value' => 'True',
                'desc' => 'Klíč api Balikovny',
            ],
//            $this->config_key_base . '' => [
//('Pobočky', 'MODULE_SHIPPING_BAL_COUNTRY', 'Vše', 'Vyberte pobočky které země chcete, aby se zobrazovaly', '6', '0', 'tep_cfg_select_option(array(\'Česká republika\', \'Slovenská republika\', \'Vše\'), ', now())");
//            ],
            $this->config_key_base . 'PRODUCTION' => [
                'title' => 'Use production API',
                'value' => 'False',
                'desc' => 'Put false here to use testing API servers.',
                'set_func' => "tep_cfg_select_option(['True', 'False'], "
        ]];
    }

    function quote($method = '') {
        global $order, $cart;

        $costAll = explode(',', MODULE_SHIPPING_BAL_COST);
        foreach ($costAll as $costStr) {
            $costA = explode(':', trim($costStr));
            $cost = (int) $costA[1]; //cena
            if ($cart->show_total() < $costA[0])
                break; //dolni limit ceny pro levnejsi tarif - pri nizsi hodnote break a nechat byt
        }


        $this->quotes = array('id' => $this->code,
            'module' => MODULE_SHIPPING_BAL_TEXT_TITLE,
            'methods' => array(array('id' => $this->code,
                    'title' => MODULE_SHIPPING_BAL_TEXT_WAY, //. $this->packeteryCode(),
                    'cost' => $cost /* MODULE_SHIPPING_ZAS_COST */))); //$cost
        if (($this->tax_class > 0) && is_array($order->delivery) && array_key_exists('zone_id', $order->delivery)) {
            $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }

        $this->quote_common();
        return $this->quotes;
    }

    function packeteryCode() {
        // important to keep the whitespaces, the Zen Cart saves shipping title sent to the checkout WITH the code, the db entry stores only first few characters so the code gets chipped away and wraps half of administration to the <script> tag
        // basically we dont want to fit the whole name to the db

        return '';

        $js = '                                                                                                                                                                                                                                                                                                                                                                                                                                                          <br><div class="testt"><script> (function(d){ var el, id = "packetery-jsapi", head = d.getElementsByTagName("head")[0]; if(d.getElementById(id)) { return; } el = d.createElement("script"); el.id = id; el.async = true; el.src = "https://www.zasilkovna.cz/api/' . $this->api_key . '/branch.js?callback=addHooks"; head.insertBefore(el, head.firstChild); }(document)); </script>
        <script language = "javascript" type = "text/javascript">;
        if(typeof window.packetery != "undefined") {
            setTimeout(function(){initBoxes()}, 1000)
        } else {
            setTimeout(function(){setRequiredOpt()}, 500)
        }

        function initBoxes() {
            console.log("initBoxes");
            var api = window . packetery;
            divs = $(\'#zasilkovna_box\');
   $(\'.packetery-branch-list\').each(function() {

       api.initialize(api.jQuery(this));
       this.packetery.option("selected-id",0);
    });
   addHooks();  
   setRequiredOpt();
}
var SubmitButtonDisabled = true;
function setRequiredOpt(){ 
        console.log("setRequiredOpt");
        var setOnce = false;
        var disableButton=false;
        var zasilkovna_selected = false;
        var opts={
            connectField: \'textarea[name=comments]\'
          }        
        $("div.packetery-branch-list").each(
            function() {
              var div = $(this).closest(\'fieldset\');
              var radioButt = $(div).find(\'input[name="shipping"]:radio\');
              var select_branch_message = $(div).find(\'#select_branch_message\');
			  
              if($(radioButt).is(\':checked\')){
                zasilkovna_selected = true;
              }else{//deselect branch (so when user click the radio again, he must select a branch). Made coz couldnt update connect-field if only clicked on radio with already selected branch
                if(this.packetery.option("selected-id")>0){
                  this.packetery.option("selected-id",0);
                }
               // $(this).find(\'option:selected\', \'select\').removeAttr(\'selected\');
                //$($(this).find(\'option\', \'select\')[0]).attr(\'selected\', \'selected\');
              }

              if($(radioButt).is(\':checked\')&&!this.packetery.option("selected-id")){
                select_branch_message.show();
                disableButton=true;
              }else{
                select_branch_message.hide();

              }
            }
          );
        
        $(\'#button-shipping-method\').attr(\'disabled\', disableButton);
        SubmitButtonDisabled = disableButton;
    
        if(!zasilkovna_selected){
          updateConnectedField(opts,0);
        }
}

function submitForm(){

  if(!SubmitButtonDisabled){
    $(\'#shipping\').submit();
  }
}

function updateConnectedField(opts, id) {
console.log("updateConnectedField("+opts+","+id+")");
          if (opts.connectField) {
              if (typeof(id) == "undefined") {
                  id = opts.selectedId
              }
              var f = $(opts.connectField);
              var v = f.val() || "",
              re = /\[Z\u00e1silkovna\s*;\s*[0-9]+\s*;\s*[^\]]*\]/,
              newV;
              if (id > 0) {
                  var branch = branches[id];
                  newV = "[Z\u00e1silkovna; " + branch.id + "; " + branch.name + "]"
              } else {
                  newV = ""
              }
              if (v.search(re) != -1) {
                  v = v.replace(re, newV)
                  } else {
                  if (v) {
                      v += "\n" + newV
                  } else {
                      v = newV
                  }
              }
              function trim(s) {
                  return s.replace(/^\s*|\s*$/, "")
                  }
              f.val(trim(v))
              }
}

    function addHooks(){
      //called when no zasilkovna method is selected. Dunno how to call this from the branch.js
      
      
      //set each radio button to call setRequiredOpt if clicked
      console.log("addHooks");
      $(\'input[name="shipping"]:radio\').each(
        function(){
          $(this).click(setRequiredOpt);
         }
      );
      button = $(\'[onclick="$(\\\'#shipping\\\').submit();"]\');
      button.removeAttr("onclick");
      button.click(submitForm);

      $("div.packetery-branch-list").each(
          function() {
            var fn = function(){
              var selected_id = this.packetery.option("selected-id");
              var tr = $(this).closest(\'tr\');
              var radioButt = $(tr).find(\'input[name="shipping"]:radio\');
              if(selected_id)$(radioButt).attr("checked",\'checked\');
              setTimeout(setRequiredOpt, 1);
            };
            this.packetery.on("branch-change", fn);
            fn.call(this);
          }
      );
    }
    </script><script>
          var radio = $(\'input:radio[name="shipping"][value="zasilkovna_' . $this->code . '"]\');
          var parent_div = radio.parent(); 
          if(parent_div.find(\'#zasilkovna_box\').length == 0){
            $(parent_div).append(\'<div id="zasilkovna_box" class="packetery-branch-list list-type=3 connect-field=textarea[name=comments] country=' . $this->country . '" style="border: 1px dotted black;">Načítání: seznam poboček osobního odběru</div> \');
            $(parent_div).append(\'<p id="select_branch_message" style="color:red; font-weight:bold; display:none">Vyberte pobočku</p>\');
          }
        </script></div>';

        return $js;
    }

//---------------------------------------------------------------------------------------------

    function formAction() {
        global $_POST, $order;

        if (!isset($_SESSION['bal_data']))
            $_SESSION['bal_data'] = [];

        $redir_back = false;
        $skip = false;

        if (isset($_POST['select_city_bal']))
            if ($_POST['select_city_bal'] != '') {

                if (isset($_SESSION['bal_data']['street']))
                    if ($_POST['select_city_bal'] != $_SESSION['bal_data']['city']) { //pri zmene mesta vsechno vymazat a znovu!
                        unset($_SESSION['bal_data']['street']);
                        unset($_SESSION['bal_data']['final']);
                        unset($_SESSION['bal_data']['comment']);
                        unset($_SESSION['bal_data']['completed']);
                        $skip = true;
                    }

                $_SESSION['bal_data']['city'] = $_POST['select_city_bal'];

                if (!isset($_SESSION['bal_data']['completed']))
                    $redir_back = true; //tep_redirect('checkout_shipping.php'); //$redir_back = true;
            }

        if (isset($_POST['select_street_bal']))
            if ($_POST['select_street_bal'] != '')
                if (!$skip) {

                    //finalni detaily pobocky:
                    $finQ = tep_db_query("SELECT * FROM balikovna WHERE id=" . $_POST['select_street_bal']);
                    $finA = tep_db_fetch_array($finQ);

                    $_SESSION['bal_data']['street'] = $finA['id'];
                    $_SESSION['bal_data']['final'] = "Vaše zásilka bude k vyzvednutí na pobočce " . $finA['name'] . " (" . $finA['street'] . ").<br />\n
  Nyní můžete pokračovat v nákupu.";
                    $_SESSION['bal_data']['comment'] = "  Doprava Balíkovnou na jméno-pobočku: \n" . $order->customer['name'] . "\nBALÍKOVNA\n" . $finA['zip'] . " " . $finA['name'];

                    if (!isset($_SESSION['bal_data']['completed']))
                        $redir_back = true;

                    $_SESSION['bal_data']['completed'] = true; //timto pruchodem povolit pokračovani

                    $_SESSION['bal_comment'] = $_SESSION['bal_data']['comment']; //pro finalni vlozeni na konci nakupu
                }

        if ($redir_back) {
            $_SESSION['shipping']['id'] = $_POST['shipping'];
            tep_redirect('checkout_shipping.php');
        }
    }

//---------------------------------------------------------------------------------------------

    function drawForm() {
//global $order;
//echo "<xmp>".var_export($order, true)."</xmp>";

        echo '<tr><td colspan=4><div id="zasdiv" class="alert alert-warning" style=" 
display:' . (true || (count($_SESSION['bal_data']) > 0) ? 'inline-block' : 'none;') .
        'height:200px; width: 100%; overflow: auto; padding: 10px;">&nbsp;';

        $selCity = isset($_SESSION['bal_data']['city']) ? $_SESSION['bal_data']['city'] : false;
        $selStreet = isset($_SESSION['bal_data']['street']) ? $_SESSION['bal_data']['street'] : false;

        $cityListQ = tep_db_query("SELECT DISTINCT city FROM balikovna WHERE country = 'cz' AND statusid = 1 ORDER BY city");

        $cityA = [['id' => '', 'text' => '-VYBERTE MĚSTO-']];
        while ($cityListA = tep_db_fetch_array($cityListQ)) {

            $cityA[] = ['id' => $cityListA['city'], 'text' => $cityListA['city']];
        }

        echo tep_draw_pull_down_menu('select_city_bal', $cityA, $selCity, "onChange=\"document.forms['checkout_address'].submit()\"") . "\n";

        if ($selCity) {

            $streetListQ = tep_db_query($qStr = "SELECT id, street FROM balikovna WHERE city = '" . $selCity . "' AND statusid = 1 ORDER BY street");

            $streetA = [['id' => '', 'text' => '-----VYBERTE ULICI------']];
            while ($streetListA = tep_db_fetch_array($streetListQ)) {

                $streetA[] = ['id' => $streetListA['id'], 'text' => $streetListA['street']];
            }
            echo '<br />';
            //echo $qStr . "<br />\n" . var_export($streetA, true) . "<br />\n";
            echo tep_draw_pull_down_menu('select_street_bal', $streetA, $selStreet, "onChange=\"document.forms['checkout_address'].submit()\"") . "\n";
        }

        if (isset($_SESSION['bal_data']['final'])) {

            echo "<br />\n" . $_SESSION['bal_data']['final'];

            //$comments = $_SESSION['bal_data']['comment'];
        }
        ?>
        </div></td></tr>
        <?php
    }

//---------------------------------------------------------------------------------------------

    function test() {
        echo "<h1>TEST</h1>";
    }

//---------------------------------------------------------------------------------------------
}
?>

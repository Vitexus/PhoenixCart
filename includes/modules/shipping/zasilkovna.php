<?php

class Zasilkovna extends abstract_shipping_module {

    var $code, $title, $description, $icon, $enabled, $api_key, $country, $quotes;

    const ZONE_COUNT = 1;
    const CONFIG_KEY_BASE = 'MODULE_SHIPPING_ZAS_';

    public function __construct() {
        parent::__construct();
        $this->zasilkovna();
    }

// class constructor
    function zasilkovna() {
        global $order, $zasPtr;
        $zasPtr = $this;
        /** injected code cleanup (for mailing, etc) * */
        if (is_object($order) && preg_match('/^Zásilkovna/', $order->info['shipping_method'])) {
            $order->info['shipping_method'] = MODULE_SHIPPING_ZAS_TEXT_WAY;
        }
        if (array_key_exists('shipping', $_SESSION) && preg_match('/^Zásilkovna/', $_SESSION['shipping']['title'])) {
            $_SESSION['shipping']['title'] = MODULE_SHIPPING_ZAS_TEXT_WAY;
        }

        $this->code = 'zasilkovna';
        $this->title = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_TEXT_TITLE');
        $this->description = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_TEXT_DESCRIPTION');
        $this->sort_order = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_SORT_ORDER');
        $this->api_key = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_API_KEY');
        $this->country = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_COUNTRY') == 'Vše' ? '' : ( \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_COUNTRY') == 'Slovenská republika' ? 'sk' : 'cz' );
        $this->icon = 'images/apps/zasilkovna/zasilkovna.png';
        $this->tax_class = \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_TAX_CLASS');
//DELETED      $this->tax_basis = MODULE_SHIPPING_ZAS_TAX_BASIS == 'Doprava' ? 'Shipping' : (MODULE_SHIPPING_ZAS_TAX_BASIS == 'Fakturace' ? 'Billing' : 'Store');

        /*
          TODO?      // disable only when entire cart is free shipping
          if (zen_get_shipping_enabled($this->code)) {
          $this->enabled = ((MODULE_SHIPPING_ZAS_STATUS == 'Povolit' && $this->api_key) ? true : false);
          }
         */

        $this->enabled = true;

        if (($this->enabled == true) && ((int) \Ease\Functions::cfg('MODULE_SHIPPING_ZAS_ZONE') > 0)) {
            $check_flag = false;
            $check = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '" . MODULE_SHIPPING_ZAS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");

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
//TODO?	  if($order->info['shipping_module_code'] == 'zasilkovna_'.$this->code){
//		  $order->info['shipping_method'] = $this->title . ' ('.$this->description.')';
//	  }
    }

// class methods
    /*
      public function quote($method = '') {
      global $order, $shipping_weight, $shipping_num_boxes;

      $dest_zone = false;
      $error = false;

      for ($i = 1; $i <= static::ZONE_COUNT; $i++) {
      if (in_array($order->delivery['country']['iso_code_2'], explode(';', $this->base_constant('COUNTRIES_' . $i)))) {
      $dest_zone = $i;
      break;
      }
      }

      if (false === $dest_zone) {
      $error = true;
      } else {
      $shipping = false;
      $zones_cost = $this->base_constant('COST_' . $dest_zone);

      $zones_table = preg_split('/[:,]/' , $zones_cost);
      for ($i = 0, $size = count($zones_table); $i < $size; $i += 2) {
      if ($shipping_weight <= $zones_table[$i]) {
      $shipping = $zones_table[$i+1];
      $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY
      . ' ' . $order->delivery['country']['iso_code_2']
      . ' : ' . $shipping_weight
      . ' ' . MODULE_SHIPPING_ZONES_TEXT_UNITS;
      break;
      }
      }

      if (false === $shipping) {
      $shipping_cost = 0;
      $shipping_method = MODULE_SHIPPING_ZONES_UNDEFINED_RATE;
      } else {
      $shipping_cost = ($shipping * $shipping_num_boxes) + $this->base_constant('HANDLING_' . $dest_zone);
      }
      }

      $this->quotes = [
      'id' => $this->code,
      'module' => MODULE_SHIPPING_ZONES_TEXT_TITLE,
      'methods' => [[
      'id' => $this->code,
      'title' => $shipping_method,
      'cost' => $shipping_cost,
      ]],
      ];

      $this->quote_common();

      if ($error) {
      $this->quotes['error'] = MODULE_SHIPPING_ZONES_INVALID_ZONE;
      }

      return $this->quotes;
      }

     */

    /**
     * Module Configuration
     * 
     * @return array Module initial configuration
     */
    function get_parameters() {
        return [
            $this->config_key_base . 'STATUS' => [
                'title' => 'Povolit Zásilkovnu',
                'value' => 'True',
                'desc' => 'Chcete povolit používání Zásilkovny?',
                'set_func' => "tep_cfg_select_option(['True', 'False'], ",
            ],
            $this->config_key_base . 'COST' => [
                'title' => 'Zásilkovna',
                'value' => '5.00', //TODO: Obtain using API
                'desc' => 'Shiping price', //TODO: Localize
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
                'value' => '145b247b34d4cf1a',
                'desc' => 'Klíč api Zásilkovny',
            ],
//            $this->config_key_base . '' => [
//('Pobočky', 'MODULE_SHIPPING_BAL_COUNTRY', 'Vše', 'Vyberte pobočky které země chcete, aby se zobrazovaly', '6', '0', 'tep_cfg_select_option(array(\'Česká republika\', \'Slovenská republika\', \'Vše\'), ', now())");
//            ],
            $this->config_key_base . 'PRODUCTION' => [
                'title' => 'Use production API',
                'value' => 'False',
                'desc' => 'Put false here to use testing API servers.',
                'set_func' => "tep_cfg_select_option(['True', 'False'], "
            ]
//title, 
//key, 
//value, 
//description, 
//group_id, 
//sort_order            
//set_function, date_added) values ('Povolit Zásilkovnu', 'MODULE_SHIPPING_ZAS_STATUS', 'Povolit', 'Chcete povolit používání Zásilkovny?', '6', '0', 'tep_cfg_select_option(array(\'Povolit\', \'Zakázat\'), ', now())");
//date_added) values ('Klíč API', 'MODULE_SHIPPING_ZAS_API_KEY', '', '', '6', '0', now())");
//date_added) values ('Cena', 'MODULE_SHIPPING_ZAS_COST', '5.00', 'Cena za dopravu.', '6', '0', now())");
//set_function, date_added) values ('Pobočky', 'MODULE_SHIPPING_ZAS_COUNTRY', 'Vše', 'Vyberte pobočky které země chcete, aby se zobrazovaly', '6', '0', 'tep_cfg_select_option(array(\'Česká republika\', \'Slovenská republika\', \'Vše\'), ', now())");
//use_function, set_function, date_added) values ('Daň', 'MODULE_SHIPPING_ZAS_TAX_CLASS', '0', '', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
//use_function, set_function, date_added) values ('Zóna dopravy', 'MODULE_SHIPPING_ZAS_ZONE', '0', 'Když je vybrána zóna, doprava se zobrazí pouze pro tuto zónu.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
//date_added) values ('Řazení', 'MODULE_SHIPPING_ZAS_SORT_ORDER', '0', 'Řazení pro zobrazení při nákupu.', '6', '0', now())");
        ];
    }

    function quote($method = '') {
        global $order, $cart;

        $costAll = explode(',', MODULE_SHIPPING_ZAS_COST);
        foreach ($costAll as $costStr) {
            $costA = explode(':', trim($costStr));
            $cost = count($costA) == 2 ? (int) $costA[1] : (int) $costA[0]; //cena TODO: undefined index 1
            if ($cart->show_total() < $costA[0])
                break; //dolni limit ceny pro levnejsi tarif - pri nizsi hodnote break a nechat byt
        }

        $this->quotes = array('id' => $this->code,
            'module' => MODULE_SHIPPING_ZAS_TEXT_TITLE,
            'custom' => $this->popUp(),
            'methods' => array(array('id' => $this->code,
                    'title' => MODULE_SHIPPING_ZAS_TEXT_WAY, //. $this->packeteryCode(),
                    'cost' => $cost /* MODULE_SHIPPING_ZAS_COST */))); //$cost
        $this->quote_common();

        if (array_key_exists('shipping', $_SESSION) && ($_SESSION['shipping'] == 'zasilkovna_zasilkovna')) {
            $zasilkovna_id = \Ease\WebPage::getRequestValue('zasilkovna_id');
            if (empty($zasilkovna_id)) {
                $this->quotes['error'] = 'Nebyla vybrána výdejna zásilkovny!';
            } else {
                $zasilkovna_id; //Todo save in order
                $order->info['shipping_method'] = 'Zásilkovna: '.\Ease\WebPage::getRequestValue('zasilkovna');
            }
        }
        
        return $this->quotes;
    }

    function popUp() {
        return '
        <script src="https://widget.packeta.com/www/js/library.js"></script>
        <script>
            var packetaApiKey = \'' . $this->api_key . '\';
            /*
             This function will receive either a pickup point object, or null if the user
             did not select anything, e.g. if they used the close icon in top-right corner
             of the widget, or if they pressed the escape key.
             */
            function showSelectedPickupPoint(point)
            {
                var spanElement = document.getElementById(\'packeta-point-info\');
                var idElement = document.getElementById(\'packeta-point-id\');
                if (point) {
                    var recursiveToString = function (o) {
                        return Object.keys(o).map(
                                function (k) {
                                    if (o[k] === null) {
                                        return k + " = null";
                                    }

                                    return k + " = " + (typeof (o[k]) == "object"
                                            ? "<ul><li>" + recursiveToString(o[k]) + "</li></ul>"
                                            : o[k].toString().replace(/&/g, \'&amp;\').replace(/</g, \'&lt;\')
                                            );
                                }
                        ).join("</li><li>");
                    };

                    spanElement.innerText = "Address: " + point.name + "\n" + point.zip + " " + point.city;
                    $("#packeta-point").val(point.name + " " + point.zip + " " + point.city);
                    $("#packeta-point-id").val(point.id);
                } else {
                    $("#packeta-point").val("None");
                    $("#packeta-point-id").val("");
                }
            }
            ;
        </script>
' . '        <input type="button" onclick="Packeta.Widget.pick(packetaApiKey, showSelectedPickupPoint)" value="' . 'MODULE_SHIPPING_ZAS_TEXT_SELECT' . '...">
        <p>' . 'MODULE_SHIPPING_ZAS_TEXT_SELECTED' . ':
            <input type="hidden" name="zasilkovna_id" id="packeta-point-id">
            <input type="hidden" name="zasilkovna" id="packeta-point">
            <span id="packeta-point-info">None</span>
        </p>
';
    }

    function packeteryCode() {
        // important to keep the whitespaces, the Zen Cart saves shipping title sent to the checkout WITH the code, the db entry stores only first few characters so the code gets chipped away and wraps half of administration to the <script> tag
        // basically we dont want to fit the whole name to the db
        //return '';

        $js = '                                                                                                                                                                                                                                                                                                                                                                                                                                                          <br><div class="testt"><script> (function(d){ var el, id = "packetery-jsapi", head = d.getElementsByTagName("head")[0]; if(d.getElementById(id)) { return; } el = d.createElement("script"); el.id = id; el.async = true; el.src = "https://www.zasilkovna.cz/api/' . $this->api_key . '/branch.js?callback=addHooks"; head.insertBefore(el, head.firstChild); }(document)); </script>
<script language="javascript" type="text/javascript">   ;
if(typeof window.packetery != "undefined"){
  setTimeout(function(){initBoxes()},1000)
}else{
  setTimeout(function(){setRequiredOpt()},500)
}
function initBoxes(){
   console.log("initBoxes");
   var api = window.packetery;
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
        global $_POST;

        if (!isset($_SESSION['zas_data']))
            $_SESSION['zas_data'] = [];

        $redir_back = false;
        $skip = false;

        if (isset($_POST['select_city']))
            if ($_POST['select_city'] != '') {
//$_SESSION['shipping']['id'] = 'zasilkovna';
                if (isset($_SESSION['zas_data']['street']))
                    if ($_POST['select_city'] != $_SESSION['zas_data']['city']) { //pri zmene mesta vsechno vymazat a znovu!
                        unset($_SESSION['zas_data']['street']);
                        unset($_SESSION['zas_data']['final']);
                        unset($_SESSION['zas_data']['comment']);
                        unset($_SESSION['zas_data']['completed']);
                        $skip = true;
                    }

                $_SESSION['zas_data']['city'] = $_POST['select_city'];

                if (!isset($_SESSION['zas_data']['completed']))
                    $redir_back = true; //tep_redirect('checkout_shipping.php'); //$redir_back = true;
            }

        if (isset($_POST['select_street']))
            if ($_POST['select_street'] != '')
                if (!$skip) {

                    //finalni detaily pobocky:
                    $finQ = tep_db_query("SELECT * FROM zasilkovna WHERE id=" . $_POST['select_street']);
                    $finA = tep_db_fetch_array($finQ);

                    $_SESSION['zas_data']['street'] = $finA['id'];
                    $_SESSION['zas_data']['final'] = "Vaše zásilka bude k vyzvednutí na pobočce " . $finA['name'] . ". Podrobnosti o pobočce 
  můžete zjistit kliknutím zde: <a href=\"" . $finA['url'] . "\" target=\"_blank\">" . $finA['url'] . "</a> .<br />\n
  Nyní můžete pokračovat v nákupu.";
                    $_SESSION['zas_data']['comment'] = "  Doprava Zásilkovnou na pobočku: \n" . $finA['name'] . ".";

                    if (!isset($_SESSION['zas_data']['completed']))
                        $redir_back = true;

                    $_SESSION['zas_data']['completed'] = true; //timto pruchodem povolit pokračovani

                    $_SESSION['zas_comment'] = $_SESSION['zas_data']['comment']; //pro finalni vlozeni na konci nakupu
                }

        if ($redir_back) {
            $_SESSION['shipping']['id'] = $_POST['shipping'];
            tep_redirect('checkout_shipping.php');
        }
    }

//---------------------------------------------------------------------------------------------

    function drawForm() {
        echo '<tr><td colspan=4><div id="zasdiv" class="alert alert-warning" style=" 
                           display:' . (true || (count($_SESSION['zas_data']) > 0) ? 'inline-block' : 'none') .
        ';height:200px; width: 100%; overflow: auto; padding: 10px;">&nbsp;';

        $selCity = isset($_SESSION['zas_data']['city']) ? $_SESSION['zas_data']['city'] : false;
        $selStreet = isset($_SESSION['zas_data']['street']) ? $_SESSION['zas_data']['street'] : false;

        $cityListQ = tep_db_query("SELECT DISTINCT city FROM zasilkovna WHERE country = 'cz' AND statusid = 1 ORDER BY city");

        $cityA = [['id' => '', 'text' => '-VYBERTE MĚSTO-']];
        while ($cityListA = tep_db_fetch_array($cityListQ)) {

            $cityA[] = ['id' => $cityListA['city'], 'text' => $cityListA['city']];
        }

        echo tep_draw_pull_down_menu('select_city', $cityA, $selCity, "onChange=\"document.forms['checkout_address'].submit()\"") . "\n";

        if ($selCity) {

            $streetListQ = tep_db_query($qStr = "SELECT id, street FROM zasilkovna WHERE city = '" . $selCity . "' AND statusid = 1 ORDER BY street");

            $streetA = [['id' => '', 'text' => '-----VYBERTE ULICI------']];
            while ($streetListA = tep_db_fetch_array($streetListQ)) {

                $streetA[] = ['id' => $streetListA['id'], 'text' => $streetListA['street']];
            }
            echo '<br />';
            //echo $qStr . "<br />\n" . var_export($streetA, true) . "<br />\n";
            echo tep_draw_pull_down_menu('select_street', $streetA, $selStreet, "onChange=\"document.forms['checkout_address'].submit()\"") . "\n";
        }

        if (isset($_SESSION['zas_data']['final'])) {

            echo "<br />\n" . $_SESSION['zas_data']['final'];

            //$comments = $_SESSION['zas_data']['comment'];
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

<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

class hook_shop_siteWide_styleSheets {

  public $sitestart = null;
  
  function listen_injectSiteStart() {
const BOOTSTRAP_ENABLED = 1;

    if (BOOTSTRAP_ENABLED == 'True') {
    $this->sitestart .= '<!-- stylesheets hooked BS-->' . PHP_EOL;
    $this->sitestart .= '<style>* {min-height: 0.01px;}.form-control-feedback { position: absolute; width: auto; top: 7px; right: 45px; margin-top: 0; }@media (max-width: 575.98px) {.display-1 {font-size: 3rem;font-weight: 300;line-height: 1.0;}.display-2 {font-size: 2.75rem;font-weight: 300;line-height: 1.0;}.display-3 {font-size: 2.25rem;font-weight: 300;line-height: 1.0;}.display-4 {font-size: 1.75rem;font-weight: 300;line-height: 1.0;}h4 {font-size: 1rem;}}</style>' . PHP_EOL;

    $css_file = 'templates/' . TEMPLATE_SELECTION . '/static/user.css';
    if (file_exists($css_file)) {
      $this->sitestart .= '<link href="' . $css_file . '" rel="stylesheet">' . PHP_EOL;
    }
} else {
    $this->sitestart .= '<!-- stylesheets hooked (generated inline) -->' . PHP_EOL;
    $this->sitestart .= '<style>';
    $str = file_get_contents('templates/' . TEMPLATE_SELECTION . '/static/grid.css');
//    $str .= file_get_contents("ext/css/queries.css");
//    $str .= file_get_contents("ext/css/screen.css");
//    $str .= file_get_contents("ext/css/phoenix.css");
$str = str_replace("\n", "", $str);
$str = str_replace("\t", " ", $str);
$str = str_replace("\t", " ", $str);
$str = str_replace("  ", " ", $str);
$str = str_replace("  ", " ", $str);
$str = str_replace("  ", " ", $str);
$str = str_replace("\t", " ", $str);
$str = str_replace(" {", "{", $str);
$str = str_replace("{ ", "{", $str);
$str = str_replace(" }", "}", $str);
$str = str_replace("} ", "}", $str);
$str = str_replace(";}", "}", $str);
$str = str_replace(", ", ",", $str);
$str = str_replace("; ", ";", $str);
$str = str_replace(": ", ":", $str);
    $this->sitestart .= $str;
    $this->sitestart .= '.pure-mimified-listing div{height:' . BGIMG_HEIGHT . 'px}' . PHP_EOL;
    $this->sitestart .= '.pure-mimified-listing div h5,.pure-mimified-listing div p{margin:0 15px 5px ' . (BGIMG_WIDTH + 16) . 'px;line-height:1.2}' . PHP_EOL;
    $this->sitestart .= '.ImSmW img{max-width:' . BGIMG_WIDTH . 'px !important;}';
    $this->sitestart .= '</style>';
}
    return $this->sitestart;
  }

}

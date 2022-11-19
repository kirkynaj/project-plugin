<?php
/**
 * @package ProjectPlugin
 */

 namespace Inc\Base;

 class Deactivate {
    public static function Deactivate() {
        flush_rewrite_rules( );
    }
 }
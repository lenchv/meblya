<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
/**
* Возвращеат уникальный индекс для каждого компонента, для формирования ID
*/
class SliderImageIndex {
	private static $index = 0;
	public static function get() { return self::$index++; }
}
?>
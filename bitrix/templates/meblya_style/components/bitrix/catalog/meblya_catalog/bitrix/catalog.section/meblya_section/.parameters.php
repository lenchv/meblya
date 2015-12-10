<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arTemplateParameters['LINE_ELEMENT_COUNT_MY'] = array(
	"PARENT" => "LIST_SETTINGS",
	"NAME" => GetMessage("IBLOCK_LINE_ELEMENT_COUNT"),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'twice' => 'По два',
		'thrice' => 'По три',
		'fourfold' => 'По четыре',
		'list' => 'Списком'
	),
	'SORT' => 800,
	"MULTIPLE" => "N",
	"DEFAULT" => "thrice",
	"REFRESH" => "N"
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
include(".section.php");
$APPLICATION->SetTitle($sSectionName);
$APPLICATION->SetDirProperty("section_name", $sSectionName);
?> Текстиль<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
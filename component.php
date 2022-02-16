<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;  
if(!Loader::includeModule("iblock"))
{
    return;
}
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "UF_PENSIAL", "UF_USER_DPA" , "PROPERTY_".$arParams["PROPERTY_CODE"]);
$arFilter = Array("IBLOCK_ID"=> IntVal($arParams["IBLOCK_ID"]), "ACTIVE"=>"Y", "PROPERTY_".$arParams["PROPERTY_CODE"]."_VALUE" => 'Да');
$res = CIBlockElement::GetList(
    Array("DATE_ACTIVE_FROM" => "ASC"), 
    $arFilter, 
    false, 
    false, 
    $arSelect
);
while($ob = $res->GetNextElement()){ 
    $arItem = $ob->GetFields();  
    $arItem["PROPERTIES"] = $ob->GetProperties();
    $arResult[] = $arItem;
}
$arParams['IS_AUTHORIZED'] = array_key_exists('IS_AUTHORIZED',$arParams) && $arParams['IS_AUTHORIZED'];
$rsUser = CUser::GetByID(1);
$arUser = $rsUser->Fetch();
$APPLICATION->SetTitle("Выбранных новостей - $count");
$this->includeComponentTemplate();
?>
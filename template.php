<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;?>
<?$order = array('sort' => 'asc');
$tmp = 'sort';
$rsUsers = CUser::GetList($order, $tmp);
$arData = [];
while($ob = $rsUsers->Fetch()){
    $arData[] = $ob;
}?>
<?$count = 0;?>
<?$curUser = $USER->GetID();?>
<?if ($USER->IsAuthorized()):?>
    <h2>Авторы и новости</h2>
<?else: echo "Данный раздел доступен только для авторизованных пользователей. Пожалуйста, зарегестрируйтесь или войдите в ваш профиль."?>
<?endif;?>        
<?foreach($arData as $groupID):?>
    <?if ($groupID["ID"] == $curUser): $group = $groupID[$arParams["UF_AUTHOR_TYPE"]];?>
    <?endif;?>
<?endforeach;?>
<?foreach($arData as $i):?> 
    <ul>
    <?if ($i[$arParams["UF_AUTHOR_TYPE"]] == $group && $i["ID"] != $curUser):?>
        <?$userID = $i["ID"];?>
            <li><?=$author = $i["LOGIN"];?>  
             <?foreach($arResult as $arItem):?>
                <?foreach($arItem["PROPERTIES"][$arParams["AUTHOR"]]["VALUE"] as $id):?>  
                    <?if ($id == $userID):?>  
                    <ul>
                        <?if (in_array($curUser, $arItem["PROPERTIES"][$arParams["AUTHOR"]]["VALUE"])):?> 
                             <?else:?><li><?=$arItem["NAME"]; $count++?></li> 
                        <?endif;?>
                    </ul>           
                    <?endif;?>
                <?endforeach;?>
            </li>
            <?endforeach;?>      
    <?endif;?>
    </ul>
<?endforeach;?>
<?$APPLICATION->SetTitle("Выбранных новостей - $count");?>
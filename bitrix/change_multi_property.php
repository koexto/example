<?php
/*
Обновление множественногго свойства с описанием полей элемента в инфоблоке, без необходимости указывать  все свойства (если в методе Update указать только одно свойство, то остальные обнулятся. SetPropertyValues поступает также)
*/
//https://i.imgur.com/kgUg2Ca.png
CModule::IncludeModule("iblock");
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_DETAILS");
$arFilter = Array(
	"IBLOCK_ID"=>2,
	"SECTION_ID"=>9,
	//"ID"=>[744, 745]
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

$updateList = [];
$pattern = '/;<\/li>/m';
$replacement = '; </li>';

while($ob = $res->fetch()){
	//print_r($ob);
	$changedDetails = [];
	//обход множественного свойства с описаниями
	for($i = 0; $i<count($ob['PROPERTY_DETAILS_VALUE']); $i++){
		$str = $ob['PROPERTY_DETAILS_VALUE'][$i];
		$changedDetails[] = [
			'VALUE' => preg_replace($pattern, $replacement, $str),
			'DESCRIPTION' => $ob['PROPERTY_DETAILS_DESCRIPTION'][$i]
		];
	}

	$updateList[] = [
		'ID'=>$ob['ID'],
		'NEW_DETAILS' =>$changedDetails,
		'OLD_DETAILS' => $ob['PROPERTY_DETAILS_VALUE'],
		'OLD_DESCRIP' => $ob['PROPERTY_DETAILS_DESCRIPTION']
	];
}
echo print_r($updateList, 1) . '</pre>';

$PROPERTY_VALUE = $updateList[0]['NEW_DETAILS'];

//обновляем свойство у элементов
foreach($updateList as $newDetail){
	CIBlockElement::SetPropertyValuesEx(
		$newDetail['ID'],
   		2,
   		['DETAILS' => $newDetail['NEW_DETAILS']]
	);
}









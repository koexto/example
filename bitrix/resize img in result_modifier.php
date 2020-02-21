<? //для is.by
$cp = $this->__component;

		$arImageSize = array('width' => 245, 'height' => 300);

		//echo '<pre>Modifier: ' . print_r($arResult, 1) . '</pre>';

		foreach ($arResult['ITEMS'] as $key => $Item) {
			$imgId = $Item['PREVIEW_PICTURE']['ID'];
			if (!$imgId) {
				$imgId = $Item['DETAIL_PICTURE']['ID'];
			}
			if (!$imgId) continue;
			$arResized = CFile::ResizeImageGet($imgId, $arImageSize, BX_RESIZE_IMAGE_PROPORTIONAL, true);
			if (is_object($cp) && $arResized) {
				$cp->arResult['ITEMS'][$key]['PICTURE'] = array_change_key_case($arResized, CASE_UPPER);
				unset($arResized, $imgId);
			}
		}
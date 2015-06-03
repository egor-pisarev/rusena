<?=str_replace('{{bestsellers}}',$this->render('_bestsellers',[
    'productsDataProvider'=>$productsDataProvider
]),$page->text)?>
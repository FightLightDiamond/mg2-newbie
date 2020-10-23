ui-component-listing.xml
```
<dataProvider class="Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider" name="casio_shop_shop_listing_data_source">
    <settings>
        <requestFieldName>id</requestFieldName>
        <primaryFieldName>shop_id</primaryFieldName>
    </settings>
</dataProvider>
```

di.xml
```
<preference for="Casio\Shop\Api\Data\ShopSearchResultsInterface" type="Magento\Framework\Api\SearchResults"/>
```

Magento\Framework\View\Element\UiComponent\DataProvider
```
protected function prepareUpdateUrl()
    {
        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }
        foreach ($this->data['config']['filter_url_params'] as $paramName => $paramValue) {
            if ('*' == $paramValue) {
                $paramValue = $this->request->getParam($paramName);
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s/',
                    $this->data['config']['update_url'],
                    $paramName,
                    $paramValue
                );
                $this->addFilter(
                    $this->filterBuilder->setField($paramName)->setValue($paramValue)->setConditionType('eq')->create()
                );
            }
        }
    }


protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        $arrItems = [];

        $arrItems['items'] = [];
        foreach ($searchResult->getItems() as $item) {
            $itemData = [];
            foreach ($item->getCustomAttributes() as $attribute) {
                $itemData[$attribute->getAttributeCode()] = $attribute->getValue();
            }
            $arrItems['items'][] = $itemData;
        }

        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        return $arrItems;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->searchResultToOutput($this->getSearchResult());
   
```

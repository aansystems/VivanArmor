<?php

namespace frontend\components;

use yii\base\Widget;

class CustomRssReader extends Widget {

    public $channel;
    public $itemView = 'item';
    public $pageSize = 20;
    public $wrapClass = 'rss-wrap';
    public $wrapTag = 'div';
    public $indexName = 'entry';

    public function run() {
        try {
            $items = [];
            $xml = simplexml_load_file($this->channel); // suppress errors if feed is invalid
            if ($xml === false) {
                return 'Error parsing feed source: ' . $this->channel;
            }
            foreach ($xml->channel->item as $item) {
                $items[] = $item;
            }
            \yii\helpers\ArrayHelper::multisort($items, function(\SimpleXMLElement $item) {
                return $item->published;
            }, SORT_ASC);
            return $this->render(
                            'wrap', [
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $items,
                            'pagination' => [
                                'pageSize' => $this->pageSize,
                            ],
                                ])
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}

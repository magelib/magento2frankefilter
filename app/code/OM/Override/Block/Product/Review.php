<?php

namespace OM\Override\Block\Product;

class Review extends \Magento\Review\Block\Product\Review
{
    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $title = $this->getCollectionSize()
            ? __('Rate & Review %1', '<span class="counter">' . $this->getCollectionSize() . '</span>')
            : __('Rate & Review %1', '<span class="counter">' . $this->getCollectionSize() . '</span>');
        $this->setTitle($title);
    }
}

?> 
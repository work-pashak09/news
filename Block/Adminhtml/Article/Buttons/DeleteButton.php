<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 07.09.18
 * Time: 13:35
 */

namespace Neklo\News\Block\Adminhtml\Article\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

class DeleteButton extends AbstractBaseButton
{
    const ADMIN_RESOURCE = 'Neklo_News::delete';

    private $Request;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\AuthorizationInterface $authorization,
        \Magento\Framework\App\Request\Http $Request)
    {
        parent::__construct($context, $registry, $authorization);
        $this->Request = $Request;
    }
    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {

        $id = $this->Request->getParam('id');
        $data  =[];
        if ($id && $this->isAllowed()) {
            $data = [
                'label' => __('Delete News'),
                'class' => 'del',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getUrl('*/*/del', ['id' => $id]) . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

}
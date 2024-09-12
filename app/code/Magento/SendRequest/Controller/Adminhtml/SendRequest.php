<?php

namespace Vendor\ModuleName\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\Client\Curl;

class SendRequest extends Action
{
    protected $curl;

    public function __construct(
        Action\Context $context,
        Curl $curl
    ) {
        $this->curl = $curl;
        parent::__construct($context);
    }

    public function execute()
    {
        $url = 'http://example.com/';

        $this->curl->get($url);

        // You can also send POST request if needed:
        // $this->curl->post($url, ['param1' => 'value1']);

        // Get response
        $response = $this->curl->getBody();

        // Log or process the response as needed
        $this->messageManager->addSuccessMessage(__('HTTP request sent successfully!'));

        // Redirect back to the admin page
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('admin/dashboard/index');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor_ModuleName::custom_menu');
    }
}

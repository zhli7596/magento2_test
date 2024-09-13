<?php
namespace Magento\SendRequest\Controller\Adminhtml\Sendrequest;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;      

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // Step 1: Initialize cURL
        $curl = curl_init();

        // Step 2: Set the cURL options
        curl_setopt($curl, CURLOPT_URL, "http://example.com");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // Follow redirects if any

        // Step 3: Execute the request
        $response = curl_exec($curl);

        // Step 4: Check for errors
        if ($response === false) {
            $error = curl_error($curl);
            $this->messageManager->addErrorMessage(__('cURL Error: %1', $error));
        } else {
            $this->messageManager->addSuccessMessage(__('Response from example.com: %1', $response));
        }

        // Step 5: Close the cURL session
        curl_close($curl);

        // Step 6: Render the result page
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_SendRequest::menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Demo Menu'));
        
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_SendRequest::menu');
    }
}

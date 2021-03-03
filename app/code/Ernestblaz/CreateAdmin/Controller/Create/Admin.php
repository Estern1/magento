<?php

namespace Ernestblaz\CreateAdmin\Controller\Create;

use Magento\Authorization\Model\Acl\Role\Group as RoleGroup;
use Magento\Authorization\Model\UserContextInterface;

class Admin extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\User\Model\UserFactory
     */
    private $_userFactory;
    /**
     * @var \Magento\Authorization\Model\RoleFactory
     */
    private $_roleFactory;
    /**
     * @var \Magento\Authorization\Model\RulesFactory
     */
    private $_rulesFactory;
    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    private $_resource;
    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $_dbConnection;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\User\Model\UserFactory $userFactory,
        \Magento\Authorization\Model\RoleFactory $roleFactory,
        \Magento\Authorization\Model\RulesFactory $rulesFactory,
        \Magento\Framework\App\ResourceConnection $resource
    ) {
        $this->_userFactory = $userFactory;
        $this->_roleFactory = $roleFactory;
        $this->_rulesFactory = $rulesFactory;
        $this->_resource = $resource;
        $this->_dbConnection = $this->_resource->getConnection();
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_dbConnection->beginTransaction();
        $role = $this->_roleFactory->create();
        $role->setName('Extra Manager')
            ->setPid(0)
            ->setRoleType(RoleGroup::ROLE_TYPE)
            ->setUserType(UserContextInterface::USER_TYPE_ADMIN);
        $role->save();

        $resource = ['Magento_Backend::admin',
            'Magento_Sales::sales',
            'Magento_Sales::create',
            'Magento_Sales::actions_view',
            'Magento_Sales::cancel'
        ];

        $this->_rulesFactory->create()->setRoleId($role->getId())->setResources($resource)->saveRel();

        $adminInfo = [
            'username'  => 'ernestblaz',
            'firstname' => 'ernest',
            'lastname'    => 'blaz',
            'email'     => 'ernestblaz@gmail.com',
            'password'  => 'admin123',
            'interface_locale' => 'en_US',
            'is_active' => 1
        ];

        $userModel = $this->_userFactory->create();
        $userModel->setData($adminInfo);
        $userModel->setRoleId($role->getId());
        try {
            $userModel->save();
            $this->_dbConnection->commit();
        } catch (\Exception $ex) {
            $this->_dbConnection->rollBack();
            $ex->getMessage();
        }
    }
}

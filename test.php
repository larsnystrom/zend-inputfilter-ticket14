<?php

require __DIR__ . '/vendor/autoload.php';

class MyFilter extends Zend\InputFilter\InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'field1',
            'required' => true,
            'validators' => [
                [
                    'name' => 'Zend\Validator\NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            'isEmpty' => "Field1 cannot be empty",
                        ],
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'field2',
            'required' => true,
            'validators' => [
                [
                    'name' => 'Zend\Validator\NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            'isEmpty' => "Field2 cannot be empty",
                        ],
                    ],
                ],
            ],
        ]);
    }
}

$app = Zend\Mvc\Application::init([
    'modules' => [
    ],

    'module_listener_options' => [
        'module_paths' => [
        ],

        'config_glob_paths' => [
        ],
    ],

    'input_filters' => [
        'invokables' => [
            'MyFilter' => 'MyFilter',
        ],
    ],
]);

$manager = $app->getServiceManager()->get('InputFilterManager');
$filter = $manager->get('MyFilter');

echo "\n";
echo "#------------------------------\n";
echo "# Test case 1\n";
echo "#------------------------------\n";
echo "\n";
$filter->setData([
]);

if (!$filter->isValid()) {
    var_dump($filter->getMessages());
}

echo "\n";
echo "#------------------------------\n";
echo "# Test case 2\n";
echo "#------------------------------\n";
echo "\n";
$filter->setData([
    'field1' => [
        'test',
    ],
]);

if (!$filter->isValid()) {
    var_dump($filter->getMessages());
}

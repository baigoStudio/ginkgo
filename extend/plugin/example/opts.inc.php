<?php return array(
    'text' => array(
        'type'      => 'text', //可选 text, textarea, select, radio（必须）
        'require'   => true, //最短（必须）
        'default'   => 100, //默认值（必须）
        'title'     => '文本框',
        'format'    => 'int', //可选 text, int, digit
        'note'      => '备注', //备注
    ),
    'textarea' => array(
        'type'      => 'textarea',
        'title'     => '文本域',
        'format'    => 'text',
        'default'   => '默认值',
    ),
    'select' => array(
        'type'      => 'select',
        'title'     => '下拉菜单',
        'require'   => true,
        'default'   => 'opt_1',
        'option'    => array(
            'opt_1' => '选项-1',
            'opt_2' => '选项-2',
            'opt_3' => '选项-3',
        ),
    ),
    'radio' => array(
        'type'       => 'radio',
        'title'      => '单选',
        'require'    => true,
        'default'    => 'opt_1',
        'option'     => array(
            'opt_1'  => array(
                'value'    => '选项-1',
                'note'     => '选项备注', //备注
            ),
            'opt_2'  => array(
                'value'    => '选项-2',
            ),
        ),
    ),
    'switch' => array(
        'type'       => 'switch',
        'title'      => '开关',
    ),
);

<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//在模块下单独配置
return [
    'view_replace_str' => [
        '__FONT__'=>'/static/admin/fonts',
        '__IMG__'=>'/static/admin/images',
        '__CSS__'=>'/static/admin/css',
        '__JS__'=>'/static/admin/js',
        '__UE__'=>'/static/admin/ueditor',
        
    ],
    'default_filter'         => 'htmlspecialchars',
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 8,
    ],
    
];

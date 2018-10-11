<?php

/**
 * 后台默认配置
 */
return [

    'title'      => 'R.Admin',

    'directory'  => app_path('Admin'),

    'route'      => [
        'prefix'     => 'admin',
        'middleware' => ['web', 'rulong'],
        'namespace'  => 'App\\Admin\\Controllers',
    ],

    'auth'       => [
        'guards'    => [
            'rulong' => [
                'driver'   => 'session',
                'provider' => 'rulong',
            ],
        ],

        'providers' => [
            'rulong' => [
                'driver' => 'eloquent',
                'model'  => RuLong\Panel\Models\Admin::class,
            ],
        ],
    ],

    'logs'       => [
        'enable' => true,
        'except' => [
            '/',
            'dashboard',
            'password',
            'logs*',
        ],
    ],
    'permission' => [
        'except' => [
            '/',
            'auth*',
            'dashboard',
            'password',
        ],
    ],

    'ueditor'    => [
        'imageActionName'         => 'uploadImage',
        'imageFieldName'          => 'upfile',
        'imageMaxSize'            => 2048000,
        'imageAllowFiles'         => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],
        'imageCompressEnable'     => true,
        'imageCompressBorder'     => 1600,
        'imageInsertAlign'        => 'none',
        'imageUrlPrefix'          => '',
        'imagePathFormat'         => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',

        /* 涂鸦图片上传配置项 */
        'scrawlActionName'        => 'uploadScrawl',
        'scrawlFieldName'         => 'upfile',
        'scrawlPathFormat'        => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
        'scrawlMaxSize'           => 2048000,
        'scrawlUrlPrefix'         => '',
        'scrawlInsertAlign'       => 'none',

        /* 截图工具上传 */
        'snapscreenActionName'    => 'uploadImage',
        'snapscreenPathFormat'    => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
        'snapscreenUrlPrefix'     => '',
        'snapscreenInsertAlign'   => 'none',

        /* 抓取远程图片配置 */
        'catcherActionName'       => 'catchImage',
        'catcherLocalDomain'      => [],
        'catcherFieldName'        => 'source',
        'catcherPathFormat'       => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
        'catcherUrlPrefix'        => '',
        'catcherMaxSize'          => 2048000,
        'catcherAllowFiles'       => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],

        /* 上传视频配置 */
        'videoActionName'         => 'uploadVideo',
        'videoFieldName'          => 'upfile',
        'videoPathFormat'         => '/uploads/videos/{yyyy}/{mm}/{dd}/{hash}',
        'videoUrlPrefix'          => '',
        'videoMaxSize'            => 102400000,
        'videoAllowFiles'         => [
            '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
            '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
        ],

        /* 上传文件配置 */
        'fileActionName'          => 'uploadFile',
        'fileFieldName'           => 'upfile',
        'filePathFormat'          => '/uploads/files/{yyyy}/{mm}/{dd}/{hash}',
        'fileUrlPrefix'           => '',
        'fileMaxSize'             => 51200000,
        'fileAllowFiles'          => [
            '.png', '.jpg', '.jpeg', '.gif', '.bmp',
            '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
            '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
            '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
            '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml',
        ],

        /* 列出指定目录下的图片 */
        'imageManagerActionName'  => 'listImage',
        'imageManagerListPath'    => '/uploads/images/',
        'imageManagerListSize'    => 20,
        'imageManagerUrlPrefix'   => '',
        'imageManagerInsertAlign' => 'none',
        'imageManagerAllowFiles'  => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],

        /* 列出指定目录下的文件 */
        'fileManagerActionName'   => 'listFile',
        'fileManagerListPath'     => '/uploads/files/',
        'fileManagerUrlPrefix'    => '',
        'fileManagerListSize'     => 20,
        'fileManagerAllowFiles'   => [
            '.png', '.jpg', '.jpeg', '.gif', '.bmp',
            '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
            '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
            '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
            '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml',
        ],
    ],
];

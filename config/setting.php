<?php
/*
* @link http://kodcloud.com/
* @author warlee | e-mail:kodcloud@qq.com
* @copyright warlee 2014.(Shanghai)Co.,Ltd
* @license http://kodcloud.com/tools/license/license.txt
*/

// header('Access-Control-Allow-Origin: *');    		// 允许的域名来源;
// header('Access-Control-Allow-Methods: *'); 			// 允许请求的类型
// header('Access-Control-Max-Age: 1800L'); 			// 缓存时间
// header('Access-Control-Allow-Credentials: true'); 	// 设置是否允许发送 cookies
// header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin, Authorization');
// header("X-Frame-Options: ALLOWALL");

//配置数据,可在setting_user.php中添加变量覆盖,升级后不会被替换
$config['settings'] = array( 
	'downloadUrlTime'	=> 0,			 	//下载地址生效时间，按秒计算，0代表不限制
	'apiLoginToken'		=> '',			 	//设定则认为开启服务端api通信登录，同时作为加密密匙
	'paramRewrite'		=> false,		 	//开启url 去除? 直接跟参数
	'ioAvailed'			=> 'local,ftp,oss,qiniu,cos,s3,oos,uss,minio,eos,eds,obs,jos',		//显示的io类型，多个以','分隔
	'ioFileOutServer'	=> false,
	'ioUploadServer'	=> false,
	
	'upload' => array(
		'chunkSize'			=> 0.5,			// MB 分片上传大小设定;需要小于php.ini上传限制的大小
		'threads'			=> 10,			// 上传并发数;部分低配服务器上传失败则将此设置为1
		'ignoreName'		=> '',			// 忽略的文件名,不区分大小写; 逗号隔开,例如: .DS_Store,Thumb.db
		'chunkRetry'		=> 2,			// 分片上传失败,重传次数;针对每个分片;
		'sendAsBinary'		=> 1,			// 以二进制方式上传;后端服务器以流php://input接收; 0则为传统方式上传 $_FILE;
		'httpSendFile'		=> false,		// 调用webserver下载 https://doc.kodcloud.com/v2/#/help/options
		
		'ignoreExt'			=> '',          // 限制的扩展名; 扩展名在该说明中则自动不上传;逗号隔开
		'allowExt'			=> '',			// 只允许扩展名列表; 设置值时不在设置中的文件自动不上传; 逗号隔开
		'downloadSpeed'		=> 0,			// 下载限速;MB/s*1024*1024; 0代表不限制		
		'ignoreFileSize'	=> 0,			// 允许单个文件上传最大值,0则不限制; 单位GB(float)
		
		// 图片上传压缩参数compress,默认配置不压缩,上传原图;
		// 可以配置参考: http://fex.baidu.com/webuploader/doc/index.html#WebUploader_Uploader_options
	),
	'fileEditLockTimeout' 	=> 1200,		// 文件编辑锁默认锁定最长时间;默认20分钟;超过了则自动解锁;
	'fileHistoryMax'		=> 500,			// 文件历史版本默认个数,免费版3个; 大于500则认为不限制
	'fileHistoryLocal'		=> 1,			// 本地文件是否开启历史版本;
	'uploadFileNumberMax'	=> 0,			// 单次批量上传文件个数上限, 0不限制
	'storeFileNumberMax'	=> 0,			// 外链分享转存文件个数上限, 0不限制
	'shareLinkSizeMax'		=> 0,			// 分享文件/文件夹最大大小限制; 0不限制; 单位GB(float)
	'unzipFileSizeMax'  	=> 0,			// 文件解压压缩包大小限制; 0-不限制; 单位GB(float)
	'zipFileSizeMax'  		=> 0,			// 文件(夹)压缩大小限制;   0-不限制; 单位GB(float)
	'groupCompany'			=> 0,			// 二级部门为子公司,独立部门;
	'shareLinkExpireTime'	=> 0,			// 外链分享过期时间，单位天（n天后过期）
	'userLoginLimit'		=> 5,			// 同一账号限制同时登录设备数;0=不限制;guest/admin不限制
	'pathShowUrlParam'		=> 0,			// 地址栏显示文件夹层级参数(默认不显示,仅移动端显示)
	'ioReadMax'				=> 1024*1024*30,// 文件读取最大长度;

	'staticPath'		=> APP_HOST."static/",	//静态文件目录,可以配置到cdn;
	'kodApiServer'		=> "https://api.kodcloud.com/?", //QQ微信登录/邮件发送/插件-列表等 
	'allowHeaderCookie' => '1',				// 允许header自定义传输cookie;
);
$config['settings']['searchContent'] 	= 1;		// 搜索:允许文件内容搜索
$config['settings']['searchMutil'] 		= 1;		// 搜索:开启批量搜索
$config['settings']['allowSEO'] 		= 1; 		// 允许SEO收录外链分享;
$config['settings']['systemBackup'] 	= 1; 		// 系统备份;
$config['settings']['bigFileForce'] 	= 0; 		// 32位时强制允许大文件上传; https://demo.kodcloud.com/#s/735psg0g 
$config['settings']['sysTempPath'] 		= TEMP_PATH;	// 系统临时目录，避免中转时data临时目录慢（如nfs挂载）
$config['settings']['sysTempFiles'] 	= TEMP_FILES;	// 系统临时文件目录
$config['settings']['fileViewLog'] 		= 0;			// 操作日志-文件预览

$config['pluginHome'] 					= 'https://kodcloud.com/';	// 插件主页
$config['APP_HOST_LINK'] 				= APP_HOST;	// 分享链接站点url; 可在setting_user中覆盖;
$config['PLUGIN_HOST'] 					= APP_HOST.str_replace(BASIC_PATH,'',PLUGIN_DIR);//插件url目录;
$config['PLUGIN_HOST_CDN_APP'] 			= '';//支持配置到cdn的插件; 插件名,逗号隔开;
$config['PLUGIN_HOST_CDN'] 				= $config['PLUGIN_HOST'];//在上面的配置插件中才使用此作为插件静态资源url;
$config['DEFAULT_PERRMISSIONS'] 		= 0755;
$config['DEFAULT_PERRMISSIONS_KOD'] 	= 0700; // 内部文件,nginx才能读写;
$config["GROUP_MEMBER_ALLOW_ALL"]		= 0; // 部门隔离时,是否允许其他用户访问;(开启后, 搜索部门,搜索成员不做过滤)

$config["ADMIN_ALLOW_USER_SAFE"]		= 0; // 是否允许系统管理员访问用户私密空间,默认关闭;ADMIN_ALLOW_SOURCE为0时无效;当有离职等情况需管理时可打开
$config["ADMIN_ALLOW_IO"] 				= 1; // 物理路径或io路径是否允许操作开关，仅限管理员(禁用后无法直接管理物理路径)
$config["ADMIN_ALLOW_SOURCE"] 			= 1; // 其他部门or用户目录操作开关，仅限管理员(是否能直接访问其他用户空间或部门空间)
$config["ADMIN_ALLOW_ALL_ACTION"] 		= 1; // 三权分立,限制系统管理员权限;关闭后系统管理员无法设置用户角色及部门权限(需配置[安全保密员及审计员角色])
$config["ADMIN_AUTH_LIMIT_PLUGINS"]		= 'adminer,webConsole';// 限制系统管理员权限时,同时限制插件列表;


// 存储类型名对应列表
$config['settings']['ioClassList'] = array(
	'local'				=> 'Local',
	'ftp'				=> 'FTP',
	'oss'				=> 'OSS',
	'qiniu'				=> 'Qiniu',
	'cos'				=> 'COS',
	's3'				=> 'S3',
	'oos'				=> 'OOS',
	'uss'				=> 'USS',
	'minio'				=> 'MinIO',
	'eos'				=> 'EOS',
	'eds'				=> 'EDS',
	'obs'				=> 'OBS',
	'jos'				=> 'JOS',
	// 'bos'				=> 'BOS',	// 未实现

	'moss'				=> 'MOSS',
	'nos'				=> 'NOS',
	'baidu'				=> 'Baidu',
	'onedrive'			=> 'OneDrive',

	'base'				=> 'Base',
	'bases3'			=> 'BaseS3',
	'db'				=> 'DB',
	'dbshareitem'		=> 'DbShareItem',
	'dbsharelink'		=> 'DbShareLink',
	'drivershareitem'	=> 'DriverShareItem',
	'driversharelink'	=> 'DriverShareLink',
	'stream'			=> 'Stream',
	'url'				=> 'Url',
);

// windows upload threads;兼容不支持并发的服务器
if($config['systemOS'] == 'windows'){
	$config['settings']['upload']['threads'] = 1;
}
// windows iis bin上传有限制
if(strstr($_SERVER['SERVER_SOFTWARE'],'-IIS')){
	$config['settings']['upload']['sendAsBinary'] = 0;
}

// 系统使用配置;
$config['systemOption'] = array(
	'favNumberMax'				=> 1000, 		// 收藏夹添加数量上限
	'tagNumberMax'				=> 1000, 		// 标签创建数量上限
	'tagContainMax'				=> 1000, 		// 标签中内容最大数

	'fileNameLengthMax'			=> 256, 		// 文件名最大长度
	'fileDescLengthMax'			=> 5000, 		// 文件描述最大长度
	'historyDescLengthMax'		=> 500, 		// 文件版本说明最大长度
	
	// 请求限制;
	'requestPerMinuteMax'  		=> 0,			// 每分钟最大请求数;0不限制; 推荐:600,300个则每秒5个,每5秒25个, 25个内小于5s
	'requestAllowPerMinuteMax' 	=> 0,			// 允许的接口每分钟最大请求数;0不限制;推荐:3000, 高频次接口(upload/mkdir/list)
	'userTaskAllowMax'			=> 0, 			// 每个用户允许的长任务个数;0不限制, 推荐50, 管理员不受限制; 占用独立进程;
	'systemListDriver'  		=> '1',			// 存储挂载,是否显示系统磁盘
);


// database/file/redis/memcached
$config['cache'] = array(
	'sessionType'	=> 'file',	//缓存方式 database/file/redis/memcached
	'sessionTime'	=> 3600*4,	//session失效时间 
    'cacheType'		=> 'file',	//缓存方式 database/file/redis/memcached
	'lockTimeout'	=> 20,		//并发锁获取超时时间 20s;
	'cacheTime'		=> 3600*5,	//缓存默认时间;
	    
    'file'	=> array('path' => TEMP_PATH.'_cache/'),
    'redis' => array(
        'host' => '127.0.0.1',
		'port' => 6379,
		// 'timeout'  => 20, 		// 连接超时时间
		// 'auth' 	  => '',  		// 密码
		// 'pconnect' => true,  	// 是否持久链接;
		// 'server'   => array('10.10.10.1:8001','10.10.10.2:8001'), //集群方式连接;有则忽略host/port
		// 'mode'	  => 'slave',	// slave、sentinel(暂不支持)、cluster
		// 'db'		  => 0,			// 选择数据库; 默认0, db0~15
    ),
    'memcached' => array(
        'host' 	   => '127.0.0.1',
		'port' 	   => 11211,
		// 'server'=> array('10.10.10.1:8001','10.10.10.2:8001'), // 集群方式连接;有则忽略host/port
    ),
);
$config['databaseDefault'] = array(
	/* 数据库设置 */
	'DB_TYPE'               => 'mysql',     // 数据库类型 mysql,mysqli,sqlite,pdo(mysql/sqlite); //pgsql,mssql
	'DB_HOST'               => '127.0.0.1', // 服务器地址
	'DB_NAME'               => '',          // 数据库名
	'DB_USER'               => '',      	// 用户名
	'DB_PWD'                => '',          // 密码
	'DB_PORT'               => '',        	// 端口
	
	'DB_PREFIX'             => '',    		// 数据库表前缀
	'DB_CHARSET'            => 'utf8',      // 数据库编码默认采用utf8
	'DB_SQL_LOG'            => false,		// SQL执行错误日志记录	
	'DB_FIELDS_CACHE'       => false,		// 启用字段缓存
	'DB_SQL_BUILD_CACHE'    => false, 		// 数据库查询的SQL创建缓存

	// 数据库集群模式配置;
	'DB_DEPLOY_TYPE'        => 0, 			// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	'DB_RW_SEPARATE'        => false,       // 数据库读写是否分离 主从式有效
	'DB_MASTER_NUM'         => 1, 			// 读写分离后 主服务器数量
	'DB_SLAVE_NO'           => '', 			// 指定从服务器序号; 开启集群和主从分离,默认host第一个为master;
	
	
	/* 主从分离,一主多从集群;
	'DB_TYPE'               => 'mysql',
	'DB_HOST'               => '10.10.10.1,10.10.10.2', // 多个数据服务器;
	'DB_NAME'               => 'db1,db2',           	// 全都一样则一个;否则和host的server个数一致,逗号隔开;
	'DB_USER'               => 'user',      			// 同上
	'DB_PWD'                => 'passowrd',       		// 同上
	'DB_PORT'               => '3306',      			// 同上
	
	'DB_DEPLOY_TYPE'        => 1,		//集群模式
	'DB_RW_SEPARATE'        => true,	//读写分离;为false则无差别随机读写
	'DB_MASTER_NUM'         => 1,
	'DB_SLAVE_NO'           => '',
	*/
);

$config['settings']['appType'] = array(
	array('type' => 'tools','name' => 'explorer.app.groupTools','class' => 'ri-tools-fill'),
	array('type' => 'game','name' => 'explorer.app.groupGame','class' => 'ri-gamepad-fill'),
	array('type' => 'movie','name' => 'explorer.app.groupMovie','class' => 'ri-film-line'),
	array('type' => 'music','name' => 'explorer.app.groupMusic','class' => 'ri-music-fill-2'),
	array('type' => 'life','name' => 'explorer.app.groupLife','class' => 'ri-map-pin-fill-2'),
	array('type' => 'others','name' => 'common.others','class' => 'ri-more-fill'),
);
$config['defaultPlugins'] = array(
	'adminer','DPlayer','jPlayer','photoSwipe','picasa','pdfjs','htmlEditor',
	'simpleClock','client','webodf','webdav','toolsCommon','oauth','fileThumb',
	'officeViewer','msgWarning','storeImport'
);

//初始化系统配置
$config['settingSystemDefault'] = array(
	'systemPassword'	=> rand_string(20),
	'systemName'		=> "kodbox",
	'systemDesc'		=> "——可道云.资源管理器",
	'systemNameType' 	=> 'text',// image/text
	'systemLogo' 		=> './static/images/common/logo.png',
	'systemLogoMenu' 	=> './static/images/common/logo-kod.png',
	'adminTheme' 		=> 'black',// black/white 
	
	'pathHidden'		=> "Thumb.db,.DS_Store,.gitignore,.git",//目录列表隐藏的项
	'autoLogin'			=> "0",			// 是否自动登录；登录用户为guest
	'needCheckCode'		=> "0",			// 登录是否开启验证码；默认关闭
	'firstIn'			=> "explorer",	// 登录后默认进入[explorer desktop]
	// 'regist'			=> "",
	'globalIcp'			=> "",
	'globalCss'			=> "",
	'globalHtml'		=> "",

	'newUserApp'		=> "高德地图,icloud",
	'newUserFolder'		=> "我的文档,我的图片,我的音乐",
	'newGroupFolder'	=> "共享资源,文档,其他",	// 新建分组默认建立文件夹
	'groupRootName'		=> '企业网盘',				// 企业组织架构根节点
	
	'versionType'		=> "A",			// 版本
	'rootListUser'		=> 0,			// 组织架构根节点展示群组内用户
	'rootListGroup'		=> 0,			// 组织架构根节点展示子群组
	'groupAuthOuther'   => 1, 			// 子部门网盘文档可授权给外部部门或成员,
	'currentVersion'	=> KOD_VERSION, // 当前版本
	'orderSort'         => 'desc',      // sort字段排序方式;默认从大到小
	'dateFormat'		=> 'Y-m-d',		// 默认 Y-m-d:YYYY-MM-DD; d/m/Y:DD/MM/YYYY; m/d/Y:MM/DD/YYYY; 
										// https://en.wikipedia.org/wiki/Date_format_by_country

	'fileEncryption'	=> 'keepName',	// all-全加密;keepExt-加密文件名保留扩展名;keepName-不加密;
	'passwordErrorLock'	=> '1',			// 密码连续错误锁定账号开关; 某账号连续输入5次后锁定30s后才能登录;
	'passwordLockNumber'=> '5',			// 密码连续错误允许次数;
	'passwordLockTime'	=> '60',		// 密码连续错误锁定时间;
	
	'passwordRule'		=> 'strongMore',// 限制密码强度;none-不限制;strong-中等强度;strongMore-高强度
	'loginCheckAllow'	=> '',			// 登录限制
	'csrfProtect'		=> '1',		 	// 开启csrf保护	
	'downloadZipClient' => '1',			// 开启前端打包压缩下载(需要能够链接外网,或https);
	'downloadZipLimit'	=> '0',			// 文件夹打包下载限制,默认为0, 0为不限制; 为避免服务器性能消耗过大,文件夹过大时限制打包下载
	'dragDownload'		=> '1',			// 拖拽出浏览器,自动下载(仅Chrome内核浏览器支持; edge,360...)
	'dragDownloadZip'	=> '0',			// 是否允许多个或文件夹拖拽下载(压缩后下载. 由于没有进度,无法取消,故默认关闭)
	'dragDownloadLimit'	=> 20,			// MB;拖拽下载文件大小限制; 为0则不限制;(压缩后下载, 由于没有进度,无法取消,故设置较低)	
	
	'showFileLink'		=> '1',			// 文件外链展示开关;默认开启; (关闭后,文件属性不再显示外链连接)
	'showFileMd5'		=> '1',			// 文件md5是否展示; 默认开启; (关闭后,文件属性不再显示文件md5)
	'systemRecycleOpen' => '0',			// 系统回收站开启关闭;
	'systemRecycleClear'=> '180',		// 系统回收站自动清除,N天以前内容;
	'systemBackup'		=> '1',			// 文档自动备份;
	'groupTagAllow' 	=> '0',			// 是否启用部门公共标签
	'groupSpaceLimit'	=> '0',			// 部门网盘层级限制; 超过部门的层级不显示部门网盘
	'groupSpaceLimitLevel'=> '5',		// 部门网盘层级,指定层级,默认超过5层不显示部门网盘; >=1;
	'pathSafeSpaceEnable' => '1',		// 1|0, 全局开启关闭[私密保险箱]
	
	// 分享相关设置;
	'shareToMeAllowTree'=> '1',			// 分享给我的内容支持按部门组织架构或用户进行分类
	'shareLinkAllow'	=> '1',			// 启用/禁用外链分享;
	'shareLinkZip'		=> '1',			// 外链分享,开启关闭文件夹打包下载; 默认开启
	'shareLinkPasswordAllowEmpty'	=> '1',		// 外链分享允许密码为空,关闭后将强制设置密码;
	'shareLinkAllowGuest'			=> '1',		// 外链分享允许未登录游客访问
	'shareLinkUserDisableSkip'		=> '1',		// 账号被禁用时,屏蔽该用户的外链分享
	'shareLinkAllowEdit'			=> '1',		// 外链允许允许启用编辑
	'desktopAppDisable'				=> '',		// 桌面默认快捷方式入口隐藏项;
	
	
	'treeOpen'			=> 'my,myFav,myGroup,rootGroup,recentDoc,fileType,fileTag,driver',//树目录开启功能;
	'groupListChild'	=> '1',//罗列子部门; 0=不罗列;1=全部罗列;2=仅树目录罗列;
	'groupRootListChild'=> '1',
	'wallpageDesktop'	=> "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17",
	'wallpageLogin'		=> "2,3,6,8,9,11,12,16,17",
	'emailType'			=> "0",			// 邮件方式
	'email'				=> "",			// 自定义邮箱服务器配置信息
	
	'sourceSecret'			=> '0',
	'sourceSecretSetUser'	=> '',
	'sourceSecretMaxID'		=> '0',
	'sourceSecretList'		=> '[{"id":"","title":"A-绝密","style":"#E64A19","auth":""},{"id":"","title":"B-机密","style":"#FF5722","auth":""},{"id":"","title":"C-秘密","style":"#E57754","auth":""}]',
	
	'regist'			=> array(			// 用户注册
		"openRegist"		=> "0",			// 开放注册
		"checkRegist" 		=> "0",			// 注册审核
		"sizeMax" 			=> "0",			// 默认空间大小
		"roleID" 			=> "",			// 默认角色
		"groupInfo" 		=> '{"1":""}',	// 默认部门
		"allowPhone"		=> "1",			// 允许手机号绑定,找回密码;
	),
	'allowNickNameRpt'	=> false,			// 允许用户昵称重复
	'menu'	=> array(		//初始化默认菜单配置
		array('name'=>'desktop','type'=>'system','url'=>'desktop','target'=>'_self','use'=>'1'),
		array('name'=>'explorer','type'=>'system','url'=>'explorer','target'=>'_self','use'=>'1'),
		array('name'=>'editor','type'=>'','url'=>'editor','target'=>'_self','use'=>'0'),
		array('name'=>'官网','url'=>'https://kodcloud.com',"icon"=>"ri-home-line-3",'target'=>'inline','use'=>'1')
	),
);
$config['settingSystemDefault']['searchFulltext'] = 0;			// like%% 转为match (fulltext索引字段)
$config['settingSystemDefault']['searchNumberUseLike']  = 0;	// 开启全文搜索时, 搜为纯数字则使用like(ngram,match纯数字会很慢)
$config['settingSystemDefault']['searchFulltextForce']  = 0;	// 完整匹配; (否则会对$words进行分词,包含一部分也作为结果;会多出结果) 
$config['settingSystemDefault']['searchFulltextInnodb'] = 0;	// 是否为innodb 


//新用户初始化默认配置
$config['settingDefault'] = array(
	'listType'			=> "icon",		// list||icon||split
	'listSortField'		=> "name",		// name||size||ext||mtime
	'listSortOrder'		=> "up",		// asc||desc
	'fileIconSize'		=> "80",		// 图标大小
	'fileOpenClick'		=> 'dbclick',	// 打开文件方式 dbclick|click; 双击|单击;
	'fileShowDesc'		=> '0',			// 图标模式显示文件夹文件详情(大小,文件夹包含子内容数)
	'fileShowRename'	=> '1',			// 文件名后显示重命名按钮
	'animateOpen'		=> "1",			// dialog动画
	'soundOpen'			=> "0",			// 操作音效
	'theme'				=> "auto",		// 'light','dark-mode','auto'
	'themeImage' 		=> "",			// url/wallpage/css
	'wall'				=> "4",			// wall picture
	'listTypeKeep'		=> '1',			// 1|0, 为每个文件夹选择视图模式，或对所有文件夹使用相同的视图模式
	'listSortKeep'		=> '1',			// 1|0, 为每个文件夹配置列排序顺序，或对所有文件夹使用相同的顺序
	'menuBarAutoHide'	=> '0',			// 1|0, 左侧菜单栏自动显示和隐藏
	'pathSafeSpaceShow' => '1',			// 1|0, 个人空间根目录显示隐藏-私密保险箱
	
	"themeStyle"		=> 'theme-windows',	// 主题样式; theme-windows/theme-mac;
	"fileRepeat"		=> "replace",	// rename,replace,skip
	"recycleOpen"		=> "1",			// 1 | 0 代表是否开启
	'kodAppDefault'		=> '',			// 
	"fileIconSizeDesktop"=> '70',		// 桌面图标大小
	"fileIconSizePhoto" => '120',		// 相册模式图片大小
	'photoConfig'		=> '',			// 相册配置
	'resizeConfig'		=> 
		'{"filename":250,"filetype":80,"filesize":80,"filetime":215,"editorTreeWidth":220,"explorerTreeWidth":220}',
	'imageThumb'		=> '1',
	'fileSelect'		=> '1',
	'displayHideFile'	=> '0',
	'filePanel'			=> '1',
	'shareToMeShowType' => 'list',
	'messageSendType'	=> 'enter', //enter,ctrlEnter
	'loginDevice'		=> '',
);
$config['editorDefault'] = array(
	'fontSize'		=> '14px',
	'theme'			=> 'tomorrow',
	'autoWrap'		=> '1',		//自适应宽度换行
	'autoComplete'	=> '1',
	'functionList' 	=> '1',
	"tabSize"		=> '4',
	"softTab"		=> '1',
	"displayChar"	=> '0',		//是否显示特殊字符
	"fontFamily"	=> "Menlo",	//字体
	"keyboardType"	=> "ace",	//ace vim emacs
	"autoSave"		=> '0',		//自动保存
);

// 多语言; 在user/view/parseMetaLang中替换; meta.[key] 为多语言key;
$config['settings']['sourceMeta'] = array(
	'configItem'	=> array(
		'defaultShow'	=> 'user_sourceAlias,user_sourceCover', 					 	//默认显示的key;
		'fileAllow'		=> 'user_sourceAlias,user_sourceCover,user_sourceNumber,user_sourceParticipant', //文件支持的key
		'folderAllow'	=> 'user_sourceAlias,user_sourceCover,user_sourceParticipant',					//文件夹支持的key
	),
	'user_sourceAlias' => array(
		"type"		=> "fileSelect",
		"value"		=> "",
		"display" 	=> "关联文件(附件)",
		"info"		=> array(
			"single"	=> false,			// 单选or多选; true/false
			"type"		=> "all", 			// 文件or文件夹选择; file|folder|all
			"makeUrl"	=> false,			// 生成永久外链,
			"valueKey"	=> "path", 			// 取结果中的key
			"valueShowKey"	=> 'name',		// 显示名称;
			"title"		=> "关联文件(附件)", // 对话框标题;		
			"authCheck"	=> "read",			// read,write或空;默认为可写入;
		),
	),
	'user_sourceCover' => array(
		"type"		=> "fileSelect",
		"value"		=> "",
		"display" 	=> "文档封面",
		"info"		=> array(
			"single"	=> true,			// 单选or多选; true/false
			"type"		=> "file", 			// 文件or文件夹选择; file|folder|all
			"makeUrl"	=> true,			// 生成永久外链,
			"valueKey"	=> "downloadPath", 	// 取结果中的key
			"valueShowKey"	=> 'name',		// 显示名称;
			"title"		=> "文档封面", 		 // 对话框标题;		
			"authCheck"	=> "read",			// read,write或空;默认为可写入;
		),
	),
	
	//扩展;
	'user_sourceNumber' => array(
		"type"		=> "input",
		"value"		=> "",
		"display" 	=> "宗卷编号",
	),
	//扩展;
	'user_sourceParticipant' => array(
		"type"		=> "user",
		"value"		=> "",
		"display" 	=> "参与者",
		"selectType"=> "mutil",
	),
);

// name优先识别为多语言key,不存在则以name为原名;
$config['settings']['userDefaultTag'] = array(
	array('name'=>"explorer.tag.default1",'style'=>'label-blue-normal'),
	array('name'=>'explorer.tag.default2','style'=>'label-red-normal'),
	array('name'=>'explorer.tag.default3','style'=>'label-yellow-normal'),
	array('name'=>"common.others",'style'=>'label-green-normal'),
);


/**
 * 文档类型筛选
 * name多语言: explorer.type.[type] 存在则使用该key;否则使用默认name;
 */
$config['documentType'] = array(
	"doc" => array(
		"name"		=> '文档',	//file-type: file-type-doc
		"ext"		=> "txt,md,pdf,ofd,doc,docx,xls,xlsx,ppt,pptx,xps,pps,ppsx,ods,odt,odp,docm,dot,dotm,xlsb,xlsm,mht,djvu,wps,dpt,csv,et,ett,pages,numbers,key,dotx,vsd,vsdx,mpp",
	),
	"image" => array(
		"name"		=> '图片',
		"ext"		=> "jpg,jpeg,png,gif,bmp,ico,svg,webp,tif,tiff,cdr,svgz,xbm,eps,pjepg,heic,raw,psd,ai",
	),	
	"music" => array(
		"name"		=> '音乐',
		"ext"		=> "mp3,wav,wma,m4a,ogg,omf,amr,aa3,flac,aac,cda,aif,aiff,mid,ra,ape",
	),
	"movie" => array(
		"name"		=> '视频',
		"ext"		=> "mp4,flv,rm,rmvb,avi,mkv,mov,f4v,mpeg,mpg,vob,wmv,ogv,webm,3gp,mts,m2ts,m4v,mpe,3g2,asf,dat,asx,wvx,mpa",
	),
	"zip" => array(
		"name"		=> '压缩包',
		"ext"		=> "zip,gz,rar,iso,tar,7z,gz,ar,bz,bz2,xz,arj",
	),
	"others" => array(
		"name"		=> '其他',
		"ext"		=> "",
	),
	// "psd" => array("name" => '设计稿',"ext"=> "psd,ai"),
);

// 多选项总配置	
// http://blog.sina.com.cn/s/blog_7981f91f01012wm7.html
// http://monsoongale.iteye.com/blog/1044431
$config['settingAll'] = array(
	'language' => array(
		"zh-CN"	=>	array("简体中文","简体中文","Simplified Chinese"),
		"zh-TW"	=>	array("繁體中文","繁體中文","Traditional Chinese"),
		"en"	=>	array("English","英语","English"),
		"ar"	=>	array("العربية","'阿拉伯语","Arabic"),
		"bn"	=>	array("বাংলা","孟加拉语","Bengali"),
		"de"	=>	array("Deutsch","德语","German"),
		"es"	=>	array("Español","西班牙语","Spanish"),
		"fr"	=>	array("Français","法语","French"),
		"hi"	=>	array("हिन्दी","印地语","Hindi"),
		"id"	=>	array("Bahasa Indonesia","印尼语","Indonesian"),
		"it"	=>	array("Italiano","意大利语","Italian"),
		"ja"	=>	array("日本語","日语","Japanese"),	// jp
		"ko"	=>	array("한국어","韩语","Korean"),	 // kr
		"pl"	=>	array("Polski","波兰语","Polish"),
		"pt"	=>	array("Português","葡萄牙语","Portuguese"),
		"ru"	=>	array("Русский язык","俄语","Russian"),
		"ta"	=>	array("த‌மிழ்","泰米尔语","Tamil"),
		"th"	=>	array("ภาษาไทย","泰语","Thai"),
		"tr"	=>	array("Türkçe","土耳其语","Turkish"),
		"uk"	=>	array("Українська","乌克兰语","Ukrainian",'uk'),//ua,
		"vi"	=>	array("Tiếng Việt","越南语","Vietnamese",'vn'),// 3=国旗icon
	),//de el fi fr nl pt	d/m/Y H:i
	
	'theme'		=> "mac,win10,win7,metro,metro_green,metro_purple,metro_pink,metro_orange,alpha_image,alpha_image_sun,alpha_image_sky,diy",
	'codeTheme'	=> "chrome,clouds,crimson_editor,eclipse,github,kuroir,solarized_light,tomorrow,xcode,gruvbox_light_hard,cloud9_day,ambiance,monokai,idle_fingers,pastel_on_dark,solarized_dark,twilight,tomorrow_night_blue,tomorrow_night_eighties,github_dark,cloud9_night,gruvbox_dark_hard",
	'codeFont'	=> 'Source Code Pro,Consolas,Courier,DejaVu Sans Mono,Liberation Mono,Menlo,Monaco,Monospace',
);

I18n::init();$lang = I18n::$langType;
if($lang != 'zh-CN' && $lang != 'zh-CN'){
	$config['settingSystemDefault']['systemDesc'] = './static/images/common/logo-en.png';
	$config['settingSystemDefault']['systemDesc'] = "—— kodbox.explorer";
	$config['settingSystemDefault']['newUserApp'] = "trello,icloud";
	$config['settingSystemDefault']['newUserFolder']  = "Documents,Pictures,Music";
	$config['settingSystemDefault']['newGroupFolder'] = "Documents,Pictures,Others";
	$config['settingSystemDefault']['groupRootName']  = "Group";
	$config['settingSystemDefault']['sourceSecretList']  = '[{"id":"","title":"A-Secret","style":"#E64A19","auth":""},{"id":"","title":"B-Secret","style":"#FF5722","auth":""},{"id":"","title":"C-Secret","style":"#E57754","auth":""}]';
	$config['settingSystemDefault']['menu'][3]['name']  = 'kodcloud';
	
	$config['settings']['sourceMeta']['user_sourceAlias']['display'] = "Attachments";
	$config['settings']['sourceMeta']['user_sourceAlias']['info']['title'] = "Attachments";
	$config['settings']['sourceMeta']['user_sourceNumber']['display'] = "Number";
	$config['settings']['sourceMeta']['user_sourceParticipant']['display'] = "Participant";
}
I18n::set(array(
	'common.iconApp' => 'images/icon/icon_512.png',
	'common.iconFav' => 'images/icon/fav.png',
));

/**
 * 无需登录检测权限检测配置;
 * 大小写无关；统一转为小写进行了判断
 * 
 * 支持：通配和全配；模块.控制器.方法;
 * user.* 			 代表user模块下所有控制器
 * user.index.*  	 代表user模块下index控制器
 * user.index.login  代表user模块下index控制器的login方法；
 */
$config['authNotNeedLogin'] = array(
	'user.index.*',
	'user.bind.*',
	'user.sso.*',
	'user.regist.*',
	'user.view.*',
	'explorer.share.*',
	'sitemap.*',
	'install.*',			// 安装/更新
	'plugin.*',				// 插件排除，权限单独检测;
	'comment.index.listData',// 评论列表,权限在对应业务中自行判断;
	'comment.index.listChildren','comment.index.test'
);

/**
 * 用户可以访问的方法白名单，不需要用户角色身份检测;需要全部配置
 * $authAllowAction和$roleAction中包含的内容;不在定义中的一律不允许访问；
 */
$config['authAllowAction'] = array(
	'explorer.tag.get',
	'explorer.fav.get',
	'explorer.index.pathInfo',
	'explorer.lightApp.get',
	'explorer.list.path','explorer.list.listAll',
	'explorer.index.desktopApp',
	'explorer.userShare.get',
	'explorer.userShare.myShare',
	'explorer.userShare.shareDisplay',
	
	'explorer.tagGroup.get','explorer.tagGroup.set',
	'explorer.tagGroup.filesRemoveFromTag','explorer.tagGroup.filesAddToTag',

	'user.setting.notice','user.setting.userLoginList',
	'user.setting.taskList','user.setting.taskKillAll','user.setting.taskAction',
	'user.setting.userChart','user.setting.userLog','user.setting.userDevice',
	
	//临时，搜索分享中使用; 设置用户权限or设置用户部门；
	'admin.role.get','admin.job.get','admin.auth.get',
	'admin.member.get','admin.member.getByID','admin.member.search',
	'admin.group.get','admin.group.getByID','admin.group.search',
);//explorer/attachment/upload

/**
 * 角色：拦截点对应的控制器方法；
 * key为角色权限；value为数组 key(控制器)=>value(对应到方法，多个用逗号隔开)
 */
$config['authRoleAction']= array(
	'explorer.add'			=> array('explorer.index'=>'mkdir,mkfile'),
	'explorer.upload'		=> array(
		'explorer.upload'	=> 'fileUpload',
		'explorer.attachment'=>'upload',
	),
	'explorer.view'			=> array(
		'explorer.index'	=> 'fileOut,unzipList,fileOutBy,pathLog',
		'explorer.editor'	=> 'fileGet',
		'explorer.fileView'	=> 'index,open',
	),
	'explorer.download'		=> array('explorer.index'=>'fileDownload,zipDownload,fileDownloadRemove'),
	'explorer.share'		=> array('explorer.userShare'=>'add,edit,del'),
	'explorer.shareLink'	=> array('explorer.userShare'=>'add,edit,del'),
	'explorer.remove'		=> array('explorer.index'=>'pathDelete,recycleDelete,recycleRestore'),
	'explorer.edit'			=> array(
		'explorer.userShareTarget' => 'save',
		'explorer.index'	=> 'setDesc,setMeta,setAuth,fileSave,pathRename,zip,unzip',
		'explorer.editor'	=> 'fileSave',
		'explorer.listSafe' => 'action',
		'explorer.history'	=> 'get,remove,clear,rollback,setDetail,fileOut',
		'comment.index'		=> 'listData,add,remove,prasise,listByUser,listChildren'
	),
	'explorer.move'			=> array('explorer.index'=>'pathCopy,pathCute,pathCopyTo,pathCuteTo,pathPast,clipboard'),
	'explorer.serverDownload'=> array('explorer.upload'=>'serverDownload'),
	'explorer.search'		=> array(''),
	'explorer.unzip'		=> array('explorer.index'=>'unzip,unzipList'),
	'explorer.zip'			=> array('explorer.index'=>'zip,zipDownload'),

	'user.edit'				=> array(
		'user.setting'		=> 'setConfig,setUserInfo,setHeadImage,uploadHeadImage,userLogoutSet',
	),
	'user.fav' 				=> array(
		'explorer.fav'		=> 'add,rename,moveTop,moveBottom,del',
		'explorer.tag'		=> 'add,edit,remove,moveTop,moveBottom,resetSort,filesAddToTag,filesRemoveFromTag',
	),
	
	'admin.index.dashboard'	=> array('admin.analysis'=>'option,table,chart,trend'),
	'admin.index.setting'	=> array(
		'admin.setting'		=> 'get,set,clearCache,phpInfo',
		'admin.notice'		=> 'get,add,edit,remove,sort,enable',
	),
	'admin.index.loginLog'	=> array('admin.log'=>'loginLogList'),
	'admin.index.log'		=> array('admin.log'=>'get,typelist'),
	'admin.index.server'	=> array('admin.setting'=>'server'),

	'admin.role.list'		=> array('admin.role'=>'get'),
	'admin.role.edit'		=> array('admin.role'=>'add,edit,remove,sort'),
	'admin.job.list'		=> array('admin.job'=>'get'),
	'admin.job.edit'		=> array('admin.job'=>'add,edit,remove,sort'),

	'admin.member.list'		=> array(
		'admin.member' 		=> 'get,getByID,search',
		'admin.group' 		=> 'get,getByID,search'
	),
	'admin.member.userEdit'	=> array('admin.member'=>'add,edit,remove,status,addGroup,removeGroup,switchGroup'),
	'admin.member.userAuth'	=> array('admin.member'=>'add,edit,remove,status,addGroup,removeGroup,switchGroup'),
	'admin.member.groupEdit'=> array('admin.group'=>'add,edit,status,sort,remove,switchGroup'),
	
	'admin.auth.list'		=> array('admin.auth'=>'get'),
	'admin.auth.edit'		=> array('admin.auth'=>'add,edit,remove,sort'),
	
	//插件管理；轻应用归属到插件；
	'admin.plugin.list'		=> array('admin.plugin'=>'appList'),
	'admin.plugin.edit'		=> array(
		'admin.plugin'		=> 'getConfig,setConfig,changeStatus,install,unInstall',
		'explorer.lightApp'	=> 'add,edit,del'
	),

	'admin.storage.list'	=> array('admin.storage'=>'get'),
	'admin.storage.edit'	=> array(
		'admin.storage'		=> 'getConfig,add,edit,remove',
		'admin.backup'		=> 'config,get,remove'
	),

	'admin.autoTask.list'	=> array('admin.autoTask'=>'get'),
	'admin.autoTask.edit'	=> array('admin.autoTask'=>'add,edit,enable,remove,run,taskStart,taskRun,taskRunEvent'),
);

// 权限允许true值覆盖;
$config['authRoleActionKeepTrue'] = array(
	'explorer.share','explorer.shareLink',
	'admin.member.userEdit','admin.member.userAuth'
);

if (file_exists(BASIC_PATH.'config/setting_user.php')) {
	include_once(BASIC_PATH.'config/setting_user.php');
}
if (file_exists(BASIC_PATH.'config/setting_user_more.php')) {
	include_once(BASIC_PATH.'config/setting_user_more.php');
}
if(!defined('INSTALL_CHANNEL')){define('INSTALL_CHANNEL','');}


function logDebug($log,$data=''){
	// if(ACT == 'fileUpload'){return;}
	// if(!defined('USER_ID') || USER_ID != '1122'){return;}
	if(is_object($data) || is_array($data)){
		$data = json_encode_force($data);
		$data = ' '.str_replace(array('\\n','\\r','\\t','\\"','\\\'','\/'),array("\n","\r","\t",'"',"'",'/'),$data);
	}
	write_log('id-'.REQUEST_ID.'; '.$log.$data,'debug');
}
if(GLOBAL_DEBUG_LOG_ALL){
	Hook::bind('globalRequestBefore','writeLogStart');
	Hook::bind('show_json','writeLogAll');
	Hook::bind('beforeShutdown','writeLogAll');
	Hook::bind('globalRequestAfter','writeLogAllAfter');
}
function writeLogStart(){
	$count = Cache::get('total-request');if(!$count){$count=0;}
	Cache::set('total-request',$count+1);
	logDebug('start;queue= '.($count+1),array("in"=>$_REQUEST,'ua'=>$_SERVER['HTTP_USER_AGENT']));
}
function writeLogAll($data=false){
	$caller = get_caller_info();
	if($data === false){return logDebug('end-log;beforeShutdown');}
	if($data && is_array($data['data'])){$data['data'] = '[]...';}
	logDebug('end-out',array('out'=>$data,'call'=>$caller));
	// logDebug('end-out',array('out'=>$data,'call'=>$caller,'trace'=>think_trace('[trace]')));
}
function writeLogAllAfter(){
	$count  = Cache::get('total-request');if(!$count){$count=1;}
	Cache::set('total-request',$count-1,600);
	logDebug('end-all;queue= '.($count-1).';time-use='.sprintf('%.4f s',mtime() - TIME_FLOAT));
}
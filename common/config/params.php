<?php
return [
    'adminEmail' => 'rwandaguide@rwandaguide.info',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    //Get images from S3
    's3_bucket' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/',
    's3_place_object' => 'uploads/places/',
    's3_post_object' => 'uploads/posts/',
    's3_event_object' => 'uploads/events/',




    //Google API Console
    'GOOGLE_MAP_API_KEY'=>'AIzaSyBbPGik7q6wMLnQKWXwh5Q9MMCkbWFi3YY',

    'root' => 'http://rwandaguide.info/',
//    'root' => 'http://localhost/rwandaguide/',

    'images' => 'files/images/',
    'uploads' => 'files/uploads/',
    'frontend_alias' => Yii::getAlias('@frontend') . '/web/',
    'frontend' => 'http://rwandaguide.info/frontend/web/',
    'profile' => 'files/uploads/profile/',
    'profile-picture' => 'http://rwandaguide.info/frontend/web/files/uploads/profile/',
    'default' => 'http://rwandaguide.info/frontend/web/files/uploads/profile/default.png',


    'gallery' => 'files/uploads/gallery/',
    'thumbnail' => 'files/uploads/gallery/thumbnails/',
    'tn_thumbnail' => 'files/uploads/gallery/thumbnails/thumbnails/',
    'galleries' => 'http://rwandaguide.info/frontend/web/files/uploads/gallery/',
    'thumbnails' => 'http://rwandaguide.info/frontend/web/files/uploads/gallery/thumbnails/tn_',
    'tn_thumbnails' => 'http://rwandaguide.info/frontend/web/files/uploads/gallery/thumbnails/thumbnails/tn_tn_',

    'test' => 'files/uploads/test/',
    'test_thumbnail' => 'files/uploads/test/thumbnails/',
    'test_images' => 'http://localhost/rwandaguide/frontend/web/files/uploads/test/',

    'blog' => 'files/uploads/blog/',
    'blog_thumbnail' => 'files/uploads/blog/thumbnails/',
    'blog_images' => 'http://rwandaguide.info/frontend/web/files/uploads/blog/',
    'blog_thumbnails' => 'http://rwandaguide.info/frontend/web/files/uploads/post/thumbnails/',

    'post' => 'files/uploads/post/',
    'post_thumbnail' => 'files/uploads/post/thumbnails/',
    'post_images' => 'http://rwandaguide.info/frontend/web/files/uploads/post/',
    'post_thumbnails' => 'http://rwandaguide.info/frontend/web/files/uploads/post/thumbnails/tn_',

    'event' => 'files/uploads/event/',
//    'thumbnails' => 'files/uploads/event/thumbnails/',
    'event_images' => 'http://rwandaguide.info/frontend/web/files/uploads/event/',
    'event_thumbnails' => 'http://rwandaguide.info/frontend/web/files/uploads/event/thumbnails/tn_',

    'tmp' => 'http://localhost/rwandaguide/frontend/web/files/images/tmp/',

    'pragmaticmates-logo-png' => 'http://rwandaguide.info/frontend/web/files/images/pragmaticmates-logo.png',
    'pragmaticmates-logo-jpg' => 'http://rwandaguide.info/frontend/web/files/images/pragmaticmates-logo.jpg',

    'ads' => 'files/uploads/ads/',
    'ads_images' => 'http://rwandaguide.info/frontend/web/files/uploads/ads/',

    'contracts'=> 'files/uploads/contracts/',

    'inactive' => 0,
    'active' => 1,
    'pending' => 2,
    'blocked' => 3,
    'accepted' => 4,
    'rejected' => 5,
    'publish' => 6,
    'unpublish' => 7,
    'draft' => 8,
    'sent' => 9,
    'imported' => 10,
    'paid' => 11,
    'not_paid' => 12,


    //For invoices types

    'normal_sell'=>1,
    'proforma'=>0,
    'credit'=>2,

    'A_TYPE' => 1,
    'B_TYPE' => 2,
    'C_TYPE' => 3,
    'D_TYPE' => 4,
    'E_TYPE' => 5,
    'A_CATEGORY' => 1,
    'B_CATEGORY' => 2,
    'C_CATEGORY' => 3,
    'D_CATEGORY' => 4,

    'PREMIUM' => 2,
    'BASIC' => 1,
    'FREE' => 0,
    'NOT_DEFINED' => -1,

    'PHYSICAL_ADDRESS' => 1,
    'PO_BOX' => 2,
    'MOB_PHONE' => 3,
    'LAND_LINE' => 4,
    'FAX' => 5,
    'EMAIL' => 6,
    'WEBSITE' => 7,
    'SKYPE' => 8,

    /*For social medial accounts*/
    'FACEBOOK' => 1,
    'TWITTER' => 2,
    'INSTAGRAM' => 3,
    'LINKEDIN' => 4,
    'PINTREST' => 5,
    'TUMBLR' => 6,
    'YOUTUBE' => 7,
    'GOOGLE_PLUS' => 8,
    'FLICKLR' => 9,
    'TRIPADVISOR' => 10,

    /*For different images sizes*/
    'max_width_768' => 768,
    'max_width_490' => 490,
    'max_width_128' => 128,

    'min_width_512' => 512,
    'min_width_328' => 328,
    'min_width_96' => 96,

    'min_heigth_384' => 384,
    'min_heigth_246' => 246,
    'min_heigth_70' => 70,

    /*Types of emails*/
    'place' => 1,
    'visitor' => 2,
    'user' => 3,

    '300x300' => 1,
    '730x300' => 2,
    '350x630' => 3,


    'favicon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/favicon-96x96.png',
    'icon_96' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/icon_96.png',
    'icon_96_festive' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/icon_96_festive.png',
    'icon_128_festive' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/icon_128_festive.png',
    'logo' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/RG.jpg',
    'logo_256' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/logo_256.png',
    'logo_512' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/logo_512.png',
    'logo_320_festive' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/logo_320_festive.png',
    'logo_320' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/logo_320.png',
    'logo_192' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/logo_192.png',
    'kwibuka' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/kwibuka.jpg',
    'ishyiga' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/ishyiga.jpeg',

    'facebook' => 'https://web.facebook.com/rwandaguide.info',
    'twitter' => 'https://twitter.com/rwandaguide_',
    'instagram' => 'https://www.instagram.com/rwandaguide/',
    'google-plus' => 'https://plus.google.com/113822365620535653172',
    'pinterest' => 'https://www.pinterest.com/rwandaguide/',
    'flickr' => 'https://www.flickr.com/photos/134467637@N08/',
    'tumblr' => 'http://rwandaguide.tumblr.com/',
    'linkedin' => 'https://www.linkedin.com/company/rwanda-guide',
    'youtube' => 'https://www.youtube.com/channel/UCq7pJUau3gsOlCNn_JLxSJA',

    'facebook_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/facebook@2x.png',
    'twitter_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/twitter@2x.png',
    'instagram_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/instagram@2x.png',
    'google-plus_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/googleplus@2x.png',
    'pinterest_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/pinterest@2x.png',
    'flickr_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/',
    'tumblr_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/tumblr@2x.png',
    'linkedin_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/',
    'youtube_icon' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/youtube@2x.png',

    'meta_twitter_id' => 'rwandaguide_',
    'meta_image' => 'https://s3-us-west-2.amazonaws.com/rwandaguide/files/RG.jpg',
    'meta_description' => 'Rwanda Guide is a directory of fun places to explore for those visiting Rwanda or for locals to discover new places.',
    'meta_classification' => [
        'News of Rwanda',
        'Remarkable Rwanda',
        'The land of a thousand hills',
    ],
    'meta_abstract' => 'This website will help you find more information about a place you would like to visit. This website also helps businesses reach out to potential clients about their services.',

];

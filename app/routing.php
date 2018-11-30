<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @category Config
 * @package  Config
 * @author   WCS <contact@wildcodeschool.fr>
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */
$routes = [
    'Default' => [ // Controller
        ['index', '/', ['GET', 'POST']], // action, url, method
        ['disconnect', '/disconnect', ['GET', 'POST']] // action, url, method
    ],
    'User' => [ // Controller
        ['profile', '/profile', ['GET', 'POST']], // action, url, method
        ['actuality', '/actuality', ['GET', 'POST']], // action, url, method
        ['readActuality', '/actuality/{id}', ['GET']] // action, url, method
    ],
    'Staff' => [ // Controller
        ['index', '/staff', ['GET', 'POST']], // action, url, method
        ['userAdd', '/user/add', ['GET', 'POST']], // action, url, method
        ['userEdit', '/user/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['userDelete', '/user/delete/{id:\d+}', ['GET']], // action, url, method
        ['articleAdd', '/article/add', ['GET', 'POST']], // action, url, method
        ['articleEdit', '/article/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['articleDelete', '/article/delete/{id:\d+}', ['GET']], // action, url, method
        ['forgottenPassword', '/forgotten', ['GET', 'POST']], // action, url, method
        ['resetPassword', '/reset', ['GET', 'POST']], // action, url, method
        ['confirmEmail', '/confirm', 'GET'] // action, url, method
    ],
    'Gallery' => [ // Controller
        ['gallery', '/gallery', ['GET', 'POST']], // action, url, method
        ['profileId', '/profilelink/{id}', ['GET']], // action, url, method
    ],
    'Category' => [ // Controller
        ['index', '/forum', ['GET']], // action, url, method
        ['categoryShow', '/forum/category/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['categoryAdd', '/forum/add', ['GET', 'POST']], // action, url, method
        ['categoryEdit', '/forum/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['categoryDelete', '/forum/delete/{id:\d+}', ['GET']] // action, url, method
    ],
    'Topic' => [ // Controller
        ['topicShow', '/forum/topic/{id:\d+}', ['GET']], // action, url, method
        ['topicAdd', '/forum/topic/add', ['GET', 'POST']], // action, url, method
        ['topicEdit', '/forum/topic/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['topicDelete', '/forum/topic/delete/{id:\d+}', ['GET']] // action, url, method
    ],
    'Reply' => [ // Controller
        ['replyAdd', '/forum/topic/reply/add', ['POST']], // action, url, method
    ],
];

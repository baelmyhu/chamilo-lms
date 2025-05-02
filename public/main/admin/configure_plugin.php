<?php

/* For licensing terms, see /license.txt */

/**
 * @author Julio Montoya <gugli100@gmail.com> BeezNest 2012
 * @author Angel Fernando Quiroz Campos <angel.quiroz@beeznest.com>
 */
<<<<<<< HEAD
=======

use Chamilo\CoreBundle\Framework\Container;

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
$cidReset = true;
require_once __DIR__.'/../inc/global.inc.php';

api_protect_admin_script();

<<<<<<< HEAD
$pluginName = $_GET['name'];
$appPlugin = new AppPlugin();
$installedPlugins = $appPlugin->getInstalledPlugins();
$pluginInfo = $appPlugin->getPluginInfo($pluginName, true);

if (!in_array($pluginName, $installedPlugins) || empty($pluginInfo)) {
    api_not_allowed(true);
}

$content = '';
$currentUrl = api_get_self()."?name=$pluginName";
=======
$pluginRepo = Container::getPluginRepository();

$plugin = $pluginRepo->getInstalledByName($_GET['plugin']);

if (!$plugin) {
    api_not_allowed(true);
}

$accessUrl = Container::getAccessUrlHelper()->getCurrent();

$pluginConfiguration = $plugin->getConfigurationsByAccessUrl($accessUrl);

$appPlugin = new AppPlugin();
$pluginInfo = $appPlugin->getPluginInfo($plugin->getTitle(), true);

$em = Container::getEntityManager();

$content = '';
$currentUrl = api_get_self()."?plugin={$plugin->getTitle()}";
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

if (isset($pluginInfo['settings_form'])) {
    /** @var FormValidator $form */
    $form = $pluginInfo['settings_form'];
<<<<<<< HEAD
    if (isset($form)) {
        // We override the form attributes
        $attributes = ['action' => $currentUrl, 'method' => 'POST'];
        $form->updateAttributes($attributes);
=======
    if (!empty($form)) {
        $form->updateAttributes(['action' => $currentUrl, 'method' => 'POST']);
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        if (isset($pluginInfo['settings'])) {
            $form->setDefaults($pluginInfo['settings']);
        }
        $content = Display::page_header($pluginInfo['title']);
        $content .= $form->toHtml();
    }
} else {
    Display::addFlash(
        Display::return_message(get_lang('No configuration settings found for this plugin'), 'warning')
    );
}

if (isset($form)) {
    if ($form->validate()) {
        $values = $form->getSubmitValues();

        // Fix only for bbb
<<<<<<< HEAD
        if ('bbb' == $pluginName) {
            if (!isset($values['global_conference_allow_roles'])) {
                $values['global_conference_allow_roles'] = [];
            }
        }

        $accessUrlId = api_get_current_access_url_id();
        api_delete_settings_params(
            [
                'category = ? AND access_url = ? AND subkey = ? AND type = ? and variable <> ?' => [
                    'Plugins',
                    $accessUrlId,
                    $pluginName,
                    'setting',
                    'status',
                ],
            ]
        );

        foreach ($values as $key => $value) {
            api_add_setting(
                $value,
                $pluginName.'_'.$key,
                $pluginName,
                'setting',
                'Plugins',
                $pluginName,
                '',
                '',
                '',
                api_get_current_access_url_id(),
                1
            );
        }
=======
        if ('bbb' == $plugin->getTitle() && !isset($values['global_conference_allow_roles'])) {
            $values['global_conference_allow_roles'] = [];
        }

        /** @var Plugin $objPlugin */
        $objPlugin = $pluginInfo['obj'];

        /** @var array<int, string> $pluginFields */
        $pluginFields = $objPlugin->getFieldNames();

        $pluginConfiguration->setConfiguration(
            array_intersect_key($values, array_flip($pluginFields))
        );

        $em->flush();
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

        Event::addEvent(
            LOG_PLUGIN_CHANGE,
            LOG_PLUGIN_SETTINGS_CHANGE,
<<<<<<< HEAD
            $pluginName,
=======
            $plugin->getTitle(),
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
            api_get_utc_datetime(),
            api_get_user_id()
        );

<<<<<<< HEAD
        if (!empty($pluginInfo['plugin_class'])) {
            /** @var \Plugin $objPlugin */
            $objPlugin = $pluginInfo['plugin_class']::create();
            $objPlugin->get_settings(true);
            $objPlugin->performActionsAfterConfigure();

            if (isset($values['show_main_menu_tab'])) {
                $objPlugin->manageTab($values['show_main_menu_tab']);
            }
=======
        $objPlugin->performActionsAfterConfigure();

        if (isset($values['show_main_menu_tab'])) {
            $objPlugin->manageTab($values['show_main_menu_tab']);
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        }

        Display::addFlash(Display::return_message(get_lang('Update successful'), 'success'));
        header("Location: $currentUrl");
        exit;
    } else {
        foreach ($form->_errors as $error) {
            Display::addFlash(Display::return_message($error, 'error'));
        }
    }
}

$interbreadcrumb[] = [
    'url' => api_get_path(WEB_CODE_PATH).'admin/index.php',
    'name' => get_lang('Administration'),
];
$interbreadcrumb[] = [
    'url' => api_get_path(WEB_CODE_PATH).'admin/settings.php?category=Plugins',
    'name' => get_lang('Plugins'),
];

<<<<<<< HEAD
$tpl = new Template($pluginName, true, true, false, true, false);
=======
$tpl = new Template($plugin->getTitle(), true, true, false, true, false);
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
$tpl->assign('content', $content);
$tpl->display_one_col_template();

<!DOCTYPE html>
<html lang="<{$xoops_langcode}>">
<head>
    <{include file="$theme_tpl/head.tpl"}>
</head>
<body id="<{$xoops_dirname}>" class="<{$hydrogen.body_classes}><{if $hydrogen.collapsed|default:false}> collapsed-sidebar<{/if}>">

<!-- 1. Header toolbar -->
<header id="hydrogen-header">
    <{include file="$theme_tpl/header-toolbar.tpl"}>
</header>
<!--/ 1. End header toolbar -->

<!-- Contents wrapper -->
<div id="hydrogen-wrapper">
    <div class="hydrogen-sidebar-wrapper" id="hydrogen-sidebar">
        <!-- Sidebar items -->
        <{include file="$theme_tpl/gui-sidebar.tpl"}>
        <!--// Sidebar items -->
    </div>
    <div class="hydrogen-contents-wrapper">
        <!-- Modules content -->
        <{include file="$theme_tpl/gui-content.tpl"}>
        <!--// Modules content -->
    </div>
</div>
<!--// Contents wrapper -->
<input type="hidden" id="xo-token" value="<{$token_value}>">

<!-- Show redirection messages if any -->
<{include file="$theme_tpl/gui-redirection.tpl"}>
</body>
</html>
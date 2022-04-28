<?php
/* Smarty version 4.1.0, created on 2022-04-28 14:51:40
  from 'E:\projects\TestApplication\kii_testApp\view\templates\structure.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_626a7fcc9661e1_51549173',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '290c48d50560cd8b862430ea688df98c2f717c7a' => 
    array (
      0 => 'E:\\projects\\TestApplication\\kii_testApp\\view\\templates\\structure.tpl',
      1 => 1651146695,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_626a7fcc9661e1_51549173 (Smarty_Internal_Template $_smarty_tpl) {
?><body class="bg-secondary">
    <div class="container-fluid p-2 bg-dark align-items-end">
        <div class="row">
            <div class="col-1 offset-11">
                <?php if ($_smarty_tpl->tpl_vars['adminFl']->value == 1) {?>
                <button class="btn btn-info" onclick="logout()">Выход</button>
                <?php } else { ?>
                <button class="btn btn-info" onclick="$('#loginForm').modal('show')">Авторизация</button>
                <?php }?>
            </div>
        </div>
    </div>
    <div class="container mt-2 p-5 bg-light h-100">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elements']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
        <div id = container_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
 class="row">
            <div class="col-1">
                <?php if ($_smarty_tpl->tpl_vars['element']->value['hasChildren'] > 0) {?>
                <i id="dropdown_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" class="fa fa-angle-double-down" aria-hidden="true"></i>
                <?php }?>
                <img id="loadingImage_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" class="img-fluid w-50" src="view/img/loading.gif" alt="loadig" style="display: none">
            </div>
            <div class="col-4 element" onclick="searchChildren(<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
, this)">
                <p><?php echo $_smarty_tpl->tpl_vars['element']->value['title'];?>
</p>
            </div>
        </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</body><?php }
}

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? CJSCore::Init(array("jquery")); ?>

<?if($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']):?>
	<div class="my-auth-form-error-message">
		<div class="ic-error"></div>
		<?=$arResult['ERROR_MESSAGE']['MESSAGE']?>
	</div>
<?endif?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<a class="authorization-link">Log In</a>

<div class="modal-wrapper">
	<div class="bx-system-auth-form my-auth-form" >
	<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif?>
	<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach?>
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		
		<div><?=GetMessage("AUTH_LOGIN")?>:</div>
		<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /><br/>

		<div><?=GetMessage("AUTH_PASSWORD")?>:</div>
		<input type="password" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" /><br/>

	<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
			<input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
			<label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label><br/>
	<?endif?>

	<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /><br/>
	
	<noindex><a rel="nofollow" class="link-forgot-password"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex><br/>

	</form>
	</div>

	<div class="my-auth-forgot-password">
		<?$APPLICATION->IncludeComponent(
			"bitrix:system.auth.forgotpasswd",
			"meblya_forgot_passwd",
			Array(
				"SHOW_ERRORS"=>"Y"
			)
		);?>
	</div>
</div>

<?
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>" class="my-short-user-info">
	<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=$arResult["USER_NAME"]?>"><?=$arResult["USER_LOGIN"]?></a><br />
	
	<?foreach ($arResult["GET"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach?>
	<input type="hidden" name="logout" value="yes" />
	<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
</form>
<?endif?>


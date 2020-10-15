<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?=html_escape($nome);?></title>
	</head>
	<body  style="background: #7f1d5a!important">
		<table width="100%" cellspacing="0" cellpadding="0" align="center" >
		    <tr>
		        <td background="<?=base_url('assets/images/emails/email_bg.jpg')?>" >
		            <table width="625" cellspacing="0" cellpadding="0" align="center">
		                <tr>
		                    <td align="center" valign="middle" height="174">
		                        <img src="data:image/png;base64,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" style="width:100%;max-width: 188px;height: auto"/>
		                    </td>
		                </tr>
		                <tr>
		                    <td>
		                        <table width="90%" cellspacing="0" cellpadding="20" align="center" style="border-collapse:separate; overflow:hidden;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;-webkit-box-shadow: 0px 0px 18px 3px rgba(224,224,224,0.75);-moz-box-shadow: 0px 0px 18px 3px rgba(224,224,224,0.75);box-shadow: 0px 0px 18px 3px rgba(224,224,224,0.75); border: solid 1px #f2f2f2;background: white;margin-bottom: 25px">
		                            <tr>
		                                <td bgcolor="#FFFFFF" align="center">
		                                    <!--<img src="http://cdljovemnatal.com.br/funcoes/emails/img/senha_redefinicao.jpg" /><br>-->
		                                    <h2 style="color:#7f1d5a; font-weight: normal; font-family: Arial, Tahoma; padding-bottom: 0px; margin-bottom: 0px;">
		                                        <?=lang('hello_user').' '.$nome;?>!
		                                    </h2>
		                                    <br>
		                                    <h4 style="color:#7f1d5a; font-weight: normal; font-family: Arial, Tahoma; padding-bottom: 0px; margin-bottom: 0px;"><?=lang('newsletters_news_incoming')?></h4>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                    <table width="10%" cellspacing="0" cellpadding="0" align="center">
		                                        <tr>
		                                            <td bgcolor="#19478a" height="1"></td>
		                                        </tr>
		                                    </table>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td align="center" style="padding-top: 0px;">
		                                    <p><b><?=$titulo;?></b><br></p>
		                                    <p style="text-align:center; width: 70%; color:#6f6f6f; font-family: Arial, Tahoma; font-size: 0.9em; line-height: 1.5; padding-top: 0px;">
		                                        <a style="background:#7f1d5a;color:white;text-decoration: none;padding: 7px 20px;border-radius: 10px;" href="<?=base_url($url)?>"><?=lang('see_full_new')?></a>
		                                    </p>

		                                </td>
		                            </tr>
		                        </table>
		                    </td>
		                </tr>
		            </table>
		        </td>
		    </tr>
		    <tr>
		        <td align="center" style="font-family:Arial,Tahoma; color: #6f6f6f;  font-size: 0.8em;background:white;margin-top: 20px;">
		            <br>
					<?=lang('discl_newsletter')?> <a href="<?=base_url($lang.'/newsletters/unsubscribe/'.md5(strtotime(date('Y-m-d H:i:s')))."_".$new_id."_".md5(strtotime(date('Y-m-d H:i:s'))))?>"><?=lang('click_here')?></a>
		            <br> <?=isset($endereco_empresa) ? $endereco_empresa : ''?><br><br>
		            <a href="<?=base_url($lang)?>" style="color:#003366;text-decoration:none;">Henekkam</a>
		        </td>
		    </tr>
		</table>
	</body>
</html>
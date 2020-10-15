<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('remover_imagem')){
	function remover_imagem($imagem,$pasta){
		$ci = &get_instance();
		$ci->load->helper('path');
		$imageFolder = set_realpath('assets/images/'.$pasta);
		if(!is_dir($imageFolder)) {
			return false;
		}

		if(is_file($imageFolder.$imagem)){
			unlink($imageFolder.$imagem);
			return true;
		}
		return false;
	}
}


if(!function_exists('upload_imagem')){
	function upload_imagem($imagem,$pasta){
		ethernal_log('ETH','ENTROU FUNÇÃO UPLOAD','',__METHOD__);
		$ci = &get_instance();
		$ci->load->helper('path');
		$ci->load->library('upload');
		$ci->load->library('image_lib');
		$total_count_of_files = count($_FILES['images']['name']);
		$error = 0;
		$arquivos = [];
		$met = 'resize';
		foreach ($imagem['images']['name'] as $key => $value) {
			if(!empty($imagem['images']['name'][$key])){
				$_FILES['foto']['name'] = 		$imagem['images']['name'][$key];
				$_FILES['foto']['tmp_name'] = 	$imagem['images']['tmp_name'][$key];
				$_FILES['foto']['type'] = 		$imagem['images']['type'][$key];
				$_FILES['foto']['size'] = 		$imagem['images']['size'][$key];
				$_FILES['foto']['error'] = 		$imagem['images']['error'][$key];

				$config['file_name']     = 'test_'.$key.uniqid(strtotime(date('Y-m-d-h-i-s-u')));
			    $config['upload_path']   = '__tmp/';
			    $config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size']      = '0';
			    $config['overwrite']     = FALSE;
			    $ci->upload->initialize($config);
			    if($ci->upload->do_upload('foto')){
				    $error += 0;
				    $nova_imagem = $ci->upload->data();
				    $imageFolder = set_realpath('assets/images/'.($pasta == 'blog/cover' ? 'blog' : $pasta));
					if(!is_dir($imageFolder)){
						mkdir($imageFolder, 0755,true);
					}
					$imageFolder = set_realpath('assets/images/'.$pasta);
					$nome_arquivo = ($pasta == 'blog/cover' ? 'cover_' : '').md5(uniqid(date('Y-m-d-h-i-s-u').rand(1,99)."-hk-384")).".".$nova_imagem['image_type'];
				    $config_upload['image_library'] = 'gd2';
					$config_upload['source_image'] = $nova_imagem['full_path'];
					$config_upload['new_image'] = set_realpath($imageFolder.$nome_arquivo);
					$config_upload['quality'] = "90%";
					if($nova_imagem['image_width'] > 1920){
						$config_upload['width'] = 1920;
					}
					switch ($pasta) {
						case 'slideshow':
							$config_upload['maintain_ratio'] = FALSE;
							$config_upload['width']         = 1060;
							$config_upload['height']		 = 406;
							$config_upload['quality'] 		 = "100%";
							break;
						case 'blog':
							
							if($key == 'blo_cover'){
								$config_upload['width']         = 1000;
								$config_upload['maintain_ratio'] = TRUE;
							}else{
								$config_upload['maintain_ratio'] = FALSE;
								$config_upload['width']         = 400;
								$config_upload['height']		 = 267;
								$config_upload['quality'] 		 = "100%";
							}
							break;
						case 'blog/cover':
							$config_upload['maintain_ratio'] = TRUE;
							$config_upload['width']         = 1000;
							$config_upload['quality'] 		 = "100%";
							break;
						case 'testimonials':
							
							$centerx = round($nova_imagem['image_width']/2);
							$centery = round($nova_imagem['image_height']/2);

							$cropWidth  = 300;
							$cropHeight = 300;

							$cropWidthHalf  = round($cropWidth / 2); // could hard-code this but I'm keeping it flexible
							$cropHeightHalf = round($cropHeight / 2);

							$x1 = max(0, $centerx - $cropWidth);
							$y1 = max(0, $centery - $cropHeight);

							$x2 = min($nova_imagem['image_width'], $cropWidth);
							$y2 = min($nova_imagem['image_height'],  $cropHeight);

							
							

							if($nova_imagem['image_width'] != $nova_imagem['image_height']){
								$met = 'crop';
								$config_upload['x_axis'] = $x1;
								$config_upload['y_axis'] = $y1;
								$config_upload['maintain_ratio'] = FALSE;
								$config_upload['width'] = $x2;
								$config_upload['height'] = $y2;
							}else{
								$config_upload['width'] = 400;
								$config_upload['maintain_ratio'] = TRUE;
							}

							
							break;
						case 'users':
							$centerx = round($nova_imagem['image_width']/2);
							$centery = round($nova_imagem['image_height']/2);

							$cropWidth  = 300;
							$cropHeight = 300;

							$cropWidthHalf  = round($cropWidth / 2); // could hard-code this but I'm keeping it flexible
							$cropHeightHalf = round($cropHeight / 2);

							$x1 = max(0, $centerx - $cropWidth);
							$y1 = max(0, $centery - $cropHeight);

							$x2 = min($nova_imagem['image_width'], $cropWidth);
							$y2 = min($nova_imagem['image_height'],  $cropHeight);

							
							

							if($nova_imagem['image_width'] != $nova_imagem['image_height']){
								$met = 'crop';
								$config_upload['x_axis'] = $x1;
								$config_upload['y_axis'] = $y1;
								$config_upload['maintain_ratio'] = FALSE;
								$config_upload['width'] = $x2;
								$config_upload['height'] = $y2;
							}else{
								$config_upload['width'] = 400;
								$config_upload['maintain_ratio'] = TRUE;
							}
							
							break;
						default:
							
							$config_upload['maintain_ratio'] = TRUE;
							break;
					}
					$ci->image_lib->initialize($config_upload);
					if($met == 'resize'){
						if ( !$ci->image_lib->resize()){
			            	ethernal_log('ETH_ERROR','Não foi possível enviar a imagem',implode(' | ',$nova_imagem)." -- novo_nome: ".$nome_arquivo,__METHOD__);
			                set_msg('Não foi possível enviar a imagem','danger');
			                return false;
			            }else{
			            	
			            	ethernal_log('ETH','foi possível enviar a imagem',implode(' | ',$nova_imagem)." -- novo_nome: ".$nome_arquivo,__METHOD__);
			            	unlink($nova_imagem['full_path']);
			                $arquivos[$key] = $nome_arquivo;
			            }
					}else{
						if ( !$ci->image_lib->crop()){
			            	ethernal_log('ETH_ERROR','Não foi possível enviar a imagem',implode(' | ',$nova_imagem)." -- novo_nome: ".$nome_arquivo,__METHOD__);
			                set_msg('Não foi possível enviar a imagem','danger');
			                return false;
			            }else{
			            	
			            	ethernal_log('ETH','foi possível enviar a imagem crop',implode(' | ',$nova_imagem)." -- novo_nome: ".$nome_arquivo,__METHOD__);
			            	unlink($nova_imagem['full_path']);
			                $arquivos[$key] = $nome_arquivo;
			            }
					}
					
				}else{
					ethernal_log('ETH','Não foi possível enviar a imagem');
					echo $ci->upload->display_errors();
				    $error += 1;
				}
			//fim
			}
		}
		if(count($arquivos) == 0){
			return false;
		}
		return $arquivos;
	}
}


// if(!function_exists('upload_imagem')){
// 	function upload_imagem($imagem,$pasta){
// 		$ci = &get_instance();
// 		ethernal_log('ETH','ENTROU FUNÇÃO UPLOAD','',__METHOD__);
// 		$ci->load->helper('path');
// 		$imageFolder = set_realpath('assets/images/'.($pasta == 'blog/cover' ? 'blog' : $pasta));
// 		if(!is_dir($imageFolder)){
// 			mkdir($imageFolder, 0755);
// 		}
// 		$images = count($imagem['images']['name']);
// 		$arquivos = [];
// 		$erros = 0;
		
// 		foreach($imagem['images']['name'] as $key => $value) {
// 			$_FILES['foto']['name'] = $imagem['images']['name'][$key];
// 			$_FILES['foto']['type'] = $imagem['images']['type'][$key];
// 			$_FILES['foto']['tmp_name'] = $imagem['images']['tmp_name'][$key];
// 			$_FILES['foto']['error'] = $imagem['images']['error'][$key];
// 			$_FILES['foto']['size'] = $imagem['images']['size'][$key];
// 			# code...
// 			$temp = $_FILES['foto'];
// 			$var= explode('.', $temp['name']);
// 		    $extensao = strtolower(end($var));
// 		    $nome_arquivo = ($pasta == 'blog/cover' ? 'cover_' : '').md5(uniqid(date('Y-m-d-h-i-s-u').rand(1,200)."hennekam_eth")).".".$extensao;
// 		    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png","jpeg"))) {
// 		    	ethernal_log('ETH_ERROR','ENTROU FUNÇÃO UPLOAD',strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)),__METHOD__);
// 		        set_msg('Tipo de arquivo não permitido','danger');
// 		        continue;
// 		    }
			
// 			$upload_config['upload_path']          =  set_realpath('_tmp');
//             $upload_config['allowed_types']        = 'gif|jpg|png|jpeg';
//             $upload_config['file_name']			   = md5(uniqid(date('Y-m-d-h-i-s-u'))).".".$extensao;
// 			$ci->load->library('upload',$upload_config);
// 			echo $upload_config['file_name']."<br>";
// 			if(!$ci->upload->do_upload('foto')){
// 				$ci->upload->display_errors('<p>', '</p>');
// 				var_dump($_FILES);
// 				echo "<br>";
// 			}else{
// 				$config['image_library'] = 'gd2';
// 				$config['source_image'] = $upload_config['upload_path'].$upload_config['file_name'];
// 				$config['new_image'] = set_realpath($imageFolder.$nome_arquivo);
// 				$config['quality'] = "90%";
// 				switch ($pasta) {
// 					case 'slideshow':
// 						$config['maintain_ratio'] = FALSE;
// 						$config['width']         = 1060;
// 						$config['height']		 = 406;
// 						$config['quality'] 		 = "100%";
// 						break;
// 					case 'blog':
// 						$config['maintain_ratio'] = FALSE;
// 						$config['width']         = 400;
// 						$config['height']		 = 267;
// 						$config['quality'] 		 = "100%";
// 						break;
// 					case 'blog/cover':
// 						$config['maintain_ratio'] = TRUE;
// 						$config['width']         = 1000;
// 						$config['quality'] 		 = "100%";
// 						break;
					
// 					default:
// 						$config['maintain_ratio'] = TRUE;
// 						break;
// 				}
				
				

// 		        $ci->load->library('image_lib', $config);

// 		        if ( !$ci->image_lib->resize()){
// 		        	ethernal_log('ETH_ERROR','Não foi possível enviar a imagem',implode(' | ',$_FILES['foto'])." -- novo_nome: ".$nome_arquivo,__METHOD__);
// 		        	$erros++;
// 		        }else{
// 		        	ethernal_log('ETH','foi possível enviar a imagem',implode(' | ',$_FILES['foto'])." -- novo_nome: ".$nome_arquivo,__METHOD__);
// 		        	$arquivos[$key] = $nome_arquivo;
// 		        	unlink($upload_config['upload_path'].$upload_config['file_name']);
// 		        }
// 			}

			
// 	    }
// 	    if($images == $erros){
// 	    	set_msg('Não foi possível enviar a imagem','danger');
// 	    	return false;
// 	    }else{
// 	    	return $arquivos;
// 	    }
// 	}
// }
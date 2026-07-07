<?
$pagTitle = $title_dett;
$pagSubTitle = "";
$bc = "Blog";
$bc_link = "blog.html";
include("fissi/page_title.inc.php");
?>


<section id="page-content" class="sidebar-right">
	<div class="container">
		<div class="row">
			<!-- post content -->
			<div class="content col-lg-9">
				
				<div id="blog">
					<div class="post-item">
						<div class="post-item-wrap">
							
							<div class="post-image">							
								<img alt="" src="admin/img_up/blog/<?=$img_dett;?>">
							</div>
							<div class="post-item-description">
								<?
								if(isset($autore_dett) && $autore_dett!=""){?>								
									<span style="color:<?=$color1;?>; font-size:0.9em">di <?=$autore_dett;?></span><br/>
								<?}?>
								<h2 style="line-height:30px"><?=$title_dett;?></h2>
								
								<?if(isset($testo_dett) && trim($testo_dett)!=""){?>
									<p><?=$testo_dett;?></p>
								<?}?>
								
								<?
								$link = "";
								if (isset($arr_dett['link']) && $arr_dett['link']!="") $link = $arr_dett['link'];
								if (isset($arr_dett['allegato']) && $arr_dett['allegato']!="" && file_exists("admin/files/news/".$arr_dett['allegato'])) $link = "admin/files/news/".$arr_dett['allegato'];
								$testo_link = "";
								if (isset($arr_dett['testo_bott']) && $arr_dett['testo_bott']!="") $testo_link = $arr_dett['testo_bott'];
								?>
								<?if($link!=""){?>
									<br/>
									<a class="btn btn-outline" href="<?=$link;?>" target="_blank">
										<?if($testo_link!=""){?>
											<?=$testo_link;?>
										<?}else{?>
											<?if($lingua=="ita"){?>
												vai
											<?}else{?>
												go
											<?}?>
										<?}?>
									</a>
								<?}?>
							</div>
							
							<?
							$query_g="SELECT * FROM ".$prec_db."blog_gallery WHERE id_rife='$id_dett' ORDER BY ordine DESC";
							$resu_g=$open_connection->connection->query($query_g);
							$num_g=$resu_g->rowCount();
							if($num_g>0){?>
								<section style="padding:20px 0 20px 0">
									<div class="container-fluid" style="padding:0">		
										<?
										$titleTxt = "Gallery";
										if (isset($arr_dett['nome_gallery']) && $arr_dett['nome_gallery']!="") $titleTxt = $arr_dett['nome_gallery'];
										?>
										<h3><?=$titleTxt;?></h3>
									</div>
								</section>
								<div id="blog" class="grid-layout post-<?=$arr_dett['col_gallery'];?>-columns m-b-30" data-item="post-item"  data-lightbox="gallery">
									<?
									$x=0;
									while($risu_gal=$resu_g->fetch()){
										$x++;
										$img_gal = $risu_gal['img'];
										$img_gal_ante = $img_gal;
										if(file_exists("admin/img_up/blog/m_".$img_gal)) $img_gal_ante = "m_".$img_gal;
										$testo_gal = "";
										if(isset($risu_gal['testo']) && trim($risu_gal['testo'])!="") $testo_gal = $risu_gal['testo'];
										$title_gal = "$title_dett - Blog - Foto $x - $nome_del_sito";
										?>
										<div class="post-item border">
											<div class="post-item-wrap" style="background:#f4f4f4; border-color:#e1e1e1">
												<div class="post-image">
													<a href="admin/img_up/blog/<?=$img_gal;?>" title="<?if($testo_gal!=""){ echo $testo_gal." - ";}?><?=$title_gal;?>"  data-lightbox="gallery-image">
														<picture>
															<?if(file_exists("admin/img_up/blog/".$img_gal_ante.".webp")){?>
																<source type="image/webp" srcset="admin/img_up/blog/<?=$img_gal_ante;?>.webp">
															<?}?>
															<source type="image/png" srcset="admin/img_up/blog/<?=$img_gal_ante;?>">
															<img alt="<?=$title_gal;?>" src="admin/img_up/blog/<?=$img_gal_ante;?>">
														</picture>
													</a>
												</div>
												<?if($testo_gal!=""){?>
													<div class="post-item-description">
														<h2 style="margin-bottom:0"><?=$testo_gal;?></h2>
													</div>
												<?}?>
											</div>
										</div>
										<?$x++;
									}?>
								</div>
							<?}?>
						</div>
					</div>					
				</div>				
			</div>
			<!-- end: post content -->
			<!-- Sidebar-->
			<div class="sidebar sticky-sidebar col-lg-3">				
				<?include("fissi/side_blog.inc.php");?>			
			</div>
			<!-- end: Sidebar-->
		</div>
	</div>
</section>
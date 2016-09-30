<!-- Modal Course -->
<div class="modal fade" id="modalCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $modal[$_SESSION['language']]['course']['title']; ?></h4>
			</div>
			<div class="modal-body">
				<p><?php echo $modal[$_SESSION['language']]['course'][0]; ?></p>
				<p class="center"><img src="<?php echo $modal[$_SESSION['language']]['course'][1]['img']; ?>" alt="<?php echo $modal[$_SESSION['language']]['course'][1]['alt']; ?>" title="<?php echo $modal[$_SESSION['language']]['course'][1]['title']; ?>" /></p>
				<p><img src="<?php echo $modal[$_SESSION['language']]['course'][2]['img']; ?>" alt="<?php echo $modal[$_SESSION['language']]['course'][2]['alt']; ?>" title="<?php echo $modal[$_SESSION['language']]['course'][2]['title']; ?>" />
				&nbsp;<?php echo $modal['fr']['course'][2]['text']; ?></p>
				<p class="center"><?php echo $modal['fr']['course'][3]['text']; ?></p>
				<p>&nbsp;</p>
				<p class="center concept"><?php echo $modal['fr']['course'][3]['tab']; ?></p>
				<p>&nbsp;</p>
				<p><?php echo $modal['fr']['course'][4]; ?></p>
				<p><?php echo $modal['fr']['course'][5]['text']; ?>
				<img src="<?php echo $modal[$_SESSION['language']]['course'][5]['img']; ?>" alt="<?php echo $modal[$_SESSION['language']]['course'][5]['alt']; ?>" title="<?php echo $modal[$_SESSION['language']]['course'][5]['title']; ?>" /></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $modal['fr']['generic']['closed']; ?></button>
			</div>
		</div>
	</div>
</div>

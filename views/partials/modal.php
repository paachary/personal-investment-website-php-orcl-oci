<?php

$msgType =	Session::get('msgType');

$msgArr = [];

if ($msgType === 'update') {
	$msgArr = MessagesController::updateMsg();
} elseif ($msgType === 'close') {
	$msgArr = MessagesController::closureMsg();
} elseif ($msgType === 'delete') {
	$msgArr = MessagesController::deleteMsg();
}

?>

<div class="modal">
	<div class="modal-header">
		<h3 class="modal-head"><?= $msgArr['title'] ?>!!</h3><img src="/images/warning-sign-30915_640.png" alt="Delete Warning" width="45" title="Delete Warning!!">
	</div>
	<div class="modal-body">
		<div><?= $msgArr['body'] ?></div>
		<div>You cannot undo this action!</div>
	</div>
	<div class="modal-footer">
		<button type="button" id="cancel" class="btn cancel" value="Cancel">Cancel</button>
		<button type="button" id="delete" class="btn delete" value="<?= $msgArr['button'] ?>"><?= $msgArr['button'] ?></button>
	</div>
</div>
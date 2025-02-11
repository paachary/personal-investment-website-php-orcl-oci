<?php
@$navigation = Session::get('BACK');
?>

<div class="buttons">
	<div class="btn-back">
		<a href="<?= $navigation ?>">Back</a>
	</div>
	<button name="submit" type="submit" id="submit" formmethod="POST" title="Submit" class="btn-submit button" value="Submit">
		Submit
	</button>
	<button name="reset" type="reset" id="reset" formmethod="POST" title="Reset" class="btn-reset button" value="Reset">
		Reset
	</button>
</div>
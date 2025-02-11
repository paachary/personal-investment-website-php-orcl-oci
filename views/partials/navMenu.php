<?php
$user = Session::get('user');
?>
<div class="nav">
	<ul>
		<?php if (Session::has('user')): ?>
			<li><a href="#"><span>Accounts</span></a>
				<ul>
					<li><a id="banks" href="#" value="banks">Bank Details</a></li>
					<?php if (strtolower($user['userName']) !== 'sysadmin'): ?>
						<li><a id="newAcct" href="#" value="newAcct">Add New Account</a></li>
						<li><a value="editAcct" id="editAcct" href="#">Edit Your Account</a></li>
						<li><a value="viewAcct" id="viewAcct" href="#">View Your Accounts</a></li>
					<?php else: ?>
						<li><a value="viewAcct" id="viewAcct" href="#">View All Accounts</a></li>
					<?php endif; ?>
				</ul>
			</li>
			<li><a href="#"><span>Investments</span></a>
				<ul>
					<li><a id="instrumentTypes" href="#" value="instrumentTypes">Instrument Types</a></li>
					<?php if (strtolower($user['userName']) !== 'sysadmin'): ?>
						<li><a id="newInvst" value="newInvst" href="#">Add New Investment</a></li>
						<li><a id="viewInvst" value="viewInvst" href="#">View Your Investments</a></li>
					<?php else: ?>
						<li><a id="viewInvst" value="viewInvst" href="#">View All Investments</a></li>
					<?php endif; ?>
				</ul>
			</li>
			<li><a href="#"><span>Reports</span></a>
				<ul>
					<li><a id="activeInvestmentsRept" value="activeInvestmentsRept" href="#">Active Investments Report</a></li>
					<li><a id="mnthlyDebitRpt" value="mnthlyDebitRpt" href="#">Monthly Debit Report</a></li>
				</ul>

			</li>
			<li><a href="#">
					<span><?= Session::get('user')['userName'] ?></span></a>
				<ul>
					<li><a id="profile" value="profile" href="/users">View Profile Details</a></li>
					<li><a id="editProfile" value="editProfile" href="/users/edit">Edit Profile Details</a></li>
					<li><a id="passwordReset" value="passwordReset" href="/users/passwordReset">Reset Password</a></li>
					<li>
						<form method="post" id="logoutForm" action="/auth/logout">
							<a id="logout" value="logout" href="#">Logout</a>
						</form>
					</li>
				</ul>
			</li>
		<?php else: ?>
			<li><a href="/auth/login"><span>Login</span></a></li>
			<li><a href="/auth/register"><span>Register</span></a></li>
		<?php endif; ?>
	</ul>
</div>
<?= loadPartial('acctSearch'); ?>
<div class="overlay hidden"></div>
<script src="/scripts/navMenu.js"></script>
<div class="menu has-background-link-light">
	<div class="menu-label">
		<figure id="avatar" class="image is-64x64">
			<img src="{{ asset('img/Blank.JPG') }}" class="is-rounded" alt="Profile Picture">
		</figure>
		<span class="is-size-5 has-text">Username</span>
	</div>
	<ul class="menu-list">
		<li>
			<a>
				<span class="icon">
					<i class="fas fa-columns"></i>
				</span>
				<span>Dashboard</span>
			</a>
		</li>
		<li>
			<a>
				<span class="icon">
					<i class="fas fa-clock"></i>
				</span>
				<span>Lab Schedules</span>
			</a>
		</li>
		<li>
			<a>
				<span class="icon">
					<i class="fas fa-users"></i>
				</span>
				<span>Accounts</span>
			</a>
		</li>
		<li>
			<a>
				<span class="icon">
					<i class="fas fa-stream"></i>
				</span>
				<span>Logs</span>
			</a>
		</li>
	</ul>
	<ul id="logout" class="menu-list">
		<li>
			<form>
				<button class="button is-link is-light is-fullwidth has-text-dark">
					<span class="icon">
						<i class="fas fa-sign-out-alt"></i>
					</span>
					<span>Log Out</span>
				</button>
			</form>
		</li>
	</ul>
</div>
